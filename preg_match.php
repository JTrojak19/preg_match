<?php
function curl(string $source){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $source);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
$subject = "https://www.otomoto.pl/oferta/bmw-seria-4-leasing-do-przejecia-cesja-zgoda-na-ubezpieczenie-obce-ID6zoTxu.html";
$data = curl($subject);
function pregMatchName(string $data){
    $pattern = "#big-text\">\s+[A-Z]+#";
    preg_match($pattern, $data, $matches);
    $name = $matches[0];
    $patternToReplace = "#[^A-Z]+#";
    $replaced = preg_replace($patternToReplace, "", $name);
    return "Name: ".$replaced;
}
echo pregMatchName($data);
function pregMatchPrice(string $data){
    $pattern = "#price__number\">.*<+#";
    preg_match($pattern, $data, $matches);
    $price = $matches[0];
    $patternToReplace = "#[^0-9]+#";
    $replaced = preg_replace($patternToReplace, "", $price);
    return "<br>Price: ".$replaced;

}
echo pregMatchPrice($data);



