<!DOCTYPE HTML>
<html>
<head>
  <title>Vishnu's Check Out </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
  .line-limit-length {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }
  .btn-primary{
    background: blue;
    display: inline-block;
    position: Center;
  }
  .header-cell{
      width: 100%;
      height: 90px;
      background: #555555;
      color: white;
      padding: 20px;
      column-span: all;
      -webkit-column-span: all;
  }
  .upper{width:100%; height:100px; background-color: #000;}
  .left{width:20%; height:1200px;background-color: white; float:left; margin-top:0px; margin-right: 2%;}
  .right{width:20%; height:1200px;background-color: white; float:right; margin-top:0px; margin-left: 1%;}
  .middle{height:1200px;background-color: #f2f2f2; margin-top:1px; margin-left: 1%;}
}
  </style>
</head>
<body>
<?php
session_start();

ini_set('display_errors', '1');
// define variables and set to empty values
$firstNameErr = $lastNameErr = $emailErr = $addressErr = $cityErr = $postErr =  "";
$firstName = $lastName = $email = $address = $city = $post  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstName"])) {
    $firstNameErr = "First Name is required";
  } else {
    $firstName = test_input($_POST["firstName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $firstNameErr = "Only letters and white space allowed";
    }
  }
    if (empty($_POST["lastName"])) {
      $lastNameErr = "Last Name is required";
    } else {
      $lastName = test_input($_POST["lastName"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
        $lastNameErr = "Only letters and white space allowed";
      }
    }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["address"])) {
    $addressErr = "address is required";
  }else{
    $address = test_input($_POST["address"]);
  }

  if (empty($_POST["city"])) {
    $cityErr = "city is required";
  } else {
    $city = test_input($_POST["city"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
      $cityErr = "Invalid city format";
    }
  }

  if (empty($_POST["postCode"])) {
    $postErr = "post code is required";
  } else {
    $post = test_input($_POST["postCode"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$post)) {
      $postErr = "Invalid post format";
    }
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="upper">
<div class="header-cell">
    <table width="100%">
        <tr>
            <td width="20%" align="left">
              <h2 style="color: white;">Hertz-UTS</h2>
            </td>
            <td width="60%" align="center">
                <h1 style="color: white;">Vishnu's Car Rental</h1>
            </td>
            <td width="15%" align="center">
                <button type="button" class="btn btn-primary" onclick="window.location.href='shoppingCart.php'">Shopping Cart</button>
            </td>
        </tr>
    </table>
</div>
</div>
<div class = "left"></div>
<div class = "right"></div>

<div class = "middle">
<p><span class="error">* Mandatory Fields</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="firstName">First Name:</label>
  <span class="error" style = "color: #ff0000">* <?php echo $firstNameErr;?></span>
  <input type="text" name="firstName" size="100" value="<?php echo $firstName;?>">
  <br><br>

  <label for="lastName">Last Name:</label>
  <span class="error" style = "color: #ff0000">* <?php echo $lastNameErr;?></span>
  <input type="text" name="lastName" size="100" value="<?php echo $lastName;?>">
  <br><br>

  <label for="email">E-mail Address:</label>
  <span class="error" style = "color: #ff0000">* <?php echo $emailErr;?></span>
  <input type="text" name="email" size="100" value="<?php echo $email;?>">
  <br><br>

  <label for="address">Address Line 1:</label>
  <span class="error" style = "color: #ff0000">* <?php echo $addressErr;?></span>
  <input type="text" name="address" size="100" value="<?php echo $address;?>">
  <br><br>

  <label for="address">Address Line 2:</label>
  <input type="text" size="100" >
  <br><br>

  <label for="city">City:</label>
  <span class="error" style = "color: #ff0000">* <?php echo $cityErr;?></span>
  <input type="text" name="city" size="100" value="<?php echo $city;?>">
  <br><br>

  <label for="state">State:</label>
  <span class="error" style = "color: #ff0000">* </span>
  <select id="country" name="country">
    <option value="NSW">New South Wales</option>
    <option value="ACT">Australia Capital Territory</option>
    <option value="NT">Northern Territory</option>
    <option value="QLD">Queensland</option>
    <option value="SA">South Australia</option>
    <option value="TAS">Tasmania</option>
    <option value="VIC">Victoria</option>
    <option value="WA">Western Australia</option>
      </select>
  <br><br>

  <label for="postCode">Post Code:</label>
  <span class="error" style = "color: #ff0000">* <?php echo $postErr;?></span>
  <input type="text" size="100" name="postCode" value="<?php echo $post;?>">
  <br><br>

  <label for="payment">Payment Type:   </label>
  <span class="error" style = "color: #ff0000">* </span>
  <select id="paymentType" name="paymentType">
      <option value="Visa">VISA</option>
      <option value="PayPal">PayPal</option>
      <option value="MasterCard">Master Card</option>
  </select>
  <?php // calculate total payment
  session_start();
  $total= 0;
 if(!isset($_SESSION['store'])){
    $rentalDays = $_REQUEST["rentalDays"];
    $_SESSION['store'] = $rentalDays;
  }
  else{
     $rentalDays = $_SESSION['store'];
  }
  $index = 0;
  foreach ($_SESSION["cart"] as $id => $item) {
      $_SESSION["cart"][$id]["RentalDays"] = $rentalDays[$index];
      $total += $rentalDays[$index++] * $item["PricePerDay"];
  }
  $_SESSION["total"] = $total;
  ?>
  <br><br>
  <h3>You are to pay $<?php echo $total;?></h3>
  <button type="button" class = "btn btn-primary" onclick="window.location.href='carsHomePage.php'">Continue Selection</button>
  <button type="submit" name="Booking" class = "btn btn-primary" value="Booking">Booking</button>
  <!-- <input type="submit" name="Booking" class="button" value="Booking" > -->
</form>
</div>
<?php
$test_var = "";
if ($emailErr == "" && $firstNameErr == "" && $lastNameErr == ""  && $addressErr == "" && $cityErr == "" && $postErr == "" ){
  if(isset($_POST['Booking'])){
    $test_var = $_POST['email'];
    $subject = "Your ordered products";
    $message = '<html>
                <body>
                <h2>This is a confirmation email of your order.</h2>
                <h3>Thanks for renting cars from Hertz-UTS, the total cost is $' . $_SESSION["total"] .
               '</h3><h3>Details are as follows:</h3>';
    foreach ($_SESSION["cart"] as $id => $item) {
    $message .= 'Model: '.$item["Brand"].'-'.$item['Model'].'-'.$item['Year'];
    $message .= '<br>mileage: ' . $item["Mileage"] . ' kms';
    $message .= '<br>fuel_type: ' . $item['FuelType'];
    $message .= '<br>seats: ' . $item['Seats'];
    $message .= '<br>price_per_day: ' . $item['PricePerDay'];
    $message .= '<br>rent_days: ' . $item['RentalDays'];
    $message .= '<br>description: ' . $item['Description'];
    $message .= '<br><br>';
   }
   $message .= '</body>
                </html>';

   $headers = "MIME-Version: 1.0\r\n";
   $headers .= "Content-type: text/html; charset=UTF-8\r\n";
   $headers .= "From: <13174038@student.uts.edu.au>\r\n";
   $headers .= "Return-Path: <13174038@student.uts.edu.au>\n";
   $from = "13174038@student.uts.edu.au";

    mail($test_var,$subject,$message,$headers);
    echo "<script type='text/javascript'>window.top.location='send_email.php';</script>"; exit;
  }
}
?>
</body>
</html>
