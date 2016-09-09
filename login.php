<?php
    require_once 'includes/config.php';
    session_start();
    // set variables to empty
    $username = $password = "";
    $email_logErr = $pass_logErr = $error = "";

    // validate data before matching the credentials
    if (isset($_POST['submit'])) {
        $username = $_REQUEST[USERNAME];
        $password = $_REQUEST[PASSWORD];

        if (db_operations::login($username, $password)) {

            if($_SESSION[ROLE]=='clerk') {
                //check the priviledges then redirect the user accordingly
                db_operations::redirect('add_records.php');
            }elseif($_SESSION[ROLE]=='superuser'){
                db_operations::redirect('overall_records.php');
            }elseif($_SESSION[ROLE]=='admin'){
//                db_operations::redirect('');
            }else{
                $error = "<div class='alert btn-danger'>Access Denied!</div>";
            }

        } else {
            $error = "<div class='alert btn-danger'>Incorrect login credentials!</div>";
        }

    }
?>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="classwork, follwoing, chatting, liking">
    <title>churchmis </title>
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

        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="login.php">Login</a></li>

                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="news.php">news</a></li>
        </div><!--/.nav-collapse -->
    </div>

</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h1 style="text-align:center; font-size:4em;">Welcome to churchMIS</h1>
            <h2 style="text-align:center;">our aim is to bring together the members of our congregation</h2>
            <h3 style="text-align:center">Please Login Below for new member registration</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="signup">

                    <?php echo $error; ?>

                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <input type="email" placeholder="Email Address" name="username" class="form-control" j
                                   required>
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" class="form-control" required>
                        </div>

                        <div align="right">
                            <button type="submit" name="submit" class="btn btn-success ">
                                <i class="glyphicon glyphicon-log-in"></i>
                                Sign In!</button>
                        </div>

                        <div class="form-group">
                            <br>
                            <p><span class="">Not a member yet?</span> <a href="signup.php" alt="Sign Up">Sign up
                                    here</a></p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
