<?php
//
// series of functions to help you validate your data. notice that each
// function returns true or false

function verifyAlphaNum ($testString) {
	// Check for letters, numbers and dash, period, space and single quote only. 
	return (preg_match ("/^([[:alnum:]]|-|\.| |')+$/", $testString));
}	

function verifyEmail ($testString) {
	// Check for a valid email address http://www.php.net/manual/en/filter.examples.validation.php
	return filter_var($testString, FILTER_VALIDATE_EMAIL);
}

function verifyNumeric ($testString) {
	// Check for numbers and period. 
	return (is_numeric ($testString));
}

function verifyPhone ($testString) {
	// Check for usa phone number http://www.php.net/manual/en/function.preg-match.php
        $regex = '/^(?:1(?:[. -])?)?(?:\((?=\d{3}\)))?([2-9]\d{2})(?:(?<=\(\d{3})\))? ?(?:(?<=\d{3})[.-])?([2-9]\d{2})[. -]?(\d{4})(?: (?i:ext)\.? ?(\d{1,5}))?$/';

	return (preg_match($regex, $testString));
}

/*function emailAlreadyTaken($email) {
	$file=fopen('../assignment1.6/data/registration.csv', 'r');
	while(!feof($file)) {
		$line = fgetcsv($file);
		$record = $line[0];
        if($email == $record) {
        	return True;
        }
    }
    return False;
}*/

function emailAlreadyTaken($email) {
	require_once('../bin/myDatabase.php');
        
    $dbUserName = get_current_user() . '_reader';
    $whichPass = "r"; //flag for which one to use.
    $dbName = strtoupper(get_current_user()) . '_BetterPlace';

    $thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
    
    $userName = 'SELECT fldEmail FROM tblUser WHERE fldEmail = ?';
    $user = array($email);
    $isValid = $thisDatabase->select($userName, $user);
    
    if(!empty($isValid)) {
        return True;
    }
    return False;
}

?>