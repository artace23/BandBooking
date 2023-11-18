<?php
  include("php/conn.php");

  // Assuming you have a MySQLi connection named $conn
  
  function generatePdf($clientID, $services, $date, $time, $hours) {
      $pdfContent = "
          Billing Information
          -------------------
          Client ID: $clientID
          Services: $services
          Date: $date
          Time: $time
          Hours: $hours
      ";
  
      $filename = 'billing_info.pdf';
  
      // Open the file for writing
      if ($file = fopen($filename, 'w')) {
          // Write content to the file
          fwrite($file, $pdfContent);
  
          // Close the file
          fclose($file);
  
          // Set headers for PDF download
          header('Content-type: application/pdf');
          header('Content-Disposition: attachment; filename="' . $filename . '"');
          header('Content-Length: ' . strlen($pdfContent));
  
          // Output the file content
          readfile($filename);
  
          // Optionally, you may delete the file after downloading
          unlink($filename);
  
          exit(); // Ensure that no additional content is sent after the download
      } else {
          // Handle file open error
          echo "Error opening file for writing.";
      }
  }
  
  // Assuming you have retrieved $clientID, $services, $date, $time, $rate from your form
  
  // Perform your transaction and insert data into the database

  

  $result = $conn->query("SELECT date FROM bookingdates");
  $disabledDates = [];
  
  while ($row = $result->fetch_assoc()) {
      $disabledDates[] = $row['date'];
  }
  

  $sql = "SELECT * FROM sevices";
  $result1 = $conn->query($sql);
  $row1 = $result1->fetch_all(MYSQLI_ASSOC);

  $sql1 = "SELECT time, date, rate FROM bookingdates";
  $result2 = $conn->query($sql1);
  $row2 = $result2->fetch_all(MYSQLI_ASSOC);


  
  if(isset($_POST["next"])) {
    $name = $_POST["name"];
    $band = $_POST["band"];
    $contact = $_POST["contact"];
    $services = $_POST["services"];
    $rate = $_POST["rate"];
    $date = $_POST["date"];
    $time = $_POST["time"];


    $insert = "CALL InsertBooking('$name', '$band', '$contact', $services, '$date', '$time', $rate)";
    generatePdf($clientID, $services, $date, $time, $rate);
    if ($conn->query($insert)) {
      echo "<script>alert('Booking Succesfully!')</script>";
    } else {
        echo "Error: " . $conn->error;
    }


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
        <select name="time" id="time" class="form-control">
          <?php
          // Loop to generate options for each hour from 8:00 AM to 11:00 PM
          for ($hour = 8; $hour <= 23; $hour++) {
            $formattedHour = ($hour > 12) ? $hour - 12 : $hour;
            $amPm = ($hour >= 12) ? 'PM' : 'AM';
            $time = sprintf("%02d:00 %s", $formattedHour, $amPm);
            echo '<option value="' . $time . '">' . $time . '</option>';
          }
          ?>
        </select>
        <?php
        if(isset($_POST['time'])) {
          $time = $_POST['time'];
          $date = date('Y-m-d', strtotime($_POST['date']));
          foreach($row2 as $rows1){
            if($time == $rows1['time'] && $date == $rows1['date']) {
              echo "<script>alert('Time is not availble!')</script>";
            }
          }
        }?>

        <div class="text-center">
          <button class="btn btn-primary" name="next">Next</button>
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
    $(function() {
        var disabledDates = <?php echo json_encode($disabledDates); ?>;

        // Disable specific dates in the date input
        $('input[type="date"]').on('input', function() {
            var selectedDate = $(this).val();
            if (disabledDates.indexOf(selectedDate) !== -1) {
                alert("This date is already taken. Please choose another date.");
                $(this).val('');
            }
        });
    });
</script>
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
