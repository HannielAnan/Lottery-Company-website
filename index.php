<?php
session_start();

include 'partials/dbconnect.php';
$query = "SELECT * FROM winner ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $winner_username_1= $row['username'];
    $winner_number_1 = $row['three_digit_number'];
    $winner_dt_1 = $row['dt'];
}
//2nd table
$query = "SELECT * FROM winner_scheme_2 ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $winner_username_2 = $row['username'];
    $winner_number_2 = $row['four_digit_number'];
    $winner_dt_2 = $row['dt'];
}
//3rd table
$query = "SELECT * FROM winner_scheme_3 ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $winner_username_3 = $row['username'];
    $winner_number_3 = $row['five_digit_number'];
    $winner_dt_3 = $row['dt'];
}
//4thd table
$query = "SELECT * FROM winner_scheme_4 ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $winner_username_4 = $row['username'];
    $winner_number_4 = $row['six_digit_number'];
    $winner_dt_4 = $row['dt'];
}
//car
$query = "SELECT * FROM car_winner ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $winner_username_5 = $row['username'];
    $winner_number_5 = $row['seven_digit_number'];
    $winner_dt_5 = $row['dt'];
}
//motor
$query = "SELECT * FROM motor_winner ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $winner_username_6 = $row['username'];
    $winner_number_6 = $row['seven_digitmotor_number'];
    $winner_dt_6 = $row['dt'];
}
//Iphone 
$query = "SELECT * FROM iphone_winner ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $winner_username_7 = $row['username'];
    $winner_number_7 = $row['seven_digitiphone_number'];
    $winner_dt_7 = $row['dt'];
}
?>    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moon Winner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- site favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png" sizes="16x16">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css"> 
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <!-- custom select css -->
    <link rel="stylesheet" href="assets/css/vendor/nice-select.css">
    <!-- animate css  -->
    <link rel="stylesheet" href="assets/css/vendor/animate.min.css">
    <!-- lightcase css -->
    <link rel="stylesheet" href="assets/css/vendor/lightcase.css">
    <!-- slick slider css -->
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
    <!-- datepicker css -->
    <link rel="stylesheet" href="assets/css/vendor/datepicker.min.css">
    <!-- style main css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/dark-version.css">
  </head>
  <body>
     <?php require 'partials/nav.php'?>
           <section class="hero style--three">
            <div class="hero__circle"><img src="assets/images/elements/hero-4-circle.png" alt="image"></div>
            <div class="hero__obj"><img src="assets/images/elements/hero-4-obj.png" alt="image"></div>
            <div class="hero__car-left wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.9s"><img src="assets/images/elements/hero-4-car-left.png" alt="image"></div>
            <div class="hero__bike wow bounceIn" data-wow-duration="0.5s" data-wow-delay="1.3s"><img src="assets/images/elements/hero-4-bike.png" alt="image"></div>
            <div class="hero__car-right wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.9s"><img src="assets/images/elements/hero-4-car-right.png" alt="image"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="hero__content text-center">
                            <div class="hero__subtitle wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.9s">Try Your Luck!</div>
                            <h2 class="hero__title wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">Win Your Dream Car</h2>
                            <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">Don't miss your chance.Will you be our next lucky winner?</p>
                            <div class="hero__btn wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
             <!--next-draw-section start -->
            <div class="pt-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="next-draw-area" style="margin-top: -50px;">
                                <h3 class="title" style="font-size:40px;color:white;">Every new lucky draw will announce in every 72 hours.</h3>
                                <br>
                                <p style="color:white;">Try your luck and fulfil your dream!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- next-draw-section end-->
        
        <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-8 mx-auto text-center">
        <div style="background-color: black; border: 2px solid gold; padding: 10px; border-radius: 10px; margin-top: 10px;">
        <h1 style="color: gold; font-family: 'Montserrat', sans-serif;">3 Digit Winner</h1>
         <?php if (!empty($winner_username_1) && !empty($winner_number_1)) : ?>
	      <!-- <p style="color: gold;">The winner is: <?php echo $winner_username_1 ?></p> -->
	     <!-- <p style="color: gold;">User Name: <?php echo $winner_username_1 ?></p> -->
	      <p style="color: gold;font-size:54px;"> <?php echo $winner_number_1 ?></p>
          <p style="color: gold;font-size:24px;"> <?php echo $winner_dt_1 ?></p>
          
        <?php else : ?>
          <p style="color: gold;">Winner will be announced after every 72 hours.</p>
    <?php endif; ?>
        </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8 mx-auto text-center">
        <div style="background-color: black; border: 2px solid gold; padding: 10px; border-radius: 10px; margin-top: 10px;">
        <h1 style="color: gold; font-family: 'Montserrat', sans-serif;">4 Digit Winner</h1>
          <?php if (!empty($winner_username_2) && !empty($winner_number_2)) : ?>
            <!-- <p style="color: gold;">The winner is: <?php echo $winner_username_2 ?></p> -->
            <!-- <p style="color: gold;">User Name: <?php echo $winner_username_2 ?></p> -->
            <p style="color: gold;font-size:54px;"><?php echo $winner_number_2 ?></p>
            <p style="color: gold;font-size:24px;"><?php echo $winner_dt_2 ?></p>
          <?php else : ?>
            <p style="color: gold;">Winner 2 will be announced after every 72 hours.</p>
          <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
      <div class="col-lg-8 mx-auto text-center">
        <div style="background-color: black; border: 2px solid gold; padding: 10px; border-radius: 10px; margin-top: 10px;">
    <h1 style="color: gold; font-family: 'Montserrat', sans-serif;">5 Digit Winner</h1>
    <?php if (!empty($winner_username_3) && !empty($winner_number_3)) : ?>
        <!-- <p style="color: gold;">The winner is: <?php echo $winner_username_3 ?></p>
        <p style="color: gold;">User Name: <?php echo $winner_username_3 ?></p> -->
        <p style="color: gold;font-size: 54px;"> <?php echo $winner_number_3 ?></p>
        <p style="color: gold;font-size:24px;"><?php echo $winner_dt_3 ?></p>
    <?php else : ?>
        <p style="color:gold;">Winner 3 will be announced after every 72 hours.</p>
    <?php endif; ?>
    </div>
