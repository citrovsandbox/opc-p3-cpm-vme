<?php
require '../utils/functions.php';
require '../class/Comment.php'; 

$Comment = new Comment;

$commentId = htmlspecialchars($_POST['commentId']);

$Comment->flag($commentId);

