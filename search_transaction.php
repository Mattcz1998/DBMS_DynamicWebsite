<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Search transaction</title>


<?php
$cookie_name = "cookie";
if (isset($_COOKIE[$cookie_name])) {
	
	include "dbconfig.php";
	$con = mysqli_connect($server, $login, $DBpass, "CPS3740_2020S")
    	or die(" <br>Cannot connect to database\n");

$search = $_GET['keyword']; 

if ($search == "*"){

	$query1 = "SELECT c.name, a.code, a.type as type, a.amount, a.mydatetime, a.note, b.name as source from CPS3740.Sources b, Money_czopikm a, CPS3740.Customers c WHERE a.sid=b.id and c.id=a.cid;";
	$result1 = mysqli_query($con,$query1);
	$row = mysqli_fetch_array($result1);

echo "<br>The transactions in customer <strong>{$row['name']}</strong> that matched your keyword <strong>$search</strong> are: \n";
	
echo "<TABLE border=1>\n";
echo "<TR><TD>Name<TD>Code<TD>Type<TD>Amount<TD>Date and Time<TD>Note<TD>Source\n";

while($row = mysqli_fetch_array($result1))
{
	if ($row['amount']> 0){
		echo "<TR><TD>{$row['name']}<TD>{$row['code']}<TD>{$row['type']}<TD><font color='blue'>{$row['amount']}<TD>{$row['mydatetime']}<TD>{$row['note']}<TD>{$row['source']}\n";

	}

	else {
		echo "<TR><TD>{$row['name']}<TD>{$row['code']}<TD>{$row['type']}<TD><font color='red'>{$row['amount']}<TD>{$row['mydatetime']}<TD>{$row['note']}<TD>{$row['source']}\n";
	}
}
	
	echo "</TABLE>\n"; }

		
	elseif ($search != "*") {
	
	$queryv = "SELECT c.name, a.code, a.type as type, a.amount, a.mydatetime, a.note, b.name as source from CPS3740.Sources b, Money_czopikm a, CPS3740.Customers c WHERE a.note LIKE '%$search%' and a.sid=b.id and c.id=a.cid;";
	$result1 = mysqli_query($con, $queryv);
	// echo(mysqlierror($con));

	if($result1->num_rows > 0){
		$query1 = "SELECT c.name, a.code, a.type, a.amount,a.mydatetime, a.note,b.name as source from CPS3740.Sources b, Money_czopikm a, CPS3740.Customers c WHERE a.note LIKE '%$search%' and a.sid=b.id and c.id=a.cid;";
		$result1 = mysqli_query($con,$queryv);

		echo "The transactions in customer records that matched your keyword $search are: \n";
	
		echo "<TABLE border=1>\n";
		echo "<TR><TD>Name<TD>Code<TD>Operation<TD>Amount<TD>Date and Time<TD>Note<TD>Source\n";

while($row = mysqli_fetch_array($result1))

{
	
	if ($row['amount'] > 0) {
		
		echo "<TR><TD>{$row['name']}<TD>{$row['code']}<TD>{$row['type']}<TD><font color='blue'>{$row['amount']}<TD>{$row['mydatetime']}<TD>{$row['note']}<TD>{$row['source']}\n";
	}
	
	else {
		
		echo "<TR><TD>{$row['name']}<TD>{$row['code']}<TD>{$row['type']}<TD><font color='red'>{$row['amount']}<TD>{$row['mydatetime']}<TD>{$row['note']}<TD>{$row['source']}\n";
	}
}

		echo "</TABLE>\n"; }
	else {
	
		echo "No result found for your search: $search. <br> Please Try Again. <br>" ;}
	}

}
	else {
		echo "ERROR: Cookie has not been set!";
	}

	echo '<br> ';
	echo "<a href='logout.php'>Logout</a>";

?>
