<?php

namespace App\Helpers;

use App\Models\TokenActivationKey;

class AuthenticateTokenActivationKey{

    static function authenticate_token_key(){

        $active_activation_key = TokenActivationKey::orderBy("id","DESC")->where("status",1)->first();
        $vendor_code = "CHUI";
        $app_code = "QMSTMA";
        $start_date = "20220101";
        $end_date = "20220601";
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891038713';
        $encryption_key = "c4e61774aa";
        $product_key = $app_code.$start_date.$end_date;

        // $encrypted_product_key = openssl_encrypt($product_key, $ciphering,$encryption_key, $options, $encryption_iv);

        // $new_key = $encrypted_product_key;
        // $key_digitis_counter = 5;
        // while ($key_digitis_counter < strlen($encrypted_product_key)){
        //     if ($key_digitis_counter == 5){
        //         $new_key = substr_replace($new_key, "-", $key_digitis_counter, 0);
        //         dd($new_key);
        //     }else{
        //         //
        //     }
        // }
        // dd(strlen($encrypted_receiver));

    }
}
