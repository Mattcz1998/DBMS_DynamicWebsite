<div>
<a href='logout.php'>Logout</a></font></li>
</div>

<?php

$cookie_name = "cookie";
if (isset($_COOKIE[$cookie_name])) {


include "dbconfig.php";

$con = mysqli_connect($server, $login, $DBpass, "CPS3740_2020S")
    or die(" <br>Cannot connect to database\n");
$cid = array();
$mid = array();

for($i=0; $i< count($_POST["cid"]); $i++) {
  $cid[$i] = $_POST["cid"][$i];
  
  $mid[$i] = $_POST["mid"][$i];

  if (isset($_POST["delete"][$i]))
     $delete[$i]=$_POST["delete"][$i];
  else
     $delete[$i]='N';
  $note[$i]=$_POST["note"][$i];


}
// dont need this yet.
$dct=0;
for($i=0;$i<count($_POST["cid"]);$i++)  {

   if ($delete[$i]=='Y') {
    $query="DELETE from Money_czopikm where mid=" . $mid[$i] ;
     $result = mysqli_query($con,$query);
  
     if ($result) {
       if (mysqli_affected_rows($con)==1) {
          echo "<b>You have successfully deleted the transaction code: $query</b><br>\n";
          $dct++;
}
     }
     else {
        echo "<b>Error!, the query could not be run: $query</b><br>\n";
     }

  }
}



$uct=0;
for($i=0;$i<count($_POST["cid"]);$i++)  {
   // They want to set note[i] where the ID is equal to something
   $query="UPDATE Money_czopikm set note='" . $note[$i] . "' where mid=" . $mid[$i] .";";

   $result = mysqli_query($con,$query);

   if ($result) {
     if (mysqli_affected_rows($con)>=1) {
        echo "<font color = 'white'><b>You have successfully updated the transaction code: $query</b></font><br>\n";
        $uct = mysqli_affected_rows($con);
     }

   }
   else {
         echo "<b>Error!, the query could not be run: $query</b><br>\n";
         echo mysqli_error($con);
   }
  
}

echo "<br><b>Deleting $dct records and updating $uct transactions have been completed!</b><br>\n";

}

else {

  echo "ERROR: Cookie has not been set!<br>";

}

mysqli_close($con);


?>