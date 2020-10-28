
<?php

if (!defined("ROOTPATH")) {
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}
require_once ROOTPATH . "/data/dbConn.php";


class Ranking{
    public $username;
    public $score;
    public $submit_times;
    public $score_avg;
}



if(isset($_GET)){
    $_VUAL = Build_Conf::Read_db_Conf($Conf_File);
    $sysConnect = DB_CONN::SYS_DbConn($_VUAL['db_server'], $_VUAL['db_user'], $_VUAL['db_password'], $_VUAL['db_database']);
    $query_score = "select * from users";
    mysqli_query($sysConnect,"set names 'utf8'");
    $stmt = $sysConnect -> query($query_score);
    while($results=mysqli_fetch_assoc($stmt))
    {
        $ranking = new Ranking();
        $ranking -> username = $results['username'];
        $ranking -> score = $results['score'];
        $ranking -> submit_times = $results['submit_times'];
        if($results['score']==1 && $results['submit_times']==1){
            $ranking->score_avg = 0;
        }else{
            $ranking -> score_avg = round($results['score']/$results['submit_times']*100,2);
        }
        $rank[] = $ranking;
    }
    echo json_encode($rank);
    $sysConnect -> close();
}


