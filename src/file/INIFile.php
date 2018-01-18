<?php


namespace kitten\pack\file;


class INIFile
{
    /**
     * @param array $assoc_arr
     * @param string $path
     * @param bool $has_sections
     * @return bool|int
     */
    public static function writeToFile(array $assoc_arr,string $path,bool $has_sections=true) {
        $content = "";
        if ($has_sections) {
            foreach ($assoc_arr as $key=>$elem) {
                $content .= "[".$key."]\n";
                foreach ($elem as $key2=>$elem2) {
                    if(is_array($elem2))
                    {
                        for($i=0;$i<count($elem2);$i++)
                        {
                            $content .= $key2."[] = \"".$elem2[$i]."\"\n";
                        }
                    }
                    else if($elem2=="") $content .= $key2." = \n";
                    else $content .= $key2." = \"".$elem2."\"\n";
                }
            }
        }
        else {
            foreach ($assoc_arr as $key=>$elem) {
                if(is_array($elem))
                {
                    for($i=0;$i<count($elem);$i++)
                    {
                        $content .= $key."[] = \"".$elem[$i]."\"\n";
                    }
                }
                else if($elem=="") $content .= $key." = \n";
                else $content .= $key." = \"".$elem."\"\n";
            }
        }
        if (!$handle = fopen($path, 'w')) {
            return false;
        }
        $success = fwrite($handle, $content);
        fclose($handle);
        return $success;
    }

    /**
     * @param string $path
     * @return array|bool
     */
    public static function readFile(string $path){
        return parse_ini_file($path,true);
    }
}