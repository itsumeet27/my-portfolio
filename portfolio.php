<?php 
    include('includes/header.php');
    include('includes/init.php');
?>
    <div class="container-fluid">
        <div class="page-title px-2 pb-1 pt-4">
            <h1 class="p-2">PORTFOLIO <hr></h1>        
        </div>
        <div class="portfolio-data px-3 pb-4">
            <div class="row">            
                <?php
                    $sql = "SELECT * FROM portfolio";
                    $result = $db->query($sql);
                    if(mysqli_num_rows($result) > 0){
                            while($portfolio = mysqli_fetch_assoc($result)):
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-4">
                    <!-- Card -->
                    <div class="card card-image" style="height: 100%">
                    <!-- Content -->
                        <a href="details.php?id=<?=$portfolio['id'];?>" target="_blank"><img src="img/portfolio/<?=$portfolio['image'];?>" style="width: 100%" /></a>
                        <div class="card-overlay p-4">
                            <a href="details.php?id=<?=$portfolio['id'];?>" target="_blank"><h4 class="card-title pt-2"><?=$portfolio['name'];?></h4></a>
                            <p style="text-align: justify;">
                                <?php 
                                    if(strlen($portfolio['description'])>100){ 
                                      $portfolio['description']=substr($portfolio['description'],0,100).'. . . <a class="font-weight-bold" href="details.php?id='.$portfolio['id'].'" title="'.nl2br($portfolio['description']).'">Read more</a>'; 
                                    }
                                ?>
                                <?=nl2br($portfolio['description']);?>
                            </p>
                            <a class="btn btn-lg btn-contact" href="details.php?id=<?=$portfolio['id'];?>" target="_blank">Details&nbsp;&nbsp;<i class="fas fa-external-link-alt"></i></a>
                            <!-- <?php if($portfolio['url'] != ''): ?>
                            <a class="btn btn-lg btn-contact" href="<?=$portfolio['url'];?>" target="_blank">Visit Website&nbsp;&nbsp;<i class="fas fa-external-link-alt"></i></a>
                            <?php endif; ?> -->
                        </div>
                    </div>
                    <!-- Card -->
                </div>
                <?php endwhile; } else { echo "<div class='alert alert-danger'>No data to display</div>"; } ?>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>