<?php 
	include ('includes/header.php');
  include ('../includes/init.php');
  
  $sql = "SELECT * FROM about";
  $result = $db->query($sql);

  if(isset($_GET['add']) || isset($_GET['edit'])){
    $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):'');
    $short_desc = ((isset($_POST['short_desc']) && $_POST['short_desc'] != '')?sanitize($_POST['short_desc']):'');
    $salutation = ((isset($_POST['salutation']) && $_POST['salutation'] != '')?sanitize($_POST['salutation']):'');
    $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
    $address = ((isset($_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):'');
    $mobile = ((isset($_POST['mobile']) && $_POST['mobile'] != '')?sanitize($_POST['mobile']):'');
    $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):'');

    if(isset($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $aboutResult = $db->query("SELECT * FROM about WHERE id = '$edit_id'");
      $about = mysqli_fetch_assoc($aboutResult);

      $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$about['name']);
      $short_desc = ((isset($_POST['short_desc']) && $_POST['short_desc'] != '')?sanitize($_POST['short_desc']):$about['feature_desc']);
      $salutation = ((isset($_POST['salutation']) && $_POST['salutation'] != '')?sanitize($_POST['salutation']):$about['salutation']);
      $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$about['about_desc']);
      $address = ((isset($_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):$about['address']);
      $mobile = ((isset($_POST['mobile']) && $_POST['mobile'] != '')?sanitize($_POST['mobile']):$about['mobile']);
      $email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$about['email']);
    }
    if($_POST){
      if(isset($_GET['add'])){        
        $insertSql = "INSERT INTO about (feature_desc,salutation,name,about_desc,address,mobile,email) VALUES ('$short_desc','$salutation','$name','$description','$address','$mobile','$email')";
      }

      if(isset($_GET['edit'])){
        $insertSql = "UPDATE about SET feature_desc = '$short_desc', salutation = '$salutation', name = '$name', about_desc = '$description', address = '$address', mobile = '$mobile', email = '$email' WHERE id = '$edit_id'";
      }
      if($db->query($insertSql)){
        echo "<script>alert('Data Saved Successfully')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      }
    }
  }
?>

  <div class="container pt-3">
    <h4 class="text-center">Index Page</h4>
  </div>
  <div class="container-fluid" style="margin: 2em 0;">
    <button type="button" class="btn btn-primary btn-floating" title="<?=((isset($_GET['edit']))?'Edit Profile Data':'Add Profile Data');?>" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-<?=((isset($_GET['edit']))?'edit':'plus-circle');?>" style="color:#fff!important"></i>
    </button>

    <div class="profile-data mt-3">
      <div class="row">
        <div class="col-md-6">
          <div class="table-responsive">
            <table class="table table-bordered table-sm">
              <?php 
                while($row = mysqli_fetch_assoc($result)){
                  $id = $row['id'];
                  $name = $row['name'];
                  $short_desc = $row['feature_desc'];
                  $salutation = $row['salutation'];
                  $description = $row['about_desc'];
                  $address = $row['address'];
                  $mobile = $row['mobile'];
                  $email = $row['email'];
                } 
              ?>
              <tr>
                <th style="font-size:14px">Name</th>
                <td style="font-size:14px"><?=$name;?> <span class="float-right" title="Edit Profile Data"><a href="index.php?edit=<?=$id;?>" class="my-2"><i class="fas fa-edit"></i></a></span></td>
              </tr>
              <tr>
                <th style="font-size:14px">Short Description</th>
                <td style="font-size:14px"><?=nl2br($short_desc);?></td>
              </tr>
              <tr>
                <th style="font-size:14px">Salutation</th>
                <td style="font-size:14px"><?=$salutation;?></td>
              </tr>
              <tr>
                <th style="font-size:14px">About Description</th>
                <td style="font-size:14px"><?=nl2br($description);?></td>
              </tr>
              <tr>
                <th style="font-size:14px">Address</th>
                <td style="font-size:14px"><?=$address;?></td>
              </tr>
              <tr>
                <th style="font-size:14px">Mobile</th>
                <td style="font-size:14px"><?=$mobile;?></td>
              </tr>
              <tr>
                <th style="font-size:14px">Email</th>
                <td style="font-size:14px"><?=$email;?></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-6"></div>
      </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="" name="index" id="index" action="index.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data" style="color: #757575;" action="#!">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?=((isset($_GET['edit']))?'Edit':'Add New');?> Portfolio</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Name -->
              <div class="form-outline">
                <input type="text" id="name" name="name" class="form-control" value="<?=((isset($_GET['edit']))?$name:'');?>">
                <label for="name" class="form-label">Name</label>
              </div>
              <!-- Salutation -->
              <div class="mt-4 form-outline">
                <input type="text" id="salutation" name="salutation" class="form-control" value="<?=((isset($_GET['edit']))?$salutation:'');?>">
                <label for="salutation" class="form-label">Salutation</label>
              </div>
              <!-- Short Description -->
              <div class="mt-4 form-outline">
              <textarea id="short_desc" name="short_desc" class="form-control"><?=((isset($_GET['edit']))?$short_desc:'');?></textarea>
                <label for="short_desc" class="form-label">Short Description</label>
              </div>
              <!-- Description -->
              <div class="mt-4 form-outline">
                <textarea id="description" name="description" class="form-control"><?=((isset($_GET['edit']))?$description:'');?></textarea>
                <label for="description" class="form-label">About Description</label>
              </div>
              <!-- Address -->
              <div class="mt-4 form-outline">
                <input type="text" id="address" name="address" class="form-control" value="<?=((isset($_GET['edit']))?$address:'');?>">
                <label for="address" class="form-label">Address</label>
              </div>
              <!-- Mobile -->
              <div class="mt-4 form-outline">
                <input type="text" id="mobile" name="mobile" class="form-control" value="<?=((isset($_GET['edit']))?$mobile:'');?>">
                <label for="mobile" class="form-label">Mobile</label>
              </div>
              <!-- Email -->
              <div class="mt-4 form-outline">
                <input type="text" id="email" name="email" class="form-control" value="<?=((isset($_GET['edit']))?$email:'');?>">
                <label for="email" class="form-label">Email ID</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Close
              </button>
              <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include ('includes/footer.php');?>