<?php
session_start();
if(isset($_SERVER['HTTP_REFERER']))
 {
  
 $page=$_SESSION['recentpage'];
 $start_from=($page-1)*3;
require_once("dbconnection.php");
$sql="select * from TBL_NAME LIMIT $start_from,3";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0)
{
$_SESSION['recentpage']++;
while($row=mysqli_fetch_array($result,MYSQL_ASSOC))
{
$title=$row['Title'];
$author=$row['Author'];
$date=$row['Date'];
$category=$row['Category'];
$link=$row['Link'];
$image=$row['Image'];
echo("
	<div class='card medium hoverable recent'>
            <a class='waves-effect' href='#'><div class='card-image' style='background:url($image); background-size:cover; background-position:center center;'></a>
             <a class='dropdown-button btn right' href='#' data-activates='dropdown-recent$Id'>Share</a>

  <!-- Dropdown Structure -->
  <ul id='dropdown-recent$Id' class='dropdown-content'>
    <li><a target='_blank' href='http://www.facebook.com/sharer/sharer.php?u=$link'>Facebook</a></li>
    <li><a href='https://www.twitter.com/share?url=$link' target='_blank'>Twitter</a></li>
    <li><a href='https://plus.google.com/share?url={$linkenc}'  target='_blank'>GPlus</a>
</li>
  </ul>
            </div>
            <div class='card-content'>
            <p>
            <a><span style='font-size:22px;color:#000;font-weight:bold;' class='card-title'>$title</span></a>
            </p>
            <div style='background:url(pics/$author.jpg);background-size:cover; background-position: center center;' class='team1'></div>
       <a id='author'>$author</a>
       <a id='date'>$date</a>
            </div>
            <div class='card-action'>
              <a style='color:#E65100;' class='waves-effect' href='$link'>Read Now</a>
              <a style='float:right;color:#E65100;' class='waves-effect' href='$category.php'>$category</a>
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