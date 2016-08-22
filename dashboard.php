<?php
include_once 'includes/config.php';
    session_start();
    if ($_SESSION[USERNAME] == "") {
        header("location:login.php");
        exit;
    }
    $result=db_operations::getUserByUsername($_SESSION[USERNAME]);

    $surname=$otherName=$gender=$email=$photo=$phototype=$userId="";

    if ($result!=null) {
//        $row = mysqli_fetch_array($sql_result_query);
        $userId = $result[USERNAME];
        $surname = $result[SURNAME];
        $otherName = $result[OTHER_NAME];
        $gender = $result[GENDER];
        $id_number = $result[ID_NUMBER];
        $email = $result[EMAIL];

        $photo = $result['photo'];
        $phototype = $result['phototype'];
    } else {
        echo "Howdy, There is an error. Please try again";
    }

    // upload image in form
    //set variable to empty
    $upload_image = $error = $empty_im = "";
    if (isset($_POST['upload_profile'])) {
        if (empty($_FILES['upload_image']['tmp_name'])) {
            $empty_im = "<div class='alert alert-info'>Please browse a photo</div>";
        } else {
            $upload_image = $_FILES['upload_image']['tmp_name'];
            $image = addslashes(file_get_contents($upload_image));
            $imagesize = getimagesize($upload_image);

            $imgtype = $imagesize['mime'];
            $sql_profile = "UPDATE users SET photo ='$image',phototype = '$imgtype' WHERE uid = '$_SESSION[uid]'";
            $sql_profile_query = mysqli_query($connect, $sql_profile);

            if ($sql_profile_query) {
                header("Location:dashboard.php");
                exit;
            } else {
                $error = "<div class='alert alert-info'>Ooops!Failed to upload image</div>";
            }
        }
    }

?>

<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="classwork, follwoing, chatting, liking">
    <title>MyGalaxy | Social for all</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="shortcut icon" href="images/favicon.png">
</head>
<body class="bgmain">

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-right" href="index.php"><img src="images/logo.png" alt="Logo"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span>
                        Welcome, <?php echo $surname . '&nbsp;' . $otherName; ?></a></li>
                <li class="active"><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profile.php">My Spaceship</a></li>
<!--                <li><a href="guardians.php">Guardians <span class="badge">--><?php //echo $sql_mem; ?><!--</span></a></li>-->
                <li><a href="logout.php">Let me out</a></li>
                <li><a href="changepassword.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
        </div><!--/.nav-collapse -->
    </div>

</nav>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-7" align="center">
            <h2 class="page-header"> Me in a glance! </h2>
            <?php

                //Select image from database
                if ($phototype == "") {
                    if ($gender == 'Male') {
                        ?>
                        <img src="users/male.png" class="img-rounded" alt="<?php echo $surname . $otherName; ?>" width="80%">
                        <?php
                    } else {
                        ?>
                        <img src="users/female.png" class="img-rounded" alt="<?php echo $surname . $otherName; ?>" width="80%">
                        <?php
                    }
                } else {
                    ?>
                    <!-- Image from database -->
                    <img src="imageselect.php?unique=<?php echo $userId; ?>" class="img-rounded"
                         alt="<?php echo $surname . $otherName; ?>" width="80%">
                    <?php
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <?php echo $empty_im; ?>
                <?php echo $error; ?>
                <input type="file" name="upload_image" class="form-control">
                <input class="btn btn-danger" type="submit" name="upload_profile" value="Upload">
            </form>

            <h4>Name: <?php echo $surname . '&nbsp;' . $otherName; ?> </h4>
            <h4>Email: <?php echo $email; ?> </h4>
            <h4>Gender: <?php echo $gender ?> </h4>
            <a href="profile.php" class="btn btn-info">View Profile</a>
        </div>
    </div>
</div>

</body>
</html>

<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/bootstrap.js"></script>
