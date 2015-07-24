<?php
	session_start();
	
	$con = mysqli_connect("localhost","root","gargee","661DB");

// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	$sel = mysqli_query($con,"SELECT * from Products WHERE Name = '" . $_POST['Name'] . "'");
	$no = mysqli_num_rows($sel);
	
	
	if ($no == 0){
	$sel = mysqli_query($con,"SELECT * from ProposeProduct WHERE ProductName = '" . $_POST['Name'] . "'");
	$no_of_rows = mysqli_num_rows($sel);
	if ($no_of_rows == 0)
	{

	
	$select = mysqli_query($con,"SELECT CategoryId FROM Category WHERE CategoryName = '" . $_POST['CategoryName'] . "'");
	
	$no_of_rows = mysqli_num_rows($select);
	if ($no_of_rows == 0)
	{
		echo "Incorrect Category ID ";
		
	}
	$row = mysqli_fetch_array($select);
	$insert = "INSERT INTO ProposeProduct (ProductName,CustomerId,CategoryId,Quantity) values ('" . $_POST['Name'] . "','" . $_SESSION['CustomerId'] . "','" . $row['CategoryId'] . "','" . $_POST['Quantity'] . "')";
	
	if (!mysqli_query($con,$insert))
{
  die('Error is coming from here: ' . mysqli_error($con));
}
echo "<font color = 'white'>Successfully added your proposal!!!</font>";
}

else
{
	$r = mysqli_fetch_array($sel);
	$votes = $r['Votes'] + 1;
	$q = $r['Quantity'] + $_POST['Quantity'];
	$up = "UPDATE ProposeProduct set Votes = '" . $votes . "', Quantity = '" . $q . "' where ProposalId = '" . $r['ProposalId'] . "'";
	if (!mysqli_query($con,$up))
	{
		die('Error: ' . mysqli_error($con));
	}
	echo "<font color = 'white'>Votes and Quantity updated as your proposal already exists!</font>";

}}
else
{
		echo "The product already exists!";
	}

?>