<?php 
	include ('includes/header.php');
	include ('../includes/init.php');
?>
<?php
  $dbpath = '';
  if(isset($_GET['add']) || isset($_GET['edit'])){
    $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):'');
    $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
    $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):'');
    $saved_image = '';
    if(isset($_GET['edit'])){
        $edit_id = (int)$_GET['edit'];
        $portfolioResult = $db->query("SELECT * FROM portfolio WHERE id = '$edit_id'");
        $portfolio = mysqli_fetch_assoc($portfolioResult);

        $a = $portfolio['technologies'];
        $technologies = explode(",",$a);

        $dbpath = $saved_image;
        $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$portfolio['name']);
        $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$portfolio['description']);
        $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):$portfolio['category']);
    }

    if($_POST){
      // Uploading Portfolio Image
      $imagefilename = $_FILES['image']['name'];
      $imagepath = BASEURL.'img/portfolio';
      $imagedestination = $imagepath . '/' . $imagefilename;
      $imageextension = pathinfo($imagefilename, PATHINFO_EXTENSION);
      $imagefile = $_FILES['image']['tmp_name'];
      $imagesize = $_FILES['image']['size'];

      if (!in_array($imageextension, ['jpg','jpeg','png','gif','PNG','JPG','GIF'])) {
          echo "You file extension must be jpg, jpeg, png, gif for image files";
      } elseif ($_FILES['image']['size'] > 10000000) { // file shouldn't be larger than 100Megabyte
          echo "Files are too large!";
      } else {
          move_uploaded_file($imagefile, $imagedestination);
      }

      if(isset($_GET['add'])){                    

          $a = $_POST['technologies'];
          $technologies = implode(',',$a);
          
          $insertSql = "INSERT INTO portfolio (name,description,category,image,technologies) VALUES ('$name','$description','$category','$imagefilename','$technologies')";
      }

      if(isset($_GET['edit'])){

          $b = $_POST['technologies'];
          $technologies_u = implode(",",$b);

          $insertSql = "UPDATE portfolio SET name = '$name', description = '$description', category = '$category', image = '$imagefilename', technologies = '$technologies_u' WHERE id = '$edit_id'";
      }

      if($db->query($insertSql)){
          echo "<script>alert('Data Saved Successfully')</script>";
      }
    }
  }

  if(isset($_GET['delete'])){
    $del_id = $_GET['delete'];
    $del = "DELETE FROM portfolio WHERE id = '$del_id'";
    $run_del = $db->query($del);
    if($run_del){
      echo "<script>alert('Data Deleted Successfully')</script>";
    }
  }
