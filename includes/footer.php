  </body>
  <!--Footer-->
  <footer class="page-footer text-center font-small animated fadeIn">
    <?php
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
    <!-- Social icons -->
    <div class="pt-3 footer-social">
      <?php if($facebook != ''){ ?>
      <a href="https://www.facebook.com/<?=$facebook;?>" target="_blank">
        <i class="fab fa-facebook mr-3" style="font-size:18px"></i>
      </a>
      <?php }if($linkedin != ''){ ?>
      <a href="https://linkedin.com/in/<?=$linkedin;?>" target="_blank">
        <i class="fab fa-linkedin mr-3" style="font-size:18px"></i>
      </a>
      <?php }if($twitter != ''){ ?>
      <a href="https://twitter.com/<?=$twitter;?>" target="_blank">
        <i class="fab fa-twitter mr-3" style="font-size:18px"></i>
      </a>
      <?php }if($instagram != ''){ ?>
      <a href="https://instagram.com/<?=$instagram;?>" target="_blank">
        <i class="fab fa-instagram mr-3" style="font-size:18px"></i>
      </a>
      <?php }if($github != ''){ ?>
      <a href="https://github.com/<?=$github;?>" target="_blank">
        <i class="fab fa-github mr-3" style="font-size:18px"></i>
      </a>
      <?php }if($pinterest != ''){ ?>
      <a href="https://in.pinterest.com/<?=$pinterest;?>" target="_blank">
        <i class="fab fa-pinterest mr-3" style="font-size:18px"></i>
      </a>
      <?php }if($behance != ''){ ?>
      <a href="https://behance.net/<?=$behance;?>" target="_blank">
        <i class="fab fa-behance mr-3" style="font-size:18px"></i>
      </a>
      <?php }?>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright pt-3 pb-2">
      © 2020 Copyright:
      <a href="./" target="_blank"> <?=$name;?> </a>
    </div>
    <!--/.Copyright-->
  </footer>
  <!--/.Footer-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->

  <!-- Dark and Light Toggle -->
  <script type="text/javascript">
    var toggleMode = document.querySelector('#btn-toggle');
    const currentTheme = localStorage.getItem("theme");
    if (currentTheme == "dark") {
      document.getElementById('theme').classList.add("dark-theme");
    }
    toggleMode.addEventListener('click', function(){
      document.getElementById('theme').classList.toggle("dark-theme");  
      
      document.getElementById('btn-theme').classList.add('fa-moon');
      document.getElementById('btn-theme').classList.remove('fa-sun');
      // Let's say the theme is equal to light
      let theme = "light";
      // If the body contains the .dark-theme class...
      if (document.getElementById('theme').classList.contains("dark-theme")) {
        // ...then let's make the theme dark
        
        document.getElementById('btn-theme').classList.remove('fa-moon');
        document.getElementById('btn-theme').classList.add('fa-sun');
        theme = "dark";
      }
      
      // Then save the choice in localStorage
      localStorage.setItem("theme", theme);
    })
  </script>
</html>