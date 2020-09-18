<?php 
	include ('includes/header.php');
	include ('../includes/init.php');
?>

    <div class="container pt-3">
        <h3 class="text-center">List of all contacts</h3>
    </div>
    <div class="table-responsive container-fluid mt-4">
        <table class="table table-sm table-striped table-bordered">
            <thead class="elegant-color white-text">
                <th></th>
                <th style="font-size:13px">Name</th>
                <th style="font-size:13px">Email</th>
                <th style="font-size:13px">Subject</th>
                <th style="font-size:13px">Message</th>
                <th style="font-size:13px">Date</th>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM contact";
                    $result = $db->query($sql);
                    if(mysqli_num_rows($result)){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td>
                        <a href="contact.php?delete=<?=$row['id'];?>" style="font-size:13px;color:#555"><i class="fas fa-trash" title="Delete"></i></a>
                    </td>
                    <td style="font-size:13px"><?=$row['name'];?></td>
                    <td style="font-size:13px"><?=$row['email'];?></td>
                    <td style="font-size:13px"><?=$row['subject'];?></td>
                    <td style="font-size:13px"><?=$row['message'];?></td>
                    <td style="font-size:13px"><?=$row['date'];?></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

<?php include ('includes/footer.php');?>