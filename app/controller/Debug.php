<?php

namespace AJE\Controller;

use AJE\Model\DBArticleInformations;
use AJE\Model\DBCategory;
use AJE\Utils\AJAXRequestHandler;
use AJE\Utils\UserErrorHelper;

class Debug
{
  public function launchDebug()
  {
    try {
      $id = 5;
      $dbArtInfos = new DBArticleInformations();

      $datas = $dbArtInfos->getElementById($id);

            $datas = array_merge($datas, $dbArtInfos->getArticlePrice($id));
    } catch (\PDOException $e) {
      throw $e;
    }

    if ($datas) {
      $json = json_encode($datas);
      //echo $json
    } else {
      echo 'Données introuvables';
    }
    require(VIEW . "/debug.php");

  }
}
