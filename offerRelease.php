<?php 
session_start();
echo "<html> <body> <h1> Regional Statistics</h1><br> <table border = '1'> <tr> <th>Customer Type</th> <th> No_of_Orders</th> <th> Amount Purchased </th></tr> ";
$con = mysqli_connect("localhost","root","gargee","661trial");

if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}
$select = mysqli_query($con,"SELECT CountryId FROM Country WHERE CountryName = '" . $_POST['CountryName'] . "'");

$r = mysqli_fetch_array($select);

$result = mysqli_query($con, "SELECT Type, COUNT(OrderID) AS No_of_Orders, SUM(AmountPaid) AS Amount_Purchased FROM customer as c JOIN ordertable as o on c.customerID=o.customerId WHERE CountryId='".$r['CountryId']."' GROUP BY c.Type");
while($row = mysqli_fetch_array($result,MYSQL_BOTH)) 
{
echo "<tr> <td> ". $row[0] ." </td> <td>".$row[1] ." </td> <td>".$row[2] ."</td></tr>"; 
}

echo "</table><br><br><form action = 'Release1.php' method = 'post'>
<table>
		<tr>
			<td>
				Customer Type(*):
			</td>
			<td>
				<select name='Type'>
					<option value='S'>Silver</option>
					<option value='G'>Gold</option>	
					<option value='P'>Platinum</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Country(*):</td>
			<td><select name='CountryName'>
			<option value='India'>India</option>
			<option value='UAE'>UAE</option>
			<option value='China'>China</option>
			<option value='Indonasia'>Indonesia</option>
			<option value='Thailand'>Thailand</option>
			<option value='Japan'>Japan</option>
			<option value='South Korea'>South Korea</option>
			<option value='Nepal'>Nepal</option>
			<option value='Bhutan'>Bhutan</option>
			<option value='Bangladesh'>Bangladesh</option>
			<option value='Afghanistan'>Afghanistan</option>
			<option value='Pakistan'>Pakistan</option>
			</select></td>
		</tr>
		<tr>
			<td>Validity(*)</td>
			<td> <input type='text' name='Validity'></td>
		</tr>
		<tr>
			<td>Discount(*)</td>
			<td> <input type='text' name='Discount'></td>
		</tr>
		<tr>
			<td>Date (YYYY-MM-DD) (*):</td>
			<td> <input type='text' name='OfferDate'></td>
		</tr>
		<tr>
			<td>Description(*)</td>
			<td> <input type='text' name='Description'></td>
		</tr>
		</table>";

echo "<input type='submit' name='Release' value = 'Release'> <input type='reset' name='Reset' value = 'Clear Form'>";
echo "</form></body></html>";
mysqli_close($con);
?>