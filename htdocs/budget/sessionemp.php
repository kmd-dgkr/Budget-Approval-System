<?php

  require('dbconn.php');
  if(isset($_POST['Submit'])){
  $query = "SELECT * FROM `emp` WHERE `ename`='".$_POST['username']."'";
  $result = mysqli_query($conn, $query);
  $employee = mysqli_fetch_assoc($result);
  var_dump($employee);
  print_r($employee);
  mysqli_free_result($result);


  if($employee['epwd'] == $_POST['psw'])
  {
  session_start();
  $_SESSION['name'] = $employee['ename'];
  $_SESSION['id'] = $employee['eid'];
  $_SESSION['empmgr'] = $employee['mid'];
  $_SESSION['role'] = "emp";
  header('Location: loggedin.php');

}
else
	header('Location: lpwderr.php');
}
else
	echo "Could not submit.";
?>
<!--

<!DOCTYPE html>
<html>
<head><title>SESSION CHECK</title></head>
<body>
<form method="post" action="sessionemp.php">
	<input type="text" name="username">
	<button type ="submit" name="submit" value="Submit">Send</button>
		<p><?php //echo $_SESSION['name']; ?></p>
</form>
</body>
</html>

-->