<?php
require '../utils/functions.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $bdd = quickConnect();
    $req = $bdd->prepare("SELECT * FROM admins WHERE username=:username");
    $req->bindValue(":username", $_POST['username']);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);
    error_log(json_encode($result), 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
    error_log($result['username'], 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
    if($result['password'] === md5($_POST['password'])) {
        session_start();
        $_SESSION['username'] = $_POST['username'];
        echo '{"code": 200, "details" : "Bienvenue, ' . $_POST['username'] . '."}';
    } else {
        echo '{"code": 403, "details" : "Accès refusé. Combinaison incorrecte."}';
    }
} else {
    echo '{"code": 500, "details" : "Erreur serveur. L\'utilisateur ou le mot de passe n\'a pas été renseigné."}';
}