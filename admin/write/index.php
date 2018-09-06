<?php
require '../../utils/functions.php';
require '../../class/Autoloader.php';
Autoloader::register();
?>
<?php
// require '../../utils/functions.php';
session_start();
protect();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Ecrire un chapitre</title>
    <link rel="stylesheet" href="../../lib/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../src/css/common-admin.css">
    <link rel="stylesheet" href="write.css">
    <script src="../../lib/js/jquery.js"></script>
    <script src="../../lib/js/bootstrap.js"></script>
    <script src="../../lib/js/bootstrap.bundle.js"></script>
    <script src="write.js"></script>
</head>
<body>
<div id="pageContainer">
    <!-- Menu -->
    <section id="menuContainer">
        <div id="menuContainerHeader">
            <div id="menuText">Menu</div>
        </div>
        <div id="menuContainerBody">
            <div id="menuListContainer">
                <div class="menu-item"><i class="fas fa-tachometer-alt"></i> <a href="../dashboard">Tableau de bord</a></div>
                <div class="menu-item"><i class="fas fa-edit"></i> <a href="#">Ecrire</a></div>
                <div class="menu-item"><i class="fas fa-clipboard-check"></i> <a href="#">Modérer</a></div>
                <div class="menu-item"><i class="fas fa-sign-out-alt"></i> <a href="../lock.php">Déconnexion</a></div>
            </div>
        </div>
        <!-- <p>Dashboard</p>
        <a href="../lock.php">Déconnexion</a> -->
    </section>
    <section id="viewContainer">
    
    </section>
</div>
</body>
</html>