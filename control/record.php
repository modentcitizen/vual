<?php
if (!defined("ROOTPATH")) {
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}
require_once ROOTPATH . "/data/dbConn.php";
//require_once CONTROL . "/core.php";

class history{
    public $username;
    public $oldscore;
    public $old_submit;
    public $last_logout;
    public $score_avg;
}



if(isset($_GET)){
    $_VUAL = Build_Conf::Read_db_Conf($Conf_File);
    $sysConnect = DB_CONN::SYS_DbConn($_VUAL['db_server'], $_VUAL['db_user'], $_VUAL['db_password'], $_VUAL['db_database']);
    $username = PAGE_ACT::VUALUserInfo();
    $query_score = "select * from history where username='".$username."'";
    mysqli_query($sysConnect,"set names 'utf8'");
    $stmt = $sysConnect -> query($query_score);
    while($results=mysqli_fetch_assoc($stmt))
    {
        $history = new history();
        $history -> username = $results['username'];
        $history -> oldscore = $results['oldscore'];
        $history -> old_submit = $results['old_submit'];
        $history -> last_logout = $results['last_logout'];
        if($results['oldscore']==1&&$results['old_submit']==1){
            $history -> score_avg = 0;
        }else{
            $history -> score_avg = round($results['oldscore']/$results['old_submit']*100,2);
        }
        $record[] = $history;
    }
    echo json_encode($record);
    $sysConnect -> close();
}







