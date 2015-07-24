<?php
session_start();
echo "<html> <body style='color:white;'> <h1> Product Table </h1><br> <table border = '1' bgcolor ='black'> <tr> <th>Product</th> <th> Stock</th> <th> Status</th> <th> Reorder Level</tr> ";
$con = mysqli_connect("localhost","root","gargee","661DB");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$select = mysqli_query($con,"SELECT ProductId, Stock FROM products WHERE Name = '" . $_POST['Name'] . "'");

$row = mysqli_fetch_array($select);

$insert = "INSERT INTO Procurement (ProductId, EmployeeId,Quantity) VALUES ('" . $row['ProductId'] . "','" . $_SESSION['EmployeeId'] . "','" . $_POST['Quantity'] . "' )";

$newStock = (int)$row['Stock'] + (int)$_POST['Quantity'];

$up = "UPDATE Products SET Stock = '" . $newStock . "' WHERE ProductId = '". $row['ProductId']. "'" ;

//Execute the insert Query
if (!mysqli_query($con,$insert))
{
  die('Error: 123' . mysqli_error($con));
}

//Execute the insert Query
if (!mysqli_query($con,$up))
{
  die('Error: 456 ' . mysqli_error($con));
}
echo "<h3><font color ='white'> Product Procured! </font></h3>";
$sql = mysqli_query($con, "SELECT Name, Stock, Status, ReorderLevel FROM products WHERE Status = 'A'");
while($r = mysqli_fetch_array($sql,MYSQL_BOTH)) 
{
echo "<tr> <td> ". $r[0] ." </td> <td>".$r[1] ." </td> <td>".$r[2] ."</td> <td> ". $r[3] ." </td> </tr>"; 
}
//Redirect to Customer Home Page
echo $_POST['Quantity'] . " units of " . $_POST['Name'] . " is  procured";

mysqli_close($con);
?>
