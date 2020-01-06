<?php

  require('dbconn.php');
  if(isset($_POST['Submit'])){
  $query = "SELECT * FROM `mgr` WHERE `mname`='".$_POST['username']."'";
  $result = mysqli_query($conn, $query);
  $employee = mysqli_fetch_assoc($result);
  var_dump($employee);
  print_r($employee);
  mysqli_free_result($result);


  if($employee['mpwd'] == $_POST['psw'])
  {
  session_start();
  $_SESSION['name'] = $employee['mname'];
  $_SESSION['id'] = $employee['mid'];
  $_SESSION['role'] = "mgr";
  header('Location: loggedin.php');

}
else
	header('Location: lpwderr.php');
}
else
	echo "Could not submit.";
?>