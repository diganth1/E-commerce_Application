<?php
$con = mysqli_connect("localhost","root","gargee","661DB");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
if($_POST['Password'] != $_POST['ConfirmPassword'])
{
	echo "Passwords do not match. ";
		die();
}
  
//Check if req fields are blank or not

$select = mysqli_query($con,"SELECT * FROM Employee WHERE EmployeeId = '" . $_POST['EmployeeId'] . "'");

$no_of_rows = mysqli_num_rows($select);
if ($no_of_rows == 0)
{
	echo "Incorrect Employee ID. ";
		die();
}

$row = mysqli_fetch_array($select);
//Make userID unique and encrypt the password.

$insert = "UPDATE Employee set UserId ='" . $_POST['UserId'] . "', Password = '" . $_POST['Password'] . "' WHERE EmployeeId = '" . $_POST['EmployeeId'] . "'";

//Execute the insert Query
if (!mysqli_query($con,$insert))
{
  die('Error: ' . mysqli_error($con));
}
//Redirect to Customer Home Page
echo "Employee Profile Successfully Updated";

mysqli_close($con);
?>

