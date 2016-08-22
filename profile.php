<?php
//session_start();
//if($_SESSION['uid'] ==""){
//header("location:login.php");
//exit;
//}
include 'includes/config.php';

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
		$city = $row['city'];
		$dob = $row['dob'];
		$photo = $row['photo'];
		$phototype = $row['phototype'];
		} else {
			echo "Howdy, There is an error. Please try again";
		}
		$date = date("d-m-Y", strtotime($dob));
// upload image in form
//set variable to empty
$upload_image = $error = $empty_im = $uploadsuccess="";
if(isset($_POST['upload_profile']))
{
  if(empty($_FILES['upload_image']['tmp_name']))
  {
     $empty_im = "<div class='alert alert-info'>Please browse a photo</div>";
  }
  else
  {
      $upload_image = $_FILES['upload_image']['tmp_name'];
	  $image = addslashes(file_get_contents($upload_image));
	  $imagesize = getimagesize($upload_image);

	  $imgtype = $imagesize['mime'];
      $sql_profile = "UPDATE users SET photo ='$image',phototype = '$imgtype' WHERE uid = '$_SESSION[uid]'";
	  $sql_profile_query = mysqli_query($connect,$sql_profile);

	  if($sql_profile_query)
	  {
	     $uploadsuccess = "<div class='alert alert-info'>Hurray! Profile Pic Update Successful!</div>";
		 //header("Location:profile.php");
		 //exit;
	  }
	  else
	  {
	    $error = "<div class='alert alert-info'>Ooops!Failed to upload image</div>";
	  }
  }
}

		//Updating the database
		$success = $empty = $error = "";
		if(isset($_POST['update']))
		{
			if($_POST['fname'] != "" and $_POST['sname'] != "" and $_POST['email'] != "" and $_POST['gender'] != "" and $_POST['IDNO'] != "" and $_POST['city'] != "" and $_POST['dob'] != "" )
			{
				$fname = test_input($_POST['fname']);
				$sname = test_input($_POST['sname']);
				$email = test_input($_POST['email']);
				$gender = test_input($_POST['gender']);
				$IDNO = test_input($_POST['IDNO']);
				$city = test_input($_POST['city']);
				$dob = test_input($_POST['dob']);
				$sql_update = "UPDATE users SET fname = '$fname',sname='$sname',email = '$email',gender = '$gender',IDNO = '$IDNO',city ='$city',dob = '$dob'  WHERE uid = '$_SESSION[uid]'";
				$sql_update_query = mysqli_query($connect,$sql_update);
				if($sql_update_query)
				{
					$sql_update_posts = "UPDATE posts set fullname = '$fname $sname' WHERE uid = '$_SESSION[uid]'";
					$sql_update_posts_query = mysqli_query($connect,$sql_update_posts);
						$success="<div class='alert alert-info'>Hurray! You have successfully updated your data</div>";
				}
				else
				{
					$error = "<br>Error Updating details<br>".mysqli_error($connect);
				}
			}
			else
			{
				$empty = "<br>Please fill all fields<br>";
			}
		}

		//deleting user

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
            <li><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span> Howdy, <?php echo $fname.'&nbsp;'.$sname?></a></li>
			<li><a href="dashboard.php">Dashboard</a></li>
			<li class="active"><a href="profile.php">My Spaceship</a></li>
			<li><a href="guardians.php">Guardians <span class="badge"><?php echo $sql_mem;?></span></a></li>
			<li><a href="logout.php">Let me out</a></li>
			<li><a href="changepassword.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
        </div><!--/.nav-collapse -->
	</div>

</nav>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-5">
			<h2 class="page-header"> Your Awesome Pic!</h2>
			<?php

				if($phototype == "")
				{
					if($gender == 'Male'){
					?>
					<img src="users/male.png" class="img-rounded" alt="<?php echo $fname.$sname;?>" width="80%" >
					<?php
					} else {
					?>
					<img src="users/female.png" class="img-rounded" alt="<?php echo $fname.$sname;?>" width="80%" >
					<?php
					}
				}
				else
				{
				  ?>
				  <!-- Image from database -->
				  <img src="imageselect.php?unique=<?php echo $uid;?>" class="img-rounded" alt="<?php echo $fname.$sname;?>" width="80%" >
				<?php
				}
				?>
				<form action="" method="post" enctype="multipart/form-data">
				<?php echo $empty_im;?>
				<?php echo $error;?>
				<?php echo $uploadsuccess;?>
				<input type="file" name="upload_image" class="form-control">
				<input class="btn btn-danger" type="submit" name="upload_profile" value="Update Pic">
				</form>
		</div>
		<div class="col-sm-12 col-md-7">
			<h2 class="page-header">Your Awesome Bio!</h2>
			<form role="form"  method="POST">
				<?php echo $success; ?>
				<div class="form-group">
					<input type="text" placeholder="First Name" value="<?php echo $fname ?>" name="fname" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="text" placeholder="SirName" value="<?php echo $sname ?>" name="sname" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="email" placeholder="Email" value="<?php echo $email ?>" name="email" class="form-control" required>
				</div>
				<div class="form-group">
							<select name="gender" class="form-control">
								<option value="<?php if(isset($gender) && $gender == "Male"){echo "Male";}else{ echo "Female";} ?>" class="dob"><?php if(isset($gender) && $gender == "Male"){echo "Male";} else{ echo "Female";}?></option>
								<option value="<?php if(isset($gender) && $gender == "Male"){echo "Female";}else{echo "Male";} ?>" class="dob"><?php if(isset($gender) && $gender == "Female"){echo "Male";} else{echo"Female";}?></option>
							</select>
				</div>
				<div class="form-group">
					<input type="number" placeholder="IDNO" value="<?php echo $IDNO ?>" name="IDNO" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="text" placeholder="City" value="<?php echo $city ?>" name="city" class="form-control" required>
				</div>
				<div class="form-group">
							<label for="dob">Date Of Birth</label> <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>" required>
				</div>
				<a href="delete.php" class="btn btn-danger">Delete Account</a>
				<input type="submit" name="update" class="btn btn-info" value="Update Bio">
			</form>
		</div>
	</div>
</div>

<!--Javascript code for delete popup!-->
<script>
function deleteFunction()
{
var x;
var r=confirm("Are you sure you want to delete your account?");
if (r==true)
  {
	  //Delete user account, destroy session and header to index page
	  //<?php
	  //$sql = "DELETE FROM users WHERE uid = '$_SESSION[uid]'";
	//		$sql_query = mysqli_query($connect,$sql);
	//		if($sql_query)
	//		{
	//			session_destroy();
	//			header("Location: index.php");
	//			exit;
	//		}
	//		else
	//		{
				//echo "Ooops!Failed to delete".mysqli_error($conn);
	//		}

	 // ?>
  //x="You pressed OK!";
  }
else
  {
  x="You pressed Cancel!";
  }
document.getElementById("demo").innerHTML=x;
}
</script>

</body>
</html>
