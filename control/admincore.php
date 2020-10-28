<?php

if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}

require_once ROOTPATH . "/session.php";
require_once DATAPATH . "/dbConn.php";



$sql = "SELECT * FROM users";

function Get_info($sql,$conn){   
    $results = array();
    if(!$res = $conn->query($sql))
    {  echo mysqli_error($conn);}
    while ($row = mysqli_fetch_assoc($res)) {
        array_push($results, $row);
    }
    return $results;

}


$_READ = new Build_Conf();
$_VUAL = $_READ -> Read_db_Conf($Conf_File);
$dbconnect = DB_CONN::VUAL_DbConn($_VUAL['db_server'],$_VUAL['db_user'],$_VUAL['db_password'],$_VUAL['db_database']);
$result = Get_info($sql,$dbconnect);
echo json_encode($result);die();


?>