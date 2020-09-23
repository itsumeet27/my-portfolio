<?php  
	include('../../includes/init.php');
	$sql = "DELETE FROM skills WHERE id = '".$_POST["id"]."'";  
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Data Deleted';  
	}  
 ?>