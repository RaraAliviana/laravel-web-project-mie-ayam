<?php

namespace App\Helpers;

class AESEncryptor
{
    // 🔐 Kunci AES harus 32 karakter (AES-256)
    private static string $AES_KEY = 'MySecretKeyAES256Encryptor_123456';

    // 🔐 IV harus 16 karakter untuk AES-256-CBC
    private static string $AES_IV = 'MyAESInitVector1';

    /**
     * Encrypt menggunakan AES-256-CBC
     */
    public static function encrypt(string $plainText): string
    {
        $encrypted = openssl_encrypt(
            $plainText,
            'AES-256-CBC',
            self::$AES_KEY,
            0,
            self::$AES_IV
        );

        return base64_encode($encrypted);
    }

    /**
     * Decrypt AES-256-CBC
     */
    public static function decrypt(string $cipherText): string
    {
        return openssl_decrypt(
            base64_decode($cipherText),
            'AES-256-CBC',
            self::$AES_KEY,
            0,
            self::$AES_IV
        );
    }
}
