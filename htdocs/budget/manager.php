<?php
    session_start();
    require('dbconn.php');

    //View the bill:
    if(isset($_POST['vw']))
    {
        $_SESSION['bill'] = substr($_POST['vw'], 4);
        unset($_POST['vw']);
        header('Location: bill.php');
    }

    //Accept or Reject the bill
    if(isset($_POST['Submit']))
    {

$queryto1 = "SELECT * FROM `bill` WHERE `bid`=".substr($_POST['Submit'],7);
$resultto = mysqli_query($conn, $queryto1);
$employeeto1 = mysqli_fetch_assoc($resultto);
$idto = $employeeto1['eid'];

$_SESSION['img'] = $employeeto1['scanimg'];

mysqli_free_result($resultto);
$queryto2 = "SELECT * FROM `emp` WHERE `eid`=".$idto;
$resultto = mysqli_query($conn, $queryto2);
$employeeto2 = mysqli_fetch_assoc($resultto);
$to = $employeeto2['eid'];
mysqli_free_result($resultto);


$subject = "New Verified";
$txt = "Hello ".$_SESSION['name']."! Your bill has been ";


    if(substr($_POST['Submit'],0,7)=="SubmitA")
    {
      $queryalt = "UPDATE `bill` SET `status`='Approved' WHERE `bid`=".substr($_POST['Submit'],7); 
      if(mysqli_query($conn, $queryalt))
      {
        $txt = $txt."approved.";
        if(mail($to,$subject,$txt))
        header('Location: bill_approved.php');
      else
        echo "Could not send email. Approved.";
      }
      
    }
    if(substr($_POST['Submit'],0,7)=="SubmitR")
    {
      $queryalt = "UPDATE `bill` SET `status`='Rejected' WHERE `bid`=".substr($_POST['Submit'],7); 
      if(mysqli_query($conn, $queryalt))
      {
        $txt = $txt."approved.";
        if(mail($to,$subject,$txt))
        header('Location: bill_rejected.php');
      else
        echo "Could not send email. Rejected.";
      }
      
    }

    
     }

    $query1 = "SELECT * FROM `mgr` WHERE `mname`='".$_SESSION['name']."'";
    $result = mysqli_query($conn, $query1);
    $manager = mysqli_fetch_assoc($result);
    $mid = $manager['mid'];
    mysqli_free_result($result);

    $query2 = "SELECT * FROM `emp` WHERE `mid`=".$mid;
    $result = mysqli_query($conn, $query2);
    $employee = mysqli_fetch_assoc($result);
    $eid = $employee['eid'];
    mysqli_free_result($result);

    $query3 = "SELECT * FROM `bill` WHERE `eid`= ".$eid." ORDER BY `status` DESC";
    $result = mysqli_query($conn, $query3);
    $bills = mysqli_fetch_all($result, MYSQLI_ASSOC) or die(mysqli_error($conn)); // Manager has 0 employees under him. Yet to do.
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

td {
  column-width: 20000px;
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
button {
  background-color: #4DDF59;
  color: white;
  padding: 10px 16px;
  /*margin: 4%;*/
  border: none;
  cursor: pointer;
  width: 80%;
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
<?php endif; ?>
</div>

<div class="row">
  <div class="side">
    <h2>About </h2>
    <p>The budget approval system is an application which helps the employees to submit the bills after being approved by the manager along with the scanned copy of the images of the bills. Our aim is to help the employees and managers to overcome the mundane and much time taking procedure of approving budgets.</p>

  </div>
  <div class="main">
    <h2 style = "align: right">Bills To Approve</h2>
  
  
    <?php foreach($bills as $bill) : ?>
      <div class="container">
        <table width="100%">
      <?php 
                $query = "SELECT * FROM `emp` WHERE `eid`=".$bill['eid'];
                $result = mysqli_query($conn, $query);
                $sub_by = mysqli_fetch_assoc($result);
                $_SESSION['submi_by'] = $sub_by['ename'];
                mysqli_free_result($result);
        ?>
        
        <tr>
      <td>Submitted by: <b><?php echo $_SESSION['submi_by']; ?></b> &nbsp &nbsp &nbsp &nbsp</td>
      <td>Amount: <b><?php echo $bill['amt']; ?></b><br/></td>
      <td rowspan="2" valign="top">Description: <b><?php echo $bill['description']; ?></b></td>
      </tr>
      <tr>
      <td>Type: <b><?php echo $bill['type']; ?></b></td>
      <td >Status: <b><?php echo $bill['status']; ?></b>&nbsp &nbsp &nbsp &nbsp<br/></td>
      </tr>
      <br/>
      <?php
      if($bill['status']=="Submitted"): ?>
        
        <span class="row" style="float:right;">
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <tr><td>
        <button type="submit" name="Submit" value="SubmitA<?php echo $bill['bid']; ?>">Approve Bill</button><br/></td>
        <td><button style="background-color: red" type="submit" name="Submit" value="SubmitR<?php echo $bill['bid']; ?>">Reject Bill</button></td>
      <hr>
      </span>
      <td><button style="background-color: #AAA;" type="Submit" name="vw" value = "view<?php echo $bill['bid']; ?>">View Bill</button></td></tr>
    <?php endif; 
      if($bill['status']!="Submitted"): ?>
        <td></td>
        <td></td>
        <td><button style="background-color: #AAA;" type="Submit" name="vw" value = "view<?php echo $bill['bid']; ?>">View Bill</button></td></tr>
      </form>
      <hr><br/>
    <?php endif; ?>
  <!--<option value = "mgr"><p style="padding: 12px 20px; margin: 8px 8px;">Manager</p></option>-->
      </div>
<?php endforeach; ?>
</div>
      
  

</body>
</html>