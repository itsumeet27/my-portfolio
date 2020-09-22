<!DOCTYPE html>
<?php
  include('includes/init.php');

  $sql = "SELECT * FROM about";
  $result = $db->query($sql);
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    $name = $row['name'];
    $short_desc = $row['feature_desc'];
    $salutation = $row['salutation'];
    $description = $row['about_desc'];
    $address = $row['address'];
    $mobile = $row['mobile'];
    $email = $row['email'];
    $image = $row['image'];
  }

  $sql_social = "SELECT * FROM social";
  $result_social = $db->query($sql_social);
  while($social = mysqli_fetch_assoc($result_social)){
    $facebook = $social['facebook'];
    $instagram = $social['instagram'];
    $linkedin = $social['linkedin'];
    $twitter = $social['twitter'];
    $pinterest = $social['pinterest'];
    $github = $social['github'];
    $behance = $social['behance'];
  }
?>
<html lang="en" id="theme">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Experienced Web Developer with a demonstrated history of working in the higher education industry. Skilled in Web framework such as Django, and PHP, WordPress, Java, HTML, CSS, Javascript, Bootstrap, Responsive Web Design, and Leadership.">
    <title><?=$name;?> - <?=$short_desc;?></title>
    <link rel="canonical" href="https://itsumeet.com/">
    <!-- Site Icon -->
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Righteous&Roboto:wght@300;400;500;700&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/style.css" />
    <style></style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light scrolling-navbar">
      <!-- Container wrapper -->
      <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="./"><?=$name;?></a>    
        <!-- Toggle button -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>
    
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left links -->
          <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="./">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./resume.php">Resume</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="./portfolio.php">Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./contact.php">Contact</a>
            </li>
          </ul>
          <!-- Left links -->
          <!-- Contact Links -->
          <ul class="navbar-nav d-flex flex-row mr-3 mt-0">
            <li class="nav-item mr-2 mr-lg-0">              
              <a class="nav-link" href="tel:<?=$mobile;?>" target="_blank"><i class="fas fa-mobile-alt mr-1" style="font-size:18px"></i>&nbsp;<?=$mobile;?></a>
            </li>
            <li class="nav-item mr-4 mr-lg-0">              
              <a class="nav-link" href="tel:<?=$email;?>" target="_blank"><i class="fas fa-envelope mr-1" style="font-size:18px"></i>&nbsp;<?=$email;?></a>
            </li>
          </ul>
          <!-- Contact Links -->
          <!-- Search form -->
          <ul class="navbar-nav d-flex flex-row mr-1">
            <!-- Icons -->
            <?php if($facebook != ''){ ?>
            <li class="nav-item mr-3 mr-lg-0">
              <a class="nav-link" href="https://facebook.com/<?=$facebook;?>" target="_blank">
                <i class="fab fa-facebook mr-1" style="font-size:18px"></i>
              </a>
            </li>
            <?php } ?>
            <?php if($linkedin != ''){ ?>
            <li class="nav-item mr-3 mr-lg-0">
              <a class="nav-link" href="https://linkedin.com/in/<?=$linkedin;?>" target="_blank">
                <i class="fab fa-linkedin mr-1" style="font-size:18px"></i>
              </a>
            </li>
            <?php } ?>
            <?php if($twitter != ''){ ?>
            <li class="nav-item mr-3 mr-lg-0">
              <a class="nav-link" href="https://twitter.com/<?=$twitter;?>" target="_blank">
                <i class="fab fa-twitter mr-1" style="font-size:18px"></i>
              </a>
            </li>
            <?php } ?>
            <?php if($instagram != ''){ ?>
            <li class="nav-item mr-3 mr-lg-0">
              <a class="nav-link" href="https://instagram.com/<?=$instagram;?>" target="_blank">
                <i class="fab fa-instagram mr-1" style="font-size:18px"></i>
              </a>
            </li>
            <?php } ?>
            <?php if($github != ''){ ?>
            <li class="nav-item mr-3 mr-lg-0">
              <a class="nav-link" href="https://github.com/<?=$github;?>" target="_blank">
                <i class="fab fa-github mr-1" style="font-size:18px"></i>
              </a>
            </li>
            <?php } ?>
            <?php if($pinterest != ''){ ?>
            <li class="nav-item mr-3 mr-lg-0">
              <a class="nav-link" href="https://in.pinterest.com/<?=$pinterest;?>" target="_blank">
                <i class="fab fa-pinterest mr-1" style="font-size:18px"></i>
              </a>
            </li>
            <?php } ?>
            <?php if($behance != ''){ ?>
            <li class="nav-item mr-3 mr-lg-0">
              <a class="nav-link" href="https://behance.net/<?=$behance;?>" target="_blank">
                <i class="fab fa-behance mr-1" style="font-size:18px"></i>
              </a>
            </li>
            <?php } ?>
          </ul>
          <button class="btn btn-floating btn-dark" id="btn-toggle"><i class="fas fa-moon" id="btn-theme"></i></button>
        </div>
        <!-- Collapsible wrapper -->
      </div>
      <!-- Container wrapper -->
    </nav>