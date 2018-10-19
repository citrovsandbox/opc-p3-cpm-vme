<?php
require '../utils/functions.php';

$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);

$bdd = quickConnect();

$req = $bdd->prepare("INSERT INTO chapters VALUES ('', :title, :content, NOW())");

$req->bindValue(':title', $title);
$req->bindValue(':content', $content);

if($req->execute()) {
    echo '{"code":200, "details": "Nouveau chapitre posté avec succès !"}';
} else  {
    echo '{"code":500, "details": "Erreur lors du post du nouveau chapitre."}';
}