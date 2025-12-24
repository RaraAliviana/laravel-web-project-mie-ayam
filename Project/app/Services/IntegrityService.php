<?php

namespace App\Services;

use App\Models\IntegrityLog;

class IntegrityService
{
    // Simpan blok baru
    public function log(array $payload)
    {
        $lastBlock = IntegrityLog::orderBy('id', 'desc')->first();

        $previousHash = $lastBlock->hash ?? null;

        $currentHash = hash('sha256', json_encode([
            'payload' => $payload,
            'previous_hash' => $previousHash,
        ]));

        return IntegrityLog::create([
            'payload' => $payload,
            'hash' => $currentHash,
            'previous_hash' => $previousHash,
        ]);
    }

    // Verifikasi semua blok
    public function verify()
{
    $blocks = IntegrityLog::orderBy('id')->get();

    $results = [];
    $isChainValid = true;

    foreach ($blocks as $index => $block) {

        // gunakan previous_hash dari database (INI PENTING)
        $expectedPreviousHash = $index === 0 ? null : $blocks[$index - 1]->hash;

        // rehash berdasarkan DATA DI DB
        $rehashed = hash('sha256', json_encode([
            'payload' => $block->payload,
            'previous_hash' => $expectedPreviousHash,
        ]));

        $valid = ($rehashed === $block->hash);

        if (!$valid) $isChainValid = false;

        $results[] = [
            'block' => $block,
            'rehashed' => $rehashed,
            'valid' => $valid,
        ];
    }

    return [
        'results' => $results,
        'isChainValid' => $isChainValid,
    ];
}
}
