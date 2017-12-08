<?php session_start(); ?>
<html lang="en">
<head>
  <title>Activities</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="public/resources/images.png">
  
  <link rel="stylesheet" type="text/css" href="public/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="public/js/statistics.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        <a class="navbar-brand" rel="home" href="#" title="PointNodes">
        <img style="max-width:60px; margin-top: -16px; " src="public/resources/images.png">
    </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Activities</a></li>
        <li class="active"><a href="statistics.php">Statistics</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a>Bun venit <i><?php echo $_SESSION['login_user']; ?></i></a></li>
        <li><a href="/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">   
 
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left"> 
      <h2>Statistics</h2> 
       <div id="currentWeekChart_div"></div>
      <div id="currentMonthChart_div"></div>
       <div id="currentYearChart_div"></div>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
    <small>If you want some help, please contact me at this address simion.robertgm95@gmail.com <br/>
        For problems regarding design or graphics, please contact this address ada.andrada@gmail.com</small>
</footer>


</body>
</html>
