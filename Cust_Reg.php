<?php


$con = mysqli_connect("localhost","root","gargee","661DB");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
//Check if req fields are blank or not
if($_POST['Password'] != $_POST['ConfirmPassword'])
{
	echo "Both your passwords do not match. Try again!";
}

$select = mysqli_query($con,"SELECT CountryId FROM Country WHERE CountryName = '" . $_POST['CountryName'] . "'");

$row = mysqli_fetch_array($select);
//Make userID unique and encrypt the password.

$insert = "INSERT INTO Customer (UserId, Password, Name, Address, ResidentPhoneNumber, MobileNumber, EmailID, CountryId) VALUES ('" . $_POST['UserId'] . "', '" . $_POST['Password'] . "','" . $_POST['Name'] . "','" . $_POST['Address'] . "','" . $_POST['ResidentPhoneNumber'] . "','" . $_POST['MobileNumber'] . "','" . $_POST['EmailID'] ."', " . $row['CountryId'] . ")";

//Execute the insert Query
if (!mysqli_query($con,$insert))
{
  die('Error: ' . mysqli_error($con));
}

//Redirect to Customer Home Page
header("Location: http://localhost/Login.html");

mysqli_close($con);
?>

