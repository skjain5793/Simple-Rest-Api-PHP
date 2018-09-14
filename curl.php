<?php
 
function insert(){
$ch = curl_init();
$curlConfig = array(
    CURLOPT_URL            => "http://localhost/restapi/api.php",
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS     => array(
        'username' => 'vishal'
    )
);
curl_setopt_array($ch, $curlConfig);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
}



function fetch(){
$ch = curl_init();
$curlConfig = array(
    CURLOPT_URL            => "http://localhost/restapi/api.php",
    CURLOPT_RETURNTRANSFER => true,
);
curl_setopt_array($ch, $curlConfig);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
}


function delete_user(){
$url = "http://localhost/restapi/api.php/sanjeev";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $result;
}


function update(){
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://localhost/restapi/api.php/raghav");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "name=newraghav");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));


// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec ($ch);

curl_close ($ch);
echo $result;
}

delete_user();

?>