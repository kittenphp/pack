<?php


namespace kitten\pack\drawing;


class GDSetting
{
    public static function check(){
        if(!function_exists('gd_info')){
            return false;
        }else{
            return true;
        }
    }
}