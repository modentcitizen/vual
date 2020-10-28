<?php

require_once "./common/directory.php";
require_once ROOTPATH . "./control/core.php";


if(!PAGE_ACT::VUALIsLoggedIn())
{
    PAGE_ACT::VUALRedirect('/control/login.php');
}else{
    PAGE_ACT::VUALRedirect('/control/list.php');
}





?>