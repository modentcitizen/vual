<?php

$Conf_File = "./DB.ini";
if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}
require_once ROOTPATH . "session.php";
require_once DATAPATH . "/dbconf.php";
require_once DATAPATH . "/dbConn.php";
$token = new Session_Fun();
$token ->generateSessionToken();
print <<<EOF
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="">
<title>VUAL_DATABASE_INSTALL </title>
<meta name="description" content="VUAL_DATABASE_INSTALL">
<meta name="keywords" content="index">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<link rel="icon" type="image/png" href="assets/i/favicon.png">
<link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
<meta name="apple-mobile-web-app-title" content="Amaze UI"/>
<link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
<link rel="stylesheet" href="/assets/css/admin.css">
<link rel="stylesheet" href="/assets/css/app.css">
</head>
<body data-type="login" >
<div class="am-g myapp-login">
<div class="myapp-login-logo-block  tpl-login-max">
<div class="myapp-login-logo-text">
<div class="myapp-login-logo-text">
VUAL<span> 用户注册</span> <i class="am-icon-skyatlas"></i>
</div>
</div>
<div class="am-u-sm-10 login-am-center">
<form class="am-form" method="post">
<fieldset>
<input type="hidden" name="submit">
<div class="am-form-group">
<font style="letter-spacing:5px;" color="white">姓名↓</font></p>
<input type="text" name="nickname" placeholder="张三/李四/王二">
</div>
</br>
<div class="am-form-group">
<font style="letter-spacing:5px;" color="white">用户名↓</font></p>
<input type="text" name="username" placeholder="不能使用admin/user/administrator/等">
</div>
</br>
<div class="am-form-group">
<font color="white">定义用户密码↓</font></p>
<input type="password" class="" name="pass" id="doc-ipt-pwd-1" placeholder="请输入密码">
</div>
</br>
<div class="am-form-group">
<font color="white">确认用户密码↓</font></p>
<input type="password" class="" name="repass" id="doc-ipt-pwd-1" placeholder="请输入密码">
</div>
</br>
<div class="am-form-group">
<div class="am-form-group">
<font color="white">注册邮箱↓</font></p>
<input type="text" name="email" placeholder="XXXX@XXX.COM">
</div>
</br>
</p>
<button type="submit" name="register" class="am-btn am-btn-default">注册</button>
</html>
EOF . $token -> tokenField() . <<<EOF
</p>
</fieldset>
</form>
</div>
</div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/amazeui.min.js"></script>
<script src="/assets/js/app.js"></script>
</body>
EOF;

function CHECK_blank(){

        if (empty($_POST['nickname'])||!preg_match('/^(?!_)[A-Za-z0-9_\x{4e00}-\x{9fa5}]{2,16}+$/u',$_POST['nickname'])){
                die("<script>alert('姓名只能包含中英文、数字及下划线的2到16位字符！');location.href='/control/register.php';</script>");          
        }else {
            htmlspecialchars(stripcslashes($_POST['nickname']));
            $_REGI['nickname'] = $_POST['nickname'];
        }
        if (empty($_POST['username'])||!preg_match('/^(?!_)[A-Za-z0-9_\x{4e00}-\x{9fa5}]{2,16}+$/u',$_POST['username'])){
            die("<script>alert('姓名只能包含中英文、数字及下划线的2到16位字符！');location.href='/control/register.php';</script>");         
        }else {
            htmlspecialchars(stripcslashes($_POST['username']));
            $_REGI['username'] = $_POST['username'];
        }
        if (empty($_POST['pass'])||!preg_match('/^[A-Za-z0-9]{3,18}$/',$_POST['pass'])){
            die( "<script>alert('密码为3到18位字符');location.href='/control/register.php';</script>");         
        }else {
            $_REGI['pass'] = md5($_POST['pass']);
        }
        if (empty($_POST['repass'])||$_POST['pass'] !== $_POST['repass']){
            die("<script>alert('两次输入密码不一致！');location.href='/control/register.php';</script>");         
        }else {
            $_REGI['repass'] = md5($_POST['repass']);
        }
        if (empty($_POST['email'])||!preg_match('/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,6})$/',$_POST['email'])){
            die("<script>alert('邮箱不能为空！');location.href='/control/register.php';</script>");         
        }else {
            $_REGI['email'] = $_POST['email'];
        }
        return $_REGI;

}

function CHECK_user($sysConnect,$_REGI)
{
    $query1=("SELECT username FROM users WHERE username=?");
    $query2=("SELECT email FROM users WHERE email=?");
    $stmt1 = $sysConnect->prepare($query1);
    $stmt1 -> bind_param("s", $_REGI['username']);
    $result1 = $stmt1 -> execute();
    $result1 = $stmt1 -> store_result();
    $result1 = $stmt1 -> num_rows();
    if($result1==1){   
        $stmt1->close(); 
        $sysConnect -> close();
        die("<script>alert('用户名已存在！');location.href='/control/register.php';</script>");     
    }
    $stmt2 = $sysConnect->prepare($query2);
    $stmt2->bind_param("s", $_REGI['email']);
    $result2 = $stmt2 -> execute();
    $result2 = $stmt2 -> store_result();
    $result2 = $stmt2 -> num_rows();
    if($result2==1){ 
        $stmt2->close();   
        $sysConnect -> close();
        die("<script>alert('邮箱已存在！');location.href='/control/register.php';</script>");
    }
    $stmt1->close();
    $stmt2->close();
}



// function Create_user_t($REGI_username,$sysConnect){
//     $create_tb = "CREATE TABLE ".$REGI_username." (last_logout TIMESTAMP,oldscore int(11) NOT NULL, old_submit int(11) NOT NULL, PRIMARY KEY (last_logout));";
//     if(!$crete_user = $sysConnect->query($create_tb))
//     {
//         echo mysqli_error($sysConnect);
//     }
//     return $crete_user;
// }

try{
    $_VUAL = Build_Conf::Read_db_Conf($Conf_File);
    if(isset($_POST["register"])){
        $_REGI=CHECK_blank();
        $sysConnect = DB_CONN::SYS_DbConn($_VUAL['db_server'],$_VUAL['db_user'],$_VUAL['db_password'],$_VUAL['db_database']);
        CHECK_user($sysConnect,$_REGI);
        $query = ("INSERT INTO users(username,nickname,password,credit,email,score,submit_times,last_logout)VALUES 
        (?,?,?,'500',?,1,1, NOW());");
        $stmt = $sysConnect->prepare($query);
        $stmt->bind_param("ssss", $_REGI['username'],$_REGI['nickname'],$_REGI['pass'],$_REGI['email']);
        $result = $stmt -> execute();
        $result = $stmt -> store_result();
        if($result == 1)
        {
            echo("<script>alert('注册成功');location.href='/control/login.php';</script>");
            PAGE_ACT::VUALLogin($REGI_username,'500');
            $stmt -> close ();
            $sysConnect -> close();
        }else{
            echo "<script>alert('注册失败1！');location.href='/control/register.php';</script>";
            $stmt -> close ();
            $sysConnect -> close();
        }   
    }
    

}catch(Exception $ex){
    echo("$ex");
}


try {
    //code...
} catch (\Throwable $th) {
    //throw $th;
}











?>