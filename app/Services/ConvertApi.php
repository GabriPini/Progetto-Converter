<?php
namespace App\Services;

use CURLFile;
use Exception;

class ConvertApi
{

  function convert_api($secrets, $format, $path_to_file, $parameters = array()) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL, "http://v2.convertapi.com/to/{$format}?secret={$secrets}");
        $parameters['file'] = strpos($path_to_file, 'http') !== 0 ? new CURLFile($path_to_file) : $path_to_file;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);
        if ($response && $httpcode >= 200 && $httpcode <= 299) {
          return json_decode($response);
        } else {
          throw new Exception($error . $response, $httpcode);
        }


      }


}


