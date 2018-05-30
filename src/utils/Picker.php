<?php

namespace dofus\utils;

class Picker
{

    public static $config; // add static var here 
    
    
    //u should learn ez code Manghao xd xd @Kittenxs
    //i never tested this code but if it doesnt work its maybe due to syntax or u would have to tweak a little bit the code.
    public static function get($var)
    {
        //ez as it is ! i don't like weird code written lel
        if (!self::$config) {

           // $config_file = '../src/conf/db.' . Environment::get() . '.php'; // if u want to handle project environment config u should un-comment this line
            $config_file = '../src/conf/db.conf.php'; // if u want to handle project environment config u should un-comment this line
            
            if (!file_exists($config_file)) {
                return false;
            }
            self::$config = require $config_file;
        }

        return self::$config[$key];
        /*
        
        weird manghao code 
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
        }*/
    }

}
