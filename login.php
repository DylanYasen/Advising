<?php

include('src/Validator.php');
include('src/CommonMethods.php');

	var_dump($_POST);

	$debug = true;

	/*
	$VALIDATOR = new Validator($debug); 
	*/


	$COMMON = new Common($debug);

		//$sql = "SELECT ID, Username, Password, Firstname, Lastname FROM Advisor";

	$name = $_POST['username'];

	$sql = "SELECT Password FROM Advisor WHERE ID = '$name'  FROM Advisor";
	$result = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);

	var_dump($result);

	if($result== NULL){
		echo "username not found.";
	}
	else
	{
		if($_POST['password'] == $result)
			echo "correct";

		else
			echo "incorrect";
	}

/*
	if($VALIDATOR->Validate( $_POST['username'],$_POST['password']))
		 header("Location:index.php");

	else
		header("Location:MySchedule.php");
*/
?>
