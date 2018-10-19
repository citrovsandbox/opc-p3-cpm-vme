<?php
require '../utils/functions.php';
require '../class/Comment.php'; 

$Comment = new Comment;

$chapterid = htmlspecialchars($_POST['chapterid']);
$author = htmlspecialchars($_POST['author']);
$content = htmlspecialchars($_POST['content']);

$Comment->post($chapterid, $author, $content);

header('Location:../blog/chapitre?id=' . $chapterid);

