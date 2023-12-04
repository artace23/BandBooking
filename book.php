<?php
  include("php/conn.php");
  require_once('tcpdf/tcpdf.php');
  // Assuming you have a MySQLi connection named $conn
  
  
  

  $sql = "SELECT * FROM sevices";
  $result1 = $conn->query($sql);
  $row1 = $result1->fetch_all(MYSQLI_ASSOC);


  
  if(isset($_POST["next"])) {
    $name = $_POST["name"];
    $band = $_POST["band"];
    $contact = $_POST["contact"];
    $services = $_POST["services"];
    $rate = $_POST["rate"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $refNo = $_POST["refNo"];

    $dateFormat = date('Y-m-d', strtotime($_POST['date']));

    $sql1 = "SELECT 1
    FROM
      bookingdates
    WHERE `date` = $dateFormat AND
      TIME_FORMAT(
        ADDTIME(
          STR_TO_DATE(`time`, '%h:%i %p'),  -- Convert the original time to TIME
          STR_TO_DATE(`hours`, '%h:%i %p')   -- Convert the hours to TIME and add to the original time
        ),
        '%h:%i %p'
      ) = '$time' OR `time` = '$time'";
    $result2 = $conn->query($sql1);
    $row2 = $result2->fetch_assoc();
  
    if($row2 > 0) {
      echo "<script>alert('Time is not availble!')</script>";
    }else {
      $insert = "CALL InsertBooking('$name', '$band', '$contact', $services, '$date', '$time', $rate, '$refNo')";
      if ($conn->query($insert)) {
        $sql = "SELECT bookingID FROM bookingDates ORDER BY bookingID DESC LIMIT 1";
        $getID = $conn->query($sql);
  
        if ($getID) {
            $result = $getID->fetch_assoc();
            $bookingID = $result['bookingID'];
            
            // Assuming $conn is your database connection
            $insert1 = "CALL InsertIntoBilling('$bookingID', 'Pending', '1')";
            $conn->query($insert1);
            
            generatePdf($conn);
        } else {
            // Handle the case where the query fails
            echo "Error: " . $conn->error;
        }
  
      } else {
          echo "Error: " . $conn->error;
      }
    }
      
  }

  function generatePdf($conn) {
    // Retrieve the data for the invoice using the provided bookingID
    $sql = "SELECT b.bookingID, c.clientID, c.name, s.serviceName, b.date, b.time, b.hours
            FROM `bookingdates` b
            INNER JOIN `client` c ON b.clientID = c.clientID
            INNER JOIN `sevices` s ON b.servicesID = s.servicesID
            ORDER BY b.bookingID
            DESC LIMIT 1";
    
    $sqlQuery = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sqlQuery);

    $clientID = $result['clientID'];
    $clientName = $result['name'];
    $bookingID = $result['bookingID'];
    $services = $result['serviceName'];
    $date = $result['date'];
    $time = $result['time'];
    $hours = $result['hours'];

    $filename = 'BookingNo'.$bookingID .'.pdf';

    if (file_exists($filename)) {
        unlink($filename);
    }

    // Use a PDF generation library (e.g., TCPDF) to create the PDF
    require_once('tcpdf/tcpdf.php');
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->writeHTML("Billing Information");
    $pdf->writeHTML("-------------------\n");
    $pdf->writeHTML("Client ID: $clientID\n");
    $pdf->writeHTML("Client Name: $clientName\n");
    $pdf->writeHTML("Services: $services\n");
    $pdf->writeHTML("Date: $date\n");
    $pdf->writeHTML("Time: $time\n");
    $pdf->writeHTML("Hours: $hours");
    $pdf->Output($filename, 'D');

    return $filename; // Return the filename for further use if needed
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css">
    <title>Music Box Rehearsal Studio</title>
  </head>
  <body>
    <header id="header" class="menu-container">
      <div class="logo-box">
        <svg id="header-img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve"><g><g>
    </g></g> </svg>
      </div>

      <!--   navbar -->
      <nav id="nav-bar">
        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
        <ul class="menu">
          <li><a href="index.php#">HOME</a></li>
          <li><a href="index.php#about" class="nav-link">ABOUT US</a></li>
          <li><a href="index.php#features" class="nav-link">SERVICES</a></li>
          <li><a href="index.php#pricing" class="nav-link">FAQ'S</a></li>
        </ul>
      </nav>
      <!--   navbar -->
    </header>
    <!-- header ends -->
    
    <main class="container">
      <section class="hero container">
        <h1 class="hero-title-primary"></h1>
        <p class="hero-title-sub"></p>
      </section>
    
    </main>

    <div>
      <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
        </g>
      </svg>
    </div>
    <!--Waves end-->
    <!--Header ends-->
    
    <!--Content starts-->
    <section class="content">
      <br>
      <form method="post">
        <label>Full Name</label>
        <input type="text" class="form-control" onkeypress="return ValidateAlpha(event)" name="name" required>
        <br>
        <label>Band Name</label>
        <input type="text" class="form-control" onkeypress="return ValidateAlpha(event)" name="band" required>
        <br>
        <label>Contact Number</label>
        <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" maxlength="11" name="contact"  required>
        <br>
        <label>Service</label>
        <select name="services" id="service" class="form-control">
          <?php
            foreach($row1 as $rows) {
              ?>
                <option value="<?php echo $rows['servicesID']?>"><?php echo $rows['serviceName']?></option>
              <?php
            }
          ?>
        </select>
        <br>
        <label>How many hours</label>
        <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" maxlength="2" name="rate"  required>
        <br>
        <label>Booking Date</label>
        <input type="date" class="form-control" name="date">
        <br>
        <label>Time</label>
        <select name="time" class="form-control">
            <option value="08:00 AM">08:00 AM</option>
            <option value="09:00 AM">09:00 AM</option>
            <option value="10:00 AM">10:00 AM</option>
            <option value="11:00 AM">11:00 AM</option>
            <option value="12:00 PM">12:00 PM</option>
            <option value="01:00 PM">01:00 PM</option>
            <option value="02:00 PM">02:00 PM</option>
            <option value="03:00 PM">03:00 PM</option>
            <option value="04:00 PM">04:00 PM</option>
            <option value="05:00 PM">05:00 PM</option>
            <option value="06:00 PM">06:00 PM</option>
            <option value="07:00 PM">07:00 PM</option>
            <option value="08:00 PM">08:00 PM</option>
            <option value="09:00 PM">09:00 PM</option>
            <option value="10:00 PM">10:00 PM</option>
            <option value="11:00 PM">11:00 PM</option>
        </select>

        <br><br>
        <div class="text-center">
          <img src="pics/GcashProcess.jpg" alt="" style="width: 25%;">
          <br><br>
          <div class="text-center">
            <label>Reference Number</label>
            <input name="refNo" class="form-control" required>
          </div>
        </div>        

        <div class="text-center">
          <button class="btn btn-primary" name="next">Next</button>
        </div>
      </div>
      </form>
    </section>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
      integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
      crossorigin="anonymous"
    ></script>
    
<script>
      function onlyNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
      }
      function ValidateAlpha(evt) {
        var keyCode = (evt.which) ? evt.which : evt.keyCode;
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode !== 32 && keyCode !== 44 && keyCode !== 46) {
          return false;
        }
        return true;
      }
    </script>
  </body>
</html>
