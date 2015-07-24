<?php
	session_start();
	$con = mysqli_connect("localhost","root","gargee","661DB");
	echo "<html><body style='color:white;'>";
	
	$select = mysqli_query($con, "Select ProductId ,Name,Cost,Stock,Status FROM Products WHERE Name LIKE '%" . $_POST['Name'] ."%' and Status = 'A'");
	$noofrows = mysqli_num_rows($select);
	if ($noofrows == 0)
	{
		echo "<font color = 'white'>Sorry - No such product exists or the product you may be looking for is retired. Please Submit a Proposal and we will take it into consideration. <br> Thank you.!!!</font>";
	}
	
	else
	{
	
	 
	$d = getdate();
	
	$y = $d["year"];
	$m = $d["mon"];
	$day = $d["mday"];
	
	$x = $y . "-" . $m . "-" . $day;
	$i = array();
	$v = mysqli_query($con, "Select Validity from Offer Where Type = '". $_SESSION['Type']  . "' and CountryId = '" . $_SESSION['CountryId'] . "'");
	if(mysqli_num_rows($v)!=0){
	$some = mysqli_fetch_array($v);
	$var = new DateTime($x);
	$var->add(new DateInterval('P' . $some['Validity'] . 'D'));
	$vdate = $var->format('Y-m-d');
	$xt = strtotime($x);
	$vt = strtotime($vdate);}
	else{
	$xt = strtotime($x);
	$vt = strtotime($x);}
	
	
	$j = 0;
	if ( $vt >= $xt )
	{
		
		$sel = mysqli_query($con, "Select Type, MAX(Discount), Description FROM Offer WHERE Type = '". $_SESSION['Type']."' AND LaunchDate <= '". $x . "'  and CountryId = '" . $_SESSION['CountryId'] . "'");
		if(mysqli_num_rows($sel)!=0)
		{
		echo "<table border = '1' bgcolor ='black'><tr><th>Type</th><th>Discount</th><th>Description</th></tr>";
		$r = mysqli_fetch_array($sel,MYSQL_NUM);
	
		echo "<tr> <td> ". $r[0] ." </td> <td>".$r[1] ."</td> <td> ". $r[2] ." </td><tr>";
		$j = $r[1];
	
	
	echo "</table></form><br><br>";
	}
	
	echo "<form action ='place.php' method = 'post'><table border = '1' bgcolor ='black'><tr><th>ProductId</th><th>Product Name</th><th>Cost</th><th>Stock</th><th>Status</th><th>Cost After Discount</th><th>Select</th></tr>";
	
	while($row = mysqli_fetch_array($select,MYSQL_NUM)) 
	{
		echo "<tr> <td> ". $row[0] ." </td> <td>".$row[1] ."</td> <td> ". $row[2] ." </td> <td> ". $row[3] ." </td> <td> ". $row[4] ." </td> <td> ". (intval($row[2]) - (($j / 100 ) * intval($row[2]) )) ." </td> <td><input type = 'radio' name = 'select' id = 'select' value = '".$row[0]."'> </td></tr>";
	}
	
	echo "</table><br>Enter Quantity: <input type = 'number' name = 'Quantity' default = 1><input type = 'submit' value = 'Place Order'></form></body></html>";
	
	
	}}
	
	mysqli_close($con);
?>
