<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . "db" . DIRECTORY_SEPARATOR . "connectdb.php");

$connectionDB = getConnection();
// $_POST['numCard'] = '201909HQM';
// $_POST['passwords'] = "wollaj@1";
if (isset($_POST['numCard']) && isset($_POST['passwords'])) {
    $numCard = $_POST['numCard'];
    $passwords = $_POST['passwords'];
    $p_connectionDB =  $connectionDB->prepare("SELECT * from Etudiants where passwords=:passwords and numCard=:numCard");
    $p_connectionDB->execute(array("passwords" => $passwords, "numCard" => $numCard));
    $r_connectionDB = $p_connectionDB->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($r_connectionDB);
    // exit(0);
    if (!empty($r_connectionDB) &&  $r_connectionDB[0]["passwords"] == $passwords) {
        $student = [
            "message" => "message_success",
            "content" => ["name" => $r_connectionDB[0]["nom"], "prenom" => $r_connectionDB[0]["prenom"], "numcard" => $r_connectionDB[0]["numcard"], "email" => $r_connectionDB[0]["email"]]
        ];
        echo json_encode($student);
    } else
        echo json_encode(array("message" => "message_error"));
} else
    echo json_encode(array("infos" => "Les information n'existe pas"));
