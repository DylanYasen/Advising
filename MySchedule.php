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
//<!-- time table -->
echo "<body>";
  echo"<link rel="stylesheet" type = "text/css" href="css/timetable.css" >";
  
  echo"<table width="80%" align = "center" >";

    //<!-- days -->  
    echo"<div id ="head_nav"></div>";
    echo"<tr>";
    echo"<th>Time</th>";
    echo"<th>Monday</th>";
    echo"<th>Tuesday</th>";
    echo"<th>Wednesday</th>";
    echo"<th>Thrusday</th>";
    echo"<th>Friday</th>";
    echo"</tr>";
    echo"</div>";

    /*
     <tr>
        <th>9:00 - 10:00</th>
        
            <td>Physics-1</td>
            <td>English</td>
            <td title="No Class" class="Holiday"></td>
            <td>Chemestry-1</td>
            <td>Alzebra</td>
        </div>
    </tr>

    <tr>
        <th>10:00 - 11:00</th>
        
            <td>Physics-1</td>
            <td>English</td>
            <td title="No Class" class="Holiday"></td>
            <td>Chemestry-1</td>
            <td>Alzebra</td>
        </div>
    </tr>

    <tr>
        <th>11:00 - 12:00</td>
        
            <td>Math-2</td>
            <td>Chemestry-2</td>
            <td>Physics-1</td>
            <td>Hindi</td>
            <td>English</td>
        </div>
    </tr>

    <tr>
        <th>12:00 - 01:00</td>
        
            <td>Hindi</td>
            <td>English</td>
            <td>Math-1</td>
            <td>Chemistry</td>
            <td>Physics</td>
        </div>
    </tr>

    <tr>
        <th>01:00 - 02:00</td>
        
            <td>Cumm. Skill</td>
            <td>Sports</td>
            <td>English</td>
            <td>Computer Lab</td>
            <td>Header</td>
        </div>
    </tr>

    <tr>
        <th>02:00 - 03:00</td>
        
            <td>Header</td>
            <td>Header</td>
            <td>Header</td>
            <td>Header</td>
            <td>Header</td>
        </div>
    </tr>

    <tr>
        <th>03:00 - 04:00</td>
        
            <td>Header</td>
            <td>Header</td>
            <td>Header</td>
            <td>Header</td>
            <td>Header</td>
        </div>
    </tr>
    */
  echo "</table>";
echo"</body>";
?>

<!-- Load javascript required for Bootstrap animation-->
<script src="https://code.jquery.com/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</html>