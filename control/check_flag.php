<?php
if (!defined("ROOTPATH")) {
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}
require_once ROOTPATH . "/data/dbConn.php";
require_once CONTROL . "/core.php";


    function add_score($sysConnect,$score,$username)
    {
        $old_score = array();
        $q_score = 'SELECT score FROM users WHERE username = \'' . $username . '\'';
        $query_score = $sysConnect->query($q_score);
        while ($srow = mysqli_fetch_assoc($query_score)) {
            array_push($old_score, $srow);
        }
        $old_score = $old_score[0]['score'];
        $new_score = $score + $old_score;
        $add_score = 'UPDATE `users` SET `score`=' . $new_score .' WHERE `username` =\'' . $username . '\''; 
        $in_new = $sysConnect->query($add_score);
        return $in_new;
    }

    function add_times($sysConnect,$username){
        $old_times = array();
        $q_times = 'SELECT submit_times FROM users WHERE username = \'' . $username . '\'';
        $query_times = $sysConnect->query($q_times);
        while ($srow = mysqli_fetch_assoc($query_times)) {
            array_push($old_times, $srow);
        }
        $old_times = $old_times[0]['submit_times'];
        $new_times = $old_times + 1;
        $add_times = 'UPDATE `users` SET `submit_times`=' . $new_times . ' WHERE `username` =\'' . $username . '\'';
        $in_times =  $sysConnect->query($add_times);
        return $in_times;
    }

    function selflag($dbConnect,$id){
        $results = array();
        $find_flag = 'SELECT * FROM  env_flag WHERE id = ' . $id;
        if(!$res = $dbConnect->query($find_flag))
        {  echo mysqli_error($dbConnect);}
        while ($row = mysqli_fetch_assoc($res)) {
            array_push($results, $row);
        }
        return $results;
    }


if (isset($_REQUEST['id']) && isset($_REQUEST['flag'])) {

    if (empty($_REQUEST['id']) || empty($_REQUEST['flag'])) {
        $arr = array("result" => "error");
        echo json_encode($arr);

    } else {
        $id = intval($_REQUEST['id']);
        $flag = trim($_REQUEST['flag']);
        $username = PAGE_ACT::VUALUserInfo();
        $results = array();
        $_VUAL = Build_Conf::Read_db_Conf($Conf_File);
        $dbConnect = DB_CONN::VUAL_DbConn($_VUAL['db_server'], $_VUAL['db_user'], $_VUAL['db_password'], 'vual_env');
        $sysConnect = DB_CONN::SYS_DbConn($_VUAL['db_server'], $_VUAL['db_user'], $_VUAL['db_password'], $_VUAL['db_database']);
        $results = selflag($dbConnect,$id);
        if($results[0]['delFlag'] !==1 ){
        if ($flag == $results[0]['envFlag']) {
            $score = $results[0]['envIntegration'];
            $in_score= add_score($sysConnect,$score,$username);
            if ($in_score == 1) {
                add_times($sysConnect,$username);
                $arr = array("result" => "success"); 
            }
            $sysConnect->close();
            $dbConnect->close();
        } else {
            add_times($sysConnect,$username);
            $arr = array("result" => "error");
            $sysConnect->close();
            $dbConnect->close();
        }
        echo json_encode($arr);
    }
}
}

