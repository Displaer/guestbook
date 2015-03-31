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
    <link rel="icon" href="assets/images/favicon.ico">

    <title><?=(System::getStorage('global_title_main') .' - ' . System::getStorage('global_title_second'))?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom_style.css" rel="stylesheet">

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
            <a class="navbar-brand" href="#"><?=System::getStorage("project_name")?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav"><?=System::getMenuLine($xcontrol);?><!--/ul>
            <ul class="nav navbar-nav pull-right"--><?=System::getLoginLink($xcontrol);?></ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">

    <!--///////////////////////////////////////////////////////////////-->
    <div style="margin-top: 80px;">

                    <?
                    if ((stripos(System::getSession('upostcomponents','global'), trim($xcontrol))!==FALSE)) {
                        $path_module = "components/" . $xcontrol . "/" . $xcontrol . ".php";
                        if (!@include($path_module)) {
                            echo "<h2>Undefined component</h2>";
                        }
                    } else {
                        echo "<h2>Access denied</h2>";
                    }
                    ?>
    </div>

    <!-- //////////////////////////////////////////////////////////////// -->

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery-1.11.0.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<?php
$jspath = 'assets/js/' . $xcontrol . '.js';
if (file_exists($jspath)) {
    echo '<script src="' . $jspath . '"></script>';
}
?>
</body>
</html>