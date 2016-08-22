<?php 
//include connection
include_once("includes/connect.php");
$id = $_GET['unique'];

$sql_im = "SELECT * FROM users WHERE uid = '$id'";
$sql_im_query = mysqli_query($connect,$sql_im);

if($sql_im_query)
{
 $row_image = mysqli_fetch_array($sql_im_query);
 $type="Content-type:".$row_image['phototype'];
 header($type);
 echo $row_image['photo'];
}
else
{
echo "<div class='alert alert-info'>Invalid file</div>";
}
?>