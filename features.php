<!DOCTYPE html>

<html lang="en">
<head>
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
  <div id="body">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <h3>Search by Features</h3>
          <h4><span style="color: red;">*</span>Please check the features you would like to have:</h4>
          <form action ="features.php" method="post">
            <div class="row">
              <div class="col-md-2">
                <h5><input type="checkbox" name="projector" value="true"> Projector</h5>
              </div>
              <div class="col-md-2">
                <h5><input type="checkbox" name="chalkboard" value="true"> Chalkboard</h5>
              </div>
              <div class="col-md-2">
                <h5><input type="checkbox" name="whiteboard" value="true"> Whiteboard</h5>
              </div>
              <div class="col-md-2">
                <h5><input type="checkbox" name="visualizer" value="true"> Visualizer</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <h5>Minimum number of outlets: </h5>
                <input type="number" name="min_outlets" min="0">
              </div>
              <div class="col-md-4">
                <h5>Minimum capacity: </h5>
                <input type="number" name="min_cap" min="0">
              </div>
            </div>
            <div class="row">
              <br>
              <div class="col-md-2">
                <input type="submit" value="Search Rooms">
              </div>
              <div class="col-md-2">
                <input type ="reset">
              </div>
            </div>
          </form>
          <br>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <table id="roomTable">
            <tr>
              <th>Room ID</th>
              <th>Projector</th>
              <th>Board</th>
              <th>Visualizer</th>
              <th>Outlets No.</th>
              <th>Capacity</th>
            </tr>
            <?php
              // Connecting, selecting database
              $dbconn = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay")
                or die('Could not connect:' . pg_last_error());
              $sql = "SELECT * FROM rooms WHERE ";

              //filter projectors
              if ($_POST["projector"] == "true") {
                $sql .= "projector = 'YES'";
              } else {
                // prepare sql with "AND" for further filters
                $sql .= "(projector = 'YES' OR projector = 'NO')";
              }
              //filter boards
              if ($_POST["chalkboard"] == "true") {
                if ($_POST["whiteboard"] == "true") {
                  $sql .= " AND whiteboard = 'BOTH'";
                } else {
                  $sql .= " AND (whiteboard = 'CHALKBOARD' OR whiteboard = 'BOTH')";
                }
              } else {
                if ($_POST["whiteboard"] == "true") {
                  $sql .= " AND (whiteboard = 'WHITEBOARD' OR whiteboard = 'BOTH')";
                }
              }
              //filter visualizers
              if ($_POST["visualizer"] == "true") {
                $sql .= " AND visualizer = 'YES'";
              }
              //filter outlets
              $min_outlets = (is_numeric($_POST["min_outlets"]) ? (int)$_POST["min_outlets"] : 0);
              $sql .= " AND outlets >= ".$min_outlets;
              //filter capacity
              $min_cap = (is_numeric($_POST["min_cap"]) ? (int)$_POST["min_cap"] : 0);
              $sql .= " AND capacity >= ".$min_cap;
              $sql .= ";";

              $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

              while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
                echo "\t<tr>\n";
                echo "\t\t<td><a href='booking.php?room=$line[0]'>$line[0]</a></td>\n";
                echo "\t\t<td>$line[3]</td>\n";
                echo "\t\t<td>$line[4]</td>\n";
                echo "\t\t<td>$line[5]</td>\n";
                echo "\t\t<td>$line[6]</td>\n";
                echo "\t\t<td>$line[7]</td>\n";
                echo "\t</tr>\n";
              }
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
<?php
// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
</html>
