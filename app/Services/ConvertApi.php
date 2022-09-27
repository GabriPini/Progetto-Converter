<!-- Endpoint della Api: https://v2.convertapi.com/{from_format}/to/{to_format}?secret={secret} e dovrà avere I parametri: file (il file da convertire), StoreFile: true
    - "L’utente carica il documento in formato pdf o doc da pc e potrà scaricare un documento convertito in doc docx jpg png e html
-->

<?php
/*
define("UPLOAD_DIR", "./tmp/");
$rest_url="http://do.convertapi.com/Pdf2Image";

$up_file=UPLOAD_DIR.rand(100,999)."_".basename($_FILES['fileField']['name']);
if (!move_uploaded_file($_FILES['fileField']['tmp_name'], $up_file)) {
    die("Possible file upload attack!");
}

$cfile=new CURLFile($up_file);

$params=array(
    "ApiKey" => 11111111,
    "OutputFormat" => "png",
    "OutputFileName" => "converted.png",
    "File" => $cfile
    );

$ch=curl_init($rest_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
$res=curl_exec($ch);
$headers=curl_getinfo($ch);
curl_close($ch);

echo "<pre>";
print_r($headers);
var_dump($res); */
