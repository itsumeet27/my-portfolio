<?php  
	$connect = mysqli_connect("localhost", "root", "", "portfolio");
	$sql = "DELETE FROM skills WHERE id = '".$_POST["id"]."'";  
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Data Deleted';  
	}  
 ?>