<?php
$con = mysqli_connect("localhost","root","gargee","661DB");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
 // $select= mysqli_query($con,"SELECT CustomerID , SUM(AmountPaid) AS Amount_Purchased FROM ordertable WHERE OderDate BETWEEN '" . $_POST['FromDate'] . "' AND '". $_POST['TillDate'] . "' AND Amount_Purchased > '". $_POST['AmountPurchased'] . "'GROUP BY CustomerID ");

  $result= mysqli_query($con,"SELECT CustomerId, a from (SELECT CustomerID, SUM(AmountPaid) AS a FROM ordertable WHERE OrderDate BETWEEN '" . $_POST['FromDate'] . "' AND '". $_POST['TillDate'] . "' GROUP BY CustomerID) AS t WHERE a > ". $_POST['AmountPurchased'] );	
  //$result=mysqli_fetch_array($select);
  //$row=mysqli_num_rows($select);
  
  while ($row = mysqli_fetch_array($result, MYSQL_NUM))
  {
  $update= "UPDATE customer SET Type= '" . $_POST['Type'] . "' WHERE CustomerID = '" . $row[0] . "'";
  if (!mysqli_query($con,$update))
{
  die('Error: ' . mysqli_error($con));
}
  }
  
  
echo "<font color = 'white'>Upgrade complete</font>";

mysqli_close($con);
?>
