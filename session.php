<?php

$Conf_File = DATAPATH ."/DB.ini";
if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}

require_once ROOTPATH ."control/core.php";



class Session_Fun
{
    public function checkToken($user_token, $session_token, $returnURL)
    {  # Validate the given (CSRF) token
        if ($user_token !== $session_token || !isset($session_token)) {
            echo 'CSRF token is incorrect';
            PAGE_ACT::VUALRedirect($returnURL);
        }
    }
    public function generateSessionToken()
    {  # Generate a brand new (CSRF) token
        if (isset($_SESSION['session_token'])) {
            $this->destroySessionToken();
        }
        $_SESSION['session_token'] = md5(uniqid());
    }

    public function destroySessionToken()
    {  # Destroy any session with the name 'session_token'
        unset($_SESSION['session_token']);
    }
    public function tokenField()
    {  # Return a field for the (CSRF) token
        return "<input type='hidden' name='user_token' value='{$_SESSION['session_token']}' />";
    }
}
