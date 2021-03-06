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
        <div class="col-md-12">
          <h3>Availability of <?php echo $_GET['room'] ?> for week of 2017-04-24: </h3>
          <form action="confirmation.php" method="post">
            <div class="row" style="overflow-x:auto;">
              <table>
                <tr>
                  <th id='date-cell'>Time</th>
                  <th id='date-cell'>08:00</th>
                  <th id='date-cell'>08:30</th>
                  <th id='date-cell'>09:00</th>
                  <th id='date-cell'>09:30</th>
                  <th id='date-cell'>10:00</th>
                  <th id='date-cell'>10:30</th>
                  <th id='date-cell'>11:00</th>
                  <th id='date-cell'>11:30</th>
                  <th id='date-cell'>12:00</th>
                  <th id='date-cell'>12:30</th>
                  <th id='date-cell'>13:00</th>
                  <th id='date-cell'>13:30</th>
                  <th id='date-cell'>14:00</th>
                  <th id='date-cell'>14:30</th>
                  <th id='date-cell'>15:00</th>
                  <th id='date-cell'>15:30</th>
                  <th id='date-cell'>16:00</th>
                  <th id='date-cell'>16:30</th>
                  <th id='date-cell'>17:00</th>
                  <th id='date-cell'>17:30</th>
                  <th id='date-cell'>18:00</th>
                  <th id='date-cell'>18:30</th>
                  <th id='date-cell'>19:00</th>
                  <th id='date-cell'>19:30</th>
                  <th id='date-cell'>20:00</th>
                  <th id='date-cell'>20:30</th>
                </tr>
                <?php
                  // Connecting, selecting database
                  $dbconn = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay")
                   or die('Could not connect:' . pg_last_error());
                  $sql = "SELECT event_id FROM times WHERE room_id='";
                  $sql .= $_GET["room"];
                  $sql .= "' AND (date >= '2017-04-24' AND date <= '2017-04-28') ORDER BY date, time;";
                  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
                  $count = 0;
                  $day = 1;
                  while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
                    if ($count % 26 == 0) {
                      switch ($day) {
                        case 1:
                          echo "\t<tr>\n\t\t<td id='date-cell'>Monday</td>";
                          break;
                        case 2:
                          echo "\t<tr>\n\t\t<td id='date-cell'>Tuesday</td>";
                          break;
                        case 3:
                          echo "\t<tr>\n\t\t<td id='date-cell'>Wednesday</td>";
                          break;
                        case 4:
                          echo "\t<tr>\n\t\t<td id='date-cell'>Thursday</td>";
                          break;
                        case 5:
                          echo "\t<tr>\n\t\t<td id='date-cell'>Friday</td>";
                          break;
                      }
                      $day += 1;
                    }
                    if ($line[0]) {
                      echo "\t\t<td id='time-cell-busy'></td>\n";
                    } else {
                      echo "\t\t<td id='time-cell-free'><input type='checkbox' name='time_list[]' value='$count'></td>";
                    }
                    $count += 1;
                    if ($count % 26 == 0) {
                      echo "\t</tr>\n";
                    }
                  }
                ?>
              </table>
            </div>
            <div class="row">
              <h5><span style="color: #22b14c">Green</span> = Free; <span style="color: #df003c">Red</span> = Busy.</h5>
              <input type="hidden" name="room" value="<?php echo htmlspecialchars($_GET['room']) ?>">
            </div>
            <div class="row">
              <div class="col-md-5">
                <h5>Give your reservation a name (this will be public):<span style="color: red;">*</span> </h5>
                <input type="text" name="info">
              </div>
              <div class="col-md-5">
                <h5>Your student ID number (930):<span style="color: red;">*</span></h5>
                <input type="number" name="reserver_id" min="0">
              </div>
            </div>
            <div clss="row">
              <br>
              <input type="submit" name="submit" value="Submit my booking request">
            </div>
          </form>
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
