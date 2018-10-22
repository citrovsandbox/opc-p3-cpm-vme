<?php
function escapeJsonString($value) { # list from www.json.org: (\b backspace, \f formfeed)
    $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c", "\"" );
    $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b", "\"");
    $result = str_replace($escapers, $replacements, $value);
    return $result;
}
if(isset($_GET['action'])) {
    switch($_GET['action']) {
        // GET
        case 'get':
            if(!isset($_GET['chapterId'])) {
                $aChapters = $ChapitreManager->getAll();
                $json = '[';
                foreach($aChapters as $oChapter) {
                    $json .= '{"id":' . $oChapter->getId() . ', "title":"' . $oChapter->getTitle() . '", "content":' . json_encode($oChapter->getContent()) . '},';
                }
                if(strlen($json) > 1) {
                    $jsondata = substr_replace($json ,"", -1);
                    $jsondata .= ']';
                } else {
                    $jsondata = $json . ']';
                }
                echo '{"code":200, "details":"Voici les données.", "data":' . $jsondata . '}';
            } else {
                $oChapter = $ChapitreManager->get($_GET['chapterId']);
                $jsondata = '{"id":' . $oChapter->getId() . ', "title":"' . $oChapter->getTitle() . '", "content":' . json_encode($oChapter->getContent()) . '}';
                echo '{"code":200, "details":"Voici les données.", "data":' . $jsondata . '}';
            }
        break;
        // SEARCH
        case 'search':
            if(isset($_GET['searchVal'])) {
                $aChapters = $ChapitreManager->search($_GET['searchVal']);
                $json = '[';
                foreach($aChapters as $oChapter) {
                    $json .= '{"id":' . $oChapter->getId() . ', "title":"' . $oChapter->getTitle() . '", "content":' . json_encode($oChapter->getContent()) . '},';
                }
                if(strlen($json) > 1) {
                    $jsondata = substr_replace($json ,"", -1);
                    $jsondata .= ']';
                } else {
                    $jsondata = $json . ']';
                }
                
                echo '{"code":200, "details":"Voici la liste des chapitres pour contenant la valeur \''. htmlspecialchars($_GET['searchVal']) .'\' dans leur titre.", "data":' . $jsondata . '}';
            } else {
                echo '{"code":500, "details":"Afin de rechercher un chapitre par son titre, merci de renseigner le paramètre \'searchVal\'.", "data":[]}';
            }
        break;
        // POST
        case 'post':
            if(isset($_GET['title']) && isset($_GET['content'])) {
                // Fonctionne mais ne retourne pas de $oChapter plein
                $oChapter = $ChapitreManager->post($_GET['title'], $_GET['content']);
                // error_log('triggerd', 3, 'C:\Users\Citrov\Documents\tmp_php.txt');
                echo '{"code":200, "details":"Nouveau chapitre ajouté à la base.", "data":{"id":'. $oChapter->getId() .', "title":"'. $oChapter->getTitle() .'", "content":'. json_encode($oChapter->getContent()) .', "date":"'. $oChapter->getDate().'"}}';
            } elseif (isset($_GET['title']) && !isset($_GET['content'])) {
                echo '{"code":500, "details":"Afin d\'ajouter un chapitre, merci de renseigner également le paramètre \'content\'.", "data":{}}';
            } elseif (!isset($_GET['title']) && isset($_GET['content'])) {
                echo '{"code":500, "details":"Afin d\'ajouter un chapitre, merci de renseigner également le paramètre \'title\'.", "data":{}}';
            } else {
                echo '{"code":500, "details":"Afin d\'ajouter un chapitre, merci de renseigner les paramètres \'title\' et \'content\'.", "data":{}}';
            }
        break;
        // UPDATE
        case 'update':
            // todo
            if(isset($_GET['chapterId']) && isset($_GET['title']) && isset($_GET['content'])) {
                $oUpdatedChapter = $ChapitreManager->update($_GET['chapterId'], $_GET['title'], $_GET['content']);
                echo '{"code":200, "details":"Les modifications au chapitre ont été apportées.", "data":{"id":'. $oUpdatedChapter->getId() .', "title":"'. $oUpdatedChapter->getTitle() .'", "content":'. json_encode($oUpdatedChapter->getContent()) .', "date":"'. $oUpdatedChapter->getDate().'"}}';
            } else {
                echo '{"code":500, "details":"Tous les paramètres n\'ont pas été renseignés. Afin de mettre à jour un chapitre, veuillez renseigner les paramètres \'chapterId\', \'title\' et \'content\'.", "data":{}}';
            }
        break;
        // DELETE
        case 'delete':
            // todo
            if(isset($_GET['chapterId'])) {
                $oChapter = $ChapitreManager->delete($_GET['chapterId']);
                echo '{"code":200, "details":"Chapitre supprimé acvec succès.", "data":{"id":'. $oChapter->getId() .', "title":"'. $oChapter->getTitle() .'", "content":'. json_encode($oChapter->getContent()) .', "date":"'. $oChapter->getDate().'"}}';
            } else {
                echo '{"code":500, "details":"Afin de supprimer un chapitre, merci de renseigner le paramètre \'chapterId\'.", "data":{}}';
            }
        break;
        default:
        echo '{"code":500, "details":"Seules les actions get/post/update/delete sont supportées.", "data":[]}';
    }
} else {
    echo '{"code":500, "details":"Merci de renseigner une action.", "data":[]}';
}


