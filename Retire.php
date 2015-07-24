<?php 
	
	$con = mysqli_connect("localhost","root","gargee","661DB");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

	$update = "UPDATE  Products SET Status = 'R' WHERE Name = '" . $_POST['Name'] . "'";
	
	if (!mysqli_query($con,$update))
	{
		die('Error: ' . mysqli_error($con));
	}
	//Redirect to Customer Home Page
	echo "<font color ='white'>". $_POST['Name'] . " retired!</font>";

	mysqli_close($con);
?>