<?php

class AES {
    private static $encryptionKey = '#77-88++000%7------444-';  

    // Encrypt the data
    public static function encryption($data) {
        $iv = substr(hash('sha256', self::$encryptionKey), 0, 16); // 16-byte IV
        return openssl_encrypt($data, 'aes-256-cbc', self::$encryptionKey, 0, $iv);
    }

    // Decrypt the data
    public static function decryption($data) {
        $iv = substr(hash('sha256', self::$encryptionKey), 0, 16); // 16-byte IV
        return openssl_decrypt($data, 'aes-256-cbc', self::$encryptionKey, 0, $iv);
    }
}
