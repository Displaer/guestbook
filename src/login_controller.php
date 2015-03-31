<?php
    use lib\System;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>
        <?php
        echo System::getStorage('global_login_header');
        ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

                <ul class="nav navbar-nav">
                    <?php
                    echo System::getLoginLink($xcontrol);
                    ?>
                </ul>
                <ul class="nav pull-right">
                    <?php
                    echo System::getHomeMenuLine();
                    ?>
                </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <!--///////////////////////////////////////////////////////////////-->
    <div id="all">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="padding:20px;">

                    <?php
                    include "components/login/login.php";
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <!-- //////////////////////////////////////////////////////////////// -->

</div><!-- /.container -->



<div class="navbar navbar-inverse navbar-fixed-bottom">
    <div id="footer">
        <div class="container">
            <p title="Информационные технологии Таджикистана" align="center" class="white_foot">ITT &copy; All Right Reserved</p>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="res/bootstrap/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>


<?
/*

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="res/js/jquery-1.10.2.js" type="text/javascript"></script>
    <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <link href="res/dtree/dtree.css" rel="stylesheet" media="screen">
    <script src="res/dtree/dtree.js"></script>
    <script src="res/edit.js"></script>
    <script type="text/javascript"></script>
    <link href="res/css/custom_style.css" rel="stylesheet" media="screen">

*/
?>