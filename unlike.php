<?php
if(isset($_SERVER['HTTP_REFERER']))
 {
$id=$_POST['id'];
require_once("dbconnection.php");
$sql="select * from TBL_NAME where Hash='$id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result,MYSQL_ASSOC);
$unlikecount=$row['UnlikeCount'];
$unlikecount++;
$sql1="update TBL_NAME set UnlikeCount='$unlikecount' where Hash='$id'";
$result1=mysqli_query($con,$sql1);
echo($unlikecount);
}
else
{
header("location:http://thefrontier.in/default.php");
}
?>