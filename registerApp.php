<?php require_once(__DIR__ . DIRECTORY_SEPARATOR . "db" . DIRECTORY_SEPARATOR . "connectdb.php");
$connectionDB = getConnection();
// $_POST["nom"] = "Ba";
// $_POST["prenom"] = "bala";
// $_POST["numcard"] = "201909HQMM";
// $_POST["email"] = "boubacarcidi77@gmail.com";
// $_POST["passwords"] = "bala@1";
$existance = false;

if (isset($_POST["nom"], $_POST["prenom"], $_POST["numcard"], $_POST["email"], $_POST["passwords"])) {
    $nom = $_POST["nom"];
    $prenom =  $_POST["prenom"];
    $numcard = strtolower($_POST["numcard"]);
    $email = strtolower($_POST["email"]);
    $passwords = $_POST["passwords"];
    $p_connectionDB = $connectionDB->prepare("select numcard from etudiants where numcard=:numcard");
    $p_connectionDB->execute(array("numcard" => $numcard));
    $r_connectionDB = $p_connectionDB->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($r_connectionDB);

    if (isset($r_connectionDB[0]["numcard"]) && !is_null($r_connectionDB[0]["numcard"])) {
        $result = "Le numéro de carte: ''" . $numcard . " " . "''existe déja"; //r_connectionDB[0]["numcard"];
        $info = ["info" => $result];
        echo json_encode($info);
        $existance = true;
    } else {
        $p_connectionDB = $connectionDB->prepare("select email from etudiants where email=:email");
        $p_connectionDB->execute(array("email" => $email));
        $r_connectionDB = $p_connectionDB->fetchAll(PDO::FETCH_ASSOC);
        //  var_dump($r_connectionDB);
        if (isset($r_connectionDB[0]["email"]) && !is_null($r_connectionDB[0]["email"])) {
            $result = "Votre email '' " . $email . " " . "'' existe deja"; //r_connectionDB[0]["numcard"];
            $info = ["info" => $result];
            echo json_encode($info);
            $existance = true;
        }
    }

    if (!$existance) {
        $p_connectionDB = $connectionDB->prepare("insert into Etudiants (nom, prenom,  numcard, email, passwords) values(:nom, :prenom, :numcard, :email, :passwords)");
        $r_connectionDB =  $p_connectionDB->execute(array("nom" => $nom, "prenom" => $prenom, "numcard" => $numcard, "email" => $email, "passwords" => $passwords));
        if ($r_connectionDB) {
            $info = array("info" => "success");
            echo json_encode($info);
        }
    }
} else {
    echo json_encode(array("info" => "les parametre n'exist pas"));
}
