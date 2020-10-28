<?php


if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}

require_once DATAPATH ."/dbconf.php";

$Conf_File = $Conf_File;
class DB_CONN{
    public static function get_dbconf($Conf_File){
        try{
            $_VUAL = Build_Conf::Read_db_Conf($Conf_File);
            return $_VUAL;
        }catch(Exception $ex){
            echo($ex);
        }
    }
    public static function SYS_DbConn($sysHost, $sysUser, $sysPwd, $sysDatabase){
        if (!$GLOBALS['sysDbConnect']) {
            try{
                $sysConnect = new mysqli($sysHost, $sysUser, $sysPwd, $sysDatabase);
                $GLOBALS['sysDbConnect'] = $sysConnect;
                mysqli_set_charset($sysConnect, "utf8");
                return $sysConnect;
            } catch (Exception $e) {
                exit("数据库连接错误".$e);
            }
        }
    }
    public static function VUAL_DbConn($host, $user, $pwd, $database){
        if (!$GLOBALS['dbConnect']) {
            try{
                $dbconnect = new mysqli($host, $user, $pwd, $database);
                $GLOBALS['dbConnect'] = $dbconnect;
                mysqli_set_charset($dbconnect, "utf8");
                return $dbconnect;
            } catch (Exception $e) {
                exit("数据库连接错误".$e);
            }
        }
    }

}


    
?>

