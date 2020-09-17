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
  <!-- Carousel wrapper -->
  <div class="banner row animated fadeIn slow">
    <div class="col-md-6 details">
      <h6 class="text-justify h6-responsive"><?=$salutation;?></h6>
      <h1 class="text-justify h1-responsive"><?=$name;?></h1>
      <hr class="title">
      <p class="text-justify lead"><?=nl2br($short_desc);?></p>
      <!-- <p class="lead text-justify">
        A hard working individual with the intent of delivering products and services in a timely and most
        efficient manner.
      </p> -->
      <div class="social-icons">
        <a href="https://www.facebook.com/profile.php?id=100007900753991" target="_blank">
          <i class="fab fa-facebook-f" title="Facebook"></i>
        </a>
        <a href="https://linkedin.com/in/itsumeet" target="_blank">
          <i class="fab fa-linkedin" title="Linkedin"></i>
        </a>
        <a href="https://twitter.com/sumeet_270296" target="_blank">
          <i class="fab fa-twitter" title="Twitter"></i>
        </a>
        <a href="https://instagram.com/sumit270296" target="_blank">
          <i class="fab fa-instagram" title="Instagram"></i>
        </a>
        <a href="https://github.com/sumit270296" target="_blank">
          <i class="fab fa-github mr-2" title="GitHub"></i>
        </a>
      </div>
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
<?php include('includes/footer.php'); ?>
  
