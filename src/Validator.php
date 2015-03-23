<?php

include('src/CommonMethods.php');

class Validator
{
	var $m_username;
	var $m_password;

	var $COMMON;

	var $database;

	var $databaseCount = 1;

	function Validator($debug)
	{
		$COMMON = new Common($debug);

		$sql = "SELECT ID, Username, Password, Firstname, Lastname FROM Advisor";
		$result = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);


		// get data from database
		while ($r = mysql_fetch_row($result)) {
			var_dump($r);
			$database[$databaseCount] = $r;
			$databaseCount++;
		}
	}

	function Validate($username,$password){

		//var_dump($username);
		//var_dump($password);

		$index = $this->CheckUsername($username);

		if($index != -1){

			if($this->CheckPassword($index, $password))
				return true;
			
			else{
				echo "Incorrect password";
				return false;
			}
		}

		else{
			echo "User name does not exist";
			return false;
		}
	}

	function CheckUsername($username){

		var_dump($username);


		$count = 0;
		foreach ($database as $row) {
			var_dump($row);
			$count ++;
			if($row[2] == $username)
		 		return $count;  // return valid ID
		}

			/*
		for ($i = 1; $i < $databaseCount;$i++ ){
			var_dump($database[$i]);
			if($database[$i][2] == $username)
		 		return $i;  // return valid ID
		}
		*/
		return -1;   // doesn't exist
	}

	function CheckPassword($index,$password){

		var_dump($password);



		$p = $database[$index][3];

		if($password == $p)
			return true;

		return false;
		//$sql = "SELECT Password FROM Advisor WHERE ID = $id"
	}

}

?>
