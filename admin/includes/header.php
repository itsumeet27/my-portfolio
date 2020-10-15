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
  if(mysqli_num_rows($result) > 0){
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

    if(isset($_FILES['image'])){
      // Uploading Profile
      $imagefilename = $_FILES['image']['name'];
      $imagepath = BASEURL.'/img';
      $imagedestination = $imagepath . '/' . $imagefilename;
      $imageextension = pathinfo($imagefilename, PATHINFO_EXTENSION);
      $imagefile = $_FILES['image']['tmp_name'];
      $imagesize = $_FILES['image']['size'];

      if (!in_array($imageextension, ['jpg','jpeg','png','gif'])) {
          echo "You file extension must be jpg, jpeg, png, gif for image";
      } elseif ($_FILES['image']['size'] > 10000000) { // file shouldn't be larger than 100Megabyte
          echo "Files of zip and pdf are too large!";
      } else {
        move_uploaded_file($imagefile, $imagedestination);
      }
    }

    if(isset($_POST['save_image'])){
      $sql_image = "UPDATE about SET image = '$imagefilename' WHERE id = '$id'";
      $result_image = $db->query($sql_image);
      if($result_image){
        echo "<script>alert('Profile image saved')</script>";
      } 
    }
  }else{
    echo "<p class='text-danger'>Fill your profile details</p>";
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
    <meta name="description" content="<?=$description;?>">
    <title><?=$name;?> - <?=$short_desc;?></title>
    <!-- Site Icon -->
    <?php if($image != ''): ?>
    <link rel="icon" href="../img/<?=$image;?>" type="image/x-icon">
    <?php else: ?>
    <link rel="icon" href="../img/profile.webp" type="image/x-icon">
    <?php endif; ?>
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
      <style type="text/css">
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
        <div class="list-group">
          <div class="image p-3">
            <?php if($image != ''): ?>
              <img src="../img/<?=$image;?>" class="img-fluid img-responsive p-3" style="box-shadow: 1px 1px 10px 2px rgba(0,0,0,0.5)" />
            <?php else: ?>
              <img src="../img/profile.webp" class="img-fluid img-responsive p-3">
            <?php endif; ?>
          </div>
          <form class="form mb-3" name="profile-upload" method="post" enctype="multipart/form-data" action="">
        <div class="form-file ml-2 mr-0">
            <input type="file" class="form-file-input" name="image" id="image" />
            <label class="form-file-label" for="image">
              <span class="form-file-text">Add/Edit Profile Picture</span>
              <span class="form-file-button">Browse</span>
            </label>
        </div>
        <button type="submit" name="save_image" class="btn btn-floating btn-primary mt-2 mx-2"><i class="fas fa-upload"></i></button>
    </form>
          <a href="portfolio.php" class="list-group-item list-group-item-action ripple <?php if($page == 'portfolio.php'){ echo 'active'; }?>"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Portfolio</a>
          <a href="comments.php" class="list-group-item list-group-item-action ripple <?php if($page == 'comments.php'){ echo 'active'; }?>"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Comments</a>
          <a href="projects.php" class="list-group-item list-group-item-action ripple <?php if($page == 'projects.php'){ echo 'active'; }?>"><i class="fas fa-building"></i>&nbsp;&nbsp;Projects</a>
          <a href="education.php" class="list-group-item list-group-item-action ripple <?php if($page == 'education.php'){ echo 'active'; }?>"><i class="fas fa-university"></i>&nbsp;&nbsp;Education</a>
          <a href="experience.php" class="list-group-item list-group-item-action ripple <?php if($page == 'experience.php'){ echo 'active'; }?>"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Experience</a>
          <a href="skills.php" class="list-group-item list-group-item-action ripple <?php if($page == 'skills.php'){ echo 'active'; }?>"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;Skills</a>
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
              <li class="nav-item <?php if($page == 'logout.php'){ echo 'active'; }?>">
                <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
              </li>
            </ul>

            <?php
              if(mysqli_num_rows($result_social) > 0){
            ?>
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
            <?php } ?>
          </div>
        </div>
      </nav>
      <!-- Navbar -->
      <!-- Jumbotron -->
      <div id="intro" class="text-center bg-light sidebar-layout">
      </div>
      <!-- Jumbotron -->
      <main class="mt-4 mb-5 sidebar-layout">