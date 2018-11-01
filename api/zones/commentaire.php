<?php

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case "get":
            $aComments = $CommentManager->getAll();
            $json = '[';
            foreach($aComments as $oComment) {
                $json .= '{"id":' . $oComment->getId() . ', "author":"' . $oComment->getAuthor() . '", "content":"' . $oComment->getContent() . '", "datetime":"' . $oComment->getDate() . '"},';
            }
            if(strlen($json) > 1) {
                $jsondata = substr_replace($json ,"", -1);
                $jsondata .= ']';
            } else {
                $jsondata = $json . ']';
            }
            echo '{"code":200, "details":"Voici les données.", "data":' . $jsondata . '}';
        
        break;
        case "post":
            if(isset($_GET['chapterId'])) {
                if(isset($_GET['commentAuthor']) && isset($_GET['commentContent'])) {
                    $oNewComment = $CommentManager->post(htmlspecialchars($_GET['chapterId']), htmlspecialchars($_GET['commentAuthor']), htmlspecialchars($_GET['commentContent'])); 
                    if($oNewComment) {
                        echo '{"code":200, "details":"Merci pour votre commentaire. Vous allez être redirigé.", "data":[]}';
                    } else {
                        echo '{"code":500, "details":"L\'ajout du commentaire a échoué.", "data":[]}';
                    }
                } else {
                    echo '{"code":500, "details":"Merci de veiller à ce que les paramètres \'commentAuthor\' et \'commentContent\' soient renseignés.", "data":[]}';
                }
            } else {
                echo '{"code":500, "details":"Merci de renseigner l\'id du chapitre associé.", "data":[]}';
            }
        break;
        case "flag":
            if(isset($_GET['commentId'])) {
                $CommentManager->flag($_GET['commentId']);
                echo '{"code":200, "details":"Le commentaire a été signalé.", "data":[]}';
            } else {
                echo '{"code":500, "details":"Merci de renseigner l\'id du commentaire à flag.", "data":[]}';
            }
        break;
        case "unflag":
            if(isset($_GET['commentId'])) {
                $CommentManager->unflag($_GET['commentId']);
                echo '{"code":200, "details":"Le signalement a été levé.", "data":[]}';
            } else {
                echo '{"code":500, "details":"Merci de renseigner l\'id du commentaire à flag.", "data":[]}';
            }
        break;
        default:
            echo '{"code":500, "details":"SQeules les actions XX, YY et ZZ sont autorisées.", "data":[]}';
    }
} else {
    echo '{"code":500, "details":"Merci de renseigner une action.", "data":[]}';
}