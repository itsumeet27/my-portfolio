<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        include('includes/header.php');
        include ('../includes/init.php');

        if(isset($_GET['delete'])){
            $del_id = $_GET['delete'];
            $del = "DELETE FROM comments WHERE id = '$del_id'";
            $run_del = $db->query($del);
            if($run_del){
                echo "<script>alert('Comment Deleted Successfully')</script>";
                echo "<script>window.location('comments.php','_self')</script>";
            }
        }

        if(isset($_GET['approve'])){
            $app_id = $_GET['approve'];
            $app = "UPDATE comments SET approve = 1 WHERE id = '$app_id'";
            $run_app = $db->query($app);
            if($run_app){
                echo "<script>alert('Comment Approved Successfully')</script>";
                echo "<script>window.location('comments.php','_self')</script>";
            }
        }
?>

    <div class="container pt-3">
        <h3 class="text-center">List of all comments</h3>
    </div>
    <div class="table-responsive container-fluid mt-4">
        <table class="table table-sm table-striped table-bordered">
            <thead class="elegant-color white-text">
                <th></th>
                <th></th>
                <th style="font-size:13px" width="250">Portfolio Name</th>
                <th style="font-size:13px" width="250">Comment By</th>
                <th style="font-size:13px" width="250">Email ID</th>
                <th style="font-size:13px" width="250">Comment</th>
                <th style="font-size:13px" width="250">Approval</th>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT c.id, c.comment, c.name, c.email, c.approve, p.name AS po_name FROM comments c INNER JOIN portfolio p ON c.portfolio_id = p.id";
                    $result = $db->query($sql);
                    if(mysqli_num_rows($result)){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td style="text-align: center">
                        <a href="comments.php?approve=<?=$row['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-check" title="Approve"></i></a>
                    </td>
                    <td style="text-align: center">
                        <a href="comments.php?delete=<?=$row['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-trash" title="Delete"></i></a>
                    </td>
                    <td style="font-size:13px"><?=$row['po_name'];?></td>
                    <td style="font-size:13px"><?=$row['name'];?></td>
                    <td style="font-size:13px"><?=$row['email'];?></td>
                    <td style="font-size:13px"><?=$row['comment'];?></td>
                    <td style="font-size:13px">
                        <?php 
                            if($row['approve'] == 1){
                                echo "<p class='text-success font-weight-bold'>Approved</p>";
                            }else{
                                echo "<p class='text-danger font-weight-bold'>Pending</p>";
                            }
                        ?>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

<?php } include ('includes/footer.php');?>