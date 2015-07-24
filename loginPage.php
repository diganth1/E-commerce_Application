 <?php 
	session_start();
// store session data


$con = mysqli_connect("localhost","root","gargee","661DB");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
if ( !$_POST['UserId'] || !$_POST['Password'] )
{
	echo "One or more required fields left blank. <a href='Home.html'> Click here to go back home. </a>";
	die();
}

$select = mysqli_query($con,"SELECT * FROM Customer WHERE UserId = '" . $_POST['UserId'] . "'");

$no_of_rows = mysqli_num_rows($select);
if ($no_of_rows == 0)
{
	$select = mysqli_query($con,"SELECT * FROM Employee WHERE UserId = '" . $_POST['UserId'] . "'");
	$no_of_rows = mysqli_num_rows($select);
	if ($no_of_rows == 0)
	{
		echo '<div id="container" >

<div id="header" style="height: 15%; color: #000000; background-color: black;background-image:url(TileImg1.jpg); background-position:left; background-repeat:no-repeat" ">
<h1 style="text-align: center; color: white; font-family: bilbo-swash-caps; font-style: normal; font-weight: 800; font-size: xx-large;"><b>e-Retail Order Management</b></h1>
<h3 style="text-align: right; color: white; font-family: bilbo-swash-caps; font-style: normal; font-weight: 400;">~Shopping is just a click away</h3>
<hr color="#676565">
<hr color="#787878">
</div>
<div id="menu" style="background-color: black; height: 500px; width: 100%; float: left;">
<h3 style="color:grey">Incorrect User ID. <a href="Home.html"> Click here to go back home. </a></h3></div> <div id="footer" style="background-color: Black; clear: both; text-align: center;color: white;">
Copyright Â© DragonByteGroup</div>';

		
		die();
	}
	$row = mysqli_fetch_array($select);

	if($_POST['Password'] != $row['Password'])
	{
		echo '<div id="container" >

<div id="header" style="height: 15%; color: #000000; background-color: black;background-image:url(TileImg1.jpg); background-position:left; background-repeat:no-repeat" ">
<h1 style="text-align: center; color: white; font-family: bilbo-swash-caps; font-style: normal; font-weight: 800; font-size: xx-large;"><b>e-Retail Order Management</b></h1>
<h3 style="text-align: right; color: white; font-family: bilbo-swash-caps; font-style: normal; font-weight: 400;">~Shopping is just a click away</h3>
<hr color="#676565">
<hr color="#787878">
</div>
<div id="menu" style="background-color: black; height: 500px; width: 100%; float: left;">
<h3 style="color:grey">Incorrect Password. <a href="Home.html"> Click here to go back home. </a></h3></div> <div id="footer" style="background-color: Black; clear: both; text-align: center;color: white;">
Copyright Â© DragonByteGroup</div>';
		
	}

	else
	{
		$_SESSION['EmployeeId'] = $row['EmployeeId'];
		$_SESSION['UserId'] = $row['UserId'];
		if($row['RoleId'] == 101)
		{
			header("Location: http://localhost/CRMhome.html");
		}
		else if($row['RoleId'] == 102)
		{
			header("Location: http://localhost/OMhome.html");
		}
		else if($row['RoleId'] == 103)
		{
			header("Location: http://localhost/PMhome.html");
		}
	}
	
}
else
{

	$row = mysqli_fetch_array($select);

	if($_POST['Password'] != $row['Password'])
	{
		echo '<div id="container" >

<div id="header" style="height: 15%; color: #000000; background-color: black;background-image:url(TileImg1.jpg); background-position:left; background-repeat:no-repeat" ">
<h1 style="text-align: center; color: white; font-family: bilbo-swash-caps; font-style: normal; font-weight: 800; font-size: xx-large;"><b>e-Retail Order Management</b></h1>
<h3 style="text-align: right; color: white; font-family: bilbo-swash-caps; font-style: normal; font-weight: 400;">~Shopping is just a click away</h3>
<hr color="#676565">
<hr color="#787878">
</div>
<div id="menu" style="background-color: black; height: 500px; width: 100%; float: left;">
<h3 style="color:grey">Incorrect Password. <a href="Home.html"> Click here to go back home. </a></h3></div> <div id="footer" style="background-color: Black; clear: both; text-align: center;color: white;">
Copyright Â© DragonByteGroup</div>';
		die();
	}

	else
	{
		$_SESSION['CountryId'] = $row['CountryId'];
		$_SESSION['CustomerId'] = $row['CustomerId'];
		$_SESSION['UserId'] = $row['UserId'];
		$_SESSION['Type'] = $row['Type'];
		header("Location: http://localhost/CustHome.html");
	}
}
	
?>