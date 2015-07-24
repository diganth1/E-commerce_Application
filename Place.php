<?php
	session_start();
	$con = mysqli_connect("localhost","root","gargee","661DB");
	
	$d = getdate();
	
	$y = $d["year"];
	$m = $d["mon"];
	$day = $d["mday"];
	
	$productid = $_POST['select'];
	
	
	$x = $y . "-" . $m . "-" . $day;
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	$quantity = $_POST['Quantity'];
	
	$s = mysqli_query($con,"SELECT Cost from Products WHERE ProductID = '" . $productid . "'");
	$cost = mysqli_fetch_array($s);
	
	$se = mysqli_query($con, "Select Max(Discount) FROM Offer WHERE Type = '". $_SESSION['Type']."'  and CountryId = '" . $_SESSION['CountryId'] . "'");
	$disc = mysqli_fetch_array($se);
	
	$amtpaid = ($cost[0] - (( $disc[0] / 100) * $cost[0])) * $quantity ;
	$totalamt = $cost[0] * $quantity ; 
	
	$sel = mysqli_query($con,"SELECT OfferId FROM Offer WHERE Type = '" . $_SESSION['Type'] . "'  and CountryId = '" . $_SESSION['CountryId'] . "'");
	$offid = mysqli_fetch_array($sel);
	
	$sel1 = mysqli_query($con,"SELECT Address From Customer where CustomerId = '" .$_SESSION['CustomerId']. "'");
	$addr = mysqli_fetch_array($sel1);
	
	$inser =  "Insert into ordertable(CustomerId, OrderDate, OfferId, Status, ShippingAddress, TotalAmount, AmountPaid)  Values ( '". $_SESSION['CustomerId'] . "','" . $x . "','" . $offid[0] . "','P' ,'". $addr[0]. "','" . $totalamt . "','" . $amtpaid . "')";
	
	if (!mysqli_query($con,$inser))
		{
			die('Error: ' . mysqli_error($con));
		}
	
	echo "Order Placed";
	
	$odarr = array();
	$c = 0;
	$secon = mysqli_query($con,"Select OrderId from OrderTable where CustomerId = '". $_SESSION['CustomerId']."'");
	while($orid = mysqli_fetch_array($secon))
	{
		$odarr[$c] = $orid[0];
		$c = $c + 1;
	}
	$len = count($odarr);
	
	$i = "Insert into item(OrderId, ProductId, Quantity) Values  ('" . $odarr[$len - 1] ."','" . $productid . "','" . $_POST['Quantity'] . "')";
	if (!mysqli_query($con,$i))
		{
			die('Error: ' . mysqli_error($con));
		}
	
	mysqli_close($con);
?>