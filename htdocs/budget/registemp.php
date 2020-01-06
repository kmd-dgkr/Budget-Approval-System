<?php
	require('dbconn.php');
  $query = "SELECT `mname` FROM `mgr` ORDER BY `mname`";
  $result = mysqli_query($conn, $query);
  $managers = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  //mysqli_close($conn);
  //var_dump($managers);//-> WORKS!
  $m_name = null;

  if(isset($_POST['Submit']))
  {
  $mname = mysqli_real_escape_string($conn, $_POST['username']);
  $memail = mysqli_real_escape_string($conn, $_POST['email']);
  $mpwd = mysqli_real_escape_string($conn, $_POST['psw']);
  $mcpwd = mysqli_real_escape_string($conn, $_POST['psw-repeat']);
  //if(isset($_POST['m_name']))
  //{
  $m_nm = mysqli_real_escape_string($conn, $_POST['m_name']);
  echo $m_nm;
  echo "from post ".$_POST['m_name'];

  $sqlmid = "SELECT * FROM mgr WHERE mname = '".$m_nm."'";
  if(mysqli_query($conn, $sqlmid))
    echo "QUERY FIINE.";
  else
    echo "QUERY NOT FINE.";
  $resmid = mysqli_query($conn, $sqlmid);

  $m_id = mysqli_fetch_assoc($resmid);

  mysqli_free_result($resmid);

  $mid = (int)mysqli_real_escape_string($conn, $m_id['mid']);
  echo "manager", $mid;


  
    echo "Submitted!!!";
    if($mpwd != $mcpwd)
      header('Location: pwderr.php');
    else{
      echo "insterting";
    //$sql = "INSERT INTO `emp` (`ename`, `epwd`, `empemail`, `mid`) VALUES ('$mname', '$mpwd', '$memail','".mysqli_real_escape_string($conn, $m_id['mid'])."')";
      $sql = "INSERT INTO `emp` (`ename`, `epwd`, `empemail`, `mid`) VALUES ('$mname', '$mpwd', '$memail','$mid')";
    if(mysqli_query($conn, $sql))
    {
      echo "Registered.";
      header('Location: added.php');
    }
    else
    {
      echo "ERROR: ".mysqli_error($conn);
    }
  }
//}
  mysqli_close($conn);
}
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
/*para font size*/
.p {
 font-size: 24px;
 font-family: Sans serif;
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
  padding: 20px;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
}


.img {
	margin-left: auto;
	margin-right: auto;
	display: block;
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


/* Full-width input fields */
input[type=text], input[type=password], input[type=email], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 4%;
  border: none;
  cursor: pointer;
  width: 40%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: 40%;
  padding: 14px 20px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: left;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 30%;
  border-radius: 40%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
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
  <a href="home.php" style = "background-color: #87e">Home</a>
  <!--<a href="#">Help</a>-->
  <a href="contact.php">Contact us</a>
  <a href="register.php" class="right">Sign Up</a>
   <a href="login.php" class="right">Login</a>


</div>

<div class="row">
  <div class="side">
    <h2>About</h2>
    <p>The budget approval system is an application which helps the employees to submit the bills after being approved by the manager along with the scanned copy of the images of the bills. Our aim is to help the employees and managers to overcome the mundane and much time taking procedure of approving budgets.</p>
  </div>
  <div class="main">

    <div class="imgcontainer">
      

    <form method="POST" class="modal-content" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="container">
      <h1 align ="center">Registration</h1>
      <p align= "center">Please fill in this form to create an account.</p>
	<label for="username"><b>Username</b></label>
      <input type="text" placeholder="Identify yourself as(Username)" name="username" required>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

	<label for="role"><b>Select your manager</b></label><br>
      	<select placeholder="Submit bills to" name="m_name" required>
          <option value="" disabled selected hidden>Submit bills to:</option>
          <?php foreach($managers as $manager) : ?>
	<option><?php echo $manager['mname']; ?></option>
	<!--<option value = "mgr"><p style="padding: 12px 20px; margin: 8px 8px;">Manager</p></option>-->
	
<?php endforeach; ?>
      </select><br>


      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required />

      <label for="psw-repeat"><b>Confirm Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required />
      
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="location.href = 'register.php';" class="cancelbtn">Cancel</button>
        <button type="submit" name="Submit" class="button" value="Submit">Sign Up</button>
      </div>
      <!--<label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="psw-repeat"><b>Confirm Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
      
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="location.href = 'register.php';" class="cancelbtn">Cancel</button>
        <button type="submit" name="Submit" class="button" value="Submit">Sign Up</button>
      </div> -->
    </div>
  </form>
    </div>
  </form>
</div>
</div>



</body>
</html>