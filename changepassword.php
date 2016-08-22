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

		
//changing password
	$success = $mismatch = $mismatches = $error = $shortpass="";
	if(isset($_POST['change_pass'])){
		
		$pass = test_input($_POST['pass']);
		$newpass = test_input($_POST['newpass']);
		$newpass2 = test_input($_POST['newpass2']);
		
		$sql_result = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
		$sql_result_query = mysqli_query($connect,$sql_result);
		
		$get_pass = $row['pass'];
		
		if(md5($pass) == $get_pass){
			if(strlen($newpass) > 6){
			if($newpass == $newpass2){
				$sql_update = "UPDATE users SET pass = '".md5($newpass)."' WHERE $uid='$_SESSION[uid]'";
				$sql_update_query = mysqli_query($connect,$sql_update);
				
					if($sql_update_query)
				{
					
						$success="<div class='alert alert-info'>Hurray! You have successfully changed your password</div>";
				}
				else
				{
					$error = "<br>Error Updating your password<br>".mysqli_error($connect);
				}
				
				
			}else {
				$mismatch= "<div class='alert alert-info'>Howdy, Your new password do not match.</div>";
			}
			}else { 
			$shortpass= "<div class='alert alert-info'>New password must be longer than 6 characters</div>";
			}
		}else {
			$mismatches = "<div class='alert alert-info'>Howdy, Your new password missmatches with the current password</div>";
			
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
				<h3 style="text-align:center">Change your password below</h3>
			</div>
		</div>
		
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="signup">
				<?php echo $error;?>
					<form role="form" method="post">
						<?php echo $success; ?>
						<?php echo $mismatch; ?>
						<?php echo $mismatches; ?>
						<?php echo $error; ?>
						<?php echo $shortpass; ?>
						<div class="form-group">
							 <input type="password" placeholder="Current Password" name="pass" class="form-control" >
							 <?php echo $email_logErr;?>
						</div>
						<div class="form-group">
							 <input type="password" placeholder="New Password" name="newpass" class="form-control" >
							 <?php echo $email_logErr;?>
						</div>
						
						<div class="form-group">
							 <input type="password" placeholder="Confirm Password" name="newpass2" class="form-control" >
							 <?php echo $pass_logErr;?>
						</div>
						<a href="dashboard.php" class="btn btn-danger ">Cancel</a>
						<button type="submit" name="change_pass" class="btn btn-success ">Change</button>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	</div>

</body>
</html>