</div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8 mx-auto text-center">
        <div style="background-color: black; border: 2px solid gold; padding: 10px; border-radius: 10px; margin-top: 10px;">
        <h1 style="color: gold; font-family: 'Montserrat', sans-serif;">6 Digit Winner 4</h1>
    <?php if (!empty($winner_username_4) && !empty($winner_number_4)) : ?>
        <!-- <p style="color: gold;">The winner is: <?php echo $winner_username_4 ?></p>
        <p style="color: gold;">User Name: <?php echo $winner_username_4 ?></p> -->
        <p style="color: gold;font-size: 54px;"><?php echo $winner_number_4 ?></p>
        <p style="color: gold;font-size:24px;"><?php echo $winner_dt_4 ?></p>
    <?php else : ?>
        <p style="color:gold;">Winner 3 will be announced after every 72 hours.</p>
    <?php endif; ?>
    </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8 mx-auto text-center">
        <div style="background-color: black; border: 2px solid gold; padding: 10px; border-radius: 10px; margin-top: 10px;">
        <h1 style="color: gold; font-family: 'Montserrat', sans-serif;">Car Winner</h1>
    <?php if (!empty($winner_username_5) && !empty($winner_number_5)) : ?>
        <!-- <p style="color: gold;">The winner is: <?php echo $winner_username_5 ?></p>
        <p style="color: gold;">User Name: <?php echo $winner_username_5 ?></p> -->
        <p style="color: gold;font-size: 54px;"><?php echo $winner_number_5 ?></p>
        <p style="color: gold;font-size:24px;"><?php echo $winner_dt_5 ?></p>
        <p style="color: gold;">Previous</p>
    <?php else : ?>
        <p style="color: gold;">Winner 3 will be announced after every 72 hours.</p>
    <?php endif; ?>
    </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8 mx-auto text-center">
        <div style="background-color: black; border: 2px solid gold; padding: 10px; border-radius: 10px; margin-top: 10px;">
        <h1 style="color: gold; font-family: 'Montserrat', sans-serif;">Motor Bike Winner</h1>
    <?php if (!empty($winner_username_6) && !empty($winner_number_6)) : ?>
        <!-- <p style="color: gold;">The winner is: <?php echo $winner_username_6 ?></p>
        <p style="color: gold;">User Name: <?php echo $winner_username_6 ?></p> -->
        <p style="color: gold;font-size: 54px;"><?php echo $winner_number_6 ?></p>
        <p style="color: gold;font-size:24px;"><?php echo $winner_dt_6 ?></p>
    <?php else : ?>
        <p style="color: gold;">Winner 3 will be announced after every 72 hours.</p>
    <?php endif; ?>
    </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8 mx-auto text-center">
        <div style="background-color: black; border: 2px solid gold; padding: 10px; border-radius: 10px; margin-top: 10px;">
        <h1 style="color: gold; font-family: 'Montserrat', sans-serif;">IPhone Winner</h1>
    <?php if (!empty($winner_username_7) && !empty($winner_number_7)) : ?>
        <!-- <p style="color: gold;">The winner is: <?php echo $winner_username_7 ?></p>
        <p style="color: gold;">User Name: <?php echo $winner_username_7 ?></p> -->
        <p style="color: gold;font-size: 54px;"><?php echo $winner_number_7 ?></p>
        <p style="color: gold;font-size:24px;"><?php echo $winner_dt_7 ?></p>
    <?php else : ?>
        <p style="color:gold;">Winner 3 will be announced after every 72 hours.</p>
    <?php endif; ?>
    </div>
        </div>
      </div>
    </div>
    <?php require 'partials/footer.php'?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 
</body>
</html>
