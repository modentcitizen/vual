<?php
session_start();
if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}

require_once ROOTPATH . "/session.php";



interface IPAGE_ACT{
    public static function VUALRedirect($pLocation);
    public static function VUALPageReload();
    public static function VUALSessionGrab();
    public static function VUALLogin($pUsername,$Credit);
    public static function VUALLogout(); 
    public static function VUALIsLoggedIn();
    public static function VUALUserInfo();
}

class PAGE_ACT implements IPAGE_ACT
{
    public static function VUALRedirect($pLocation)
    {
        session_commit();
        header("Location:{$pLocation}");
        exit;
    }
    public static function VUALPageReload()
    {
        self::VUALRedirect($_SERVER['PHP_SELF']);
    }

    public static function &VUALSessionGrab()
    {
        if (!isset($_SESSION['VUAL'])) {
           return $_SESSION['VUAL'];
        }
        return $_SESSION['VUAL'];
    }
    public static function VUALLogin($pUsername,$Credit)
    {
        $VUALSession =& self::VUALSessionGrab();
        $VUALSession['username']=$pUsername;
        $VUALSession['credit'] = $Credit;
        return $VUALSession;
        
    }

    public static function VUALLogout() {
        $VUALSession =& self::VUALSessionGrab();
        unset( $VUALSession[ 'username' ] );
        unset( $VUALSession[ 'Credit']);
        session_unset();
        session_destroy();
    }
    public static function VUALIsLoggedIn()
    {      
        $VUALSession =& self::VUALSessionGrab();
        if(!isset($VUALSession['username']) && !isset($VUALSession['credit'])){
            self::VUALRedirect('/control/login.php');
        }else{ 
            return true; 
        }
    }
    public static function VUALUserInfo(){
        $VUALSession =& self::VUALSessionGrab();
        return (isset( $VUALSession['username'])? $VUALSession['username']:'');
    }
    public static function VUALUserCredit(){
        $VUALSession =& self::VUALSessionGrab();
        return (isset( $VUALSession['credit'])? $VUALSession['credit']:'');
}
    
}
