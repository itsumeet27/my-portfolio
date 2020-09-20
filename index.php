<?php 
  include('includes/header.php');
  include('includes/init.php'); 

  $sql = "SELECT * FROM about";
  $result = $db->query($sql);
  if(mysqli_num_rows($result) > 0){
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
  <!-- Carousel wrapper -->
  <div class="banner row animated fadeIn slow">
    <div class="col-md-6 details">
      <h6 class="text-justify h6-responsive"><?=$salutation;?></h6>
      <h1 class="text-justify h1-responsive"><?=$name;?></h1>
      <hr class="title">
      <p class="text-justify lead" style="font-weight:400"><?=$short_desc;?></p>
      <p class="" style="text-align:justify; font-weight: 300"><?=$description;?></p>
      <a href="portfolio.php" class="btn btn-portfolio btn-lg">Portfolio</a>
      <a href="contact.php" class="btn btn-contact btn-lg ml-2">Hire Me</a>
    </div>
    <div class="col-md-6">
      <div class="image">
        <img src="img/sumeet.jpg">
      </div>
    </div>
  </div>
  <!-- Carousel wrapper -->

  <?php } else { echo "<div class='alert alert-danger'>No data to display</div>"; } ?>
  
<?php include('includes/footer.php'); ?>
  
