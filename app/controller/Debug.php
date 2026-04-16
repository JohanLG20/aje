<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;


class Debug
{
    public function launchDebug(string $query)
    {
        $db = new DBArticle();
        $datas = $db->searchForArticle($query);
        $json = json_encode($datas);
        require (VIEW . "/debug.php");
    }


}
