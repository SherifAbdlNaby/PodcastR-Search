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
        // OK cool - then let's create a new cURL resource handle
        $curl = curl_init();

        // Set URL to download
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($curl);

        // Close the cURL resource, and free system resources
        curl_close($curl);

        return json_decode($output, true);
    }
}
