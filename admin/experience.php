<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        include('includes/header.php');
        include ('../includes/init.php');
?>
<?php
  if(isset($_GET['add']) || isset($_GET['edit'])){
    $designation = ((isset($_POST['designation']) && $_POST['designation'] != '')?sanitize($_POST['designation']):'');
    $year_of_work = ((isset($_POST['year_of_work']) && $_POST['year_of_work'] != '')?sanitize($_POST['year_of_work']):'');
    $company_name = ((isset($_POST['company_name']) && $_POST['company_name'] != '')?sanitize($_POST['company_name']):'');
    $long_description = ((isset($_POST['long_description']) && $_POST['long_description'] != '')?sanitize($_POST['long_description']):'');
    if(isset($_GET['edit'])){
        $edit_id = (int)$_GET['edit'];
        $experienceResult = $db->query("SELECT * FROM experience WHERE id = '$edit_id'");
        $experience = mysqli_fetch_assoc($experienceResult);

        $designation = ((isset($_POST['designation']) && $_POST['designation'] != '')?sanitize($_POST['designation']):$experience['designation']);
        $year_of_work = ((isset($_POST['year_of_work']) && $_POST['year_of_work'] != '')?sanitize($_POST['year_of_work']):$experience['year_of_work']);
        $company_name = ((isset($_POST['company_name']) && $_POST['company_name'] != '')?sanitize($_POST['company_name']):$experience['company_name']);
        $long_description = ((isset($_POST['long_description']) && $_POST['long_description'] != '')?sanitize($_POST['long_description']):$experience['long_description']);
    }

    if($_POST){

      if(isset($_GET['add'])){              
          
          $insertSql = "INSERT INTO experience (designation,year_of_work,company_name,long_description) VALUES ('$designation','$year_of_work','$company_name','$long_description')";
      }

      if(isset($_GET['edit'])){

          $insertSql = "UPDATE experience SET designation = '$designation', year_of_work = '$year_of_work', company_name = '$company_name', long_description = '$long_description' WHERE id = '$edit_id'";
      }

      if($db->query($insertSql)){
          echo "<script>alert('Data Saved Successfully')</script>";
          echo "<script>window.location('experience.php','_self');</script>";
      }
    }
  }

  if(isset($_GET['delete'])){
    $del_id = $_GET['delete'];
    $del = "DELETE FROM experience WHERE id = '$del_id'";
    $run_del = $db->query($del);
    if($run_del){
      echo "<script>alert('Data Deleted Successfully')</script>";
    }
  }
?>

  <div class="container pt-3">
    <h3 class="text-center">List of Experience</h3>
  </div>
	<div class="container-fluid" style="margin: 2em 0;">
    <button type="button" class="btn btn-primary btn-floating" title="<?=((isset($_GET['edit']))?'Edit Experience':'Add New Experience');?>" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-<?=((isset($_GET['edit']))?'edit':'plus-circle');?>" style="color:#fff!important"></i>
    </button>

    <div class="table-responsive mt-3">
      <table class="table table-sm table-striped table-bordered">
        <thead class="elegant-color white-text">
          <th></th>
          <th></th>
          <th style="font-size:13px">Designation</th>
          <th style="font-size:13px">Company Name</th>
          <th style="font-size:13px">Long Description</th>
          <th style="font-size:13px">Year of Work</th>
        </thead>
        <tbody>
          <?php
            $fetchexperience = "SELECT * FROM experience ORDER BY id ASC";
            $readexperience = $db->query($fetchexperience);

            if(mysqli_num_rows($readexperience) > 0){
              while($experience = mysqli_fetch_assoc($readexperience)):
          ?>
          <tr>
            <td>
              <a href="experience.php?edit=<?=$experience['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-edit" title="Edit"></i></a>
            </td>
            <td>
              <a href="experience.php?delete=<?=$experience['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-trash" title="Delete"></i></a>
            </td>
            <td style="font-size:13px"><?=$experience['designation'];?></td>
            <td style="font-size:13px"><?=$experience['company_name'];?></td>
            <td style="font-size:13px">
              <?php
                if(strlen($experience['long_description'])>50){ 
                  $experience['long_description']=substr($experience['long_description'],0,50).'. . . <a class="font-weight-bold" href="" title="'.$experience['long_description'].'">Read more</a>'; 
                }
              ?>
              <?=nl2br($experience['long_description']);?>
            </td>
            <td style="font-size:13px"><?=$experience['year_of_work'];?></td>
          </tr>
          <?php endwhile; } ?>
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="" name="experience" id="experience" action="experience.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data" style="color: #757575;" action="#!">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?=((isset($_GET['edit']))?'Edit':'Add New');?> Experience</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Designation -->
              <div class="form-outline">
                <input type="text" id="designation" name="designation" class="form-control" value="<?=((isset($_GET['edit']))?$designation:'');?>">
                <label for="designation" class="form-label">Designation</label>
              </div>
              <!-- Company Name -->
              <div class="mt-4 form-outline">
                <input type="text" id="company_name" name="company_name" class="form-control" value="<?=((isset($_GET['edit']))?$company_name:'');?>">
                <label for="company_name" class="form-label">Company Name</label>
              </div>
              <!-- Long Description -->
              <div class="mt-4 form-outline">
                <textarea id="long_description" name="long_description" class="form-control"><?=((isset($_GET['edit']))?$long_description:'');?></textarea>
                <label for="long_description" class="form-label">Long Description</label>
              </div>
              <!-- Year of Work -->
              <div class="mt-4 form-outline">
                <input type="text" id="year_of_work" name="year_of_work" class="form-control" value="<?=((isset($_GET['edit']))?$year_of_work:'');?>">
                <label for="year_of_work" class="form-label">Year of Work</label>
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

<?php } include ('includes/footer.php');?>