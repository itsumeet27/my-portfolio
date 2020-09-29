<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        include('includes/header.php');
        include ('../includes/init.php');
?>
<?php
  $dbpath = '';
  if(isset($_GET['add']) || isset($_GET['edit'])){
    $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):'');
    $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
    $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):'');
    $technologies = ((isset($_POST['technologies']) && $_POST['technologies'] != '')?sanitize($_POST['technologies']):'');
    $features = ((isset($_POST['features']) && $_POST['features'] != '')?sanitize($_POST['features']):'');
    $reference = ((isset($_POST['reference']) && $_POST['reference'] != '')?sanitize($_POST['reference']):'');
    $slug = ((isset($_POST['slug']) && $_POST['slug'] != '')?sanitize($_POST['slug']):'');

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
        $features = ((isset($_POST['features']) && $_POST['features'] != '')?sanitize($_POST['features']):$portfolio['features']);
        $slug = ((isset($_POST['slug']) && $_POST['slug'] != '')?sanitize($_POST['slug']):$portfolio['slug']);
        $reference = ((isset($_POST['reference']) && $_POST['reference'] != '')?sanitize($_POST['reference']):$portfolio['reference']);
    }

    if(isset($_POST['submit'])){
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
          $insertSql = "INSERT INTO portfolio (name,description,category,image,technologies,features,reference,slug) VALUES ('$name','$description','$category','$imagefilename','$technologies','$features','$reference')";
      }

      if(isset($_GET['edit'])){
        $insertSql = "UPDATE portfolio SET name = '$name', description = '$description', category = '$category', image = '$imagefilename', technologies = '$technologies', features = '$features', reference = '$reference', slug = '$slug' WHERE id = '$edit_id'";
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
          <th style="font-size:13px">Features</th>
          <th style="font-size:13px">Reference</th>
          <th style="font-size:13px">Slug</th>
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
            <td style="font-size:13px"><?=$portfolio['features'];?></td>
            <td style="font-size:13px"><?=$portfolio['reference'];?></td>
            <td style="font-size:13px"><?=$portfolio['slug'];?></td>
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
              <!-- Portfolio Features -->
              <div class="mt-4 form-outline">
                <textarea id="features" name="features" class="form-control"><?=((isset($_GET['edit']))?$features:'');?></textarea>
                <label for="features" class="form-label">Portfolio Features</label>
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
              <!-- Reference -->
              <div class="mt-4 form-outline">
                <input type="text" id="reference" name="reference" class="form-control" value="<?=((isset($_GET['edit']))?$reference:'');?>">
                <label for="reference" class="form-label">Reference</label>
              </div>
              <!-- Slug -->
              <div class="mt-4 form-outline">
                <input type="text" id="slug" name="slug" class="form-control" value="<?=((isset($_GET['edit']))?$slug:'');?>">
                <label for="slug" class="form-label">Slug</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Close
              </button>
              <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
	</div>

<?php } include ('includes/footer.php');?>