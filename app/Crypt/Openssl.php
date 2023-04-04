<?php

namespace App\Crypt;

class Openssl implements Crypt
{
    private const CIPHER = 'AES-128-CBC';
    private string $ivlen = '';
    private string $iv = '';

    public function __construct()
    {
        $this->ivlen = openssl_cipher_iv_length(self::CIPHER);
        $this->iv = substr(env('APP_KEY'), 0, $this->ivlen);
    }

    public function myEncrypt(string $plaintext)
    {
        $ciphertext = openssl_encrypt($plaintext, self::CIPHER, env('APP_KEY'), OPENSSL_RAW_DATA, $this->iv);
        return base64_encode($this->iv . hash_hmac('sha256', $ciphertext, env('APP_KEY'), true) . $ciphertext);
    }

    public function myDecrypt(string $ciphertext)
    {
        $base64Cipher = base64_decode($ciphertext);
        $iv = substr($base64Cipher, 0, $this->ivlen);
        $hmac = substr($base64Cipher, $this->ivlen, 32);
        $encryptText = substr($base64Cipher, $this->ivlen + 32);

        return openssl_decrypt($encryptText, self::CIPHER, env('APP_KEY'), OPENSSL_RAW_DATA, $iv);
    }
}
