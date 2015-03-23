<?php

include('src/Validator.php');
	var_dump($_POST);

	$debug = true;
	$VALIDATOR = new Validator($debug); 

	if($VALIDATOR->Validate( $_POST['username'],$_POST['password']))
		 header("Location:index.php");

	else
		header("Location:MySchedule.php");
?>
