<!DOCTYPE html>
<?php
  function sanitize($dirty){
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");
  }
?>
<?php
  include('../includes/init.php');
  $path=$_SERVER['PHP_SELF'];
  $page=basename($path); 

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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Experienced Web Developer with a demonstrated history of working in the higher education industry. Skilled in Web framework such as Django, and PHP, WordPress, Java, HTML, CSS, Javascript, Bootstrap, Responsive Web Design, and Leadership.">
    <title><?=$name;?> - <?=$short_desc;?></title>
    <link rel="canonical" href="https://itsumeet.com/">
    <!-- Site Icon -->
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <!-- Custom styles -->
    <style></style>
  </head>
  <body>
    <header>
      <!-- Intro settings -->
      <style>
        #intro {
          /* Margin to fix overlapping fixed navbar */
          margin-top: 58px;
        }

        .sidebar {
          display: none;
        }

        @media (min-width: 992px) {
          .sidebar {
            display: block;
            width: 240px;
            height: 100%;
            position: fixed;
            border-right: 0 20px 40px 0 rgba(0, 0, 0, 0.05) !important;
            background-color: #fff;
            z-index: 2000;
          }
          .sidebar-layout {
            padding-left: 240px;
          }
        }

        .sidebar .list-group .list-group-item.active{
          color: #fff;
          background: #555!important;
          border-color: #555!important;
        }
      </style>

      <!-- Sidebar -->
      <div class="sidebar pt-3 shadow-5">
        <div class="list-group list-group-flush">
          <a href="portfolio.php" class="list-group-item list-group-item-action ripple <?php if($page == 'portfolio.php'){ echo 'active'; }?>"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Portfolio</a>
          <a href="projects.php" class="list-group-item list-group-item-action ripple <?php if($page == 'projects.php'){ echo 'active'; }?>"><i class="fas fa-building"></i>&nbsp;&nbsp;Projects</a>
          <a href="contact.php" class="list-group-item list-group-item-action ripple <?php if($page == 'contact.php'){ echo 'active'; }?>"><i class="fas fa-envelope"></i>&nbsp;&nbsp;Contact</a>
        </div>
      </div>
      <!-- Sidebar -->

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" style="box-shadow:none">
        <div class="container-fluid">
          <!-- Navbar brand -->
          <a class="navbar-brand" href="../index.php" target="_blank"><?=$name;?></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarExample01"
            aria-controls="navbarExample01"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
              <li class="nav-item <?php if($page == 'index.php'){ echo 'active'; }?>">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
            </ul>

            <ul class="navbar-nav d-flex flex-row mr-3">
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
          </div>
        </div>
      </nav>
      <!-- Navbar -->
      <!-- Jumbotron -->
      <div id="intro" class="text-center bg-light sidebar-layout">
      </div>
      <!-- Jumbotron -->
      <main class="mt-4 mb-5 sidebar-layout">