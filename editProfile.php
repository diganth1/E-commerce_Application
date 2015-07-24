<?php 
	session_start();
	$userid = $_SESSION['UserId'];
	$cusid = $_SESSION['CustomerId'];
	$con = mysqli_connect("localhost","root","gargee","661DB");

// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$select = mysqli_query($con,"SELECT * FROM Customer WHERE UserId = '" . $_SESSION['UserId'] . "'");
	
	$no_of_rows = mysqli_num_rows($select);
	if ($no_of_rows == 0)
	{
		echo "Incorrect User ID. <a href = LoginPage.html> Click here to go back </a>";
		die();
	}

	$row = mysqli_fetch_array($select);
	$sel = mysqli_query($con,"SELECT * FROM Country WHERE CountryId = '" . $row['CountryId'] . "'");
	$r = mysqli_fetch_array($sel);
?>

<html>
	<body>
	<h1>Edit details<h1>
	<form method="post" action = "updateProfile.php">
		<table>
			<tr>
				<td>Customer Name:</td>
				<td><input type = "text" required name = "Name" value = "<?php echo $row['Name'];?>"></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td> <input type="text" required name="Address" value = "<?php echo $row['Address'];?>"></td>
			</tr>
			<tr>
				<td>Contact Number Home:</td>
				<td> <input type="text" required name="ResidentPhoneNumber" value = "<?php echo $row['ResidentPhoneNumber'];?>"></td>
			</tr>
			<tr>
				<td> Mobile Number:</td>
				<td> <input type="text" required name="MobileNumber" value = "<?php echo $row['MobileNumber'];?>"></td>
			</tr>
			<tr>
				<td>Email Id:</td> 
				<td><input type="text" required name="EmailID" value = "<?php echo $row['EmailID'];?>"></td>
			</tr>
			<tr>
				<!-- Try removing the duplicate country -->
				<td>Country:</td>
				<td><select name="CountryName" required>
					<option selected = "selected" value = "<?php echo $r['CountryName'];?>"> <?php echo $r['CountryName'];?> </option>
					<option value="India">India</option>
					<option value="UAE">UAE</option>
					<option value="China">China</option>
					<option value="Indonasia">Indonasia</option>
					<option value="Thailand">Thailand</option>
					<option value="Japan">Japan</option>
					<option value="South Korea">South Korea</option>
					<option value="Nepal">Nepal</option>
					<option value="Bhutan">Bhutan</option>
					<option value="Bangladesh">Bangladesh</option>
					<option value="Afghanistan">Afghanistan</option>
					<option value="Pakistan">Pakistan</option>
			</select></td>
			</tr>
			<tr>
				<td>User Id:</td> 
				<td><input type="text" required name="UserId" value = "<?php echo $row['UserId'];?>"></td>
			</tr>
		</table>
		<input type="submit" name = "EditCustomer" value = "Edit Customer"><input type="reset" name="Reset" value = "Reset">
	</form>
	</body>
</html>				