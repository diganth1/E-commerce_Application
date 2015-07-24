<?php
	session_start();
	
	$con = mysqli_connect("localhost","root","gargee","661DB");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	echo "<html> <body style='color:white;'> <h1> Clear Order </h1><form action = 'clear.php' method='post'> <table border = '1' bgcolor ='black'> <tr><th>Order Id</th><th>Product Name</th><th>Stock</th><th>Quantity</th><th>ReorderLevel</th><th>Select</th></tr>";

	$sel = mysqli_query($con, "SELECT OrderTable.OrderId, Products.ProductId, Products.Name, Products.Stock, Item.Quantity, Products.ReorderLevel FROM Products JOIN Item JOIN OrderTable ON Products.ProductId = Item.ProductId and  OrderTable.OrderId = Item.OrderId WHERE ordertable.Status = 'P'");  
	

	while($row = mysqli_fetch_array($sel,MYSQL_NUM)) 
	{
			echo "<tr> <td> ". $row[0] ." </td> <td>".$row[2] ." </td> <td>".$row[3] ."</td> <td>".$row[4] ."</td> <td>".$row[5] ."</td> <td><input type = 'radio' name = 'select' id = 'select' value = '".$row[0]."' </td></tr>" ;
	}
	
		echo "</table><input type ='submit' value='Clear Order'><input type='reset' value='Reset'></form>";		
	
	
	echo "</table></body></html>";

	mysqli_close($con);
?>
