<?php  
$connect = mysqli_connect("localhost", "root", "", "portfolio");
$sql = "INSERT INTO skills(name, percentage) VALUES('".$_POST["name"]."', '".$_POST["percentage"]."')";  
if(mysqli_query($connect, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>