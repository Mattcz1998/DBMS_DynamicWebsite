<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Insert transaction</title>

</head>
<body>

<?php

$cookie_name = "cookie";
	if (isset($_COOKIE[$cookie_name])) {
		include "dbconfig.php";
	$con = mysqli_connect($server, $login, $DBpass, "CPS3740_2020S")
    	or die(" <br>Cannot connect to database\n");

$code = $_POST['code'];
$type = $_POST['type'];
$amount = $_POST['amount'];
$source = $_POST['source'];
$note = $_POST['note'];

$query1 = "SELECT code, SUM(amount) as total from Money_czopikm";
	$res1 = $con->query($query1);	

	if ($res1->num_rows > 0) {
    
    	while($row = $res1->fetch_assoc()) {
        
	if ($amount == '') {
		echo "ERROR: Option not allowed.";
	}
	
	elseif ($amount <= 0 ) {
	
		echo "ERROR: Amount cannot be negative.";
	}

	elseif ($row["total"] < $amount) {
	
		echo "You do not have enough money in your account. ";
	}

	elseif ($code == $row["code"]) {
	
		echo "ERROR: This code has already been taken.";
	}
	
	else {

	if ($type == "D") {
		$amount = $amount * 1; 
	}
	elseif ($type == "W") {
		$amount = $amount * -1;
	}

	$query2 = "INSERT into Money_czopikm (code, cid, sid, type, amount, mydatetime, note)
				VALUES ('$code', 2, '$source', '$type', $amount, now(), '$note')";

	//$query2 = "INSERT into Money_czopikm (code, cid, sid, type, amount, mydatetime, note) values ('$code', 1, '$source', '$type', '$amount', now(), '$note')" ;
	 
	$res2 = $con->query($query2);
	echo "Transaction has been saved."; }

		}
	}
}

else {
	echo "ERROR: Cookie has not been set!";
	}
?>

</body>
</html>