<?php
require '../utils/functions.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $bdd = quickConnect();
    $req = $bdd->prepare("SELECT * FROM admins WHERE username=:username");
    $req->bindValue(":username", $_POST['username']);
    $req->execute();
    $User = $req->fetch();
    if($User['password'] === md5($_POST['password'])) {
        session_start();
        $_SESSION['username'] = $User['username'];
        echo '{"code": 200, "details" : "Bienvenue, ' . $User['username'] . '."}';
    } else {
        echo '{"code": 403, "details" : "Accès refusé. Combinaison incorrecte."}';
    }
} else {
    echo '{"code": 500, "details" : "Erreur serveur. L\'utilisateur ou le mot de passe n\'a pas été renseigné."}';
}