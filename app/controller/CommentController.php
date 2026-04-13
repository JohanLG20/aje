<?php

namespace AJE\Controller;
use AJE\Model\DBArticle;

class CommentController{
     /**
     * Return all the comment of the queried article
     *
     * @param string $idArticle The id of the article
     * 
     * @return array An array with all the comments in the form of :
     * [0] => [
     *          ['fullname'] => nameOfCommentator|utilisateur_supprimé if the user is deleted,
     *          ['comment'] => theComment
     *          ['canEdit'] => true if the user can edit the comment, false otherwise
     *          ['canDelete] => true if the user can delete the comment, false otherwise
     *         ]
     * ....
     */
    public function retrieveComments(string $idArticle): array
    {
        $comments = []; //The variable returned

        //Retrive all the comment and the id of the user associated to the comment
        $dbArticle = new DBArticle();
        $commentsAndUserInfos = $dbArticle->getCommentsAndUserInfosForArticle($idArticle);

        $authCtl = new AuthentificationController();
        
        for($i = 0; $i < count($commentsAndUserInfos); $i++){
            $comments[$i]['comment'] = $commentsAndUserInfos[$i]['comment'];
            $comments[$i]['fullname'] = $commentsAndUserInfos[$i]['fullname'];
            $comments[$i]['canEdit'] = $authCtl->canEditComment($commentsAndUserInfos[$i]['id_user_']);
            $comments[$i]['canDelete'] = $authCtl->canDeleteComment($commentsAndUserInfos[$i]['id_user_']);

        }

        return $comments;

    }
}