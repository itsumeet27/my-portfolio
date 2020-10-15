<?php 
    include('includes/header.php');
    include('includes/init.php');
?>
    <div class="container"> 
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mt-2">
                <?php
                    if(isset($_GET['id'])){
                        $sql = "SELECT * FROM portfolio WHERE id = ".$_GET['id']."";
                        $result = $db->query($sql);
                        if(mysqli_num_rows($result) > 0){
                                while($portfolio = mysqli_fetch_assoc($result)):
                ?>
                <div class="page-title pb-1 pt-4">
                    <h2 class="py-3"><?=$portfolio['name'];?></h2>        
                </div>
                <div class="portfolio-image">
                    <img src="img/portfolio/<?=$portfolio['image'];?>" style="width: 100%" />
                </div>
                <div class="portfolio-details mt-3">
                    <p><label style="font-weight:600;">Category:&nbsp;</label><?=$portfolio['category'];?></p>
                    <p><label style="font-weight:600;">Technologies:&nbsp;</label><?=$portfolio['technologies'];?></p>
                    <p><label style="font-weight:600;">URL:&nbsp;</label>
                        <?php if($portfolio['url'] != ''): ?>
                        <a href="<?=$portfolio['url'];?>" target="_blank" id="portfolio-url"><?=$portfolio['url'];?></a>
                        <?php endif; ?>
                    </p>
                    <p class="text-justify"><label style="font-weight:600;">About:&nbsp;</label><?=nl2br($portfolio['description']);?></p>
                    <p class="text-justify"><label style="font-weight:600;">Features:&nbsp;</label><br><?=nl2br($portfolio['features']);?></p>
                    <?php if($portfolio['reference'] != ''): ?>
                    <p class="text-justify"><label style="font-weight:600;">References:&nbsp;</label><?=$portfolio['reference'];?></p>
                    <?php endif; ?>
                </div>
                <?php endwhile; } } else { echo "<div class='alert alert-danger'>No data to display</div>"; } ?>
                <!-- Display Comments -->
                <div class="display-comments">
                    <?php
                        $display = "SELECT * FROM comments WHERE approve = 1 AND portfolio_id = ".$_GET['id']."";
                        $runDisplay = $db->query($display);
                        if(mysqli_num_rows($runDisplay) > 0){
                            echo "<h4 class='h4-responsive py-3'>COMMENTS!</h4>";
                            while($rowDisplay = mysqli_fetch_assoc($runDisplay)){
                                ?>
                                <div class="comments-section">
                                    <h6 class="comment-by h6-responsive font-weight-bold"><?=$rowDisplay['name'];?> (<?=$rowDisplay['email'];?>)</h6>
                                    <p class="mt-3"><sup><i class="fas fa-quote-left mr-2" style="font-size: 13px"></i></sup><?=$rowDisplay['comment'];?></p>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
                <!-- Add a Comment -->
                <div class="comments">
                    <h4 class="h4-responsive py-3">LEAVE A REPLY!</h4>
                    <?php
                        if(isset($_POST['save_comment'])){                    
                            $portfolio_id = $_GET['id'];
                            $comment = $_POST['comment'];
                            $name = $_POST['name'];
                            $email = $_POST['email'];

                            $sqlComment = "INSERT INTO comments (portfolio_id,comment,name,email) VALUES ('$portfolio_id','$comment','$name','$email')";
                            $insertComment = $db->query($sqlComment);
                            if($insertComment){
                                echo "<script>alert('Thank you for your comment! Your comment will be approved and displayed soon.')</script>";
                            }
                        }
                    ?>
                    <div class="contact-form">
                        <form name="contact-form" method="post" enctype="multipart/form-data" id="contact-form">

                            <!-- Comment -->
                            <div class="form-outline mb-4">
                                <textarea class="form-control" name="comment" id="comment" rows="4"required></textarea>
                                <label class="form-label" for="comment">Comment</label>
                            </div>

                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="name" name="name" class="form-control" required/>
                                <label class="form-label" for="name">Name</label>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control" required/>
                                <label class="form-label" for="email">Email</label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" name="save_comment" class="btn btn-lg btn-portfolio mb-4">Submit &nbsp;<i class="fas fa-paper-plane"></i></button>
                            <div class="status"></div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include('includes/sidebar.php'); ?>
        </div>
    </div>
<?php include('includes/footer.php'); ?>