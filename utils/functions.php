<?php

function redirectToDashboardIfLoggedIn () {
    if(isset($_SESSION['username'])) {
        echo "<script>window.location.href = '../dashboard';</script>";
    }
}
function quickConnect () {
    try
    {
        return $bdd = new PDO('mysql:host=localhost;dbname=db747861774;charset=utf8', 'dbo747861774', 'Openclassrooms01!#');
    }
    catch (Exception $e)
    {
        return die('Erreur : ' . $e->getMessage());
    }
}
function protect () {
    if(!isset($_SESSION['username'])) {
        echo "<script>alert('Vous n\'êtes pas connecté. Vous allez être redirigé.');
        window.location.href = '../index.php';</script>";
        // header('Location : ../index.php');
    }
}