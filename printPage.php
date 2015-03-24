
<?php 
var_dump($_POST);
/*
class Printer
{	

	var $outputStr;

	fuction Printer($apts,$groupApts,$day){

		$outputStr += "\t\tIndividual Advising\n";

		foreach($apts as $apt){
			
			if($apt[1] != $day)
				continue;

			$startTime = $apt[2];
			$startTime = substr($startTime,0,5);

			$endTime = $apt[3];
			$endTime = substr($endTime,0,5);

			$studentID = $apt[5];

			// get student info
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

<html>

<body>
<div class = "container">
    <div class = "row">
        <div class = "<col-md-8 col-sm-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Monday</h3>
                </div>
                    <?php
                        echo "<div class='panel-body'>";
                        $hasApt = false;

                        echo "<ul>";
                                //var_dump($apts[1]);
                                foreach ($apts as $apt) {

                                    $day = $apt[1];
                                    
                                        if($day == 1)
                                        {
                                            $startTime = $apt[2];
                                            $startTime = substr($startTime,0,5);

                                            $endTime = $apt[3];
                                            $endTime = substr($endTime,0,5);

                                            $studentID = $apt[5];

                                            // get student info
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

                                            echo "<li>".$startTime." - ".$endTime."</li>";
                                            
                                            // student info popover
                                            echo "<div class = 'container'>";
                                                    echo "<button type='button' class='btn btn-xs btn-info' data-toggle='popover' data-placement='bottom' title='Student Info' data-html='true' 
                                                           data-content= 'Name: $studentFullname <br /> 
                                                                           ID: $studentID <br />
                                                                           Major: $studentMajor <br />
                                                                           Rank: $studentRank <br />  ' >

                                                            Detail</button>"; 

                                            echo "</div>";

                                            //echo "<a data-container='body' data-toggle='popover' data-placement='bottom' data-trigger='hover'>StudentID:$apt[5]</a>";
                                            echo "<br>";
                                            $hasApt = true;
                                        }
                                }

                                // group apt
                                foreach ($groupApts as $apt) {

                                        $day = $apt[1];
                                    
                                        if($day == 1)
                                        {
                                            $startTime = $apt[2];
                                            $startTime = substr($startTime,0,5);

                                            $endTime = $apt[3];
                                            $endTime = substr($endTime,0,5);

                                            $printedHeading = false;

                                            // ID starts at 6th slot
                                            for($i = 5; $i < 15; $i++ ){
                                                $studentID = $apt[$i];

                                                if($studentID == NULL)
                                                    break;

                                                // print time 
                                                if(!$printedHeading){
                                                    echo "<li>".$startTime." - ".$endTime."</li>";
                                                    $printedHeading = true;

                                                    echo "<button type='button' class='btn btn-xs btn-info' data-toggle='popover' data-placement='bottom' title='Student Info' data-html='true' 
                                                           data-content= '";

                                                           $hasApt = true;
                                                }

                                                 // get student info
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

                                                echo "Name: $studentFullname <br /> 
                                                                           ID: $studentID <br />
                                                                           Major: $studentMajor <br />
                                                                           Rank: $studentRank <br /><br />";

                                            }
                                            echo "'>Detail</button>";
                                        }
                                    echo "</ul>";
                            }


                                if(!$hasApt)
                                    echo "No Appointments";
                        echo "</div>";
                    ?>
            </div>
        </div>

</body>
</html>		

*/
?>
