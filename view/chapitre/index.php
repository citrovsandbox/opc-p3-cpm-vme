<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Jean Forteroche</title>
    <link rel="stylesheet" href="../../lib/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../src/css/common-blog.css">
    <link rel="stylesheet" href="../view/chapitre/chapitre.css">
    <script src="../../lib/js/jquery.js"></script>
    <script src="../../lib/js/bootstrap.js"></script>
    <script src="../../lib/js/bootstrap.bundle.js"></script>
    <script src="../../lib/js/Hermes.js"></script>
    <script src="../view/chapitre/chapitre.js"></script>
</head>
<body>
<div id="pageContainer">
    <!-- Partie sur le menu -->
    <nav id="headerContainer">
        <div id="menuContainer">
            <div class="menu-item">
                <a href="./livre.php" class="menu-text">Le livre</a></p>
            </div>
            <div class="menu-item">
                <a href="./about.php" class="menu-text">L'auteur</a></p>
            </div>
            <div class="menu-item">
                <a href="./contact.php" class="menu-text">Le contact</a></p>
            </div>
        </div>
    </nav>
    <!-- Zone bannière -->
    <section id="banniereContainer">
        <div id="titleContainer">
            <!-- <h1>Chapitre I — Un génie qui sent fout</h1> -->
            <h2><?= $oChapter->getTitle() ?></h2>
        </div>
        <div id="teleporter" class="bring-me-to-content-please" title="Lire le chapitre">
            <div class="bring-me-icon"><i class="fas fa-arrow-down"></i></div>
        </div>
    </section>
    <!-- Zone du contenu du chapitre -->
    <section id="contentContainer">
        <h3><?= $oChapter->getTitle() ?></h3>
        <p>
            <?= $oChapter->getContent() ?>
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
        foreach($aComments as $oComment) {
        ?>
        <div class="comment">
            <div class="comment-header">
                <h6><?= $oComment->getAuthor() ?> <span class="comment-date">le <?php $displayDate = new DateTime($oComment->getDate()); echo $displayDate->format('d/m/Y'); ?></span></h6>
                <div class="comment-flag" data-flag="<?= $oComment->getId() ?>" data-state="<?php if($oComment->getFlag() == 0) { echo 'unreported';}else { echo 'reported';}?>"><i class="far fa-flag" title="Commentaire abusif ? Cliquez pour signaler"></i></div>
            </div>
            <div class="comment-content">
                <p><?= $oComment->getContent() ?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </section>
    <div class="separator"></div>
    <!-- Zone de saisie d'un commentaire -->
    <section id="commentWriteContainer">
        <form id="formContainer">
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

<!-- INFORMATION MODAL -->
<div id="informationModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:#179FB5;"><i class="fas fa-info-circle"></i> Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="infoRes"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
<!-- ATTENTION MODAL -->
<div id="attentionModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:#179FB5;"><i class="fas fa-exclamation-triangle"></i> Avertissement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Vous êtes sur le point de reporter un commentaire. Cette action signifie que vous allez signaler ce commentaire comme étant un contenu inapproprié.</p>
        <p>Êtes-vous sûr de vouloir continuer ?</p>
      </div>
      <div class="modal-footer">
        <button id="reportBtn" type="button" class="btn btn-info" data-dismiss="modal">Signaler quand même</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>