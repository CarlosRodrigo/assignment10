<?php
// Check for empty fields
if(empty($_POST['hours'])) {
	echo "No arguments Provided!";
	return false;
   }
$dataRecord = array();

$project = $_POST['project'];
$hours = $_POST['hours'];
$description = $_POST['description'];

$dataRecord[] = $project;
$dataRecord[] = $hours;
$dataRecord[] = $description;

require_once('../bin/myDatabase.php');
        
$dbUserName = get_current_user() . '_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = strtoupper(get_current_user()) . '_Time_Sheet';

$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
$query = "INSERT INTO tblWorksOn SET fldDate ='12/12/14', fnkUserId = 1, fnkProjectId = ?, fldHours = ?, fldDescription = ?";

$results = $thisDatabase->insert($query, $dataRecord);

return true;

?>