<?php
session_start();
// Si l'administrateur est connecté on redirige /dashboard
if(isset($_SESSION['username'])) {
    header('Location: ./dashboard');
} else {
    header('Location: ./auth');
}