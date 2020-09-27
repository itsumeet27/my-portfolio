<?php 
  include('includes/header.php');
  include('includes/init.php'); 

  $sql = "SELECT * FROM about";
  $result = $db->query($sql);
  while($row = mysqli_fetch_assoc($result)){
    $name = $row['name'];
    $short_desc = $row['feature_desc'];
    $salutation = $row['salutation'];
    $description = $row['about_desc'];
    $address = $row['address'];
    $mobile = $row['mobile'];
    $email = $row['email'];
  } 
?>
    <div class="container-fluid">
        <div class="page-title px-2 pb-1 pt-4">
            <h1 class="p-2">CONTACT <hr></h1>        
        </div>
        <div class="contact px-2">
            <div class="row">
                <div class="contact-form col-md-6 px-4">
                    <h4 class="pb-3">SEND ME YOUR QUERY</h4>
                    <?php
                        if(isset($_POST['submit'])){
                            
                            $username = $_POST['name'];
                            $useremail = $_POST['email'];
                            $subject = $_POST['subject'];
                            $message = $_POST['message'];

                            $sql = "INSERT INTO contact (name,email,subject,message) VALUES ('$username','$useremail','$subject','$message')";
                            $insert = $db->query($sql);$username = $_POST['name'];
                            $useremail = $_POST['email'];
                            $usermessage = $_POST['message'];
                            $usersubject = $_POST['subject'];	
                                    
                            $to = $email;
                            $subject = "Contact Message from $username";
                            
                            $message = "<p style='font-size: 17px'>Greetings for the day,</p>";
                            $message .= "<p>You have a message from $username as follows:</i></p>";
                            $message .= "<p><b>Subject: </b><i><u>$usersubject</u></i></p>";
                            $message .= "<p><b>Message: </b>$usermessage</p>";
                            
                            $header = "From:$useremail \r\n";
                            $header .= "MIME-Version: 1.0\r\n";
                            $header .= "Content-type: text/html\r\n";
                            
                            $retval = mail ($to,$subject,$message,$header);
                            
                            if( $retval == true ) {
                                echo "<div class='alert alert-success'>Thank you for contacting!</div>";
                            }else {
                                echo "<div class='alert alert-danger'>Message could not be sent</div>";
                            }
                        }
                    ?>
                    <form name="contact-form" method="post" enctype="multipart/form-data" id="contact-form">
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="name" name="name" class="form-control" />
                            <label class="form-label" for="name">Name</label>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control" />
                            <label class="form-label" for="email">Email address</label>
                        </div>

                        <!-- Subject input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="subject" name="subject" class="form-control" />
                            <label class="form-label" for="name">Subject</label>
                        </div>

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                            <label class="form-label" for="message">Message</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-portfolio mb-4">Send &nbsp;<i class="fas fa-paper-plane"></i></button>
                        <div class="status"></div>
                    </form>
                </div>
                <div class="contact-details col-md-6 px-4">
                    <h4 class="pb-3">REACH OUT TODAY</h4>
                    <p class="py-2">&nbsp;<i class="fas fa-map-marker-alt fa-2x"></i>&nbsp;&nbsp;&nbsp;<?=$address;?></p>
                    <p class="py-2">&nbsp;<i class="fas fa-mobile-alt fa-2x"></i>&nbsp;&nbsp;&nbsp;<a href="tel:<?=$mobile;?>"><?=$mobile;?></a></p>
                    <p class="py-2"><i class="fas fa-envelope fa-2x"></i>&nbsp;&nbsp;&nbsp;<a href="mailto:<?=$email;?>"><?=$email;?></a></p>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>