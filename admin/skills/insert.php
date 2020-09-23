<?php  
	include('../../includes/init.php');
	$sql = "INSERT INTO skills(name, percentage) VALUES('".$_POST["name"]."', '".$_POST["percentage"]."')";  
	if(mysqli_query($connect, $sql))  
	{  
	     echo 'Data Inserted';  
	}  
?>