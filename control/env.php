<?php
if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}

require_once ROOTPATH . "data/dbConn.php";
require_once CONTROL . "/core.php";
require_once ROOTPATH . "session.php";
PAGE_ACT::VUALIsLoggedIn();

function cheageKey($arr){
    for ($i = 0; $i < count($arr); ++ $i) {
        if($arr[$i]['envFlag'] != NULL){
            $arr[$i]['envFlag']='check'; 
        }    
    }
    return $arr;
}

if (isset($_REQUEST['level']) && isset($_REQUEST['type'])) {
    if (!empty($_REQUEST["level"]) && !empty($_REQUEST['type'])) {
        $results = array();
        $level = $_REQUEST["level"];
        $type = $_REQUEST["type"];
        $sql = "SELECT l.id as id , l.envName as envName, l.`level`, l.type, l.envDesc as envDesc, l.envIntegration as envIntegration, l.delFlag as delFlag, l.envFlag AS envFlag, p.path AS path, p.listId AS listId FROM env_flag l LEFT JOIN env_path p ON p.listId = l.id WHERE l.delFlag = 0 AND p.delFlag = 0";
        if ($level != 9) {
            $sql = $sql." AND l.level={$level}";
        }
        if ($type != 9) {
            $sql = $sql." AND l.type={$type}";
        }
        $_READ = new Build_Conf();
        $_VUAL = $_READ -> Read_db_Conf($Conf_File);
        $dbconnect = DB_CONN::VUAL_DbConn($_VUAL['db_server'],$_VUAL['db_user'],$_VUAL['db_password'],'vual_env');
        $res = $dbconnect->query($sql);
        while ($row = mysqli_fetch_assoc($res)) {
            array_push($results, $row);
        }
        $result = cheageKey($results);
        echo json_encode($result);die();
    }
        
}
require_once ROOTPATH. "list.php";

?>