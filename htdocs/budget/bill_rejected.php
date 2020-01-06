<?php
session_start();
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
  background-color: #ffffff;
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
  background-color: #fff;
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
    <div class="fakeimg" style="background-color: white">
      <h1 align ="center" style="background-color: white;">The bill has been rejected.</h1><br>
            <p align ="center" style="background-color: white;">Click on your username to view remaining bills.</p><br>

    </div>
  

</body>
</html>