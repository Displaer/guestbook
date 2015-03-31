<?php
@session_start();
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

    $_connector = Connector::getInstance();
    $_connector->connect($CONN['dsn'], $CONN['user'], $CONN['password']);

    include("includes.php");

    // init DI map
    Startup::init();
    System::prepareControl($_GET);
    $xcontrol = System::getSession('control','global');

    if ((stripos(System::getSession('upostcomponents','global'), trim($xcontrol))!==FALSE)) {
        $path_module = "components/" . $xcontrol . "/" . $xcontrol . ".php";
        if (!@include($path_module)) {
            echo 'undefined component';
        }
    } else {
        echo 'undefined component';
    }




