<?php 
  include ('includes/header.php');
  include ('../includes/init.php');
?>
<?php
  if(isset($_GET['add']) || isset($_GET['edit'])){
    $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):'');
    $associated_with = ((isset($_POST['associated_with']) && $_POST['associated_with'] != '')?sanitize($_POST['associated_with']):'');
    $status = ((isset($_POST['status']) && $_POST['status'] != '')?sanitize($_POST['status']):'');
    $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
    $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):'');
    $technologies = ((isset($_POST['technologies']) && $_POST['technologies'] != '')?sanitize($_POST['technologies']):'');
    $url = ((isset($_POST['url']) && $_POST['url'] != '')?sanitize($_POST['url']):'');

    if(isset($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $projectResult = $db->query("SELECT * FROM projects WHERE id = '$edit_id'");
      $project = mysqli_fetch_assoc($projectResult);

      $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$project['name']);
      $associated_with = ((isset($_POST['associated_with']) && $_POST['associated_with'] != '')?sanitize($_POST['associated_with']):$project['associated_with']);
      $status = ((isset($_POST['status']) && $_POST['status'] != '')?sanitize($_POST['status']):$project['status']);
      $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$project['description']);
      $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):$project['category']);
      $technologies = ((isset($_POST['technologies']) && $_POST['technologies'] != '')?sanitize($_POST['technologies']):$project['technologies']);
      $url = ((isset($_POST['url']) && $_POST['url'] != '')?sanitize($_POST['url']):$project['url']);
    }
    if($_POST){
      if(isset($_GET['add'])){ 
        $insertSql = "INSERT INTO projects (name,associated_with,status,description,technologies,category,url) VALUES ('$name','$associated_with','$status','$description','$technologies','$category','$url')";
      }

      if(isset($_GET['edit'])){
        $insertSql = "UPDATE projects SET name = '$name', associated_with = '$associated_with', status = '$status', description = '$description', technologies = '$technologies', category = '$category', url = '$url' WHERE id = '$edit_id'";
      }
      if($db->query($insertSql)){
        echo "<script>alert('Data Saved Successfully')</script>";
        echo "<script>window.location('projects.php','_self')</script>";
      }
    }
  }

  if(isset($_GET['delete'])){
    $del_id = $_GET['delete'];
    $delete = "DELETE FROM projects WHERE id = '$del_id'";
    $runDelete = $db->query($delete);
    if($runDelete){
      echo "<script>alert('Data Deleted Successfully')</script>"; 
      echo "<script>window.location('projects.php','_self')</script>";
    }
  }
?> 

  <div class="container pt-3">
    <h3 class="text-center">List of Projects</h3>
  </div>
  <div class="container-fluid" style="margin: 2em 0;">
    <button type="button" class="btn btn-primary btn-floating" title="<?=((isset($_GET['edit']))?'Edit Project':'Add New Project');?>" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-<?=((isset($_GET['edit']))?'edit':'plus-circle');?>" style="color:#fff!important"></i>
    </button>

    <div class="table-responsive mt-3">
      <table class="table table-sm table-striped table-bordered">
        <thead class="elegant-color white-text">
          <th></th>
          <th></th>
          <th width="250" style="font-size:13px">Name</th>
          <th width="250" style="font-size:13px">Associated with</th>
          <th width="250" style="font-size:13px">Status</th>
          <th width="250" style="font-size:13px">Description</th>
          <th width="250" style="font-size:13px">Technologies</th>
          <th width="250" style="font-size:13px">Category</th>
          <th width="250" style="font-size:13px">URL</th>
        </thead>
        <tbody>
          <?php
            $fetchProject = "SELECT * FROM projects ORDER BY name ASC";
            $readProject = $db->query($fetchProject);

            if(mysqli_num_rows($readProject) > 0){
              while($project = mysqli_fetch_assoc($readProject)):
          ?>
          <tr>
            <td>
              <a href="projects.php?edit=<?=$project['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-edit" title="Edit"></i></a>
            </td>
            <td>
              <a href="projects.php?delete=<?=$project['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-trash" title="Delete"></i></a>
            </td>
            <td style="font-size:13px"><?=$project['name'];?></td>
            <td style="font-size:13px"><?=$project['associated_with'];?></td>
            <td style="font-size:13px"><?=$project['status'];?></td>
            <td style="font-size:13px">
              <?php
                if(strlen($project['description'])>50){ 
                  $project['description']=substr($project['description'],0,50).'. . . <a class="font-weight-bold" href="" title="'.$project['description'].'">Read more</a>'; 
                }
              ?>
              <?=nl2br($project['description']);?>
            </td>
            <td style="font-size:13px"><?=$project['technologies'];?></td>
            <td style="font-size:13px"><?=$project['category'];?></td>
            <td style="font-size:13px"><?=$project['url'];?></td>
          </tr>
          <?php endwhile; } ?>
        </tbody>
      </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="" name="project" id="project" action="projects.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data" style="color: #757575;" action="#!">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?=((isset($_GET['edit']))?'Edit':'Add New');?> Project</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Project Name -->
              <div class="form-outline mt-4">
                <input type="text" id="name" name="name" class="form-control" value="<?=((isset($_GET['edit']))?$name:'');?>">
                <label for="name" class="form-label">Project Name</label>
              </div>
              <!-- Associated with -->
              <div class="form-outline mt-4">
                <input type="text" id="associated_with" name="associated_with" class="form-control" value="<?=((isset($_GET['edit']))?$associated_with:'');?>">
                <label for="associated_with" class="form-label">Associated with</label>
              </div>
              <!-- Status -->
              <div class="form-outline mt-4">
                <input type="text" id="status" name="status" class="form-control" value="<?=((isset($_GET['edit']))?$status:'');?>">
                <label for="status" class="form-label">Status</label>
              </div>
              <!-- Description -->
              <div class="form-outline my-4">
                <textarea id="description" name="description" class="form-control" value="<?=((isset($_GET['edit']))?$description:'');?>"></textarea>
                <label for="description" class="form-label">Description</label>
              </div>
              <!-- Technologies -->
              <div class="mt-4 form-outline">
                <input type="text" id="technologies" name="technologies" class="form-control" value="<?=((isset($_GET['edit']))?$technologies:'');?>">
                <label for="technologies" class="form-label">Technologies Used</label>
              </div>
              <!-- Category -->
              <div class="form-outline mt-4">
                <input type="text" id="category" name="category" class="form-control" value="<?=((isset($_GET['edit']))?$category:'None');?>">
                <label for="category" class="form-label">Category</label>
              </div>
              <!-- URL -->
              <div class="form-outline mt-4">
                <input type="text" id="url" name="url" class="form-control" value="<?=((isset($_GET['edit']))?$url:'');?>">
                <label for="url" class="form-label">URL</label>
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