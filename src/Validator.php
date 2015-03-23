<?php

include('src/CommonMethods.php');

class Validator
{
	var $m_username;
	var $m_password;

	var $COMMON;

	var $database;

	function Validator($debug)
	{
		$COMMON = new Common($debug);

		$sql = "SELECT ID, Username, Password, Firstname, Lastname FROM Advisor";
		$result = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);


		// get data from database
		$counter = 0;
		while ($r = mysql_fetch_row($result)) {

			$database[$counter] = $r;
			$counter++;
		}
	}

	function Validate($username,$password){

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

		$count = 0;
		foreach ($database as $row) {
			$count ++;
			if($row[2] == $username)
		 		return $count;  // return valid ID
		}

		return -1;   // doesn't exist
	}

	function CheckPassword($index,$password){

		$p = $database[$index][3];

		if($password == $p)
			return true;

		return false;
		//$sql = "SELECT Password FROM Advisor WHERE ID = $id"
	}

}

?>
