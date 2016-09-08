<?php
/**
 * Created by PhpStorm.
 * User: kevynashinski
 * Date: 1/25/2016
 * Time: 4:41 PM
 */
include_once 'includes/config.php';
include_once 'includes/session.php';

//set the variables to empty
$message="";

if (isset($_POST['submit'])) {

    $fullName = $_POST[FULL_NAME];
    $phoneNumber = $_POST[PHONE_NUMBER];
    $gender = $_POST[GENDER];
    $purposesNumber = $_POST[PURPOSE_NUMBER];
    $purposes = $_POST[PURPOSE];
    $cash = $_POST[CASH];
    $cheque = $_POST[CHEQUE];
    $forex = $_POST[FOREX];

    //save the details to the database
    if (db_operations::addUserRecord($fullName, $phoneNumber, $gender, $purposes, $cash, $cheque, $forex)) {
header('location: add_records.php?inserted');
    } else {
        header('location: add_records.php?failure');
    }
}

if(isset($_GET['inserted'])){
    $message = "<div class='alert alert-info'>Record Successfully Saved!!!.</div>";
} else if(isset($_GET['failure'])){
    $message = "<div class='alert btn-danger'>There was an error while trying to register you. Please try again </div>";
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
                <li class="active"><a href="">Hi <?php echo $_SESSION['username'] ?></a></li>
                <li><a href='dashboard.php'>DashBoard</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                 <li><a href="help.php">Helpinfomation</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>

</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h1 style="text-align:center; font-size:4em;">Welcome to MyGalaxy</h1>
            <h2 style="text-align:center;">Are you feeling bored? want to have some fun with your friends online?<br>
                then definately you are in the right place</h2>
            <h3 style="text-align:center">Enter Record</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="signup">
                    <?php echo $message; ?>
                    <form role="form" method="post">

                        <!--                        Search in the input field-->
                        <div class="form-group">
                            <input id="full_name" type="text" placeholder="Enter full name" name='full_name'
                                   class="form-control" list="fullNameList" required>
                            <datalist id="fullNameList">

                            </datalist>
                        </div>

                        <div class="form-group">
                            <input id="phoneNumber" type="number" placeholder="Phone Number" name="phone_number"
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <select name="gender" class="form-control" title="gender" required="required">
                                <option value="" class="dob">Gender</option>
                                <option value="Male" class="dob">Male</option>
                                <option value="Female" class="dob">Female</option>
                            </select>
                        </div>

                        <div>
                            <select id="purposesNumber" name="purposesNumber" class="form-control"
                                    title="Purposes Number" required="required">
                                <option class="dob" value="">-- Select The Number of Purposes You Want To Enter --
                                </option>
                                <?php
                                for ($i = 1; $i <= 5; $i++)
                                    echo "<option class=\"dob\" value='" . $i . "'>" . $i . "</option>";
                                ?>
                            </select>
                        </div>

                        <br>

                        <fieldset id="populate">

                        </fieldset>

                        <button type="reset" class="btn btn-danger btn-lg">Clear All Fields</button>
                        <button type="submit" name="submit" class="btn btn-success btn-lg">
                            <span class="glyphicon-plus"></span>
                            Save Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/bootstrap.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="js/myScript.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        //if the value within the dropdown box has changed then run this code
        $('#purposesNumber').change(function () {
            //get the number of fields required from the dropdown box
            var count = $('#purposesNumber').val();

            var html = ''; //string variable for html code for fields
            //loop through to add the number of fields specified
            for (var i = 1; i <= count; i++) {
                //concatenate number of fields to a variable
                html +=
                    '<label>Purpose and Payment << <b>' + i + '</b> >> </label> '
                    + '<div class="form-group">'
                    + '<select name="purpose[' + i + ']" class="form-control" title="Purpose" required=\"required\" >'
                    + '<option class="dob" value="purpose">Purpose</option>'
                    + ' <?php
                        $result = db_operations::getPurposes();
                        while ($row = $result->fetch()) {
                            echo "<option value=" . $row[PURPOSE] . " class=\"dob\">" . $row[PURPOSE] . "</option>";
                        }
                        ?> '
                    + '</select>'
                    + '</div>'
                    + '<div class="form-group">'
                    + '<input type="number" placeholder="Cash" name="cash[' + i + ']" class="form-control">'
                    + '</div>'
                    + '<div class="form-group">'
                    + '<input type="number" placeholder="Cheque" name="cheque[' + i + ']" class="form-control">'
                    + '</div>'
                    + '<div class="form-group">'
                    + '<input type="number" placeholder="Forex" name="forex[' + i + ']" class="form-control">'
                    + '</div>';
            }

            //insert this html code into the div with id catList
            $('#populate').html(html);
        });
    });

</script>
