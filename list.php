<?php

if($_SERVER['REQUEST_METHOD'] !== 'GET'){
    header($_SERVEUR["SERVEUR_PROTOCOL"] . "405 Method Not Allowed", true, 405);
    exit;
}

header('Content-Type: application/json; charset=ustf-8');

$file = "data.json";
$skin = [];

if(file_exists($file)){
    $skin = json_decode(file_get_contents($file),true);
}

//$json_text = json_decode($skin);

$json_text = json_encode($skin);
echo $json_text;

?>