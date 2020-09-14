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
    $url = ((isset($_POST['url']) && $_POST['url'] != '')?sanitize($_POST['url']):'');

    if(isset($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $projectResult = $db->query("SELECT * FROM projects WHERE id = '$edit_id'");
      $project = mysqli_fetch_assoc($projectResult);

      $a = $project['technologies'];
      $technologies = explode(",",$a);

      $dbpath = $saved_image;
      $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$project['name']);
      $associated_with = ((isset($_POST['associated_with']) && $_POST['associated_with'] != '')?sanitize($_POST['associated_with']):$project['associated_with']);
      $status = ((isset($_POST['status']) && $_POST['status'] != '')?sanitize($_POST['status']):$project['status']);
      $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$project['description']);
      $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):$project['category']);
      $url = ((isset($_POST['url']) && $_POST['url'] != '')?sanitize($_POST['url']):$project['url']);
    }
    if($_POST){
      if(isset($_GET['add'])){                    

        $a = $_POST['technologies'];
        $technologies = implode(', ',$a);
        
        $insertSql = "INSERT INTO projects (name,associated_with,status,description,technologies,category,url) VALUES ('$name','$associated_with','$status','$description','$technologies','$category','$url')";
      }

      if(isset($_GET['edit'])){

        $b = $_POST['technologies'];
        $technologies_u = implode(",",$b);

        $insertSql = "UPDATE projects SET name = '$name', associated_with = '$associated_with', status = '$status', description = '$description', technologies = '$technologies_u', category = '$category', url = '$url' WHERE id = '$edit_id'";
      }
      if($db->query($insertSql)){
        echo "<script>alert('Data Saved Successfully')</script>";
      }
    }
  }

  if(isset($_GET['delete'])){
    $del_id = $_GET['delete'];
    $delete = "DELETE FROM projects WHERE id = '$del_id'";
    $runDelete = $db->query($delete);
    if($runDelete){
      echo "<script>alert('Data Deleted Successfully')</script>"; 
    }
  }
?> 

  <style type="text/css">
    .btn-floating{      
      cursor: pointer;
      border-radius: 50%;
      overflow: hidden;
      vertical-align: middle;
      box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18), 0 4px 15px 0 rgba(0,0,0,0.15);
      transition: all .2s ease-in-out;

    }

    .btn-floating{
      width: 60px;
      height: 60px;
      border:none!important;
    }

    .options{
      width: 45px;
        height: 45px;
        border:none!important;
    }

    .remove_file{
      width: 35px;
        height: 35px;
        border:none!important;
    }
  </style>
  <div class="container-fluid" style="margin: 2em 0;">
    <button type="button" class="btn btn-primary btn-floating-options" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-plus-circle" style="color:#fff!important"></i>
    </button>
    <span class="text-justify ml-3"><?=((isset($_GET['edit']))?'Edit':'Add New');?> Project</span>

    <div class="table-responsive mt-3">
      <table class="table table-sm table-striped table-bordered">
        <thead class="elegant-color white-text">
          <th></th>
          <th width="250" class="text-center">Name</th>
          <th width="250" class="text-center">Associated with</th>
          <th width="250" class="text-center">Status</th>
          <th width="250" class="text-center">Description</th>
          <th width="250" class="text-center">Technologies</th>
          <th width="250" class="text-center">Category</th>
          <th width="250" class="text-center">URL</th>
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
              <a href="projects.php?edit=<?=$project['id'];?>"><i class="fas fa-edit" title="Edit"></i></a>
              <a href="projects.php?delete=<?=$project['id'];?>"><i class="fas fa-trash" title="Delete"></i></a>
            </td>
            <td><?=$project['name'];?></td>
            <td><?=$project['associated_with'];?></td>
            <td><?=$project['status'];?></td>
            <td>
              <?php
                if(strlen($project['description'])>50){ 
                  $project['description']=substr($project['description'],0,50).'. . . <a class="font-weight-bold" href="" title="'.$project['description'].'">Read more</a>'; 
                }
              ?>
              <?=nl2br($project['description']);?>
            </td>
            <td><?=$project['technologies'];?></td>
            <td><?=$project['category'];?></td>
            <td><?=$project['url'];?></td>
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
              <div class="form-outline mt-4">
                <textarea id="description" name="description" class="form-control" value="<?=((isset($_GET['edit']))?$description:'');?>"></textarea>
                <label for="description" class="form-label">Description</label>
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
              <div class="form-check mt-1">
                <input type="checkbox" class="form-check-input" id="others" name="technologies[]" value="Others" 
                    <?php if((isset($_GET['edit'])) && in_array("Others",$technologies)){
                            echo "checked";
                        }
                    ?>
                >
                <label class="form-check-label" for="others">Others</label>
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