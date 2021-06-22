<!DOCTYPE html>
<html>
<head>
</head>

<style>
table, th, td {
  border: 0.5px solid black;
}
</style>

<body>

<?php


$server = "imc.kean.edu";
$login = "czopikm";
$DBpass = "1123791";
$dbname2 = "CPS3740_2020S";

$con2 = mysqli_connect($server, $login, $DBpass, $dbname2)
    or die(" <br>Cannot connect to database\n");

    $result = mysqli_query($con2, "select * from CPS3740_2020S.Money_czopikm")
    or die("Failed to query database ".mysqli_connect_error());
    $row = mysqli_fetch_array($result);
?>


<p>The transactions for customer Matthew Czopik:</p>

<table style="width:100%">
        <tr>
            <th>ID</th>
            <th>Code</th> 
            <th>Operation</th>
            <th>Amount</th>
            <th>Date Time</th>
            <th>Note</th>
        </tr>

 <?php
    while ($row = mysqli_fetch_array($result)) {?>
    <tr>    
    <td><?php echo $row['mid'];?></td>
    <td><?php echo $row['code'];?></td>
    <td><?php echo $row['type'];?></td>
    <td><?php echo $row['amount'];?></td>
    <td><?php echo $row['mydatetime'];?></td>
    <td><?php echo $row['note'];?></td>

    </tr>
} ?>

</body>

</html>