<?php

namespace AJE\Controller;

use AJE\Model\DBComment;
use AJE\Model\DBUser;

class Debug
{
    public function launchDebug()
    {

        $array = [[1,2,30], [7,8,9], ["a"]];
        var_dump($this->combinateAllFiltersValues($array));
    }

    /*
        Credit to  @heyMP fot the function.
        Found at https://gist.github.com/heyMP/96803251eb55270d22948746433861e6
    */

    function combinateAllFiltersValues($arrays, $i = 0)
    {
        if (!isset($arrays[$i])) {
            return array();
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = $this->combinateAllFiltersValues($arrays, $i + 1);

        $result = array();

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge(array($v), $t) :
                    array($v, $t);
            }
        }

        return $result;
    }
}
