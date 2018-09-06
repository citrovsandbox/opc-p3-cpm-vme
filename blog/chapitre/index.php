<?php
require '../../utils/functions.php';
require '../../class/Autoloader.php';
Autoloader::register(); 
$Chapitre = new Chapitre;
$chapitre = $Chapitre->getSpecific($_GET['id']);

$Comment = new Comment;
$req = $Comment->get($_GET['id']);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Jean Forteroche</title>
    <link rel="stylesheet" href="../../lib/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../src/css/common-blog.css">
    <link rel="stylesheet" href="chapitre.css">
    <script src="../../lib/js/jquery.js"></script>
    <script src="../../lib/js/bootstrap.js"></script>
    <script src="../../lib/js/bootstrap.bundle.js"></script>
    <script src="chapitre.js"></script>
</head>
<body>
<div id="pageContainer">
    <!-- Partie sur le menu -->
    <nav id="headerContainer">
        <div id="menuContainer">
            <div class="menu-item">
                <a href="../livre" class="menu-text">Le livre</a></p>
            </div>
            <div class="menu-item">
                <a href="../about" class="menu-text">L'auteur</a></p>
            </div>
            <div class="menu-item">
                <a href="../contact" class="menu-text">Le contact</a></p>
            </div>
        </div>
    </nav>
    <!-- Zone bannière -->
    <section id="banniereContainer">
        <div id="titleContainer">
            <!-- <h1>Chapitre I — Un génie qui sent fout</h1> -->
            <h2><?= $chapitre['ch_title'] ?></h2>
        </div>
    </section>
    <!-- Zone du contenu du chapitre -->
    <section id="contentContainer">
        <h3><?= $chapitre['ch_title'] ?></h3>
        <p>
            <?= $chapitre['ch_content'] ?>
        </p>
    </section>

    <div class="separator"></div>
    <!-- Zone des commentaires -->
    <div id="headerCommentsContainer">
        <div id="headerCommentsContainerLeft">
            Commentaires
        </div>
        <div id="headerCommentsContainerRight">
            <div id="menuToggle"><i class="fas fa-chevron-circle-up"></i></div>
        </div>
    </div>
    <section id="commentsContainer">
        <!-- Un commentaire unitaire -->
        <?php
        while($comment = $req->fetch()) {
        ?>
        <div class="comment">
            <div class="comment-header">
                <h6><?= $comment['com_author'] ?> <span class="comment-date">le <?php $displayDate = new DateTime($comment['com_date']); echo $displayDate->format('d/m/Y'); ?></span></h6>
                <div class="comment-flag" data-flag="<?= $comment['com_id'] ?>" data-state="<?php if($comment['com_flag'] == 0) { echo 'unreported';}else { echo 'reported';}?>"><i class="far fa-flag" title="Commentaire abusif ? Cliquez pour signaler"></i></div>
            </div>
            <div class="comment-content">
                <p><?= $comment['com_content'] ?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </section>
    <div class="separator"></div>
    <!-- Zone de saisie d'un commentaire -->
    <section id="commentWriteContainer">
        <form id="formContainer" method="POST" action="../../api/postComment.php">
            <!-- Pseudo -->
            <h6>Laisser un commentaire</h6>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Votre nom</span>
                </div>
                <input name="author" id="usernameInput" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <!-- Textarea -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Commentaire</span>
                </div>
                <textarea name="content" id="commentTextarea" class="form-control" aria-label="With textarea"></textarea>
            </div>
            <input name="chapterid" type="text" value="<?= $_GET['id'] ?>" style="display:none;">
            <!-- Submit -->
            <button id="submitButton" type="submit" class="btn btn-info">Poster</button>
        </form>
    </section>
    <div class="separator"></div>
</div>
</body>
</html>