<?php

if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}
require_once ROOTPATH ."control/core.php";
require_once ROOTPATH . "session.php";
$token = new Session_Fun();
$DBMS = Build_Conf::Read_db_name();
if( isset( $_POST[ 'install' ] ) ) {
	// Anti-CSRF
	if (array_key_exists ("session_token", $_SESSION)) {	
		$session_token = $_SESSION[ 'session_token' ];
		
	} else {
		$session_token = "";
	}
	$token -> checkToken( $_REQUEST[ 'user_token' ], $session_token, 'setup.php' );
	if( $DBMS == 'MySQL' ) {
		include_once ROOTPATH . '/data/DB_install.php';
	}
	elseif($DBMS == 'PGSQL') {
		echo  'PostgreSQL is not yet fully supported.';
		$pageact -> VUALPageReload();
	}
	else {
		
		exit("<script>alert('ERROR: Invalid database selected. Please review the config file syntax.');</script>");
		$pageact -> VUALPageReload();
	}
}


// Anti-CSRF
$token -> generateSessionToken();






?>