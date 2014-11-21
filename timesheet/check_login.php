<?php 
session_start();

require_once('bin/myDatabase.php');

$dbUserName = get_current_user() . '_reader';
$whichPass = "r"; //flag for which one to use.
$dbName = strtoupper(get_current_user()) . '_Time_Sheet';

$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
$pass=/*sha1*/($_POST['password']);

$sql="SELECT fldEmail, fldPassword, pmkUserId, fldType FROM tblUser WHERE fldEmail='".$user_name."'";
$results = $thisDatabase->select($sql);
$db_user_name = $results[0][0];
$db_password = $results[0][1];
$db_user_id = $results[0][2];
$db_user_role = $results[0][3];

if(count($results) > 0) {
	
	if(strcmp($db_password,$pass)==0) {

		$_SESSION['userName']=$db_user_name; 
		$_SESSION['userID']=$db_user_id;
		$_SESSION['userRole']=$db_user_role;

		//print_r($_SESSION);
		header('Location: index.php');

		}
	else
		header('Location: login.php'); //Wrong Password 
}
else
	header('Location: login.php'); //Invalid Login
?>