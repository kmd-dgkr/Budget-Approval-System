<?php
session_start();
require('dbconn.php');

    $query2 = "SELECT * FROM `emp` WHERE `ename`='".$_SESSION['name']."'";
    $result = mysqli_query($conn, $query2);
    $employee = mysqli_fetch_assoc($result);
    $eid = $employee['eid'];
    $mid = $employee['mid'];
    mysqli_free_result($result);

    $query3 = "SELECT * FROM `bill` WHERE `eid`=".$eid." ORDER BY `status` DESC";
    $result = mysqli_query($conn, $query3);
    $bills = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);


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
  padding: 10px;
  text-align: center;
  background: #1abc9c;
  color: white;
}

/* Increase the font size of the heading */
.header h1 {
  font-size: 20px;
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

button {
  background-color: #4DDF59;
  color: white;
  padding: 14px 20px;
  /*margin: 4%;*/
  border: none;
  cursor: pointer;
  width: 25%;
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
  -ms-flex: 20%; /* IE10 */
  flex: 20%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {   
  -ms-flex: 80%; /* IE10 */
  flex: 80%;
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
  	<h2 style = "align: right">My Bills</h2>
    <b>Submit a new bill here: &nbsp &nbsp</b>
    <button  type="submit" onclick="location.href='submit_bill.php';">Submit Bill</button>
          <br/><hr/>

      <?php foreach($bills as $bill) : ?>
      <div class="container">
      <?php 
                $query = "SELECT * FROM `mgr` WHERE `mid`=".$mid;
                $result = mysqli_query($conn, $query);
                $sub_to = mysqli_fetch_assoc($result);
                $submi_to = $sub_to['mname'];
                mysqli_free_result($result);
        ?>
      
      Submitted to: <b><?php echo $submi_to; ?></b> &nbsp &nbsp &nbsp &nbsp
      Amount: <b><?php echo $bill['amt']; ?></b><br/>
      Type: <b><?php echo $bill['type']; ?></b> &nbsp &nbsp &nbsp &nbsp        
      Status: <b><?php echo $bill['status']; ?></b><br/>
      Description: <b><?php echo $bill['description']; ?></b>

      <!--BUTTON TO APPROVE-->

      <br><br><hr><br>
  <!--<option value = "mgr"><p style="padding: 12px 20px; margin: 8px 8px;">Manager</p></option>-->
      </div>
<?php endforeach; ?>
	
  </div>
  

</body>
</html>