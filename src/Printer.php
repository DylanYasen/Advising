<?php 




class Printer
{	

	var $outputStr;

	fuction Printer($apts,$groupApts,$day){

		$outputStr += "\t\tIndividual Advising\n";

		foreach($apts as $apt){
			
			if($apt[1] != $day)
				continue;

			$outputStr += "\tStudentName:$apt[]"

			$sql = "SELECT * FROM Student WHERE ID = '$studentID'";

        	 $rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);
			$studentInfo = $COMMON->getDataArray($rs);
			$studentInfo = $studentInfo[1];
                                            $studentID = $studentInfo[0];
                                            $studentFirstname = $studentInfo[1];
                                            $studentLastname = $studentInfo[2];
                                            $studentFullname = $studentFirstname." ".$studentLastname;
                                            $studentMajor = $studentInfo[3];
                                            $studentRank = $studentInfo[4];
		}

		
	}

}

?>