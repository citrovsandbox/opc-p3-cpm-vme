<?php
require '../model/ChapitreManager.php';
require '../model/CommentManager.php';
$ChapitreManager = new ChapitreManager;
$CommentManager = new CommentManager;

if(isset($_GET['zone'])) {
    switch($_GET['zone']) {
        case 'chapitre':
        include('./zones/chapitre.php');
        break;
        case 'commentaire':
        include('./zones/commentaire.php');
        break;
        default:
        echo '{"code":500, "details":"La zone que vous avez saisie n\'est pas supportée. Essayez à nouveau avec les valeurs \'chapitre\' ou \'commentaire\'", "data":[]}';
    }
} else {
    echo '{"code":500, "details":"Merci de renseigner la zone.", "data":[]}';
}






