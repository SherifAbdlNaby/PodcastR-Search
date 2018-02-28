<?php
/**
 * Created by PhpStorm.
 * User: Sherif
 * Date: 27-Feb-18
 * Time: 12:14 AM
 */
namespace App\Utilities;

class ApiUtil{
    static function curlCall($url){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($curl);

        curl_close($curl);

        return $output ? json_decode($output, true) : false;
    }
}
