<?php 
  include('includes/header.php');
  include('includes/init.php'); 

  $sql = "SELECT * FROM about";
  $result = $db->query($sql);
  while($row = mysqli_fetch_assoc($result)){
    $name = $row['name'];
    $short_desc = $row['feature_desc'];
    $salutation = $row['salutation'];
    $description = $row['about_desc'];
    $address = $row['address'];
    $mobile = $row['mobile'];
    $email = $row['email'];
  } 
?>
    <div class="container-fluid">
        <div class="page-title p-4">
            <h1 class="p-2">ABOUT <hr></h1>        
        </div>
        <!-- About -->
        <div class="about mt-2 px-4">
            <div class="row">
                <div class="col-md-6 px-1">
                    <img src="img/itsumeet.jpg" class="img-fluid img-responsive p-3"> 
                </div>
                <div class="col-md-6 p-3">
                    <i class="fas fa-quote-left fa-2x"></i>
                    <p class="px-3 py-3"><?=nl2br($description);?></p>
                    <a href="http://drawingsbysumeet.itsumeet.com/" class="btn btn-portfolio btn-lg ml-3" target="_blank">Browse Now</a>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>