<!DOCTYPE html>
<?php
  function sanitize($dirty){
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");
  }
?>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Experienced Web Developer with a demonstrated history of working in the higher education industry. Skilled in Web framework such as Django, and PHP, WordPress, Java, HTML, CSS, Javascript, Bootstrap, Responsive Web Design, and Leadership.">
    <title>Sumeet Sharma - Software Engineer | UI/Frontend Developer | Web Developer</title>
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
      </style>

      <!-- Sidebar -->
      <div class="sidebar pt-3 shadow-5">
        <div class="list-group list-group-flush">
          <a href="portfolio.php" class="list-group-item list-group-item-action ripple">Portfolio</a>
          <a href="projects.php" class="list-group-item list-group-item-action ripple">Projects</a>
          <a href="contact.php" class="list-group-item list-group-item-action ripple">Contact</a>
        </div>
      </div>
      <!-- Sidebar -->

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" style="box-shadow:none">
        <div class="container-fluid">
          <!-- Navbar brand -->
          <a class="navbar-brand" target="_blank" href="https://mdbootstrap.com/docs/standard/">
            <img
              src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png"
              height="16"
              alt=""
              loading="lazy"
              style="margin-top: -3px;"
            />
          </a>
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
              <li class="nav-item active">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
            </ul>

            <ul class="navbar-nav d-flex flex-row mr-3">
              <!-- Icons -->
              <li class="nav-item mr-3 mr-lg-0">
                <a class="nav-link" href="https://facebook.com/itsumeet" target="_blank">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="nav-item mr-3 mr-lg-0">
                <a class="nav-link" href="https://linkedin.com/in/itsumeet" target="_blank">
                  <i class="fab fa-linkedin"></i>
                </a>
              </li>
              <li class="nav-item mr-3 mr-lg-0">
                <a class="nav-link" href="https://twitter.com/itsumeet27" target="_blank">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="nav-item mr-3 mr-lg-0">
                <a class="nav-link" href="https://instagram.com/itsumeet27" target="_blank">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
              <li class="nav-item mr-3 mr-lg-0">
                <a class="nav-link" href="https://github.com/itsumeet27" target="_blank">
                  <i class="fab fa-github"></i>
                </a>
              </li>
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