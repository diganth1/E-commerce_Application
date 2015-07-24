<?php
	session_start();
	$con = mysqli_connect("localhost","root","gargee","661DB");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$orderid = $_POST['select'];
	
	$update = "Update OrderTable Set Status = 'C' Where OrderId = '". $orderid ."'";
	$sel = mysqli_query($con,"SELECT Quantity, ProductId from Item where orderid = '". $orderid ."'");
	$q = mysqli_fetch_array($sel);
	$up = "Update products set stock = stock - " . $q[0] . " where productid = '" . $q[1] . "'";
	

	if (!mysqli_query($con,$update))
		{
			die('Error: ' . mysqli_error($con));
		}
	
	if (!mysqli_query($con,$up))
		{
			die('Error: ' . mysqli_error($con));
		}
	echo "Order cleared.";
	
	mysqli_close($con);
	
?>