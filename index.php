<?php
session_start();
header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL); // & ~E_DEPRECATED
include "src/front_controller.php";
?>