<?php 
	include ('../includes/init.php');

	session_start();
	$sql = "SELECT * FROM about";
	$result = $db->query($sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
		  $id = $row['id'];
		  $name = $row['name'];
		  $short_desc = $row['feature_desc'];
		  $salutation = $row['salutation'];
		  $description = $row['about_desc'];
		  $address = $row['address'];
		  $mobile = $row['mobile'];
		  $email = $row['email'];
		  $image = $row['image'];
		}
	}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="<?=$description;?>">
    <title>Admin Login | <?=$name;?> - <?=$short_desc;?></title>
    <!-- Site Icon -->
    <?php if($image != ''): ?>
    <link rel="icon" href="../img/<?=$image;?>" type="image/x-icon">
    <?php else: ?>
    <link rel="icon" href="../img/profile.webp" type="image/x-icon">
    <?php endif; ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <!-- Custom styles -->
    <style type="text/css">
    	
    </style>
  </head>
  <body>
  	<div class="background" style="background: url('../img/banner.jpg');background-size:cover;background-repeat: no-repeat;padding:7em 0">
  	<div class="container py-5">
  		<div class="row py-5">
  			<div class="col-md-4"></div>
  			<div class="col-md-4">
  				<div class="card">
  					<form class="form" method="post" action="">
	  					<div class="card-header text-center">
	  						<div class="card-title p-3 m-0">
	  							<h5 class="h5-responsive text-center m-0">ADMIN PANEL</h5>
	  						</div>
	  					</div>
	  					<div class="card-body">
	  						<!-- Email input -->
  							<div class="form-outline mb-4">
  								<label for="username" class="mb-2">Username</label>
							    <input type="username" id="username" name="username" class="form-control" style="background: #f4f4f4" />							    
							</div>

							  <!-- Password input -->
							<div class="form-outline mb-4">
								<label for="password" class="mb-2">Password</label>
							    <input type="password" id="password" name="password" class="form-control" style="background: #f4f4f4" />							    
							</div>
	  					</div>
	  					<div class="card-footer">
	  						<button type="submit" name="login" style="padding:1em 0;" class="btn btn-primary btn-block mt-2">Sign in</button>
	  					</div>
	  				</form>
	  				<?php 
						if(isset($_POST['login'])){
							if(empty($_POST['username']) || empty($_POST['password'])){
								echo "<script>window.open('login.php','_self')</script>";
							}else{
								$query = "SELECT * FROM admin WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'";
								$run = mysqli_query($db, $query);
								if($row_admin = mysqli_fetch_assoc($run)){
									$_SESSION['username'] = $_POST['username'];
									$_SESSION['admin_id'] = $row_admin['id'];
									echo "<script>window.open('index.php','_self')</script>";
								}else{
									echo "<script>alert('Invalid email or password, please try again!');</script>";
								}
							}
						}

					?>
  				</div>
  			</div>
  			<div class="col-md-4"></div>
  		</div>
  	</div>
  </body>
</html>


