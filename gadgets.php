<title>Gadgets</title>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
if (!filter_var($page, FILTER_VALIDATE_INT) === false) {

$start_from = ($page-1) * 3; 
require_once("dbconnection.php");
include_once("common.htm");
echo("<script>
$(document).ready(function() {
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

<div class='row'>");
$page=$_GET['page'];
echo("<div id='part2'><h1>Gadgets</h1><hr/>");
$sql1="select * from TBL_NAME where Category='Gadgets'";
$result1=mysqli_query($con,$sql1);
$count=mysqli_num_rows($result1);
if($count!=0)
{
$total=ceil($count/3);
$sql="select * from TBL_NAME where Category='Gadgets' ORDER BY Id DESC LIMIT $start_from,3";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result,MYSQL_ASSOC))
{
 $title=$row['Title'];
 $date=$row['Date'];
 $author=$row['Author'];
 $title=$row['Title'];
 $author=$row['Author'];
 $date=$row['Date'];
 $category=$row['Category'];
 $link=$row['Link'];
 $image=$row['Image'];
$Id=$row['Id'];
$linkenc=urlencode($link);
 echo("<div class='col s4'>
    <div class='card small'>
            <div class='card-image' style='background:url($image); background-size:cover; background-position:center center;'>
            <a style='float:right;' class='dropdown-button btn' href='#' data-activates='dropdown-gadgets$Id'>Share</a>

  <!-- Dropdown Structure -->
  <ul id='dropdown-gadgets$Id' class='dropdown-content'>
    <li><a target='_blank' href='http://www.facebook.com/sharer/sharer.php?u=$link'>Facebook</a></li>
    <li><a href='https://www.twitter.com/share?url=$link' target='_blank'>Twitter</a></li>
    <li><a href='https://plus.google.com/share?url={$linkenc}'  target='_blank'>GPlus</a>
</li>

  </ul>
            </div>
            <div class='card-content'>
            <p>
            <span style='font-size:18px;color:#000;font-weight:bold;' class='card-title'>$title</span>
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
            </div> ");
}
echo("<ul class='pagination'>");
for ($i=1; $i<=$total; $i++) { 
            echo "<li class='waves-effect'><a href='gadgets.php?page=".$i."'>".$i."</a><li>"; 
};
echo("</ul></div>");
}
else
{
  echo("<h1>Nothing to display right now.</h1></div>");
}
}
else
{
  include_once("error.php");
echo("</div>");
  die();
} 
?>
<footer style="background:#000000;" class="page-footer">
          <div class="container">
          <div class="row">
          <div class="col s4">
<a href="default.php" style="font-family:forque;font-size:22px;">The Frontier</a>
<div class="fb-page" data-href="https://www.facebook.com/TheFrontier.in" data-width="250" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/TheFrontier.in"><a href="https://www.facebook.com/TheFrontier.in">VecTech</a></blockquote></div></div>
          </div>
          
          <div class="col s2">
          <h3 style="color:#FFFFFF;margin:0;font-size:25px;float:left;">Categories</h3>
          <div class="left">
          <a href="news.php" style="font-size:18">News</a>
          <br/><a href="gadgets.php" style="font-size:18">Gadgets</a>
          <br/><a href="sci-fi.php" style="font-size:18">Sci-Fi</a>
          <br/><a href="gaming.php" style="font-size:18">Gaming</a>
          <br/><a href="reviews.php" style="font-size:18">Reviews</a>
          </div>
          </div>
          <div class="col s2">
          <h3 style="color:#FFFFFF;margin:0;font-size:25px;float:left;">Other Stuff</h3>
          <div class="left">
          <a href="about.php" style="font-size:18">About Us</a>
          <br/><a style="font-size:18">Advertise</a>
          <br/><a href="about.php#contact" style="font-size:18">Contact Us</a>
          </div>
          </div>
          <div class="col s2">
          <h3 style="color:#FFFFFF;margin:0;font-size:25px;float:left;">Connect</h3>
          <div class="left">
          <img style="margin-right:10px;" src='images/footer/Facebook.png' height="20"><a href='http://www.facebook.com/TheFrontier.in' style="font-size:18">Facebook</a>
          <br/> <img style="margin-right:10px;" src='images/footer/Twitter.png' height="20"><a style="font-size:18px;">Twitter</a>
          <br/> <img style="margin-right:10px;" src='images/footer/Flipboard.png' height="20"><a style="font-size:18px;">Flipboard</a>
          </div>
          </div>
          <div class="col s2">
           <h3 style="color:#FFFFFF;margin:0;font-size:25px;float:left;">Subscribe</h3>
          <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
          
    <br>
    <button class="btn waves-effect waves-light subscribe" type="submit" name="action">Subscribe
    <i class="material-icons">send</i>
  </button>
  </br>
        </div>

      </div>
          </div>
          </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            &#169; 2015 VecTech
            <a class="grey-text text-lighten-4 right" href="#!">
            </a>
            </div>
          </div>
        </footer>