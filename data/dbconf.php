<?php

if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}

require_once ROOTPATH ."/control/core.php";

class Build_Conf
{
    public static $DB_INFO = array();
    const DBMS = 'MySQL';
    
    private static function Count_Null($Array)
    {
        $Count_Value = count(Array_filter($Array));
        $Count_Array = count($Array);
        if ($Count_Value == $Count_Array) {
            return true;
        } else {
            return false;
        }
    }

    public static function Wr_db_Conf($Conf_File)
    {   
        if (false !== fopen("$Conf_File", 'w+')) {
            if (self::Count_Null(self::$DB_INFO) == true) {
                $op = file_put_contents($Conf_File, serialize(self::$DB_INFO), LOCK_EX);
                if (false !== $op); 
                {   
                    echo "<script>alert('数据写入完成');</script>";
                    require_once ROOTPATH . "setup.php";
                }
            } else {
                    PAGE_ACT::VUALRedirect("/install.php");
            }
        }
    }

    public static function Read_db_Conf($Conf_File)
    {   
        if (false !== fopen("$Conf_File", 'r')) {
            $_VUAL = unserialize(fread(fopen($Conf_File, 'r'), filesize($Conf_File)));   
            if($_VUAL==''){
                PAGE_ACT::VUALRedirect("/install.php");
                exit();
            }
            return $_VUAL;
        } else {
            PAGE_ACT::VUALRedirect("/install.php");
        }
    }
    public static function Read_db_name(){
        return self::DBMS;
    }
}

