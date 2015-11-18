<?php
session_start();
$token=$_POST['token'];
if(isset($_SERVER['HTTP_REFERER']))
  {
$page=$_SESSION['newspage'];
$start_from=($page-1)*3;
$_SESSION['newspage']++;
require_once("dbconnection.php");
$sql="select * from TBL_NAME where (Category='TechNews') OR (Category='CurrentAffairs') LIMIT $start_from,3";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0)
{
$_SESSION['newspage']++;
while($row=mysqli_fetch_array($result,MYSQL_ASSOC))
{

$title=$row['Title'];
        $date=$row['Date'];
    $link=$row['Link'];
    $image=$row['Image'];
    $author=$row['Author'];
    $id=$row['LId'];
    $Id=$row['Id'];
echo("<div class='card medium hoverable news'>
            <div class='card-image' style='background:url($image); background-size:cover; background-position:center center;'>
             
                   <a style='background: rgb(0, 0, 0); background: rgba(0, 0, 0, 0.7);height:100%;' class='card-title'>$title</a>
            </div>
            <div class='card-content'>
            <div style='background:url(pics/$author.jpg);background-size:cover; background-position: center center;' class='team1'></div>
       <a id='author'>$author</a>
       
       <a id='date'>$date</a>

            </div>
            <div style='text-align:center;' class='card-action'>
              <a style='color:#E65100;' href='$link'>Read Now</a>
            </div>
          </div>
       ");
}
}
}
else
{
header("location:http://thefrontier.in/default.php");
}
?>