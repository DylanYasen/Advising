
<?php 
 include('src/CommonMethods.php');

    $debug = false;
    $COMMON = new Common($debug);

    $advisorID = $_POST['advisorID'];
    $day = $_POST['day'];
    //var_dump($advisorID);

    // ---- individual appointments ---- //
    $sql = "SELECT * FROM Appointment WHERE Advisor_ID = '$advisorID' AND Day = '$day' ORDER BY StartTime ASC";
    $rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);

    $apts = $COMMON->getDataArray($rs);
    //var_dump($apts);

    // ---- group appointments ---- //
    $sql = "SELECT * FROM AppointmentGroup WHERE Advisor_ID = '$advisorID' AND Day = '$day' ORDER BY StartTime ASC";
    $rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);

    $groupApts = $COMMON->getDataArray($rs);

    echo "Individual Advising";
    echo "<br>";
    echo "==============";
    echo "<ul>";

    if($apts != NULL){
         foreach ($apts as $apt) {

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

        echo "<li>Time: ".$startTime." - ".$endTime."</li>";
        echo "<li>Student Name: ".$studentFullname."</li>";
        echo "<li>ID: ".$studentID."</li>";
        echo "<li>Major: ".$studentMajor."</li>";
        echo "<li>Rank: ".$studentRank."</li>";
        echo "<br>"; 
        echo "<br>";
        }
     echo "</ul>";
    }
   
    echo"<br>";
    echo "Group Advising";
    echo "<br>";
    echo "==============";
    echo "<ul>";
    if($apts != NULL){
    foreach ($groupApts as $apt) {

            $startTime = $apt[2];
            $startTime = substr($startTime,0,5);    

            echo "<li>Time: ".$startTime." - ".$endTime."</li>";

            $endTime = $apt[3];
            $endTime = substr($endTime,0,5);

            $printedHeading = false;

            // ID starts at 5th slot
            for($i = 5; $i < 15; $i++ ){
                $studentID = $apt[$i];

                if($studentID == NULL)
                    break;

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

                echo "<li>Student Name: ".$studentFullname."</li>";
                echo "<li>ID: ".$studentID."</li>";
                echo "<li>Major: ".$studentMajor."</li>";
                echo "<li>Rank: ".$studentRank."</li>";
                echo "<br>";
            }
            echo "<br>";
            echo "<br>";
        }
    }
    echo "</ul>";
?>

<script type="text/javascript">
    window.print();
</script>