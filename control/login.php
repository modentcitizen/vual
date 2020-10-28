<?php

if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}

require_once ROOTPATH . "data/dbConn.php";
require_once CONTROL . "/core.php";


print <<<EOF
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>VUAL_DATABASE_LOGIN</title>
<meta name="description" content="VUAL_DATABASE_LOGIN">
<meta name="keywords" content="index">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="icon" type="image/png" href="/assets/i/favicon.png">
<link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
<meta name="apple-mobile-web-app-title" content="Amaze UI" />
<link rel="stylesheet" href="/assets/css/amazeui.min.css" />
<link rel="stylesheet" href="/assets/css/admin.css">
<link rel="stylesheet" href="/assets/css/app.css">
</head>
<body data-type="login">
<div class="am-g myapp-login">
<div class="myapp-login-logo-block  tpl-login-max">
<div class="myapp-login-logo-text">
<div class="myapp-login-logo-text">
VUAL<span> Login</span> <i class="am-icon-skyatlas"></i>
</div>
</div>
<div class="login-font">
<i>Log In </i> or <a href="./register.php">Sign Up</a>
</div>
<div class="am-u-sm-10 login-am-center">
<form class="am-form" method="post">
<fieldset>
<input type="hidden" name="submit">
<div class="am-form-group">
<input type="text" name="username" placeholder="请输入用户名">
</div>
</br>
<div >
<input type="password" class="" name="password" id="doc-ipt-pwd-1" placeholder="请输入密码">
</div>
</br>
<div class="am-form-group">
<p>
<button type="submit" name="login" class="am-btn am-btn-default" Cache-Control"">登录</button>
</p>
</div>
</fieldset>
</form>
</div>
</div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/amazeui.min.js"></script>
</body>
</html>
EOF;
try{
    $_VUAL = Build_Conf::Read_db_Conf($Conf_File);
    $user = $_POST[ 'username' ];
    $user = stripslashes( $user );
    $pass = $_POST[ 'password' ];
    $pass = stripslashes( $pass );
    $pass = md5( $pass ); 
    $query = ("SELECT * FROM users WHERE username = ? AND password = ?");
    $sysConnect = DB_CONN::SYS_DbConn($_VUAL['db_server'],$_VUAL['db_user'],$_VUAL['db_password'],$_VUAL['db_database']);
    $stmt = $sysConnect->prepare($query);
    if(empty($stmt)){
        header("location:/install.php");
    }
    if(isset($_POST['login'])){
        $stmt->bind_param("ss", $user, $pass);
        $usercd = $stmt -> bind_result($userid,$username,$nickname,$pasword,$credit,$email,$score,$submit_times,$last_logout);
        $result = $stmt ->execute();
        while ( $stmt -> fetch()){
            $username = $username;
            $nickname = $nickname;
            $credit = $credit;
        }
        $result = $stmt -> store_result();
        $result = $stmt -> num_rows();
        if($result == 1 ){
            PAGE_ACT::VUALLogin($user,$credit);
            PAGE_ACT::VUALRedirect("/control/env.php");
            $stmt -> close ();
            $sysConnect -> close();
        }else{
            echo("<script>alert('登录失败，错误的用户名或密码')</script>");
            $stmt -> close ();
            $sysConnect -> close();
        }
    }else{
        $stmt -> close ();
        $sysConnect -> close();
    }
}catch(Exception $ex){
    echo("$ex");
}
