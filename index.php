<?php

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
          <li><a href="#">HOME</a></li>
          <li><a href="#about" class="nav-link">ABOUT US</a></li>
          <li><a href="#features" class="nav-link">SERVICES</a></li>
          <li><a href="#pricing" class="nav-link">FAQ'S</a></li>
        
          <li class="highlight"><a class="special" name="get_start" href="book.php">Book Now</a></li>
        </ul>
      </nav>
      <!--   navbar -->
    </header>
    <!-- header ends -->
    
    <main class="container">
      <section class="hero container">
        <h1 class="hero-title-primary">Music Box Rehearsal Studio </h1>
        <p class="hero-title-sub">Easy To Book – Band / Recording Studio</p>
    
        <button onclick="window.location.href='book.php';">Book Now</button>
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
    
      <div id="about" class="inner-content">
        <div class="inner-content-text content__TextLeft">
          <div  class="inter-content-subtitle">
            About
          </div>
    
          <div class="inner-content-title">
            Music Box Rehearsal Studio
          </div>
    
          <div class="inner-content-para">
            <p> Our studios are designed to meet the highest standards, offering a premium space for musicians, actors, and performers.</p>
          </div>
        </div>
    
        <div class="inner-image-container container__ImageRight">
          <div class="inner-content-image content__ImageRight">
            <img class="section-images" src="pics/1.jpg" style="object-position: 50% 50%;">
          </div>
        </div>
      </div>
    
      <div id="features" class="inner-content">
        <div class="inner-content-text content__TextRight">
          <div  class="inter-content-subtitle">
            Features
          </div>
    
          <div class="inner-content-title">
          Your Premier Rehearsal Studio Hub in Davao, Philippines.
          </div>
    
          <div class="inner-content-para">
            <p>
            At Rehearse Studio, we understand the importance of providing a seamless and inspiring environment for your artistic endeavors. Our state-of-the-art rehearsal studios are designed to meet the unique needs of musicians, actors, and performers, offering convenient and frictionless spaces for your creative journey.
          </div>
        </div>
    
        <div class="inner-image-container container__ImageLeft">
          <div class="inner-content-image content__ImageLeft">
            <img class="section-images" src="pics/2.jpg" style="object-position: 50% 50%;">
          </div>
        </div>
      </div>
    
    </section>
    
    <section id="pricing" class="pricing-container">
      <div  class="pricing-title">
        <h2>Pricing?</h2>
      </div>
      <div class="flex-container">
      <div class="flex-item">
        <ul class="package">
          <li class="header">Music Recording</li>  
          <li class="gray"><sup class="dolla">&#8369;</sup>250<sup class="dolla"></sup><br><span class="month">Per Hour<span></li>
          <li class="features first-feat">Per Hour Rent</li>
          <li class="features">Affordable Price</li>
          <li class="features">Music Recording Equipments</li>
          <li class="features">100% Safe</li>
          <li>
            <a href="book.php" type="button" name="rent_car" class="pricing-button"  style="text-decoration: none;color: red;">Book Now</a>
            
          </li>
        </ul>
      </div>
      <div class="flex-item">
       <ul class="package">
          <li class="header">Music Video Recording</li>
          <li class="gray"><sup class="dolla">&#8369;</sup>150<br><span class="month">Per Hour<span></li>
          <li class="features first-feat">Per Hour Rent</li>
          <li class="features">Affordable price </li>
          <li class="features">Music Recording Equipments</li>
          <li class="features">Video Recording Equipments</li>
          <li>
            <a href="book.php" type="button" name="rent_car" class="pricing-button" style="text-decoration: none; color: red;">Book Now</a>
          </li>
        </ul>
      </div>
      <div class="flex-item">
       <ul class="package">
          <li class="header">Band <br>Practice</li>
          <li class="gray"><sup class="dolla">&#8369;</sup>150<br><span class="month">Per Hour<span></li>
          <li class="features first-feat">Per Hour Rent</li>
          <li class="features">Affordable price </li>
          <li class="features">Affordable Equipments</li>
          <li class="features">100% Safe</li>
          <li>
            <a href="book.php" type="button" name="rent_car" class="pricing-button" style="text-decoration: none; color: red;">Book Now</a>
          </li>
        </ul>
      </div>
    </div>
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
    
  </body>
</html>
