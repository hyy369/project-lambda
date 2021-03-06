<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<title>CS421 Database G11 Project "Class Booking Service"</title>
	  <meta name="Author" content="Yangyang He">
	  <meta content="width=device-width,initial-scale=1" name=viewport>
	  <!-- Latest compiled and minified CSS -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	  <link rel="stylesheet" href="assets/css/main.css">
	  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	</head>
	<body>
		<div id="header">
	    <!--Puts logo into Bootstrap grid so that it properly resizes across devices-->
	    <div class="container">
	      <div class="row">
	        <div class="col-sm-4" id="logo"><a href="home.html"><div id="logo-img"></div></a></div>
	        <div class="col-sm-4"></div>
	        <div class="col-sm-4"></div>
	      </div>
	    </div>

	    <!-- Static navbar -->
	    <!-- HTML for the navigation bar - will collapse into a dropdown button on small screens-->
	    <div class="navbar navbar-inverse navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-left">
	            <li><a href="home.html">Home</a></li>
	            <li><a href="classrooms.php">Search by Classrooms</a></li>
	            <li><a href="features.php">Search by Features</a></li>
	            <li><a href="events.php">Confirmed Reservations</a></li>
	            <li><a href="schedule.php">Schedule a class</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
	  </div> <!--end Header-->

		<div class="container">
			<div class="row">
				<div class="col-md-12" id="middle">
					<h3>Run Scheduler Script</h3>
					<p>The system returns the following:</p>
          <?php
            echo '<pre>';
            passthru('python alg.py');
            echo '</pre>';
            echo "<h4 style='color: green;'>Successfully scheduled classes!</h4>";
          ?>
				</div>
			</div>
		</div>
	</body>
</html>
