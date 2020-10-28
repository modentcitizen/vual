


<?php
$Conf_File = "./DB.ini";
if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}
require_once ROOTPATH . "session.php";
require_once ROOTPATH . "data/dbconf.php";
$token = new Session_Fun();
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
VUAL<span> 数据安装</span> <i class="am-icon-skyatlas"></i>
</div>
</div>
<div class="am-u-sm-10 login-am-center">
<form class="am-form" method="post">
<fieldset>
<input type="hidden" name="submit">
<div class="am-form-group">
<font style="letter-spacing:5px;" color="white">数据库地址↓</font></p>
<input type="text" name="DB_address" placeholder="例如127.0.0.1">
</div>
</br>
<div class="am-form-group">
<font color="white">数据库超级用户名↓</font></p>
<input type="text" name="DB_user" placeholder="admin">
</div>
</br>
<div class="am-form-group">
<font color="white">数据库超级用户密码↓</font></p>
<input type="password" class="" name="DB_password" id="doc-ipt-pwd-1" placeholder="请输入密码">
</div>
<div class="am-form-group">
</div>
</br>
<div class="am-form-group">
<font color="white">定义靶场数据库名称↓</font></p>
<input type="text" name="DB_name" value="VUAL_SYS">
</div>
</br>
<div class="am-form-group">
<font color="white">数据库连接端口↓</font></p>
<input type="number" name="DB_port" value="3306" min="1" maxlength="5"/>
</div>
</br>
<p>
<button type="submit" name="install" class="am-btn am-btn-default">安装靶场数据</button>
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
if(isset($_POST['install'])){
    Build_Conf::$DB_INFO['db_server'] = $_POST['DB_address'];
    Build_Conf::$DB_INFO['db_user']   = $_POST['DB_user'];
    Build_Conf::$DB_INFO['db_password'] = $_POST['DB_password'];
    Build_Conf::$DB_INFO['db_database'] = $_POST['DB_name'];
    Build_Conf::$DB_INFO['db_port '] = $_POST['DB_port'];
    Build_Conf::Wr_db_Conf($Conf_File);
}

?>