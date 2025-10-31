<?php

namespace App\Helpers;

class EncryptHelper
{
    // Kunci AES dan IV (harus 16 karakter untuk AES-128-CBC)
    private static string $aesKey = 'mySuperSecretKey123'; // 16 karakter
    private static string $aesIV = 'mySecretIV123456';     // 16 karakter

    // ===== AES Encrypt =====
    private static function aesEncrypt(string $data): string
    {
        return base64_encode(openssl_encrypt($data, 'AES-128-CBC', self::$aesKey, OPENSSL_RAW_DATA, self::$aesIV));
    }

    // ===== AES Decrypt =====
    private static function aesDecrypt(string $encrypted): string
    {
        return openssl_decrypt(base64_decode($encrypted), 'AES-128-CBC', self::$aesKey, OPENSSL_RAW_DATA, self::$aesIV);
    }

    // ===== Caesar Cipher Encrypt =====
    private static function caesarEncrypt(string $data, int $shift = 5): string
    {
        $result = '';
        foreach (str_split($data) as $char) {
            $ascii = ord($char);
            $result .= chr(($ascii + $shift) % 256);
        }
        return $result;
    }

    // ===== Caesar Cipher Decrypt =====
    private static function caesarDecrypt(string $data, int $shift = 5): string
    {
        $result = '';
        foreach (str_split($data) as $char) {
            $ascii = ord($char);
            $result .= chr(($ascii - $shift + 256) % 256);
        }
        return $result;
    }

    // ===== Gabungan Dua Lapis Enkripsi =====
    public static function encryptTwoLayer(string $data): string
    {
        $first = self::caesarEncrypt($data);
        return self::aesEncrypt($first);
    }

    // ===== Gabungan Dua Lapis Dekripsi =====
    public static function decryptTwoLayer(string $encrypted): string
    {
        $first = self::aesDecrypt($encrypted);
        return self::caesarDecrypt($first);
    }
}