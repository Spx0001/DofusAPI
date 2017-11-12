<?php

namespace dofus\utils;

class Picker
{

    public static function get($var)
    {
        $datas = array();
        $vars = explode('.', $var);
        $p = SRC . DS . 'conf' . DS . $vars[0] . '.conf.php';
        if (file_exists($p)) {
            $datas = require $p;
            if (array_key_exists($vars[1], $datas)) {
                return $datas[$vars[1]];
            } else {
                return "V N/C";
            }
        } else {
            return "V N/C";
        }
    }

}