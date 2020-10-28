<?php

if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}

require_once ROOTPATH . "/control/core.php";
require_once DATAPATH . "/dbConn.php";
require_once DATAPATH . "/dbconf.php";

$_VUAL = Build_Conf::Read_db_Conf($Conf_File);
$sysConnect = DB_CONN::SYS_DbConn($_VUAL['db_server'], $_VUAL['db_user'], $_VUAL['db_password'], $_VUAL['db_database']);

$username = PAGE_ACT::VUALUserInfo();

function query_info($sysConnect,$username){
    $_info=array();
    $query = 'SELECT last_logout,score,submit_times FROM users WHERE username = \'' . $username . '\'';;
    if(!$info = $sysConnect->query($query))
    {  echo mysqli_error($sysConnect);}
    while ($srow = mysqli_fetch_assoc($info)) {
        array_push($_info, $srow);
    }
    $score = $_info[0]['score'];
    $submit = $_info[0]['submit_times'];
    $query2 = "INSERT INTO history (username,last_logout,oldscore, old_submit) VALUES ('".$username."',NOW(),".$score.",".$submit.");";
    var_dump($query2);
    if(!$insert = $sysConnect->query($query2))
    {  echo mysqli_error($sysConnect);}
    return $insert;

}

function insert_times($sysConnect,$username){
    $add_times = 'UPDATE `users` SET `last_logout`= NOW(),`score`=1 ,`submit_times`=1 WHERE `username` =\'' . $username . '\'';
    $in_times =  $sysConnect->query($add_times);
    return $in_times;
}
if(query_info($sysConnect,$username)==1)
{
    if(insert_times($sysConnect,$username)==1)
    {
        if(!PAGE_ACT::VUALIsLoggedIn()){
            PAGE_ACT::VUALRedirect('/control/login.php');
        }
        
        PAGE_ACT::VUALLogout();
        PAGE_ACT::VUALRedirect('/control/login.php');
        $sysConnect->close();
    }else{
        PAGE_ACT::VUALRedirect('/control/env.php');
        echo("<script>alert('登出失败1')</script>");
        $sysConnect->close();
    }
    
}else{
    PAGE_ACT::VUALRedirect('/control/env.php');
    echo("<script>alert('登出失败2')</script>");
    $sysConnect->close();
}







?>
