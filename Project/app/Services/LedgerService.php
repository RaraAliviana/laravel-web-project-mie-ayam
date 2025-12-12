<?php

namespace App\Services;

use App\Models\BlockLedger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LedgerService
{
    /**
     * Buat blok baru di ledger secara atomic.
     * $payload: array data yang ingin dicatat (akan diserialisasi ke JSON)
     * $relatedModel: optional [model_type, model_id]
     */
    public static function createBlock(array $payload, ?array $relatedModel = null): BlockLedger
    {
        // serialisasi data — pastikan konsisten ordering supaya hash deterministic
        // gunakan JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE untuk readability
        $jsonData = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


        // Gunakan transaksi dan lock untuk mencegah race pada pengambilan previous hash
        return DB::transaction(function () use ($jsonData, $relatedModel) {
            // Ambil blok terakhir dengan FOR UPDATE agar di-lock (InnoDB)
            $last = DB::table('block_ledgers')->lockForUpdate()->latest('id')->first();

            $previousHash = $last->current_hash ?? '';

            $timestamp = now()->toIso8601String();

            // Rumus: SHA256(Data + Timestamp + PreviousHash)
            // Gunakan concat string: JSON + '|' + timestamp + '|' + previousHash
            $toHash = $jsonData . '|' . $timestamp . '|' . $previousHash;
            $currentHash = hash('sha256', $toHash);

            $insert = [
                'data' => $jsonData,
                'block_timestamp' => now(),
                'previous_hash' => $previousHash,
                'current_hash' => $currentHash,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (!empty($relatedModel) && isset($relatedModel['model_type'])) {
                $insert['model_type'] = $relatedModel['model_type'];
                $insert['model_id'] = $relatedModel['model_id'] ?? null;
            }

            $id = DB::table('block_ledgers')->insertGetId($insert);

            return BlockLedger::find($id);
        });
    }
}
