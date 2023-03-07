<?php

namespace App\Crypt;

interface Crypt
{
    public function myEncrypt(string $plaintext);
    public function myDecrypt(string $ciphertext);
}