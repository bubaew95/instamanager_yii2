<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 30/09/2019
 * Time: 21:37
 */

namespace common\components\encryption;

class Encryption
{
    public static function encrypt($key, $text)
    {
        $ivlen  = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv     = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($text, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac   = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $ciphertext;
    }

    public static function decrypt($key, $text)
    {
        $c      = base64_decode($text);
        $ivlen  = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv     = substr($c, 0, $ivlen);
        $hmac   = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $text   = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        if (hash_equals($hmac, $calcmac))  {
            return $text;
        }
        return false;
    }

}
