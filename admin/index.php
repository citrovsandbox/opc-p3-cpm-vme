<?php
session_start();
// Si l'administrateur est connecté on redirige /dashboard
if(isset($_SESSION['username'])) {
    header('Location: ./dashboard');
// Sinon on redirige vers /auth
} else {
    header('Location: ./auth');
}