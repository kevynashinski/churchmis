<?php
//session_start();
//if($_SESSION['uid'] ==""){
//header("location:login.php");
//exit;
//}
include 'includes/connect.php';
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
			<li class="active"><a href="guardians.php">Guardians <span class="badge"><?php echo $sql_mem;?></span></a></li>
			<li><a href="logout.php">Let me out</a></li>
			<li><a href="changepassword.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
        </div><!--/.nav-collapse -->
	</div>

</nav>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<h2 class="page-header" style="text-align:center;">Here are your fellow Guardians of the Galaxy!</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12">
		<?php
		//fetching user details from the database
			$sql_users = "SELECT * FROM users";
			$sql_users_query = mysqli_query($connect, $sql_users);
			if($sql_users_query)
			{
			echo "<table class='table '>

				<thead>
					<th>Pic</th>
					<th>Name</th>
					<th>Gender</th>
					<th>City</th>
					<th>Date Of Birth</th>
				</thead> ";
				while($row = mysqli_fetch_array($sql_users_query)) {
				echo "<tbody>";
					echo"<tr>";
					if($row['phototype'] == "")
					{
					if($row['gender'] == "Male")
					{
					  echo "<td>" ."<img src='users/male.png' class='img-rounded' alt='".$row['uid']."' width='50px' height='50px' >" ."</td>";
					}
					else
					{
					  echo "<td>" ."<img src='users/female.png' class='img-rounded' alt='".$row['uid']."' width='50px' height='50px' >" ."</td>";
					}
					}
					else
					{
					 echo "<td>" ."<img src='imageselect.php?unique=".$row['uid']."' class='img-rounded' alt='".$row['uid']."' width='50px' height='50px' >" ."</td>";
					}

						echo "<td>" .$row['fname'] ." " .$row['sname'] ."</td>";
						echo "<td>" .$row['gender'] ."</td>";
						echo "<td>" .$row['city'] ."</td>";
						echo "<td>" .$row['dob'] ."</td>";
					echo "</tr>";
				echo "</tbody>";

				}
				}
			echo "</table>";
			?>
			<span style="text-align:center;">We have <?php echo $sql_mem;?> Guardians aboard </span>
		</div>
	</div>
</div>

</body>
</html>
