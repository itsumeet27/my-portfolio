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
                        <a href="<?=$portfolio['url'];?>" target="_blank"><?=$portfolio['url'];?></a>
                        <?php endif; ?>
                    </p>
                    <p class="text-justify"><label style="font-weight:600;">About:&nbsp;</label><?=$portfolio['description'];?></p>
                    <p class="text-justify"><label style="font-weight:600;">Features:&nbsp;</label><br><?=nl2br($portfolio['features']);?></p>
                    <p class="text-justify"><label style="font-weight:600;">References:&nbsp;</label><?=$portfolio['reference'];?></p>
                </div>
                <?php endwhile; } } else { echo "<div class='alert alert-danger'>No data to display</div>"; } ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-4">

            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>