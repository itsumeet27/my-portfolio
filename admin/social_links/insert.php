<?php  
include('../../includes/init.php');
$sql = "INSERT INTO social (facebook, instagram, twitter, linkedin, pinterest, github, behance) VALUES ('".$_POST["facebook"]."', '".$_POST["instagram"]."', '".$_POST["twitter"]."', '".$_POST["linkedin"]."', '".$_POST["pinterest"]."', '".$_POST["github"]."', '".$_POST["behance"]."')";  
var_dump($sql);
if(mysqli_query($db, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>