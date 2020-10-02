<?php include('init.php'); ?>    
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 px-3 my-4">
        <div class="portfolio-list-items card pb-4">
            <div class="page-title pb-1 pt-4">
                <h3 class="pt-3 pl-4">Recently Added Portfolio</h3>        
            </div>
            <ul type="none" style="list-style-type: none;" class="mb-2 mb-lg-0 pl-4">
            <?php
                $sql_list = "SELECT * FROM portfolio ORDER BY id DESC";
                $result_list = $db->query($sql_list);
                if(mysqli_num_rows($result_list)>0){
                    while ($row = mysqli_fetch_assoc($result_list)) {
                        ?>
                        <li class="nav-item portfolio-list">
                            <a class="nav-link px-0" href="details.php?id=<?=$row['id'];?>"><?=$row['name'];?></a>
                        </li>
                        <?php
                    }
                }
            ?>
            </ul>
        </div>
    </div>