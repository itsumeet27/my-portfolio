<?php 
  include ('includes/header.php'); 
  include ('../includes/init.php');

  if(isset($_GET['add']) || isset($_GET['edit'])){
    $cert_name = ((isset($_POST['cert_name']) && $_POST['cert_name'] != '')?sanitize($_POST['cert_name']):'');
    $issued_by = ((isset($_POST['issued_by']) && $_POST['issued_by'] != '')?sanitize($_POST['issued_by']):'');
    $issued_date = ((isset($_POST['issued_date']) && $_POST['issued_date'] != '')?sanitize($_POST['issued_date']):'');

    if(isset($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $certificationResult = $db->query("SELECT * FROM certifications WHERE id = '$edit_id'");
      $certification = mysqli_fetch_assoc($certificationResult);

      $cert_name = ((isset($_POST['cert_name']) && $_POST['cert_name'] != '')?sanitize($_POST['cert_name']):$certification['cert_name']);
      $issued_by = ((isset($_POST['issued_by']) && $_POST['issued_by'] != '')?sanitize($_POST['issued_by']):$certification['issued_by']);
      $issued_date = ((isset($_POST['issued_date']) && $_POST['issued_date'] != '')?sanitize($_POST['issued_date']):$certification['issued_date']);
    }

    if($_POST){
      if(isset($_GET['add'])){        
        $insertSql = "INSERT INTO certifications (cert_name,issued_by,issued_date) VALUES ('$cert_name','$issued_by','$issued_date')";
      }

      if(isset($_GET['edit'])){
        $insertSql = "UPDATE certifications SET cert_name = '$cert_name', issued_by = '$issued_by', issued_date = '$issued_date' WHERE id = '$edit_id'";
      }

      if($db->query($insertSql)){
        echo "<script>alert('Data Saved Successfully')</script>";
        echo "<script>window.location('skills.php','_self')</script>";
      }
    }
  }
?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

  <div class="container pt-3">
    <h3 class="text-center">Skills/Online Certifications</h3>
  </div>
  <div class="container-fluid" style="margin: 2em 0;">
    <h5 class="text-justify py-2">Skills&nbsp;&nbsp;<i class="fas fa-info-circle" title="Add/Edit Skills"></i> <hr style="width: 75px;border:2px solid #666;border-radius:50%"></h5>
    <span id="result"></span>
    <div id="live_data"></div>
    <h5 class="text-justify py-2">Certifications&nbsp;&nbsp;<i class="fas fa-info-circle" title="Add/Edit Certifications"></i> <hr style="width: 75px;border:2px solid #666;border-radius:50%"></h5>

    <button type="button" class="btn btn-primary btn-floating" title="<?=((isset($_GET['edit']))?'Edit Certification':'Add New Certification');?>" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-<?=((isset($_GET['edit']))?'edit':'plus-circle');?>" style="color:#fff!important"></i>
    </button>
    <div class="table-responsive mt-3">
      <table class="table table-sm table-striped table-bordered">
        <thead class="elegant-color white-text">
          <th></th>
          <th></th>
          <th style="font-size:13px">Name</th>
          <th style="font-size:13px">Issued By</th>
          <th style="font-size:13px">Issued Date</th>
        </thead>
        <tbody>
          <?php
            $fetchCertifications = "SELECT * FROM certifications ORDER BY issued_date ASC";
            $readCertifications = $db->query($fetchCertifications);

            if(mysqli_num_rows($readCertifications) > 0){
              while($certificate = mysqli_fetch_assoc($readCertifications)):
          ?>
          <tr>
            <td>
              <a href="skills.php?edit=<?=$certificate['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-edit" title="Edit"></i></a>
            </td>
            <td>
              <a href="skills.php?delete=<?=$certificate['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-trash" title="Delete"></i></a>
            </td>
            <td style="font-size:13px"><?=$certificate['cert_name'];?></td>
            <td style="font-size:13px"><?=$certificate['issued_by'];?></td>
            <td style="font-size:13px"><?=$certificate['issued_date'];?></td>
          </tr>
          <?php endwhile; } ?>
        </tbody>
      </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="" name="skills" id="skills" action="skills.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data" style="color: #757575;" action="#!">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?=((isset($_GET['edit']))?'Edit':'Add New');?> Certification</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Certification Name -->
              <div class="form-outline mt-4">
                <input type="text" id="cert_name" name="cert_name" class="form-control" value="<?=((isset($_GET['edit']))?$cert_name:'');?>">
                <label for="cert_name" class="form-label">Certification Name</label>
              </div>
              <!-- Issued By -->
              <div class="form-outline mt-4">
                <input type="text" id="issued_by" name="issued_by" class="form-control" value="<?=((isset($_GET['edit']))?$issued_by:'');?>">
                <label for="issued_by" class="form-label">Issued By</label>
              </div>
              <!-- Issued Date -->
              <div class="mt-4">                
                <label for="issued_date" class="">Issued Date</label>
                <input type="date" id="issued_date" name="issued_date" class="form-control" value="<?=((isset($_GET['edit']))?$issued_date:'');?>">
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
  <script type="text/javascript">
    $(document).ready(function(){  
        function fetch_data()  
        {  
            $.ajax({  
                url:"skills/select.php",  
                method:"POST",  
                success:function(data){  
                  $('#live_data').html(data);  
                }  
            });  
        }  
        fetch_data();  
        $(document).on('click', '#btn_add', function(){  
            var name = $('#name').text();  
            var percentage = $('#percentage').text();  
            if(name == '')  
            {  
                alert("Enter Skill Name");  
                return false;  
            }  
            if(percentage == '')  
            {  
                alert("Enter Percentage");  
                return false;  
            }  
            $.ajax({  
                url:"skills/insert.php",  
                method:"POST",  
                data:{name:name, percentage:percentage},  
                dataType:"text",  
                success:function(data)  
                {  
                    alert(data);  
                    fetch_data();  
                }  
            })  
        });  
        
      function edit_data(id, text, column_name)  
        {  
            $.ajax({  
                url:"skills/edit.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                    //alert(data);
                  $('#result').html("<div class='alert alert-success'>"+data+"</div>");
                  setTimeout(location.reload.bind(location), 500);
                }  
            });  
        }  
        $(document).on('blur', '.name', function(){  
            var id = $(this).data("id1");  
            var name = $(this).text();  
            edit_data(id, name, "name");  
        });  
        $(document).on('blur', '.percentage', function(){  
            var id = $(this).data("id2");  
            var percentage = $(this).text();  
            edit_data(id,percentage, "percentage");  
        });  
        $(document).on('click', '.btn_delete', function(){  
            var id=$(this).data("id3");  
            if(confirm("Are you sure you want to delete this?"))  
            {  
                $.ajax({  
                    url:"skills/delete.php",  
                    method:"POST",  
                    data:{id:id},  
                    dataType:"text",  
                    success:function(data){  
                        alert(data);  
                        fetch_data();  
                    }  
                });  
            }  
        });  
    });
  </script>
<?php include ('includes/footer.php'); ?>
