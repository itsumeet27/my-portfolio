<?php include ('includes/header.php'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

  <div class="container pt-3">
    <h3 class="text-center">Index Page</h3>
  </div>
  <div class="container-fluid" style="margin: 2em 0;">
    <h5 class="text-justify py-2">Profile Details <hr style="width: 75px;border:2px solid #666;border-radius:50%"></h5>
    <span id="result"></span>
    <div id="live_data"></div> 
  </div>

  <script type="text/javascript">
    $(document).ready(function(){  
        function fetch_data()  
        {  
            $.ajax({  
                url:"about_details/select.php",  
                method:"POST",  
                success:function(data){  
            $('#live_data').html(data);  
                }  
            });  
        }  
        fetch_data();  
        $(document).on('click', '#btn_add', function(){  
            var name = $('#name').text();  
            var feature_desc = $('#feature_desc').text();  
            var about_desc = $('#about_desc').text();  
            var salutation = $('#salutation').text();  
            var address = $('#address').text();  
            var mobile = $('#mobile').text();  
            var email = $('#email').text();  
            if(name == '')  
            {  
                alert("Enter Name");  
                return false;  
            }  
            if(feature_desc == '')  
            {  
                alert("Enter Feature Text");  
                return false;  
            } 
            if(about_desc == '')  
            {  
                alert("Enter Description");  
                return false;  
            } 
            if(salutation == '')  
            {  
                alert("Enter a salutation");  
                return false;  
            } 
            if(address == '')  
            {  
                alert("Enter Address");  
                return false;  
            } 
            if(mobile == '')  
            {  
                alert("Enter Mobile");  
                return false;  
            }
            if(email == '')  
            {  
                alert("Enter Email");  
                return false;  
            }  
            $.ajax({  
                url:"about_details/insert.php",  
                method:"POST",  
                data:{name:name, feature_desc:feature_desc, about_desc:about_desc, salutation: salutation, address: address, mobile:mobile, email: email},  
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
                url:"about_details/edit.php",  
                method:"POST",  
                data:{id:id,text:text,column_name:column_name},  
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
        $(document).on('blur', '.feature_desc', function(){  
            var id = $(this).data("id2");  
            var feature_desc = $(this).text();  
            edit_data(id,feature_desc, "feature_desc");  
        }); 
        $(document).on('blur', '.about_desc', function(){  
            var id = $(this).data("id3");  
            var about_desc = $(this).text();  
            edit_data(id,about_desc, "about_desc");  
        }); 
        $(document).on('blur', '.salutation', function(){  
            var id = $(this).data("id4");  
            var salutation = $(this).text();  
            edit_data(id,salutation, "salutation");  
        }); 
        $(document).on('blur', '.address', function(){  
            var id = $(this).data("id5");  
            var address = $(this).text();  
            edit_data(id,address, "address");  
        }); 
        $(document).on('blur', '.mobile', function(){  
            var id = $(this).data("id6");  
            var mobile = $(this).text();  
            edit_data(id,mobile, "mobile");  
        });
        $(document).on('blur', '.email', function(){  
            var id = $(this).data("id7");  
            var email = $(this).text();  
            edit_data(id,email, "email");  
        });  
    }); 
  </script>

<?php include ('includes/footer.php');?>