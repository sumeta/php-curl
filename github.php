<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://github.com/sumeta');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false); 
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,1);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
$result = curl_exec($ch);
print_r($result);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
