<?php

include('src/Validator.php');
	var_dump($_POST);

	$debug = true;
	$VALIDATOR = new Validator($debug); 

	if($VALIDATOR->Validate( $_POST['inputUsername'],$_POST['inputPassword']))
		 header("index.php");

	else
		header("MySchedule.php");
?>
