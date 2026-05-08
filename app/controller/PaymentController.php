<?php

namespace AJE\Controller;

use AJE\Model\DBArticleOrder;
use AJE\Model\DBOrder_;
use Exception;
use PDOException;

/**
 * [Description PaymentController]
 * Class that is used when the user tries to pay or access the payment page. It handdles the registration in the databse of the payment.
 */
class PaymentController
{
    /**
     * Called when a non-client tries to access to the payment page
     */
    public function permissionDenied()
    {
        require(VIEW . "/basketPreviewRefuse.php");
    }


    /**
     * Called when a client tries to access to the payment page via the route /payment/
     */
    public function displayPaymentPage()
    {
        $validatePayment = true; // This variable is used to know which button to display in the view
        require(VIEW . "/payment_view.php");
        $client = new AuthentificationController();
    }

    /**
     * This method is accessed by the route /pay/
     */
    public function proceedToPayment()
    {
        $basket = new BasketController();
        $articles = $basket->getArticles(); // Retrieving the articles in the basket

        if (!is_null($articles)) { // 
            try {
                $this->registerOrder($basket->getArticles($articles));
                $orderInfos['items'] = $articles; //Preloading the articles informations for the view
                $basket->resetBasket();
                require(VIEW . "/validatePayment_view.php");
            } catch (PDOException $e) {
                throw ($e);
            }
        } else {
            //Sending the user back to the main page since a user shouldn't have access to this route if they have no articles il the basket
            header("Location: index.php");
            
        }
    }

    /**
     * Register the order, create the line in the db. It also links the orders with the articles in the associative table ARTICLE_ORDER
     * @param array $basketArticles The basket of the client
     * 
     */
    private function registerOrder(array $basketArticles)
    {
        try {
            //Initializing the db that will be used 
            $dbOrder = new DBOrder_();
            $dbArticleOrder = new DBArticleOrder();

            //Retrivieving the client id
            $client = new AuthentificationController();
            $clientId = $client->getId();

            if (!is_null($clientId)) {
                //Creating each order and linking it to the article in the ARTICLE_ORDER table
                foreach ($basketArticles as $articleId => $article) {
                    $dbOrder->addNewElement(["id_user_" => $clientId]);
                    $lastOrderId = $dbOrder->getLastAddedElement()['id_order_']; //Retrieving the newly created order
                    $registrationSucceded = $dbArticleOrder->addNewElement([
                        "id_article" => $articleId,
                        "id_order_" => $lastOrderId,
                        "quantity" => $article['quantity']
                    ]);

                    if (!$registrationSucceded) {
                        throw new Exception("Une erreur est survenue lors de l'enregistement de la commande");
                    }
                }
            }
        } catch (\PDOException $e) {
            throw new Exception("Une erreur est survenue lors de l'enregistement de la commande");
        }
    }
}
