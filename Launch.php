<?php
	session_start();
	$con = mysqli_connect("localhost","root","gargee","661DB");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$name = $_POST['select'];
	$i = 0;
	$res = array();
	foreach($name as $select)
	{
		$res[$i] = $select;
		$i = $i + 1;
	}
	
	$arrlen=count($res);
	
	for($i = 0; $i < $arrlen; $i++)
	{	
		
		$sel = mysqli_query($con,"select * from ProposeProduct where ProposalId = '". intval($res[$i]/10) ."'");
		$r = mysqli_fetch_array($sel);
		$insert = "INSERT INTO Products(CategoryId,EmployeeId,Name,Cost,WarrantyPeriod,Stock,Status,ReorderLevel) VALUES ('".$r[3] . "','" . $_SESSION['EmployeeId'] . "','" . $r[1] ."','" .$_POST['Cost'.$res[$i]%10] ."','" . $_POST['Warranty'.$res[$i]%10] ."','" . $_POST['Stock'.$res[$i]%10] . "','A','" . $_POST['ReorderLevel'.$res[$i]%10] . "')";
		
		
		if (!mysqli_query($con,$insert))
		{
			die('Error is coming from here: ' . mysqli_error($con));
		}
		
		$del = "DELETE FROM ProposeProduct WHERE ProposalId = '". intval($res[$i]/10) ."'";
		if (!mysqli_query($con,$del))
		{
			die('Error is coming from deletion: ' . mysqli_error($con));
		}
	}
	
	
	echo "<font color ='white'>Successfully Launched Product!!!</font>";

	mysqli_close($con);	
?>