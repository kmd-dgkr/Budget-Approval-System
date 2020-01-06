<?php
session_start();
require('dbconn.php');

//ini_set('SMTP','localhost');
//ini_set('smtp_port',25);
//ini_set('sendmail_from','kaumudidegekar@gmail.com');


$query1 = "SELECT * FROM `mgr` WHERE `mid`=".$_SESSION['empmgr'];
$result = mysqli_query($conn, $query1);
$manager = mysqli_fetch_assoc($result);
$to = $manager['memail'];
mysqli_free_result($result);







/*
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers  .= "From: NO-REPLY<no-reply@mydomain.com>" . "\r\n";
$subject = "Confirmation For Request";
$message = '<html>
                <body>
                    <p>Hi '.$firstname.' '.$lastname.'</p>
                    <p>
                        We recieved below details from you. Please use given Request/Ticket ID for future follow up:
                    </p>
                    <p>
                        Your Request/Ticket ID: <b>'.$ticketID.'</b>
                    </p>
                    <p>
                    Thanks,<br>
                    '.$team.' Team.
                    </p>
                </body>
            </html>';
mail( $to, $subject, $message, $headers );  */ 







$subject = "New Bill";
$txt = "Hello ".$_SESSION['name']."! You have new bills to check.";
//$headers = "From: webmaster@example.com";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Budget Approval System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Style the body */
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

/* Header/logo Title */
.header {
  padding: 80px;
  text-align: center;
  background: #1abc9c;
  color: white;
}

/* Increase the font size of the heading */
.header h1 {
  font-size: 40px;
}

/* Style the top navigation bar */
.navbar {
  overflow: hidden;
  background-color: #333;
}

/* Style the navigation bar links */
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

/* Right-aligned link */
.navbar a.right {
  float: right;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Column container */
.row {  
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  -ms-flex: 30%; /* IE10 */
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {   
  -ms-flex: 70%; /* IE10 */
  flex: 70%;
  background-color: white;
  padding: 20px;
}

/* Fake image, just for this example */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  height: 80%
  padding: 20px;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #fff;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .row {   
    flex-direction: column;
  }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width: 100%;
  }
}
</style>
</head>
<body>

<div class="header">
  <h1>Budget Approval System</h1>
</div>

<div class="navbar">
  <a href="home.php">Home</a>
  <!--<a href="#">Help</a>-->
  <a href="contact.php">Contact us</a>
<?php
  if(!isset($_SESSION['name'])): ?>
  <a href="register.php" class="right">Sign Up</a>
   <a href="login.php" class="right">Login</a>
 <?php endif; ?>
 <?php
 if(isset($_SESSION['name'])): ?>
  <a href="logout.php" class="right">Log Out</a>
      <?php
        if($_SESSION['role']=="emp"): ?>
        <a href="employee.php" class="right"><?php echo $_SESSION['name']; ?></a>
        <?php endif; ?>
        <?php
        if($_SESSION['role']=="mgr"): ?>
        <a href="manager.php" class="right"><?php echo $_SESSION['name']; ?></a>
        <?php endif; ?>
<?php endif; ?></div>
<div class="row">
  <div class="side">
    <h2>About </h2>
    <p>The budget approval system is an application which helps the employees to submit the bills after being approved by the manager along with the scanned copy of the images of the bills. Our aim is to help the employees and managers to overcome the mundane and much time taking procedure of approving budgets.</p>

  </div>
  <div class="main">
    <div class="fakeimg" style="background-color: white;">
      <h1 align ="center" style="background-color: white;">Your bill has been submitted!</h1>
            <p align ="center" style="background-color: white;">Thank you for using Budget Approval System, <?php echo $_SESSION['name']; 
            if(mail($to,$subject,$txt))
  echo "<br/><br/>Email alert on the way. Your manager knows now!";
else
  echo "<br/><br/>Could not alert your manager.";


            ?>

    </div>
  

</body>
</html>