$(window).load(function(){$(".se-pre-con").fadeOut("slow")}),$(document).ready(function(){$("#helper").hide(),$(".search").hide(),$(".button-collapse").sideNav(),$(".dropdown-button").dropdown({inDuration:300,outDuration:225,constrain_width:!1,hover:!0,gutter:0,belowOrigin:!1}),$("#search").on("click",function(){$(".search").toggle(800)}),$(".fixed-action-btn").hover(function(){$("#helper").toggle()}),$("#search-field").hide(),$("body").on("click",".more",function(e){var t=$(this).attr("id");$(this).hide();"recentmore"==t&&$.ajax({url:"getarticles.php",type:"post",success:function(e){var n=$("#recent").html();n+=e,$("#recent").html(n),$("#"+t).insertAfter($(".recent:last-child")),$("#"+t).fadeIn()},error:function(e){alert("sfd")}}),"popularmore"==t&&$.ajax({url:"getpopular.php",type:"post",success:function(e){var n=$("#test").html();n+=e,$("#test").html(n),$("#"+t).insertAfter($(".recent:last-child")),$("#"+t).fadeIn()},error:function(e){alert("sfd")}}),"newsmore"==t&&$.ajax({url:"getnews.php",type:"post",success:function(e){var n=$("#technews").html();n+=e,$("#technews").html(n),$("#"+t).insertAfter($(".news:last-child")),$("#"+t).fadeIn()}})}),$("#search").click(function(){$("#search-field").toggle(600)})});