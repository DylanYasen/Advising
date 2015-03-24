<?php

//include('src/Validator.php');
include('src/CommonMethods.php');

	//var_dump($_POST);

	$debug = false;

	/*
	$VALIDATOR = new Validator($debug); 
	*/

	$COMMON = new Common($debug);

		//$sql = "SELECT ID, Username, Password, Firstname, Lastname FROM Advisor";

	$name = $_POST['username'];

	$sql = "SELECT Password FROM Advisor WHERE Username = '$name'";
	$result = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);

	$row = mysql_fetch_row($result);

	if($result== NULL){
		//echo "username not found.";
		header("Location:index.php");
	}
	else
	{
		if($_POST['password'] == $row[0]){

			$sql = "SELECT ID FROM Advisor WHERE Username = '$name'";
			$rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);

			$ID = $COMMON->getSingleData($rs);

			//echo "correct";
			session_start();

			// pass adviosr id
			$_SESSION['id'] = $ID;

			header("Location:MySchedule.php");
		}

		else{

			//echo "incorrect";
			header("Location:index.php");
		}
	}

?>
