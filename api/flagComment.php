<?php
require '../utils/functions.php';
require '../class/Comment.php'; 

$Comment = new Comment;

$commentid = htmlspecialchars($_POST['commentid']);

$Comment->flag($commentid);

