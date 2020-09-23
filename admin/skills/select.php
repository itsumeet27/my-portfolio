<?php  
include('../../includes/init.php');
$output = '';  
$sql = "SELECT * FROM skills ORDER BY id ASC";  
$result = mysqli_query($db, $sql);  
$output .= '  
<div class="table-responsive">  
<table class="table table-bordered">  
<tr>  
<th style="font-size:13px;">Id</th>  
<th style="font-size:13px;">Name</th>  
<th style="font-size:13px;">Percentage</th>  
<th style="font-size:13px;">Delete</th>  
</tr>';  
$rows = mysqli_num_rows($result);
if($rows > 0)  
{  
  while($row = mysqli_fetch_array($result))  
  {  
   $output .= '  
   <tr>  
   <td style="font-size:13px;">'.$row["id"].'</td>  
   <td style="font-size:13px;" class="name" data-id1="'.$row["id"].'" contenteditable>'.$row["name"].'</td>  
   <td style="font-size:13px;" class="percentage" data-id2="'.$row["id"].'" contenteditable>'.$row["percentage"].'</td>  
   <td style="font-size:13px;"><button type="button" name="delete_btn" data-id3="'.$row["id"].'" class="btn btn-xs btn-danger btn-floating btn_delete"><i class="fas fa-trash-alt"></i></button></td>  
   </tr>  
   ';  
 }  
 $output .= '  
 <tr>  
 <td style="font-size:13px;"></td>  
 <td style="font-size:13px;" id="name" contenteditable></td>  
 <td style="font-size:13px;" id="percentage" contenteditable></td>  
 <td style="font-size:13px;"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success btn-floating"><i class="fas fa-plus"></i></button></td>  
 </tr>  
 ';  
}  
else  
{  
  $output .= '
  <tr>  
  <td style="font-size:13px;"></td>  
  <td style="font-size:13px;" id="name" contenteditable></td>  
  <td style="font-size:13px;" id="percentage" contenteditable></td>  
  <td style="font-size:13px;"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success btn-floating"><i class="fas fa-plus"></i></button></td>  
  </tr>';  
}  
$output .= '</table>  
</div>';  
echo $output;  
?>