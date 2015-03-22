<html>

<head>
<title>UMBC Advisor Console</title>

    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

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
      <img href="umbc.edu" class="navbar-brand"  src="res/logo.png" >
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Advisor Console</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Login</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="MySchedule.php">My Schedule</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php

// Stage 1, vardump, watch all values passed
var_dump($_POST);  echo("<br>");

// Stage 2, DB setup

include('src/CommonMethods.php');
$debug = true;
$COMMON = new Common($debug); // common methods

$sql = "SELECT ID, StudentName, StartTime, EndTime, AptType FROM AdvisingTimeTable";
$result = $COMMON->executeQuery($sql,$_SERVER["SCRIPT_NAME"]);
    echo "'$result'";

    while($row = mysql_fetch_row($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["StudentName"]. " " . $row["StartTime"]." " . $row["EndTime"]. "<br>";
      
        echo("<tr>");
      foreach ($row as $element)
      { 
       echo("<td>".$element."</td>");
      }
      echo("</tr>");
    }
    
//$name = 

//$sql = "insert into test_data (`StudentName`, `StartTime`, `EndTime`,'AptType') values ('1', '2', '2','2')";
//$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

var_dump($_POST);  echo("<br>");
?>

<!-- Load javascript required for Bootstrap animation-->
<script src="https://code.jquery.com/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</html>