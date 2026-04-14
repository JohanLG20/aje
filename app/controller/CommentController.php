<?php

namespace AJE\Controller;

use AJE\Model\DBComment;
use AJE\Model\DBUser;
use AJE\Utils\DataTransformer;

use PDOException;

use function PHPSTORM_META\elementType;

class CommentController
{

    private AuthentificationController $connectedUser;
    private DBComment $db;

    public function __construct()
    {
        $this->connectedUser = new AuthentificationController();
        try {
            $this->db = new DBComment();
        } catch (PDOException $e) {
            throw $e;
        }
    }

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
    public function getComments(string $idArticle): array
    {
        $comments = []; //The variable returned

        //Checking if a comment error as occured
        if (isset($_SESSION['commentError'])) {
            $comments['error'] = $_SESSION['commentError']; //Set the error for the user if there was one
            unset($_SESSION['commentError']); //Unsetting the variable to prevent the message to be displayed again
        }

        try {
            //Retrive all the comment and the id of the user associated to the comment
            $dbComment = new DBComment();
            $commentsAndUserInfos = $dbComment->getCommentsAndUserInfosForArticle($idArticle);


            for ($i = 0; $i < count($commentsAndUserInfos); $i++) {
                $idComment = $commentsAndUserInfos[$i]['id_comment'];
                $comments[$i]['idComment'] = $idComment;
                $comments[$i]['comment'] = $commentsAndUserInfos[$i]['comment'];
                $comments[$i]['fullname'] = $commentsAndUserInfos[$i]['fullname'];
                $comments[$i]['canEdit'] = $this->canEdit($idComment, $idArticle);
                $comments[$i]['canDelete'] = $this->canDelete($idComment, $idArticle);
            }
        } catch (\PDOException $e) {
        }
        //$comments['error'] = $this

        return $comments;
    }

    /*
    Check if the connected user is allowed to add a comment on the article
    */
    public function canAddComment(string $id): bool
    {
        return $this->connectedUser->canCommentArticle($id) && !$this->hasCommented($id);
    }

    /**
     * @param string $idArticle The id of the article
     * 
     * @return bool True if the connected user has commented, false otherwise
     */
    private function hasCommented(string $idArticle): bool
    {

        if (!is_null($this->connectedUser->getId())) {

            try {
                $dbUser = new DBUser();
                $userComment = $dbUser->getUserCommentForArticle($this->connectedUser->getId(), $idArticle);
                $res = is_array($userComment) && !empty($userComment); //This test must be because the model function can return a boolean
            } catch (\PDOException) {
                $res = false;
            }
            return $res;
        } else {
            return false;
        }
    }

    /**
     * It adds a comment on an article. It is reached with the path /addComment/. It test the permissions, the given comment and add it to the db if all is correct
     */
    public function addComment()
    {
        $idArticle = $this->getArticleIdFromHTTPReferer();


        if ($this->canAddComment($idArticle)) {
            //Escaping the values
            $escapedPost = DataTransformer::escapeValues($_POST);
            $comment['comment_label'] = $escapedPost['comment'];

            //Checking the length of the comment is valid
            if (isset($comment['comment_label']) && strlen($comment['comment_label']) < 120 && !empty($comment['comment_label'])) {
                if ($this->db->addNewElement(
                    [
                        'comment_label' => $comment['comment_label'],
                        'id_user_' => $this->connectedUser->getId(),
                        'id_article' => $idArticle
                    ]
                )) {
                } else {
                    $_SESSION['commentError'] = "Une erreur est survenue lors de l'ajout du commentaire, veuillez réessayer";
                }
            } else {
                $_SESSION['commentError'] = "Veuillez ne pas entrer un commentaire vide ou de plus de 120 caractères";
            }
        }
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    /**
     * Delete a given comment. It checks if the user asking for it has the permission to do so.
     * @param string $idComment The comment to delete
     * 
     */
    public function deleteComment(string $idComment)
    {
        $idArticle = $this->getArticleIdFromHTTPReferer();
        if ($this->canDelete($idComment, $idArticle)) {
            try {
                $this->db->deleteElementById($idComment);
            } catch (\PDOException $e) {
                $_SESSION['commentError'] = "Une erreur est survenue lors de la suppression du commentaire";
            }
        }
        else{
            $this->permissionDenied();
        }
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    /**
     * Triggered when some one without the correct permissions tries to take an action on the comments
     */
    public function permissionDenied()
    {
        //TODO: Create a function that display an error
    }

    public function getArticleIdFromHTTPReferer(): string
    {
        $lastUri = $_SERVER['HTTP_REFERER'];
        $explodedLastUri = explode("/", $lastUri);

        //Returns the last value of the array as it is the article id
        return  $explodedLastUri[count($explodedLastUri) - 1];
    }

    public function canEdit(string $idComment, string $idArticle): bool
    {
        return $this->isAuthor($idComment, $idArticle);
    }

    public function canDelete(string $idComment, string $idArticle): bool
    {

        return $this->connectedUser->canDeleteComment() ||
            $this->isAuthor($idComment, $idArticle);
    }

    private function isAuthor(string $idComment, string $idArticle): bool
    {
        if (!is_null($this->connectedUser->getId())) {
            $res = $this->db->getCommentByIdByAuthorByArticle($idComment, $this->connectedUser->getId(), $idArticle);
            return is_array($res) && !empty($res);
        }

        return false;
    }
}
