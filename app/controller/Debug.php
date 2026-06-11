<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBCategory;
use AJE\Utils\UserErrorHelper;

class Debug
{
    public function launchDebug()
    {
      
        $datas = UserErrorHelper::checkOldPassword('Test@test2');


        $data = json_encode($datas);

        echo $data;
    }
}
