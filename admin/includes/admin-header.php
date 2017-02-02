<?php include '../includes/db_connect.php' ?>
<?php include '../functions.php' ?>

<?php
//Improves performance with output buffering more here : http://stackoverflow.com/questions/2832010/what-is-output-buffering
ob_start();
?>

<?php session_start(); ?>


<?php

if(!isset($_SESSION['user_role'])){

        header("Location: ../index.php");

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS - by George Tourtsinakis</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet" type="text/css">

    <!--WYSIWYG HTML Editor-->
    <link href="js/skins/lightgray/skin.min.css" rel="stylesheet" type="text/css">
    <link href="js/skins/lightgray/content.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--Google charts-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    

</head>