<?php


namespace kitten\pack\excel\reader;

//https://stackoverflow.com/questions/10242879/read-excel-xlsx-file-using-simplexlsx-in-php

class ExcelDateTime
{
    /**
     * @param int $excelTime
     * @return int
     */
    private static function getUnixStamp($excelTime){
        $d = floor( $excelTime ); // seconds since 1900
        $t = $excelTime - $d;
        return ($d > 0) ? ( $d - 25569 ) * 86400 + $t * 86400 : $t * 86400;
    }

    /**
     * @param int $excelTime
     * @param string $format
     * @return false|string
     */
    public static function getDateTimeString($excelTime,$format='Y-m-d H:i:s'){
        $unixStamp=self::getUnixStamp($excelTime);
        return date($format,$unixStamp);
    }
}