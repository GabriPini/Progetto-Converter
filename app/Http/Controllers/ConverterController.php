<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\ConvertApi;


class ConverterController extends Controller
{


    /**
 * Store a new blog post.
 *
 * @param  \App\Http\Requests\StorePostRequest  $request
 * @return Illuminate\Http\Response
 */
public function __invoke(FileRequest $request , ConvertApi $convert)
{

    $fileName = $request->File->getClientOriginalName();
    $originalFile = $request->File;

    $type = $request->File->getClientMimeType();
    $size = $request->File->getSize();

    $secret ='ltE5TH69gYyu4IKI';
    $from_format = substr($type, strrpos($type, '/') + 1);
    $to_format = $request->selectType;


 /*    $result = convert_api( $secret, $to_format, $originalFile, array('FileName' => $fileName, 'StoreFile' => 'true')); */
  /*   $converted_file_url = $result->Files[0]->Url; */


   /*  return  $converted_file_url; */

}
}
