<?php

function redirectToDashboardIfLoggedIn () {
    header('Location : ../dashboard');
}
function quickConnect () {
    try
    {
        return $bdd = new PDO('mysql:host=localhost;dbname=sandbox;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        return die('Erreur : ' . $e->getMessage());
    }
}
function protect () {
    if(!isset($_SESSION['username'])) {
        header('Location : ../index.php');
    } else {
        // echo $_SESSION['username'];
    }
}