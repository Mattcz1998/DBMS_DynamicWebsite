<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
</head>
<body>

<div class="container">
    <form>

<?php

$username = $_POST['username'];
$pass = $_POST['password'];

$keanip1 = "10.";
$keanip2 = "131.125.";

//IP address verification

if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];

}
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

//echo "<br>Username: $username\n";

//echo "<br>Password: $pass\n";

include "dbconfig.php";

$con = mysqli_connect($server, $login, $DBpass, $dbname)
    or die(" <br>Cannot connect to database\n");

$query = "SELECT * ";
$query = $query . " FROM Customers WHERE login = '$username'";
//echo "<br>query: $query\n";

$result = mysqli_query($con,$query);
if($result) {
    if (mysqli_num_rows($result)> 0) {
        while($row = mysqli_fetch_array($result)){	

            //if($pass == $row['password'])

            //All page info IF TRUE 
            if(($row['login'] == $username && !empty($username)) && ($row['password'] == $pass && !empty($pass))){

                echo "<br>Your IP: $ip"; 
                echo "<br>Your browser; Operating System: $browser". $_SERVER['HTTP_USER_AGENT']. "<br>";

            if(strpos($ip, $keanip1) !== FALSE OR strpos($ip, $keanip2) != FALSE) {

                echo "<br>You ARE from Kean University.";

            }

                else {

                echo "<br>You are NOT from Kean University";

                }

        $cur_date = date('Y/m/d');
		$dob = $row['DOB'];
        $age = $cur_date - $dob;

                echo "<br>Welcome customer: " . $row['name'] ."!";
                echo "<br>Age: $age";
                echo "<br>Address: " . $row['street'] .", " . $row['city'] .", " . $row['zipcode'];  

?>
        <hr>

<?php 

        echo"<table width = '650'align right border='1' cellpadding='1' cellspacing='1'>

                <tr>
                <th>ID</th>
                <th>CODE</th>
                <th>OPERATION</th>
                <th>AMOUNT</th>
                <th>DATE TIME</th>
                <th>NOTE</th>
                </tr>";

    include "dbconfig2.php";

    $con2 = mysqli_connect($server2, $login2, $DBpass2, $dbname2)
    or die(" <br>Cannot connect to database\n");    

    $query2 = "SELECT * FROM Money_czopikm";    
    
    $result2 = mysqli_query($con2, $query2)
    or die("Failed to query database ".mysqli_connect_error());

    $row2 = mysqli_fetch_array($result2);

    if($result2 = mysqli_query($con2, $query2)) {

        if(mysqli_num_rows($result2) > 0){

            echo "<br>The transactions for Matthew Czopik are in the Saving Account:";

    while ($row2 = mysqli_fetch_array($result2)) {

    		echo"<tr>";
			echo"<td>".$row2['mid']."</td>";
			echo"<td>".$row2['code']."</td>";
			echo"<td>".$row2['type']."</td>";

		if($row2['type'] == "W"){

			$red = "<font color=\"red\">".$row2['amount']."</font>";
				echo"<td>".$red."</td>";

		} 	else{

			$blue = "<font color=\"blue\">".$row2['amount']."</font>";
				echo"<td>".$blue."</td>";

}

		$sum += $row2['amount'];

		$total = $total + $row2['amount'];

			echo"<td>".$row2['mydatetime']."</td>";
			echo"<td>".$row2['note']."</td>";
			echo"</tr>";

}

			echo "</TABLE>\n"; 


}
}

		echo "Total balance: $total";

            } 

            else {

                echo "<br> Username found, but wrong password.";

            }
        }

        mysqli_free_result($result);    
   
    } else {

        echo "<br>No records found in database.\n";

    }

} else {

    echo "<br> You have an error in your SQL query.\n"; 
    echo "<br>Error: " . mysqli_error($con);

}

?>

</form>
</div>

</body>

</html>