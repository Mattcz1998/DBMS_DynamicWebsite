<!DOCTYPE html>
<html>
<head>
    <title>Display Update Transaction</title>
</head>
<body>

<?php
$cookie_name = "cookie";

if (isset($_COOKIE[$cookie_name])) {
include "dbconfig.php";
$con = mysqli_connect($server, $login, $DBpass, $dbname)
    or die(" <br>Cannot connect to database\n");

$query = "SELECT a.name, sum(amount) as amount from CPS3740.Customers a, CPS3740_2020S.Money_czopikm b where b.cid=a.id;";
	$result = mysqli_query($con,$query);
	
	while($row = mysqli_fetch_array($result)){
		echo "Total balance: <strong>{$row['amount']}</strong>.<br><br>";

	}

$query1 = "SELECT  * FROM CPS3740_2020S.Money_czopikm;";
$result1 = mysqli_query($con,$query1);
$i = 0;
if($result1) {
if (mysqli_num_rows($result1)>0) {
	
		echo "<form action='update_transaction.php' method='post'>";
		echo "You can only update <strong>Note</strong> column.";
		echo "<TABLE border=1>\n";
		echo "<TR><TD>ID<TD>Code<TD>Operation<TD>Amount<TD>Date and Time<TD>Note<TD>Delete\n";

	while($row = mysqli_fetch_array($result1)) {

	$mid = $row['mid'];
	$code=$row['code'];
	$type=$row['type'];
	$amount=$row['amount'];
	$mydatetime=$row['mydatetime'];
	$note=$row['note'];
	
	if ($amount>0){
		echo "
		<TR>
		<TD>$mid
		<TD>$code
		<TD>$type
		<TD><font color='blue'>$amount
		<TD>$mydatetime
		<TD bgcolor='yellow'><input type='text' value='$note' name=note[$i] style='background-color:yellow;'>
		<input type='hidden' name=mid[$i] value=$mid >
		<input type='hidden' name=cid[$i] value=$code >
		<input type='hidden' name='delete[$i]' value='N'>
		<TD><input type='checkbox' name='delete[$i]' value='Y'>
		\n";
	}
	
	else{
		echo "
		<TR>
		<TD>$mid
		<TD>$code
		<TD>$type
		<TD><font color='red'>$amount
		<TD>$mydatetime<TD bgcolor='yellow'>
		<input type='text' value='$note' name=note[$i] style='background-color:yellow;'>
		<input type='hidden' name=mid[$i] value=$mid >
		<input type='hidden' name=cid[$i] value=$code >
		<input type='hidden' name='delete[$i]' value='N'>
		<TD><input type='checkbox' name='delete[$i]' value='Y' >
		\n";
		
	}
	$i++;
}

echo "</TABLE>\n";
echo "<input type='submit' value= 'Update Transaction' name='submit'>";
echo "</form>";
		}
	}
}

	else {
		echo "ERROR: Cookie has not been set!<br>";
		}

echo "<br><a href='logout.php'>User logout</a>";		
?>

</body>
</html>