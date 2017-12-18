<?php
function curl(string $source){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $source);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
$subject = "https://www.otomoto.pl/oferta/bmw-seria-3-328i-xdrive-gran-turismo-m-pakiet-ID6zniRZ.html";
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
    $pattern = "#price__number\">.*<#";
    preg_match($pattern, $data, $matches);
    $price = $matches[0];
    $patternToReplace = "#[^0-9]+#";
    $replaced = preg_replace($patternToReplace, "", $price);
    return "<br>Price: ".$replaced;

}
echo pregMatchPrice($data);
function pregMatchMainParameters(string $data){
    $pattern = "#params__item\">\s+.*[^<]#";
    preg_match_all($pattern, $data, $matches);
    foreach ($matches as $value)
    {
         $pattern = "#params__item\">#";
         $replaced = preg_replace($pattern, "", $value);
    }
    $year = $replaced[0];
    $milage = $replaced[1];
    $typeOfFuel = $replaced[2];
    $typeOfCar = $replaced[3];
    $info = ["year" =>$year, "milage" =>$milage, "fuel" =>$typeOfFuel, "type" =>$typeOfCar];
    return $info;
}
$parameters = pregMatchMainParameters($data);
foreach ($parameters as $key =>$value){
    echo "<br>".$key. ': '.$value;
}
function pregMatchEngineCode(string $data){
    $pattern = "#title=\"[0-9]{3}#msiU";
    preg_match($pattern, $data, $matches);
    $engineCode = $matches[0];
    $pattern2 = "#[^0-9]+#";
    $code = preg_replace($pattern2, "", $engineCode);
    return "<br>Engine Code: ".$code;
}
echo pregMatchEngineCode($data);
function pregMatchCylinderCapacity(string $data){
    $pattern = "#params__value\">\s+.*cm3#";
    preg_match($pattern, $data, $matches);
    $cylinderCapacity = $matches[0];
    $pattern2 = "#[^0-9]{4}#";
    $capacity = preg_replace($pattern2, "", $cylinderCapacity);
    return "<br>Cylinder Capacity: ". $capacity;
}
echo pregMatchCylinderCapacity($data);
function pregMatchVIN(string $data){
    $pattern = "#VIN</span>\s+<div class=\"offer-params__value\">.*</div#msiU";
    preg_match($pattern, $data, $matches);
    $number = $matches[0];
    $pattern2= "#(VIN)([^A-Z0-9]+)#";
    $vin = preg_replace($pattern2,"", $number);
    return "<br>VIN: ". $vin;
}
echo pregMatchVIN($data);
echo "<br>";
function pregMatchHorsePower(string $data){
    $pattern = "#Moc</span>\s<div class=\"offer-params__value\">\s.*</div#";
    preg_match($pattern, $data, $matches);
    $power = $matches[0];
    $pattern2 = "#[^0-9]+#";
    $horsePower = preg_replace($pattern2, "", $power);
    return "<br>Horse power: ".$horsePower;
}
echo pregMatchHorsePower($data);

