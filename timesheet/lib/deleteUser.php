<?php

require_once('../bin/myDatabase.php');
        
$dbUserName = get_current_user() . '_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = strtoupper(get_current_user()) . '_Time_Sheet';

$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

$dataRecord = array();
$id = $_GET['id'];
$dataRecord[] = $id;
$query = "DELETE FROM tblUser WHERE pmkUserId = ?";

$results = $thisDatabase->delete($query, $dataRecord);

//alert_success("You've successfully deleted a user.".$id);

header('Location: ../user.php');

?>