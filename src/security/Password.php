<?php


namespace kitten\pack\security;

use kitten\utils\StringTools;

class Password
{
    /**
     * @param string $str
     * @return int
     */
    public static function check(string $str){
        if (StringTools::isNullOrEmptyString($str)){
            return 0;
        }else{
            if (strlen($str)<8){
                return 1;
            }else{
                $number=StringTools::match($str,'/^[0-9]+$/');
                $lower=StringTools::match($str,'/^[a-z]+$/');
                $upper=StringTools::match($str,'/^[A-Z]+$/');
                if ($number || $lower || $upper){
                    return 2;
                }else{
                    return 3;
                }
            }
        }
    }

    /**
     * @param string $pwd
     * @return bool
     */
    public static function match($pwd) {
        $r='/^[A-Za-z0-9]+$/';
        return StringTools::match($pwd,$r);
    }
}