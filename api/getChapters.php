<?php
require '../utils/functions.php';

$title = $_GET['title'];

$bdd = quickConnect();

$req = $bdd->prepare("SELECT * FROM chapters WHERE ch_title LIKE :title");

$req->bindValue(':title', '%' . $title . '%');

$req->execute();

$results = $req->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($results);

echo $json;
// echo json_encode($_GET);
// echo "{'title':'test'}";