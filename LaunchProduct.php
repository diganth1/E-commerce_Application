<?php
session_start();
	echo "<html> <body style='color:white;'> <h1> Launch Product</h1><form action = 'Launch.php' method='post'> <table border = '1' bgcolor = 'black'> <tr> <th>ProposalId</th><th>ProductName</th><th>Category</th><th>Votes</th><th>Quantity</th><th>Cost</th><th>Warranty</th><th>Stock</th><th>ReorderLevel</th><th>Select</th></tr>";
			
	$con = mysqli_connect("localhost","root","gargee","661DB");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	//change p to a
	$s = mysqli_query($con, "SELECT * FROM ProposeProduct WHERE Status = 'A'");
	$i = 0;
	$res = array();
	while($row = mysqli_fetch_array($s,MYSQL_NUM))
	{
		$selec = mysqli_query($con,"SELECT CategoryName from Category WHERE CategoryId = '" . $row[3] ."'");
		$r = mysqli_fetch_array($selec);
		$res[$i] = $r['CategoryName'];
		$i = $i + 1;
	}
	$sel = mysqli_query($con, "SELECT ProposalId, ProductName ,CategoryId, Votes, Quantity FROM ProposeProduct WHERE Votes > 0 and Status = 'A'");
	$i = 0;
	while($row = mysqli_fetch_array($sel,MYSQL_NUM)) 
	{
			echo "<tr> <td> ". $row[0] ." </td> <td>".$row[1] ." </td> <td>". $res[$i] ."</td><td>" .$row[3] ."</td><td>".$row[4] ."</td>";
			echo "<td><input type = 'text' name = 'Cost".$i."' value='0'></td><td><input type='text' name='Warranty".$i."' value='0'></td><td><input type='text' name='Stock".$i."' value='0'></td><td><input type='text' name='ReorderLevel".$i."' value='0'></td><td><input type = 'checkbox' name = 'select[]' id = 'select' value = '".$row[0].$i."'> </td></tr>";
			$i = $i + 1;
	}
	
		echo "</table><input type ='submit' value='Launch'><input type='reset' value='Reset'></form>";		
	
	
	echo "</table></body></html>";

	mysqli_close($con);
?>