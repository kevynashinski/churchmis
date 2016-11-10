<?php
//include connection
include_once("includes/config.php");
include_once 'includes/db_operations.php';

$id = $_GET['unique'];

//$sql_im = "SELECT * FROM auth WHERE username = '$id'";
//$sql_im_query = mysqli_query($connect,$sql_im);

$row_image = db_operations::getUserByUsername($id);

//if($sql_im_query)
//{
// $row_image = mysqli_fetch_array($sql_im_query);
 $type="Content-type:".$row_image['phototype'];
 header($type);
 echo $row_image['photo'];
//}
//else
//{
//echo "<div class='alert alert-info'>Invalid file</div>";
//}
