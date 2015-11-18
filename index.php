
<?php
session_start();
$_SESSION['newspage']=2;
$_SESSION['recentpage']=2;
$_SESSION['popularpage']=2;
$token=md5(rand(1234,9876));
$_SESSION['token']=$token;
?>
<head>
<title>The Frontier</title>
<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<script type="text/javascript">
$(window).load(function() {
		$(".se-pre-con").fadeOut("slow");
	});
  $(document).ready(function() {
    $(".search").hide();
    $(".button-collapse").sideNav();
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

</head>
<body>
<?php include_once("analyticstracking.php") ?>
<div id="fb-root"></div>
<script>(function(d, p, id) {
  var js, fjs = d.getElementsByTagName(p)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(p); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=144512422311701";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="se-pre-con"></div>
<div class="navbar-fixed">
<nav>
  <div style="background-color:#009688;" class="nav-wrapper">
    <a href="index.php" style="font-family:forque;padding:5px;" class="brand-logo"><img src="logo.png" height="55"></a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
    <li><div style="width:300px;" class="search"><form method="get" action="search.php"><input autocomplete="off" name="search_term" type="text" placeholder="Search" required></form></div></li>
    <li><a><i id="search" class="material-icons">search</i></a></li>
    <li><a class="waves-effect" href="news.php">News</a></li>
  <li><a class="waves-effect" href="sci-fi.php">Sci-Fi</a></li>
  <li><a class="waves-effect" href="reviews.php">Reviews</a></li>
  <li><a class="waves-effect" href="gaming.php">Gaming</a></li>
  <li><a class="waves-effect" href="gadgets.php">Gadgets</a></li>
      <li><a class="waves-effect" href="about.php">About Us</a></li>

    </ul>
    <ul class="side-nav" id="mobile-demo">
        <li><a href="news.php">News</a></li>
  <li><a href="sci-fi.php">Sci-Fi</a></li>
  <li><a href="reviews.php">Reviews</a></li>
  <li><a href="gaming">Gaming</a></li>
  <li><a href="gadgets.php">Gadgets</a></li>
      <li><a href="about.php">About Us</a></li>

      </ul>
  </div>
</nav>
</div>
<div style="z-index:1;" class="navbar-fixed">
<nav style="background:#113e42;">
<div class="nav-wrapper">
<div class="row">
<div class="col s3">
<h1 style="color:#757575;font-family:'aileron';line-height: 0%">TRENDING</h1>
</div>
<div class="col s5 center-align">
<h1 style="color:#757575;font-family:'aileron';margin-bottom:10px;line-height: 0%">LATEST</h1>
</div>
<div class="col s4 center-align">
<h1 style="color:#757575;font-family:'aileron';margin-bottom:10px;line-height: 0%">BUZZING</h1>
</div>
</div>
</div>
</nav>
</div>
 <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a style="background:url(favicon.png);background-size:cover; background-position:center center;" class="btn-floating btn-large red">
      
    </a>
    <ul>
      <li><a class="btn-floating red"><i class="material-icons">contact_phone</i></a></li>
     <li> <a href='http://www.facebook.com/TheFrontier.in' style='background:url(resources/fbicon.jpg);background-size:cover;' class="btn-floating yellow darken-1"></a></li>
      <li><a style='background:url(resources/twittericon.jpg);background-size:cover;' class="btn-floating green"></a></li>
      <li><a style='background:url(resources/gplusicon.jpg);background-size:cover;' class="btn-floating blue"></a></li>
    </ul>
  </div>
    <div class="row">

      <div class="col s3" id="technews">
          <?php
       require_once("dbconnection.php");
         $sql="select * from TBL_NAME where (Category='TechNews') OR (Category='CurrentAffairs') ORDER BY Id DESC LIMIT 3";
         $result=mysqli_query($con,$sql);
         $count=mysqli_num_rows($result);
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
             
                   <a style='background: rgb(0, 0, 0); background: rgba(0, 0, 0, 0.7);height:100%;width:100%;' class='card-title'>$title</a>
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
    ?>
 <a style="color:#212121;" class="waves-effect waves-teal btn-flat more" id="newsmore">Load More</a>
         
          </div>
      <div class="col s5" id="recent">
       <?php
       require_once("dbconnection.php");
         $sql="select * from TBL_NAME ORDER BY Id DESC LIMIT 3";
         $result=mysqli_query($con,$sql);
         $count=mysqli_num_rows($result);
         while($row=mysqli_fetch_array($result,MYSQL_ASSOC))
         {
        $title=$row['Title'];
        $author=$row['Author'];
        $date=$row['Date'];
    $category=$row['Category'];
    $link=$row['Link'];
    $image=$row['Image'];
    $id=$row['LId'];
    $Id=$row['Id'];
    $linkenc=urlencode($link);
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
    ?>
<a class="center-align waves-effect waves-teal btn-flat more" id="recentmore">Load More</a>
      </div>
      <div class="col s4">
        <div id="test">
       <?php
       require_once("dbconnection.php");
         $sql="select * from TBL_NAME ORDER BY Views DESC LIMIT 3 ";
         $result=mysqli_query($con,$sql);
         $count=mysqli_num_rows($result);
         while($row=mysqli_fetch_array($result,MYSQL_ASSOC))
         {
        $title=$row['Title'];
        $author=$row['Author'];
        $date=$row['Date'];
    $category=$row['Category'];
    $link=$row['Link'];
    $image=$row['Image'];
    $id=$row['LId'];
    $Id=$row['Id'];
$linkenc=urlencode($link);
    echo("
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
              <a style='color:#E65100;' href='$link'>Read Now</a>
              <a style='float:right;color:#E65100;' href='#'>$category</a>
            </div>
          </div>
       ");
    }
    ?>
    <a class="center-align waves-effect waves-teal btn-flat more" id="popularmore">Load More</a>
      </div>

    </div>
    </div>
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
  </body>
  
  </html>