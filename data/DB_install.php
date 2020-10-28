<?php
if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}
require_once ROOTPATH ."control/core.php";
require_once ROOTPATH ."data/dbConn.php";

$pageact = new PAGE_ACT();
$_VUAL = DB_CONN::get_dbconf($Conf_File);

if( !@($GLOBALS["___mysqli_ston"] = mysqli_connect( $_VUAL[ 'db_server' ],  $_VUAL[ 'db_user' ],  $_VUAL[ 'db_password' ] )) ) {
	die( "Could not connect to the MySQL service.<br />Please check the config file." );
	if ($_VUAL[ 'db_user' ] == "root") {
		echo( 'Your database user is root, if you are using MariaDB, this will not work, please read the README.md file.' );
	}
	$pageact->VUALPageReload();
}

$drop_db = "DROP DATABASE IF EXISTS {$_VUAL[ 'db_database' ]};";
if( !@mysqli_query($GLOBALS["___mysqli_ston"],  $drop_db ) ) {
	echo( "Could not drop existing database<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}

$create_db = "CREATE DATABASE {$_VUAL[ 'db_database' ]};";
if( !@mysqli_query($GLOBALS["___mysqli_ston"],  $create_db ) ) {
	echo( "Could not create database<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "Database has been created.</br>" );

if( !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $_VUAL[ 'db_database' ])) ) {
	echo( 'Could not connect to database.' );
	$pageact -> VUALPageReload();
}

$drop_db = "DROP DATABASE IF EXISTS VUAL_ENV;";
if( !@mysqli_query($GLOBALS["___mysqli_ston"],  $drop_db ) ) {
	echo( "Could not drop existing database<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
$create_db = "CREATE DATABASE VUAL_ENV;";
if( !@mysqli_query($GLOBALS["___mysqli_ston"],  $create_db ) ) {
	echo( "Could not create database<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "Database has been created.</br>" );


if( !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $_VUAL[ 'db_database' ])) ) {
	echo( 'Could not connect to database.' );
	$pageact -> VUALPageReload();
}

$create_tb = "CREATE TABLE users (user_id int(6)NOT NULL AUTO_INCREMENT,username varchar(15),nickname varchar(15), password varchar(32),credit int(10),email varchar(70),score int(11) NOT NULL DEFAULT 1, submit_times int(11) NOT NULL DEFAULT 1,last_logout TIMESTAMP, PRIMARY KEY (user_id));";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb ) ) {
	echo( "Table could not be created<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "'users' table was created.</br>" );

$create_tb = "CREATE TABLE history(username varchar(15),last_logout TIMESTAMP,oldscore int(11) NOT NULL DEFAULT '1', old_submit int(11) NOT NULL DEFAULT '1');";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb ) ) {
	echo( "Table could not be created<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "'users' table was created.</br>" );

$insert = "INSERT INTO users(username,nickname,password,credit,email,score,submit_times,last_logout) VALUES
	('admin','admin',MD5('admin'),'1000','admin@admin.com','1','1', NOW());";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $insert ) ) {
	die( "Data could not be inserted into 'users' table<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "Data inserted into 'users' table.</br>");

if( !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE VUAL_ENV")) ) {
	echo( 'Could not connect to database.' );
	$pageact -> VUALPageReload();
}


$create_tb_env_flag = "CREATE TABLE env_flag ( id bigint(11) NOT NULL AUTO_INCREMENT,
envName varchar(50) DEFAULT NULL,
envDesc varchar(255) DEFAULT NULL,
envIntegration int(10) DEFAULT NULL COMMENT '积分',
delFlag tinyint(2) DEFAULT NULL,
envFlag varchar(50) DEFAULT NULL,
level int(10) DEFAULT NULL COMMENT '1、入门 2、初级 3、中级 4、高级',
type int(10) DEFAULT NULL COMMENT '1、注入 2、xss 3、任意下载 4、上传 5、逻辑 6、编辑器 7、其他',
PRIMARY KEY (id))";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb_env_flag ) ) {
	die( "Table could not be created<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "'env_flag' table was created.</br>" );


$insert  = "INSERT INTO env_flag VALUES ('1', '显错注入', '显错注入', '3', '0', 'dfafdasfafdsadfa', '1', '1');";
$insert .= "INSERT INTO env_flag VALUES ('2', '布尔注入', '布尔注入', '3', '0', 'fdsafsdfa', '1', '1');";
$insert .= "INSERT INTO env_flag VALUES ('3', '延时注入', '延时注入', '3', '0', 'gfdgdfsdg', '1', '1');";
$insert .= "INSERT INTO env_flag VALUES ('4', 'post注入', 'post注入', '3', '0', 'dsfasdczxcg', '1', '1');";
$insert .= "INSERT INTO env_flag VALUES ('5', '过滤注入', '过滤注入', '3', '0', 'safsafasdfasdf', '2', '1');";
$insert .= "INSERT INTO env_flag VALUES ('6', '宽字节注入', '宽字节注入', '3', '0', 'dfsadfsadfas', '1', '1');";
$insert .= "INSERT INTO env_flag VALUES ('7', 'xxe注入', 'xxe注入', '3', '0', 'ddfasdfsafsadfsd', '1', '1');";
$insert .= "INSERT INTO env_flag VALUES ('8', 'csv注入', 'csv注入', '3', '0', '', '1', '1');";
$insert .= "INSERT INTO env_flag VALUES ('9', '反射型xss', '反射型xss', '3', '0', 'fsdafasdfas', '1', '2');";
$insert .= "INSERT INTO env_flag VALUES ('10', '存储型xss', '存储型xss', '3', '0', 'asdfsdfadfsdrew', '1', '2');";
$insert .= "INSERT INTO env_flag VALUES ('11', '万能密码登陆', '万能密码登陆', '3', '0', 'htryyujryfhyjtrjn', '1', '1');";
$insert .= "INSERT INTO env_flag VALUES ('12', 'DOM型xss', 'DOM型xss', '3', '0', 'uoijkhhnloh', '1', '2');";
$insert .= "INSERT INTO env_flag VALUES ('13', '过滤xss', '过滤xss', '3', '0', 'poipjklkjppoi', '1', '2');";
$insert .= "INSERT INTO env_flag VALUES ('14', '链接注入', '链接注入', '3', '0', null, '1', '2');";
$insert .= "INSERT INTO env_flag VALUES ('15', '任意文件下载', '任意文件下载', '3', '0', 'sadfvgsadfhe', '1', '3');";
$insert .= "INSERT INTO env_flag VALUES ('16', 'mysql配置文件下载', 'mysql配置文件下载', '3', '0', 'poiplmkounipoj', '1', '3');";
$insert .= "INSERT INTO env_flag VALUES ('17', '文件上传(前端拦截)', '文件上传(前端拦截)', '3', '0', 'sadfsadfsdadf', '1', '4');";
$insert .= "INSERT INTO env_flag VALUES ('18', '文件上传(解析漏洞)', '文件上传(解析漏洞)', '3', '0', 'sdfasdfgfddst', '1', '4');";
$insert .= "INSERT INTO env_flag VALUES ('19', '文件上传(畸形文件)', '文件上传(畸形文件)', '3', '0', 'vnghuytiuygui', '1', '4');";
$insert .= "INSERT INTO env_flag VALUES ('20', '文件上传(截断上传)', '文件上传(截断上传)', '3', '0', 'sadfhbvjyyiyukuyt', '1', '4');";
$insert .= "INSERT INTO env_flag VALUES ('21', '文件上传(htaccess)', '文件上传(htaccess)', '3', '0', 'vbchjgwestruyi', '1', '4');";
$insert .= "INSERT INTO env_flag VALUES ('22', '越权修改密码', '越权修改密码', '3', '0', null, '1', '5');";
$insert .= "INSERT INTO env_flag VALUES ('23', '支付漏洞', '支付漏洞', '3', '0', null, '1', '5');";
$insert .= "INSERT INTO env_flag VALUES ('24', '邮箱轰炸', '邮箱轰炸', '3', '0', null, '1', '5');";
$insert .= "INSERT INTO env_flag VALUES ('25', '越权查看admin', '越权查看admin', '3', '0', null, '1', '5');";
$insert .= "INSERT INTO env_flag VALUES ('26', 'URL跳转', 'URL跳转', '3', '0', null, '1', '6');";
$insert .= "INSERT INTO env_flag VALUES ('27', '文件包含漏洞', '文件包含漏洞', '3', '0', null, '1', '6');";
$insert .= "INSERT INTO env_flag VALUES ('28', '命令执行', '命令执行', '3', '0', null, '1', '6');";
$insert .= "INSERT INTO env_flag VALUES ('29', 'webshell爆破', 'webShell爆破', '3', '0', null, '1', '6');";
$insert .= "INSERT INTO env_flag VALUES ('30', 'ssrf', 'ssrf', '3', '0', null, '1', '6');";
$result = mysqli_multi_query($GLOBALS["___mysqli_ston"],  $insert );
if( $result == 0) {
	die( "Data could not be inserted into 'env_flag' table<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "Data inserted into 'env_flag' table.</br>" );
mysqli_close($GLOBALS["___mysqli_ston"]);

if( !@($GLOBALS["___mysqli_ston"] = mysqli_connect( $_VUAL[ 'db_server' ],  $_VUAL[ 'db_user' ],  $_VUAL[ 'db_password' ] )) ) {
	die( "Could not connect to the MySQL service.<br />Please check the config file." );
	if ($_VUAL[ 'db_user' ] == "root") {
		echo( 'Your database user is root, if you are using MariaDB, this will not work, please read the README.md file.' );
	}
	$pageact->VUALPageReload();
}

if( !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE VUAL_ENV")) ) {
	echo( 'Could not connect to database.' );
	$pageact -> VUALPageReload();
}

$create_tb_env_path = "CREATE TABLE env_path (id bigint(11) NOT NULL AUTO_INCREMENT,
path varchar(255) DEFAULT NULL,
delFlag tinyint(2) DEFAULT NULL,
listId bigint(11) DEFAULT NULL,
PRIMARY KEY (id))";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb_env_path ) ) {
	die( "Table could not be created<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "'env_path' table was created.</br>" );

$insert  = "INSERT INTO env_path VALUES ('1', '/vulner/sqlinject/manifest_error.php?id=1', '0', '1');";
$insert .= "INSERT INTO env_path VALUES ('2', '/vulner/sqlinject/bool_injection.php?id=1', '0', '2');";
$insert .= "INSERT INTO env_path VALUES ('3', '/vulner/sqlinject/bool_injection.php?id=1', '0', '3');";
$insert .= "INSERT INTO env_path VALUES ('4', '/vulner/sqlinject/post_injection.php', '0', '4');";
$insert .= "INSERT INTO env_path VALUES ('5', '/vulner/sqlinject/filter_injection.php', '0', '5');";
$insert .= "INSERT INTO env_path VALUES ('6', '/vulner/sqlinject/width_byte_injection.php?id=1', '0', '6');";
$insert .= "INSERT INTO env_path VALUES ('7', '/vulner/sqlinject/xxe_injection.php', '0', '7');";
$insert .= "INSERT INTO env_path VALUES ('8', '/vulner/sqlinject/csv_vuln.php', '0', '8');";
$insert .= "INSERT INTO env_path VALUES ('9', '/vulner/xss/xss_1.php?id=1', '0', '9');";
$insert .= "INSERT INTO env_path VALUES ('10', '/vulner/xss/xss_2.php', '0', '10');";
$insert .= "INSERT INTO env_path VALUES ('11', '/vulner/sqlinject/universal_passwd.php', '0', '11');";
$insert .= "INSERT INTO env_path VALUES ('12', '/vulner/xss/dom_xss.php', '0', '12');";
$insert .= "INSERT INTO env_path VALUES ('13', '/vulner/xss/filter_xss.php?id=1', '0', '13');";
$insert .= "INSERT INTO env_path VALUES ('14', '/vulner/xss/link_xss.php?id=1', '0', '14');";
$insert .= "INSERT INTO env_path VALUES ('15', '/vulner/filedownload/file_download.php', '0', '15');";
$insert .= "INSERT INTO env_path VALUES ('16', '/vulner/filedownload/ini_file_download.php', '0', '16');";
$insert .= "INSERT INTO env_path VALUES ('17', '/vulner/upload_file/upload_file_1.php', '0', '17');";
$insert .= "INSERT INTO env_path VALUES ('18', '/vulner/upload_file/upload_file_2.php', '0', '18');";
$insert .= "INSERT INTO env_path VALUES ('19', '/vulner/upload_file/upload_file_3.php', '0', '19');";
$insert .= "INSERT INTO env_path VALUES ('20', '/vulner/upload_file/upload_file_4.php', '0', '20');";
$insert .= "INSERT INTO env_path VALUES ('21', '/vulner/upload_file/upload_file_5.php', '0', '21');";
$insert .= "INSERT INTO env_path VALUES ('22', '/vulner/auth_cross/cross_auth_passwd.php', '0', '22');";
$insert .= "INSERT INTO env_path VALUES ('23', '/vulner/auth_cross/cross_permission_pay.php', '0', '23');";
$insert .= "INSERT INTO env_path VALUES ('24', '/vulner/auth_cross/email.php', '0', '24');";
$insert .= "INSERT INTO env_path VALUES ('25', '/vulner/auth_cross/cross_find.php', '0', '25');";
$insert .= "INSERT INTO env_path VALUES ('26', '/vulner/more/url_redirect.php', '0', '26');";
$insert .= "INSERT INTO env_path VALUES ('27', '/vulner/more/file_include.php?filename=../../template/dom_xss.html', '0', '27');";
$insert .= "INSERT INTO env_path VALUES ('28', '/vulner/tp5/public/index.php', '0', '28');";
$insert .= "INSERT INTO env_path VALUES ('29', '/vulner/more/webshell.php', '0', '29');";
if( !mysqli_multi_query($GLOBALS["___mysqli_ston"],  $insert ) ) {
	die( "Data could not be inserted into 'env_path' table<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	$pageact -> VUALPageReload();
}
print_r( "Data inserted into 'env_path' table.</br>" );
mysqli_close($GLOBALS["___mysqli_ston"]);







// // Copy .bak for a fun directory listing vuln
// $conf = VUAL_WEB_PAGE_TO_ROOT . 'config/config.inc.php';
// $bakconf = VUAL_WEB_PAGE_TO_ROOT . 'config/config.inc.php.bak';
// if (file_exists($conf)) {
// 	// Who cares if it fails. Suppress.
// 	@copy($conf, $bakconf);
// }

//print_r( "Backup file /config/config.inc.php.bak automatically created.</br>" );

// Done
print_r( "<em>Setup successful</em>!" );
if( !$pageact -> VUALIsLoggedIn()){
	print_r( "Please <a href='login.php'>login</a>.<script>setTimeout(function(){window.location.href='login.php'},5000);</script>" );
}
	

?>



