<?php
$id=$_GET['id'];
require_once 'mobiledetect/Mobile_Detect.php';
$detect = new Mobile_Detect;
if (!filter_var($id, FILTER_VALIDATE_INT) === false) {
require_once("dbconnection.php");
$sql="select * from TBL_NAME where LId='$id'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0)
{
$row=mysqli_fetch_array($result,MYSQL_ASSOC);
$include=$row['Include'];
$author=$row['Author'];
$date=$row['Date'];
$title=$row['Title'];
$link=$row['Link'];
$like=$row['LikeCount'];
$unlike=$row['UnlikeCount'];
$pageviews=$row['Views'];
$pageviews++;
$sqlv="update TBL_NAME set Views='$pageviews' where LId='$id'";
$resultv=mysqli_query($con,$sqlv);
echo("<title>$title</title>");
include_once("common.htm");

}
else
{
  include_once("error.php");
  die();
}
}
else
{
  include_once("error.php");
  die();
}
?>
<head>
<link rel="stylesheet" href="test.css">
<link rel="stylesheet" href="style.css">
<script>
$(document).ready(function() {
  $(".white").hover(function() {
    $(this).toggleClass("white");
  });
$(".liker").on("click",function() {
 var id='<?php echo md5($id); ?>';
$.ajax ({
url:'like.php',
type:'post',
data:'id='+id,
success:function(data) {
$("#like").html(data);
},
});
});
$(".unlike").on("click",function() {
 var id='<?php echo md5($id); ?>';
$.ajax ({
url:'unlike.php',
type:'post',
data:'id='+id,
success:function(data) {
$("#unlike").html(data);
},
});
});
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};
 $(document).on("click", '.whatsapp', function() {
        if( isMobile.any() ) {

            var text = $(this).attr("data-text");
            var url = $(this).attr("data-link");
            var message = encodeURIComponent(text) + " - " + encodeURIComponent(url);
            var whatsapp_url = "whatsapp://send?text=" + message;
            window.location.href = whatsapp_url;
        } else {
            alert("Please share this article in mobile device");
        }

    });
    });
</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="part2">
<div class="row">
<div class="col s2">
&nbsp;
<table style="position:fixed;width:10%;">
<tbody>
 <tr>
 <td><a class="btn-floating btn-large waves-effect waves-light white " href="#" onClick="MyWindow=window.open('http://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>','MyWindow',width=600,height=300); return false;"><img class="sharebuttons" src='images/Facebook.png'></a></td>
 </tr>
 <tr>
 <td><a class="btn-floating btn-large waves-effect waves-light white" href="#" onClick="MyWindow=window.open('http://www.twitter.com/share?url=<?php echo $link; ?>','MyWindow',width=600,height=300); return false;"><img class="sharebuttons" src='images/Twitter.png'></a></td>
 </tr>
 <tr>
 <td><a class="btn-floating btn-large waves-effect waves-light white" href="#" onClick="MyWindow=window.open('http://www.plus.google.com/share?url={<?php echo urlencode($link); ?>}','MyWindow',width=600,height=300); return false;"><img class="sharebuttons" src='images/Google+.png'></a></td>
 </tr>
<tr>
<td><a data-text="<?php echo('Read this'); ?>" data-link="<?php echo $link; ?>" class="btn-floating btn-large waves-effect waves-light white whatsapp"><img class="sharebuttons" src="images/whatsapp.png"></a>
</td>
</tr>
</tbody>
 </table>
</div>
<div class="col s6 matter">
<div class="row">
<div class="col s12">
<h2 class="entry-title"><?php echo $title; ?></h2>
</div>
</div>
<hr/>
<div class="row" style="font-weight:bold;">
<div class="col s4">
<?php echo $date; ?>
</div>
<div class="col s4">
<i class='material-icons liker'>thumb_up</i><a id='like'><?php echo $like; ?></a>
<i class='material-icons unlike'>thumb_down</i><a id='unlike'><?php echo $unlike; ?></a>
</div>
<div class="col s4">
<div style='background:url(pics/<?php echo $author; ?>.jpg);background-size:cover; background-position: center center;' class='team1'></div><?php echo $author; ?>
</div>
</div>
<div class="row">
<?php include_once($include); ?>
<div style="margin-top:40px;" id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'vectech';
    var disqus_identifier='<?php echo $id; ?>';
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
</div>
</div>
<?php
if ( $detect->isMobile() ) {
echo('<div class="col s1">&nbsp;</div><div style="border-left:solid 1px #000000;" class="col s3 more-reading">');
}
else
{
echo('<div class="col s2">&nbsp;</div>
<div style="border-left:solid 1px #000000;" class="col s2 more-reading">');
}
?>
<h1>More Reading</h1>
       <?php
       require_once("dbconnection.php");
         $sql="select * from TBL_NAME ORDER BY rand() LIMIT 6 ";
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
  <div class='card small hoverable'>
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
 
    ?>
</div>
</div>