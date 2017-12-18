<?php
function curl(string $source){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $source);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($source);
    curl_close($ch);
    return $data; 
}