?>

  <div class="container pt-3">
    <h4 class="text-center">List of Portfolio</h4>
  </div>
	<div class="container-fluid" style="margin: 2em 0;">
    <button type="button" class="btn btn-primary btn-floating" title="<?=((isset($_GET['edit']))?'Edit Portfolio':'Add New Portfolio');?>" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-<?=((isset($_GET['edit']))?'edit':'plus-circle');?>" style="color:#fff!important"></i>
    </button>

    <div class="table-responsive mt-3">
      <table class="table table-sm table-striped table-bordered">
        <thead class="elegant-color white-text">
          <th></th>
          <th></th>
          <th style="font-size:13px">Name</th>
          <th style="font-size:13px">Description</th>
          <th style="font-size:13px">Category</th>
          <th width="125" style="font-size:13px">Image</th>
          <th style="font-size:13px">Technologies</th>
        </thead>
        <tbody>
          <?php
            $fetchPortfolio = "SELECT * FROM portfolio ORDER BY name ASC";
            $readPortfolio = $db->query($fetchPortfolio);

            if(mysqli_num_rows($readPortfolio) > 0){
              while($portfolio = mysqli_fetch_assoc($readPortfolio)):
          ?>
          <tr>
            <td>
              <a href="portfolio.php?edit=<?=$portfolio['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-edit" title="Edit"></i></a>
            </td>
            <td>
              <a href="portfolio.php?delete=<?=$portfolio['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-trash" title="Delete"></i></a>
            </td>
            <td style="font-size:13px"><?=$portfolio['name'];?></td>
            <td style="font-size:13px"><?=$portfolio['description'];?></td>
            <td style="font-size:13px"><?=$portfolio['category'];?></td>
            <td style="font-size:13px"><img src="../img/portfolio/<?=$portfolio['image'];?>" class="img-fluid img-responsive" style="width: 100%"></td>
            <td style="font-size:13px"><?=$portfolio['technologies'];?></td>
          </tr>
          <?php endwhile; } ?>
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="" name="portfolio" id="portfolio" action="portfolio.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data" style="color: #757575;" action="#!">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?=((isset($_GET['edit']))?'Edit':'Add New');?> Portfolio</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Portfolio Name -->
              <div class="form-outline">
                <input type="text" id="name" name="name" class="form-control" value="<?=((isset($_GET['edit']))?$name:'');?>">
                <label for="name" class="form-label">Portfolio Name</label>
              </div>
              <!-- Portfolio Description -->
              <div class="mt-4 form-outline">
                <textarea id="description" name="description" class="form-control"><?=((isset($_GET['edit']))?$description:'');?></textarea>
                <label for="description" class="form-label">Portfolio Description</label>
              </div>
              <!-- Portfolio Category -->
              <div class="mt-4 form-outline">
                <input type="text" id="category" name="category" class="form-control" value="<?=((isset($_GET['edit']))?$category:'');?>">
                <label for="category" class="form-label">Portfolio Category</label>
              </div>
              <!-- Portfolio Image -->
              <div class="form-file mt-4">
                <input type="file" class="form-file-input" name="image" id="image" />
                <label class="form-file-label" for="image">
                  <span class="form-file-text">Choose file...</span>
                  <span class="form-file-button">Browse</span>
                </label>
              </div>
              <!-- Technologies -->
              <label for="technologies mt-4">Technologies Used</label>
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="html5" name="technologies[]" value="HTML5" 
                    <?php if((isset($_GET['edit'])) && in_array("HTML5",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="html5">HTML5</label>
              </div>
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="css3" name="technologies[]" value="CSS3" 
                    <?php if((isset($_GET['edit'])) && in_array("CSS3",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="css3">CSS3</label>
              </div>
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="javascript" name="technologies[]" value="JavaScript" 
                    <?php if((isset($_GET['edit'])) && in_array("JavaScript",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="javascrip">JavaScript</label>
              </div>
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="jquery" name="technologies[]" value="jQuery" 
                    <?php if((isset($_GET['edit'])) && in_array("jQuery",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="jquery">jQuery</label>
              </div>                  
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="php" name="technologies[]" value="PHP" 
                    <?php if((isset($_GET['edit'])) && in_array("PHP",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="php">PHP</label>
              </div>                  
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="mysql" name="technologies[]" value="MySQL" 
                    <?php if((isset($_GET['edit'])) && in_array("MySQL",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="mysql">MySQL</label>
              </div>
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="bootstrap" name="technologies[]" value="Bootstrap" 
                    <?php if((isset($_GET['edit'])) && in_array("Bootstrap",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="bootstrap">Bootstrap</label>
              </div>
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="wordpress" name="technologies[]" value="WordPress" 
                    <?php if((isset($_GET['edit'])) && in_array("WordPress",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="wordpress">WordPress</label>
              </div>
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="photoshop" name="technologies[]" value="Adobe Photoshop" 
                    <?php if((isset($_GET['edit'])) && in_array("Adobe Photoshop",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="photoshop">Adobe Photoshop</label>
              </div>
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="adobexd" name="technologies[]" value="Adobe XD" 
                    <?php if((isset($_GET['edit'])) && in_array("Adobe XD",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="adobexd">Adobe XD</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Close
              </button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>

<?php include ('includes/footer.php');?>