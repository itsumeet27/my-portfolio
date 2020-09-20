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
    $technologies = ((isset($_POST['technologies']) && $_POST['technologies'] != '')?sanitize($_POST['technologies']):'');

    $saved_image = '';
    if(isset($_GET['edit'])){
        $edit_id = (int)$_GET['edit'];
        $portfolioResult = $db->query("SELECT * FROM portfolio WHERE id = '$edit_id'");
        $portfolio = mysqli_fetch_assoc($portfolioResult);

        $dbpath = $saved_image;
        $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$portfolio['name']);
        $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$portfolio['description']);
        $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):$portfolio['category']);
        $technologies = ((isset($_POST['technologies']) && $_POST['technologies'] != '')?sanitize($_POST['technologies']):$portfolio['technologies']);
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
          $insertSql = "INSERT INTO portfolio (name,description,category,image,technologies) VALUES ('$name','$description','$category','$imagefilename','$technologies')";
      }

      if(isset($_GET['edit'])){
        $insertSql = "UPDATE portfolio SET name = '$name', description = '$description', category = '$category', image = '$imagefilename', technologies = '$technologies' WHERE id = '$edit_id'";
      }

      if($db->query($insertSql)){
          echo "<script>alert('Data Saved Successfully')</script>";
          echo "<script>window.location('portfolio.php', '_self')</script>";
      }
    }
  }

  if(isset($_GET['delete'])){
    $del_id = $_GET['delete'];
    $del = "DELETE FROM portfolio WHERE id = '$del_id'";
    $run_del = $db->query($del);
    if($run_del){
      echo "<script>alert('Data Deleted Successfully')</script>";
      echo "<script>window.location('portfolio.php','_self')</script>";
    }
  }
?>

  <div class="container pt-3">
    <h3 class="text-center">List of Portfolio</h3>
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
              <div class="form-file my-4">
                <input type="file" class="form-file-input" name="image" id="image" />
                <label class="form-file-label" for="image">
                  <span class="form-file-text">Choose file...</span>
                  <span class="form-file-button">Browse</span>
                </label>
              </div>
              <!-- Technologies -->
              <div class="mt-4 form-outline">
                <input type="text" id="technologies" name="technologies" class="form-control" value="<?=((isset($_GET['edit']))?$technologies:'');?>">
                <label for="technologies" class="form-label">Technologies Used</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
	</div>

<?php include ('includes/footer.php');?>