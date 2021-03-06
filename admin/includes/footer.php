    </main>
  </body>
  <!--Footer-->
  <footer class="page-footer text-center font-small animated sidebar-layout">
    <?php
      include('../includes/init.php');

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

    <?php
      if(mysqli_num_rows($result_social) > 0){
    ?>
    <!-- Social icons -->
    <div class="pt-3 footer-social">
      <?php if($facebook != ''){ ?>
      <a href="https://www.facebook.com/<?=$facebook;?>" target="_blank">
        <i class="fab fa-facebook mr-3" style="font-size:18px;color:#555"></i>
      </a>
      <?php }if($linkedin != ''){ ?>
      <a href="https://linkedin.com/in/<?=$linkedin;?>" target="_blank">
        <i class="fab fa-linkedin mr-3" style="font-size:18px;color:#555"></i>
      </a>
      <?php }if($twitter != ''){ ?>
      <a href="https://twitter.com/<?=$twitter;?>" target="_blank">
        <i class="fab fa-twitter mr-3" style="font-size:18px;color:#555"></i>
      </a>
      <?php }if($instagram != ''){ ?>
      <a href="https://instagram.com/<?=$instagram;?>" target="_blank">
        <i class="fab fa-instagram mr-3" style="font-size:18px;color:#555"></i>
      </a>
      <?php }if($github != ''){ ?>
      <a href="https://github.com/<?=$github;?>" target="_blank">
        <i class="fab fa-github mr-3" style="font-size:18px;color:#555"></i>
      </a>
      <?php }if($pinterest != ''){ ?>
      <a href="https://in.pinterest.com/<?=$pinterest;?>" target="_blank">
        <i class="fab fa-pinterest mr-3" style="font-size:18px;color:#555"></i>
      </a>
      <?php }if($behance != ''){ ?>
      <a href="https://behance.net/<?=$behance;?>" target="_blank">
        <i class="fab fa-behance mr-3" style="font-size:18px;color:#555"></i>
      </a>
      <?php }?>
    </div>
    <!-- Social icons -->
    <?php } ?>

    <!--Copyright-->
    <div class="footer-copyright pt-3 pb-2">
      © 2020 Copyright:
      <a href="../index.php" target="_blank" style="color:#555"> <?=$name;?> </a>
    </div>
    <!--/.Copyright-->
  </footer>
  <!--/.Footer-->

  <!-- MDB -->
  <script type="text/javascript" src="../js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</html>