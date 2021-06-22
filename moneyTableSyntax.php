<style>
		table, th, td {
  			border: 0.5px solid black;
		}
		</style>
		
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
?>