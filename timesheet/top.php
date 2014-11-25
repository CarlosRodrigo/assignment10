<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Carlos Rodrigo, Colin Luther">
        <meta name="description" content="Time Sheet">
        <title>Time-Sheet</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">

        <!-- Sticky Note CSS -->
        <link href="css/sticky-note.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <?php
            // parse the url into htmlentites to remove any suspicous vales that someone
            // may try to pass in. htmlentites helps avoid security issues.
            //
            //PATH SETUP
            //
            //  $domain = "https://www.uvm.edu" or http://www.uvm.edu;
             $domain = "http://";
            if (isset($_SERVER['HTTPS'])) {
                if ($_SERVER['HTTPS']) {
                    $domain = "https://";
                }
            }

            $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");
        
            $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

            $domain .= $server;
            
            // break the url up into an array, then pull out just the filename
            $path_parts = pathinfo($phpSelf);
            
            if ($debug){ 
                print "<p>Domain" . $domain;
                print "<p>php Self". $phpSelf;
                print "<p>Path Parts<pre>";
                print_r($path_parts);
            }
            
            // inlcude all libraries
            //
            //require_once('../lib/security.php');
            
            if ($path_parts['filename'] == "index"
                || $path_parts['filename'] == "project"
                || $path_parts['filename'] == "user"
                || $path_parts['filename'] == "statistics") {
                #include "../lib/validation-functions.php";
                #include "../lib/mail-message.php";

                require_once('bin/myDatabase.php');
        
                $dbUserName = get_current_user() . '_writer';
                $whichPass = "w"; //flag for which one to use.
                $dbName = strtoupper(get_current_user()) . '_Time_Sheet';

                $thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
            }
            
        ?>	
        
    </head>
    
    <?php
// giving each body tag an id really helps with css later on
        print '<body id="' . $path_parts['filename'] . '">';
    ?>

    <!-- ######################     Start of Body   ############################ -->