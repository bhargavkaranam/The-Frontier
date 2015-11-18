<?php
session_start();
if(isset($_SERVER['HTTP_REFERER']))
 {
  
 $page=$_SESSION['popularpage'];
 $start_from=($page-1)*3;
require_once("dbconnection.php");
$sql="select * from TBL_NAME LIMIT $start_from,3";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0)
{
$_SESSION['popularpage']++;
while($row=mysqli_fetch_array($result,MYSQL_ASSOC))
{
$title=$row['Title'];
$author=$row['Author'];
$date=$row['Date'];
$category=$row['Category'];
$link=$row['Link'];
$image=$row['Image'];
echo("
	<link rel='stylesheet' href='style.css'>
<script>$(document).ready(function() {
$('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, 
      hover: true, 
      gutter: 0, 
      belowOrigin: false 
    }
  );
});
</script>
<script src='disqus.js'></script>
     <div class='card medium hoverable'>
            <div class='card-image' style='background:url($image); background-size:cover; background-position:center center;'>
             <a class='dropdown-button btn right' href='#' data-activates='dropdown-popular$Id'>Share</a>

  <!-- Dropdown Structure -->
  <ul id='dropdown-popular$Id' class='dropdown-content'>
    <li><a target='_blank' href='http://www.facebook.com/sharer/sharer.php?u=$link'>Facebook</a></li>
    <li><a href='https://www.twitter.com/share?url=$link' target='_blank'>Twitter</a></li>
    <li><a href='https://plus.google.com/share?url={$linkenc}'  target='_blank'>GPlus</a>
</li>
  </ul>
            </div>
            <div class='card-content'>
            <p>
           <a><span style='font-size:18px;color:#000;font-weight:bold;' class='card-title'>$title</span></a>
            </p>
            <div style='background:url(pics/$author.jpg);background-size:cover; background-position: center center;' class='team1'></div>
       <a id='author'>$author</a>
       <a id='date'>$date</a>
            </div>
            <div class='card-action'>
              <a href='$link'>Read Now</a>
              <a style='float:right' href='#'>$category</a>
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