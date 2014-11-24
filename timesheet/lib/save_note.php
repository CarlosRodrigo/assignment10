<?php
// Check for empty fields
if(empty($_POST['hours'])) {
	echo "No arguments Provided!";
	return false;
   }
$dataRecord = array();

$date = $_POST['date'];
$userId = $_POST['userId'];
$project = $_POST['project'];
$hours = $_POST['hours'];
$description = $_POST['description'];

$dataRecord[] = $date;
$dataRecord[] = $userId;
$dataRecord[] = $project;
$dataRecord[] = $hours;
$dataRecord[] = $description;

require_once('../bin/myDatabase.php');
        
$dbUserName = get_current_user() . '_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = strtoupper(get_current_user()) . '_Time_Sheet';

$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
$query = "INSERT INTO tblWorksOn SET fldDate = STR_TO_DATE(?, '%m/%d/%Y'), fnkUserId = ?, fnkProjectId = ?, fldHours = ?, fldDescription = ?";

$results = $thisDatabase->insert($query, $dataRecord);

return true;

?>