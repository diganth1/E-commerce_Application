<?php
	session_start();
	echo "<html> <body style='color:white;'> <h1> Analyse Product</h1><form action = 'Analyse.php' method='post'> <table border = '1' bgcolor = 'black'> <tr><th>Proposal Id</th><th>Product Name</th><th>Votes</th><th>Status</th><th>Quantiity</th><th>Select</th></tr>";

	$con = mysqli_connect("localhost","root","gargee","661DB");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	
	$sel = mysqli_query($con, "SELECT ProposalId, ProductName , Votes, Status, Quantity FROM ProposeProduct WHERE Status = 'P'");
	while($row = mysqli_fetch_array($sel,MYSQL_NUM)) 
	{
		echo "<tr> <td> ". $row[0] ." </td> <td>". $row[1] . "</td><td>". $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4]."</td><td><input type = 'checkbox' name = 'select[]' id = 'select' value = '".$row[0]."'> </td></tr>";
	}
	
	
	
	echo "</table><input type ='submit' value='Approved'><input type='reset' value='Reset'></form></body></html>";


?>