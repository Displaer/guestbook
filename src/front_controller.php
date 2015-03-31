<?php
use \lib\Startup;
use \lib\System;
use \lib\Connector;


include("lib/DI.php");
include("lib/Startup.php");
include("lib/BaseLayer.php");
include("lib/BaseManager.php");
include("lib/config.php");
include("lib/Connector.php");
include("lib/System.php");
//include("library/image-resize/ImageResize.php");

    $_connector = Connector::getInstance();
    $_connector->connect($CONN['dsn'], $CONN['user'], $CONN['password']);

    include("includes.php");

    // init DI map
    Startup::init();
    System::prepareControl($_GET);
	$xcontrol = System::getSession('control','global');

    System::setSession('upostcomponents', 'login enter guest homepage','global');


    //System::disSession('control','global');

    //var_dump(System::getSession('logedin','global'));
include "app_controller.php";
/*
if (System::getSession('logedin','global') == null) {
    include "login_controller.php";
} else {
    }
*/
