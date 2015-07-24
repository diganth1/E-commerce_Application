<?php 
	echo "<html> <body style='color:white;'> <h1> Retire Product</h1><br> <table border = '1' bgcolor = 'black'> <tr> <th>ProductId</th> <th> Product Name </th> <th> Quantity </th></tr> ";
	$con = mysqli_connect("localhost","root","gargee","661DB");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	
	
	$select = mysqli_query($con, "SELECT Products.ProductId, Products.Name, SUM(Item.Quantity) FROM Products JOIN Item ON Products.ProductId = Item.ProductId WHERE products.Status = 'A' GROUP BY Item.ProductId ");  
	
	while($row = mysqli_fetch_array($select,MYSQL_NUM)) 
	{
			echo "<tr> <td> ". $row[0] ." </td> <td>".$row[1] ." </td> <td>".$row[2] ."</td></tr>"; 
	}
	
	echo "</table><br><br><form action = 'Retire.php' method = 'post'><table> <tr> <td>Product(*):</td>	<td><select name = 'Name'>";

	$sel = mysqli_query($con, "SELECT Products.ProductId, Products.Name, SUM(Item.Quantity) FROM Products JOIN Item ON Products.ProductId = Item.ProductId WHERE products.Status = 'A' GROUP BY Item.ProductId");
	while($row = mysqli_fetch_array($sel,MYSQL_NUM)) 
	{
		echo "<option value = '" . $row[1] . "'>" .$row[1] . "</option>" ;
	}
	echo "</select>	</td> </tr>	</table>";
	echo "<input type = 'submit' value = 'Retire'>";
	echo "</form></body></html>";
	
	
	mysqli_close($con);
?>