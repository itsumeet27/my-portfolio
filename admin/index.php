<?php include ('includes/header.php'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

  <div class="container pt-3">
    <h3 class="text-center">Index Page</h3>
  </div>
  <div class="container-fluid" style="margin: 2em 0;">
    <h5 class="text-justify py-2">Profile Details&nbsp;&nbsp;<i class="fas fa-info-circle" title="Add/Edit Profile Details"></i> <hr style="width: 75px;border:2px solid #666;border-radius:50%"></h5>
    <span id="result_profile"></span>
    <div id="live_data_profile"></div> 

    <h5 class="text-justify py-2">Social Details&nbsp;&nbsp;<i class="fas fa-info-circle" title="Add/Edit Social Username"></i> <hr style="width: 75px;border:2px solid #666;border-radius:50%"></h5>
    <span id="result_social"></span>
    <div id="live_data_social"></div> 
  </div>

  <script type="text/javascript">
    $(document).ready(function(){  
        function fetch_profile_data()  
        {  
            $.ajax({  
                url:"about_details/select.php",  
                method:"POST",  
                success:function(data){  
                    $('#live_data_profile').html(data);  
                }  
            });  
        }  
        fetch_profile_data();  
        $(document).on('click', '#btn_add_profile', function(){  
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
                data:{name:name, feature_desc:feature_desc, about_desc:about_desc, salutation:salutation, address:address, mobile:mobile, email:email},  
                dataType:"text",  
                success:function(data)  
                {  
                    alert(data);  
                    fetch_profile_data();  
                }  
            })  
        });  
        
      function edit_profile_data(id, text, column_name)  
        {  
            $.ajax({  
                url:"about_details/edit.php",  
                method:"POST",  
                data:{id:id,text:text,column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                    //alert(data);
                    $('#result_profile').html("<div class='alert alert-success'>"+data+"</div>");
                    setTimeout(location.reload.bind(location), 500);
                }  
            });  
        }  
        $(document).on('blur', '.name', function(){  
            var id = $(this).data("id1");  
            var name = $(this).text();  
            edit_profile_data(id, name, "name");  
        });  
        $(document).on('blur', '.feature_desc', function(){  
            var id = $(this).data("id2");  
            var feature_desc = $(this).text();  
            edit_profile_data(id,feature_desc, "feature_desc");  
        }); 
        $(document).on('blur', '.about_desc', function(){  
            var id = $(this).data("id3");  
            var about_desc = $(this).text();  
            edit_profile_data(id,about_desc, "about_desc");  
        }); 
        $(document).on('blur', '.salutation', function(){  
            var id = $(this).data("id4");  
            var salutation = $(this).text();  
            edit_profile_data(id,salutation, "salutation");  
        }); 
        $(document).on('blur', '.address', function(){  
            var id = $(this).data("id5");  
            var address = $(this).text();  
            edit_profile_data(id,address, "address");  
        }); 
        $(document).on('blur', '.mobile', function(){  
            var id = $(this).data("id6");  
            var mobile = $(this).text();  
            edit_profile_data(id,mobile, "mobile");  
        });
        $(document).on('blur', '.email', function(){  
            var id = $(this).data("id7");  
            var email = $(this).text();  
            edit_profile_data(id,email, "email");  
        });  
    }); 
  </script>

  <script type="text/javascript">
    $(document).ready(function(){  
        function fetch_social_data()  
        {  
            $.ajax({  
                url:"social_links/select.php",  
                method:"POST",  
                success:function(data){  
                    $('#live_data_social').html(data);  
                }  
            });  
        }  
        fetch_social_data();  
        $(document).on('click', '#btn_add_social', function(){  
            var facebook = $('#facebook').text();  
            var instagram = $('#instagram').text();  
            var twitter = $('#twitter').text();  
            var linkedin = $('#linkedin').text();  
            var pinterest = $('#pinterest').text();  
            var github = $('#github').text();  
            var behance = $('#behance').text();  
            if(facebook == '')  
            {  
                alert("Enter Facebook Username");  
                return false;  
            }  
            if(instagram == '')  
            {  
                alert("Enter Instagram Username");  
                return false;  
            } 
            if(twitter == '')  
            {  
                alert("Enter Twitter Username");  
                return false;  
            } 
            if(linkedin == '')  
            {  
                alert("Enter Linkedin Username");  
                return false;  
            } 
            if(pinterest == '')  
            {  
                alert("Enter Pinterest Username");  
                return false;  
            } 
            if(github == '')  
            {  
                alert("Enter Github Username");  
                return false;  
            }
            if(behance == '')  
            {  
                alert("Enter Behance Username");  
                return false;  
            }  
            $.ajax({  
                url:"social_links/insert.php",  
                method:"POST",  
                data:{facebook:facebook, instagram:instagram, twitter:twitter, linkedin:linkedin, pinterest:pinterest, github:github, behance:behance},  
                dataType:"text",  
                success:function(data)  
                {  
                    alert(data);  
                    fetch_social_data();  
                }  
            })  
        });  
        
      function edit_social_data(id, text, column_name)  
        {  
            $.ajax({  
                url:"social_links/edit.php",  
                method:"POST",  
                data:{id:id,text:text,column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                    //alert(data);
                    $('#result_social').html("<div class='alert alert-success'>"+data+"</div>");
                    setTimeout(location.reload.bind(location), 500);
                }  
            });  
        }  
        $(document).on('blur', '.facebook', function(){  
            var id = $(this).data("id1");  
            var facebook = $(this).text();  
            edit_social_data(id, facebook, "facebook");  
        });  
        $(document).on('blur', '.instagram', function(){  
            var id = $(this).data("id2");  
            var instagram = $(this).text();  
            edit_social_data(id,instagram, "instagram");  
        }); 
        $(document).on('blur', '.twitter', function(){  
            var id = $(this).data("id3");  
            var twitter = $(this).text();  
            edit_social_data(id,twitter, "twitter");  
        }); 
        $(document).on('blur', '.linkedin', function(){  
            var id = $(this).data("id4");  
            var linkedin = $(this).text();  
            edit_social_data(id,linkedin, "linkedin");  
        }); 
        $(document).on('blur', '.pinterest', function(){  
            var id = $(this).data("id5");  
            var pinterest = $(this).text();  
            edit_social_data(id,pinterest, "pinterest");  
        }); 
        $(document).on('blur', '.github', function(){  
            var id = $(this).data("id6");  
            var github = $(this).text();  
            edit_social_data(id,github, "github");  
        });
        $(document).on('blur', '.behance', function(){  
            var id = $(this).data("id7");  
            var behance = $(this).text();  
            edit_social_data(id,behance, "behance");  
        });  
    }); 
  </script>

<?php include ('includes/footer.php');?>