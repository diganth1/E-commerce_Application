<?php
	session_start();
	
	if ( !$_POST['Name'] || !$_POST['EmailID'] || !$_POST['Address'] || !$_POST['CountryName'] || !$_POST['ResidentPhoneNumber'] || !$_POST['MobileNumber'] || !$_POST['UserId'] )
	{
		echo "One or more required fields left blank. <a href = editProfile.php> Click here to go back </a>";
		die();
	}
	
	$con = mysqli_connect("localhost","root","gargee","661DB");

	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$sel = mysqli_query($con,"SELECT * FROM Country WHERE CountryName = '" . $_POST['CountryName'] . "'");
	$r = mysqli_fetch_array($sel);
	
	
	
	if(!mysqli_query($con,"UPDATE Customer SET Name = '" . $_POST['Name'] . "', EmailID = '" . $_POST['EmailID'] . "', Address = '" . $_POST['Address'] . "', CountryId = '" . $r['CountryId'] . "', ResidentPhoneNumber = '" . $_POST['ResidentPhoneNumber'] . "', MobileNumber = '" . $_POST['MobileNumber'] . "', UserId = '" . $_POST['UserId'] . "' WHERE CustomerId = " . $_SESSION['CustomerId']))
	{
		die('Error: ' . mysqli_error($con));
	}
	
	else
	{
		echo "<font color ='white'>Profile updated!!!</font>";
	}
	
?>