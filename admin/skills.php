<?php include ('includes/header.php'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

  <div class="container pt-3">
    <h3 class="text-center">Skills/Online Certifications</h3>
  </div>
  <div class="container-fluid" style="margin: 2em 0;">
    <h5 class="text-justify py-2">Skills&nbsp;&nbsp;<i class="fas fa-info-circle" title="Add/Edit Skills"></i> <hr style="width: 75px;border:2px solid #666;border-radius:50%"></h5>
    <span id="result"></span>
    <div id="live_data"></div>
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
