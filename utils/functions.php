<?php

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