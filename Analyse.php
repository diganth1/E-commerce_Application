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
		$update = mysqli_query($con,"update ProposeProduct SET Status = 'A' Where ProposalId = '". $res[$i] . "'");
		$update1 = mysqli_query($con,"update ProposeProduct SET EmployeeId = '" . $_SESSION['EmployeeId'] ."' WHERE ProposalId = '". $res[$i] . "'");
	}
	
	echo "<font color ='white'>Successfully Approved!</font>";
		
	mysqli_close($con);
	
?>