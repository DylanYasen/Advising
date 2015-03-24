<?php
session_start();

    include('src/CommonMethods.php');

    $debug = false;
    $COMMON = new Common($debug);

    $name = "yadi";
    $advisorID = $_SESSION['id'];
    //var_dump($advisorID);

    // ---- get advisor name info
    $sql = "SELECT Firstname FROM Advisor WHERE ID = '$advisorID'";
    $rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);
    $advisorFirstname = $COMMON->getSingleData($rs);

    $sql = "SELECT Lastname FROM Advisor WHERE ID = '$advisorID'";
    $rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);
    $advisorLastname = $COMMON->getSingleData($rs);
    // ---------------------------

    // ---- individual appointments ---- //
    $sql = "SELECT * FROM Appointment WHERE Advisor_ID = '$advisorID' ORDER BY Day ASC, StartTime ASC";
    $rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);

    $apts = $COMMON->getDataArray($rs);
    //var_dump($apts);

    // ---- group appointments ---- //
    $sql = "SELECT * FROM AppointmentGroup WHERE Advisor_ID = '$advisorID' ORDER BY Day ASC, StartTime ASC";
    $rs = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);

    $groupApts = $COMMON->getDataArray($rs);
    //var_dump($groupApts);
?>

<html>

<head>
<title>UMBC Advisor Console</title>

    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <link href="css/main.css" rel="stylesheet">
   
</head>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img class="navbar-brand"  src="res/logo.png" >
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Advisor Console</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">

        <?php
            echo "<li><a href='#'>"."Welcome, ".$advisorFirstname." ". $advisorLastname."</a></li>";
        ?>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Home</a></li>
            <li><a href="MySchedule.php">My Schedule</a></li>
            <li class="divider"></li>
            <li><a href="index.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class = "container">
    <div class = "row">
       
        <!-- Monday -->
        <div class = "<col-sm-2 col-xs-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Monday 
                        <form action = "printPage.php" method ="post">
                            <?php
                            echo "<input type='hidden' name = 'advisorID' value = $advisorID>";
                            echo "<input type='hidden' name = 'day' value = 1>";
                            echo "<button type='submit' class='btn btn-primary btn-xs'>Print</button>";
                            ?>
                        </form>
                    </h3>
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
                                                                           Rank: $studentRank <br />' >

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
                                                    echo "<div class = 'container'>";
                                                    echo "<button type='button' class='btn btn-xs btn-info' data-toggle='popover' data-placement='bottom' title='Student Info' data-html='true' 
                                                           data-content='";

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
                                                echo "</div>";
                                        }
                                    echo "</ul>";
                            }


                                if(!$hasApt)
                                    echo "No Appointments";
                        echo "</div>";
                    ?>
            </div>
        </div>
    
    <!-- Tuesday -->
        <div class = "<col-sm-2 col-xs-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Tuesday 
                        <form action = "printPage.php" method ="post">
                            <?php
                            echo "<input type='hidden' name = 'advisorID' value = $advisorID>";
                            echo "<input type='hidden' name = 'day' value = 2>";
                            echo "<button type='submit' class='btn btn-primary btn-xs'>Print</button>";
                            ?>
                        </form>
                    </h3>
                </div>
                    <?php
                        echo "<div class='panel-body'>";
                        $hasApt = false;

                        echo "<ul>";
                                //var_dump($apts[1]);
                                foreach ($apts as $apt) {

                                    $day = $apt[1];
                                    
                                        if($day == 2)
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
                                    
                                        if($day == 2)
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

    <!-- Wednesday -->
        <div class = "<col-sm-2 col-xs-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Wednesday 
                        <form action = "printPage.php" method ="post">
                            <?php
                            echo "<input type='hidden' name = 'advisorID' value = $advisorID>";
                            echo "<input type='hidden' name = 'day' value = 3>";
                            echo "<button type='submit' class='btn btn-primary btn-xs'>Print</button>";
                            ?>
                        </form>
                    </h3>
                </div>
                    <?php
                        echo "<div class='panel-body'>";
                        $hasApt = false;

                        echo "<ul>";
                                //var_dump($apts[1]);
                                foreach ($apts as $apt) {

                                    $day = $apt[1];
                                    
                                        if($day == 3)
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
                                    
                                        if($day == 3)
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


    <!-- Thursday -->
        <div class = "<col-sm-2 col-xs-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Thursday 
                        <form action = "printPage.php" method ="post">
                            <?php
                            echo "<input type='hidden' name = 'advisorID' value = $advisorID>";
                            echo "<input type='hidden' name = 'day' value = 4>";
                            echo "<button type='submit' class='btn btn-primary btn-xs'>Print</button>";
                            ?>
                        </form>
                    </h3>
                </div>
                    <?php
                        echo "<div class='panel-body'>";
                        $hasApt = false;

                        echo "<ul>";
                                //var_dump($apts[1]);
                                foreach ($apts as $apt) {

                                    $day = $apt[1];
                                    
                                        if($day == 4)
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
                                    
                                        if($day == 4)
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
 
    <!-- Friday -->
        <div class = "<col-sm-2 col-xs-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Friday 
                        <form action = "printPage.php" method ="post">
                            <?php
                            echo "<input type='hidden' name = 'advisorID' value = $advisorID>";
                            echo "<input type='hidden' name = 'day' value = 5>";
                            echo "<button type='submit' class='btn btn-primary btn-xs'>Print</button>";
                            ?>
                        </form>
                    </h3>
                </div>
                    <?php
                        echo "<div class='panel-body'>";
                        $hasApt = false;

                        echo "<ul>";
                                //var_dump($apts[1]);
                                foreach ($apts as $apt) {

                                    $day = $apt[1];
                                    
                                        if($day == 5)
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
                                    
                                        if($day == 5)
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
       
    </div>
</div>

<!-- Load javascript required for Bootstrap animation-->
<script src="https://code.jquery.com/jquery.js"></script>

 <script type="text/javascript">
        $(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</html>