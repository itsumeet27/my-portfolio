<?php 
	include ('includes/header.php');
	include ('../includes/init.php');
?>
<?php
  if(isset($_GET['add']) || isset($_GET['edit'])){
    $degree_name = ((isset($_POST['degree_name']) && $_POST['degree_name'] != '')?sanitize($_POST['degree_name']):'');
    $year_of_education = ((isset($_POST['year_of_education']) && $_POST['year_of_education'] != '')?sanitize($_POST['year_of_education']):'');
    $college_name = ((isset($_POST['college_name']) && $_POST['college_name'] != '')?sanitize($_POST['college_name']):'');
    $short_description = ((isset($_POST['short_description']) && $_POST['short_description'] != '')?sanitize($_POST['short_description']):'');
    $long_description = ((isset($_POST['long_description']) && $_POST['long_description'] != '')?sanitize($_POST['long_description']):'');
    $board_university = ((isset($_POST['board_university']) && $_POST['board_university'] != '')?sanitize($_POST['board_university']):'');
    $result = ((isset($_POST['result']) && $_POST['result'] != '')?sanitize($_POST['result']):'');
    if(isset($_GET['edit'])){
        $edit_id = (int)$_GET['edit'];
        $educationResult = $db->query("SELECT * FROM education WHERE id = '$edit_id'");
        $education = mysqli_fetch_assoc($educationResult);

        $degree_name = ((isset($_POST['degree_name']) && $_POST['degree_name'] != '')?sanitize($_POST['degree_name']):$education['degree_name']);
        $year_of_education = ((isset($_POST['year_of_education']) && $_POST['year_of_education'] != '')?sanitize($_POST['year_of_education']):$education['year_of_education']);
        $college_name = ((isset($_POST['college_name']) && $_POST['college_name'] != '')?sanitize($_POST['college_name']):$education['college_name']);
        $short_description = ((isset($_POST['short_description']) && $_POST['short_description'] != '')?sanitize($_POST['short_description']):$education['short_description']);
        $long_description = ((isset($_POST['long_description']) && $_POST['long_description'] != '')?sanitize($_POST['long_description']):$education['long_description']);
        $board_university = ((isset($_POST['board_university']) && $_POST['board_university'] != '')?sanitize($_POST['board_university']):$education['board_university']);
        $result = ((isset($_POST['result']) && $_POST['result'] != '')?sanitize($_POST['result']):$education['result']);
    }

    if($_POST){

      if(isset($_GET['add'])){              
          
          $insertSql = "INSERT INTO education (degree_name,year_of_education,college_name,short_description,long_description,board_university,result) VALUES ('$degree_name','$year_of_education','$college_name','$short_description','$long_description','$board_university','$result')";
      }

      if(isset($_GET['edit'])){

          $insertSql = "UPDATE education SET degree_name = '$degree_name', year_of_education = '$year_of_education', college_name = '$college_name', short_description = '$short_description', long_description = '$long_description', board_university = '$board_university', result = '$result' WHERE id = '$edit_id'";
      }

      if($db->query($insertSql)){
          echo "<script>alert('Data Saved Successfully')</script>";
          echo "<script>window.location('education.php','_self');</script>";
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
    <h3 class="text-center">List of Education</h3>
  </div>
	<div class="container-fluid" style="margin: 2em 0;">
    <button type="button" class="btn btn-primary btn-floating" title="<?=((isset($_GET['edit']))?'Edit Education':'Add New Education');?>" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-<?=((isset($_GET['edit']))?'edit':'plus-circle');?>" style="color:#fff!important"></i>
    </button>

    <div class="table-responsive mt-3">
      <table class="table table-sm table-striped table-bordered">
        <thead class="elegant-color white-text">
          <th></th>
          <th></th>
          <th style="font-size:13px">Degree Name</th>
          <th style="font-size:13px">College Name</th>
          <th style="font-size:13px">Short Description</th>
          <th style="font-size:13px">Long Description</th>
          <th style="font-size:13px">Board/University</th>
          <th style="font-size:13px">Result</th>
          <th style="font-size:13px">Year of Education</th>
        </thead>
        <tbody>
          <?php
            $fetchEducation = "SELECT * FROM education ORDER BY id ASC";
            $readEducation = $db->query($fetchEducation);

            if(mysqli_num_rows($readEducation) > 0){
              while($education = mysqli_fetch_assoc($readEducation)):
          ?>
          <tr>
            <td>
              <a href="education.php?edit=<?=$education['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-edit" title="Edit"></i></a>
            </td>
            <td>
              <a href="education.php?delete=<?=$education['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-trash" title="Delete"></i></a>
            </td>
            <td style="font-size:13px"><?=$education['degree_name'];?></td>
            <td style="font-size:13px"><?=$education['college_name'];?></td>
            <td style="font-size:13px">
              <?php
                if(strlen($education['short_description'])>50){ 
                  $education['short_description']=substr($education['short_description'],0,50).'. . . <a class="font-weight-bold" href="" title="'.$education['short_description'].'">Read more</a>'; 
                }
              ?>
              <?=nl2br($education['short_description']);?>
            </td>
            <td style="font-size:13px">
              <?php
                if(strlen($education['long_description'])>50){ 
                  $education['long_description']=substr($education['long_description'],0,50).'. . . <a class="font-weight-bold" href="" title="'.$education['long_description'].'">Read more</a>'; 
                }
              ?>
              <?=nl2br($education['long_description']);?>
            </td>
            <td style="font-size:13px"><?=$education['board_university'];?></td>
            <td style="font-size:13px"><?=$education['result'];?></td>
            <td style="font-size:13px"><?=$education['year_of_education'];?></td>
          </tr>
          <?php endwhile; } ?>
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="" name="education" id="education" action="education.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data" style="color: #757575;" action="#!">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?=((isset($_GET['edit']))?'Edit':'Add New');?> Education</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Degree Name -->
              <div class="form-outline">
                <input type="text" id="degree_name" name="degree_name" class="form-control" value="<?=((isset($_GET['edit']))?$degree_name:'');?>">
                <label for="degree_name" class="form-label">Degree Name</label>
              </div>
              <!-- Short Description -->
              <div class="mt-4 form-outline">
                <textarea id="short_description" name="short_description" class="form-control"><?=((isset($_GET['edit']))?$short_description:'');?></textarea>
                <label for="short_description" class="form-label">Short Description</label>
              </div>
              <!-- Long Description -->
              <div class="mt-4 form-outline">
                <textarea id="long_description" name="long_description" class="form-control"><?=((isset($_GET['edit']))?$long_description:'');?></textarea>
                <label for="long_description" class="form-label">Long Description</label>
              </div>
              <!-- College Name -->
              <div class="mt-4 form-outline">
                <input type="text" id="college_name" name="college_name" class="form-control" value="<?=((isset($_GET['edit']))?$college_name:'');?>">
                <label for="college_name" class="form-label">College Name</label>
              </div>
              <!-- Board/University -->
              <div class="mt-4 form-outline">
                <input type="text" id="board_university" name="board_university" class="form-control" value="<?=((isset($_GET['edit']))?$board_university:'');?>">
                <label for="board_university" class="form-label">Board/University</label>
              </div>
              <!-- Result -->
              <div class="mt-4 form-outline">
                <input type="text" id="result" name="result" class="form-control" value="<?=((isset($_GET['edit']))?$result:'');?>">
                <label for="result" class="form-label">Result</label>
              </div>
              <!-- Year of Education -->
              <div class="mt-4 form-outline">
                <input type="text" id="year_of_education" name="year_of_education" class="form-control" value="<?=((isset($_GET['edit']))?$year_of_education:'');?>">
                <label for="year_of_education" class="form-label">Year of Education</label>
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