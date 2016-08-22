<?php
session_start();
if($_SESSION['uid'] ==""){
header("location:login.php");
exit;
}
include 'includes/connect.php';
// set variables to empty
	$email_log = $pass_log = "";
	$email_logErr = $pass_logErr = $error = "";
//fetching user info from the database
$sql_result = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
	$sql_result_query = mysqli_query($connect,$sql_result);
	
	if($sql_result_query) {
		$row = mysqli_fetch_array($sql_result_query);
		$uid = $row['uid'];
		$fname = $row['fname'];
		$sname = $row['sname'];
		$gender = $row['gender'];
		$IDNO = $row['IDNO'];
		$email = $row['email'];
		$pass = $row['pass'];
		$dob = $row['dob'];
		$photo = $row['photo'];
		$phototype = $row['phototype'];
		} else {
			echo "Howdy, There is an error. Please try again";
		}

		
//Delete Account
		if(isset($_POST['delete'])){
			$sql = "DELETE FROM users WHERE uid = '$_SESSION[uid]'";
			$sql_query = mysqli_query($connect,$sql);
				if($sql_query)
				{
				session_destroy();
				header("Location: index.php");
				exit;
				}
				else
				{
						echo "Ooops!Failed to delete".mysqli_error($conn);
				}
						
						
					} 
?>
<html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content= "width=device-width, initial-scale=1">
	<meta name="description" content="classwork, follwoing, chatting, liking">
	<title>MyGalaxy | Social for all</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="shortcut icon" href="images/favicon.png">
</head>
<body class="bgmain">
	<nav class ="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-right" href="index.php"><img src="images/logo.png" alt="Logo"></a>			
		</div>
		<div id="navbar" class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span> Howdy, <?php echo $fname.'&nbsp;'.$sname;?></a></li>	
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="profile.php">My Spaceship</a></li>
			<li><a href="guardians.php">Guardians <span class="badge"><?php echo $sql_mem;?></span></a></li>
			<li><a href="logout.php">Let me out</a></li>
			<li class="active"><a href="changepassword.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
        </div><!--/.nav-collapse -->
	</div>

	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<h3 style="text-align:center">Are you sure that you want to delete your account?</h3>
			</div>
		</div>
		
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="signup">
				<?php echo $error;?>
					<form role="form" method="post">
						<center>
						<p>You won't be able to connect with your friends and access the site if you delete your account. Are You Sure?</p>
						<a href="profile.php" class="btn btn-danger ">No, Cancel</a>
						<button type="submit" name="delete" class="btn btn-success ">Yes, Delete</button>
						</center>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	</div>

</body>
</html>