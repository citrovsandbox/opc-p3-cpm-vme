<?php
require '../../utils/functions.php';
require '../../class/Autoloader.php'; 
Autoloader::register(); 
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Jean Forteroche</title>
    <link rel="stylesheet" href="../../lib/css/bootstrap.css">
    <link rel="stylesheet" href="../../src/css/common-blog.css">
    <link rel="stylesheet" href="livre.css">
    <script src="../../lib/js/jquery.js"></script>
    <script src="../../lib/js/bootstrap.js"></script>
    <script src="../../lib/js/bootstrap.bundle.js"></script>
    <script src="livre.js"></script>
</head>
<body>
<div id="pageContainer">
    <!-- Partie sur le menu -->
    <nav id="headerContainer">
        <div id="menuContainer">
            <div class="menu-item">
                <a href="#" class="menu-text">Le livre</a></p>
            </div>
            <div class="menu-item">
                <a href="../about" class="menu-text">L'auteur</a></p>
            </div>
            <div class="menu-item">
                <a href="../contact" class="menu-text">Le contact</a></p>
            </div>
        </div>
    </nav>

    <section id="banniereContainer">
        <div id="titleContainer">
            <h1>Jean Forteroche</h1>
            <h2>Billet simple pour l'Alaska</h2>
        </div>
    </section>

    <section id="chapitresContainer">
        <?php
        $Chapitre = new Chapitre;
        $Comment = new Comment;
        $req = $Chapitre->get();
        while($chapitre = $req->fetch()) {
        ?>
        <div class="chapitre-container">
            <div class="chapitre-img"></div>
            <div class="chapitre-aside" onclick="window.location.href = '../chapitre?id=<?= $chapitre['ch_id'] ?>'">
                <div id="chapter-<?= $chapitre['ch_id']?>" class="chapitre-aside-inside">
                    <div class="chapitre-aside-inside-top">
                        <?= $chapitre['ch_title'] ?>
                    </div>
                    <div class="chapitre-aside-inside-bottom">
                        <div class="comment-container">
                            <span class="badge badge-pill badge-primary iced"> <?= $Comment->forChapter($chapitre['ch_id']) ?> Commentaires</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </section>
</div>
</body>
</html>