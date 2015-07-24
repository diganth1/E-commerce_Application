
<html>
	<head>
		<title> Procure Product </title>
	</head>
	<body>
		
		<h1><font color = 'white'> e - Retail Order Management </font></h1>
		<h2><font color = 'white'> Product Procurement Form</font></h2>
		<form action="procureProduct.php" method="post">
		<?php
		echo "<html> <body style='color:white;'> <b> Product Table <b><br> <table border = '1' bgcolor ='black'> <tr> <th>Product</th> <th> Stock</th> <th> Status</th> <th> Reorder Level</tr> ";
		$con = mysqli_connect("localhost","root","gargee","661DB");

				// Check if the connection failed	
				if (mysqli_connect_errno()) 
				{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					die();
				}
				$sql = mysqli_query($con, "SELECT Name, Stock, Status, ReorderLevel FROM products WHERE Status = 'A' and Stock <= ReorderLevel");
				while($r = mysqli_fetch_array($sql,MYSQL_BOTH)) 
				{
				echo "<tr> <td> ". $r[0] ." </td> <td>".$r[1] ." </td> <td>".$r[2] ."</td> <td> ". $r[3] ." </td> </tr>"; 
				}
				?>
		
		<table>
		<tr>
			
			<td>Product: </td>
			<td> <select name="Name">
				<option value="">-- Select A Product --</option>
				<?php 
				$sql = "(SELECT Name FROM products WHERE Status = 'A' and Stock <= ReorderLevel)";
				$result=mysqli_query($con,$sql);
				while ($row = mysqli_fetch_array($result))
				{
					echo "<option value='". $row['Name'] . "'>". $row['Name'] ."</option>";
				}
			?>
				
			</select></td>
		
		</tr>
		<tr>
			<td>Quantity</td>
			<td> <input type='text' name='Quantity'></td>
		</tr>
		</table>
		<input type="submit" name="Procure" value = "Procure">
		</form>
	</body>
</html>