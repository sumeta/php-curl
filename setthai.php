<?php

$symbol = $_GET['symbol'];
$curl = curl_init("https://marketdata.set.or.th/mkt/stockquotation.do?symbol='$symbol'&ssoPageId=1&language=en&country=US");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$page = curl_exec($curl);
if(curl_errno($curl)):
	echo 'Erro: ' . curl_error($curl);
	exit;
endif;
curl_close($curl);

$DOM = new DOMDocument;
libxml_use_internal_errors(true);

if(!$DOM->loadHTML($page)):
	$erros = null;
	foreach (libxml_get_errors() as $error):
		$errors.= $error->message."\r\n"; 
	endforeach;

	libxml_clear_errors();
	print "LibXML Erros: \r\n$erros";
	return;
endif;

$Xpath = new DOMXPath($DOM);

$content = $Xpath->query('//*[@class="set-color-black"]')->item(0);
if(!$content){
	$content = $Xpath->query('//*[@class="set-color-green"]')->item(0);
}
if(!$content){
	$content = $Xpath->query('//*[@class="set-color-red"]')->item(0);
}
echo utf8_decode($content->textContent);