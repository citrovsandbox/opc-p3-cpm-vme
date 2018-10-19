<?php
require '../model/ChapitreManager.php';
$ChapitreManager = new ChapitreManager;
if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'get':
            if(!isset($_GET['chapterid'])) {
                $ChapitreManager->getAll();
            } else {
                $ChapitreManager->get($_GET['chapterid']);
            }
        break;
        case 'post':
            // todo
        break;
        case 'update':
            // todo
        break;
        case 'delete':
            // todo
        break;
        default:
        echo '{"code":500, "details":"Seules les actions get/post/update/delete sont supportées.", "data":[]}';
    }
} else {
    echo '{"code":500, "details":"Merci de renseigner une action.", "data":[]}';
}


