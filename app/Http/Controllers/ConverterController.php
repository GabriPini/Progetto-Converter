<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Services\ConvertApi;
use Illuminate\Http\Request;



class ConverterController extends Controller
{

public function submit(Request $request)
{


    $fileName = $request->config;
    return   $fileName;
/* Cercando di vedere cosa mi torna  */

/*     $originalFile = $request->File;

    $type = $request->File->getClientMimeType();
    $size = $request->File->getSize();

    $secret ='ltE5TH69gYyu4IKI';
    $from_format = substr($type, strrpos($type, '/') + 1);
    $to_format = $request->selectType;

    $fileConvertito = new ConvertApi();

    $response = $fileConvertito->convert_api($secret, $to_format, $originalFile, array('FileName' => $fileName, 'StoreFile' => 'true'));

dd($response);
 */

}
}
