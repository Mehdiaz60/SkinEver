<?php
// ! = =
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}
$inputJSON = file_get_contents('php://input'); // récupération du corps de la requete HTTP
$skin = json_decode($inputJSON, TRUE);
// Vérifier la validité du champion et l'ajouter:
// En BDD -> C'est ce qu'il faut faire dans un vrai projet
// === Dans un fichier ===
$file_name = "data.json";
$skins = [];
if (file_exists($file_name)) {
    // chargement de la liste des champions depuis le fichier
    $skins = json_decode(file_get_contents($file_name), true);
}

$i=0;
while ($i<count($skins)){
    if ($skins[$i]["name"] == $skin["name"]){
        $skins[$i]["skills"] = $skin["skills"];
        $skins[$i]["dlc"] = $skin["dlc"];
        $skins[$i]["img"] = $skin["img"];
    }else{
        header("HTTP/1.1 400 BAD REQUEST");
    }
    $i++;
}
//echo $skins['name'];

// Mise à jour du fichier
file_put_contents($file_name, json_encode($skins));