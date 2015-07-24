<?php
session_start();
$con = mysqli_connect("localhost","root","gargee","661DB");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result=mysqli_query($con,"SELECT CountryId FROM Country WHERE CountryName = '" . $_POST['CountryName'] . "'");

$row = mysqli_fetch_array($result);

 
$insert="INSERT INTO offer (Type, CountryId,  EmployeeId, Validity, Discount, Description, LaunchDate) VALUES ('" . $_POST['Type'] . "','". $row['CountryId'] ."','".$_SESSION['EmployeeId']. "','". $_POST['Validity'] . "','" . $_POST['Discount'] . "','" . $_POST['Description'] . "','" . $_POST['OfferDate'] . "')";

if (!mysqli_query($con,$insert))
{
  die('Error: ' . mysqli_error($con));
}
echo "<font color ='white'> Offer has been released.</font>";

mysqli_close($con);
?>
<br>
<a href="offerRelease.html">Click here to change country</a>
