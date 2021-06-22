<!DOCTYPE html>
<html>
<head>
    <title>Customers Displayed</title>
</head>

<style>
table, th, td {
  border: 0.5px solid black;
}
</style>

<body>

<?php

include "dbconfig.php";

$con = mysqli_connect($server, $login, $DBpass, $dbname)
    or die(" <br>Cannot connect to database\n");

	$result = mysqli_query($con, "select * from CPS3740.Customers")
	or die("Failed to query database ".mysqli_connect_error());
	$row = mysqli_fetch_array($result);
?>


<p>The following customers are in the bank system:</p>

<table style="width:100%">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Login</th> 
    <th>Password</th>
    <th>DOB</th>
    <th>Gender</th>
    <th>Street</th>
    <th>City</th>
    <th>State</th>
    <th>Zipcode</th>
  </tr>

 <?php
    while ($row = mysqli_fetch_array($result)) {?>
    <tr>	
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['login'];?></td>
    <td><?php echo $row['password'];?></td>
    <td><?php echo $row['DOB'];?></td>
    <td><?php echo $row['gender'];?></td>
    <td><?php echo $row['street'];?></td>
    <td><?php echo $row['city'];?></td>
    <td><?php echo $row['state'];?></td>
    <td><?php echo $row['zipcode'];?></td>

    </tr>

<?php  
} ?>

</body>

</html>