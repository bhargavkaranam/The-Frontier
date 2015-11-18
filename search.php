<?php include 'common.htm'; ?>
<?PHP
function getmicrotime()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
$RESULTS_LIMIT=10;
if(isset($_GET['search_term']))
{
      $search_term = stripslashes($_GET['search_term']);
    if(!isset($first_pos))
    {
        $first_pos = "0";
    }
    $start_search = getmicrotime();

    $sql_query = mysql_query("SELECT * FROM TBL_NAME WHERE MATCH(Title,Author,Category) AGAINST('$search_term')");

    if($results = mysql_num_rows($sql_query) != 0)
            {
                $sql =  "SELECT * FROM TBL_NAME WHERE MATCH(Title,Author,Category) AGAINST('$search_term') LIMIT $first_pos, $RESULTS_LIMIT";
                  $sql_result_query = mysql_query($sql);        
            }
    else
            {
                  $sql = "SELECT * FROM TBL_NAME WHERE (Title LIKE '%".mysql_real_escape_string($search_term)."%' OR Author LIKE '%".$search_term."%' OR Category LIKE '%".$search_term."%') ";
                  $sql_query = mysql_query($sql);
                  $results = mysql_num_rows($sql_query);
                  $sql_result_query = mysql_query("SELECT * FROM TBL_NAME WHERE (Title LIKE '%".mysql_real_escape_string($search_term)."%' OR Author LIKE '%".$search_term."%' OR Category LIKE '%".$search_term."%') LIMIT $first_pos, $RESULTS_LIMIT ");
            }
    $stop_search = getmicrotime();
      //calculating the search time
    $time_search = ($stop_search - $start_search);
}
?>
<?PHP
if($results != 0)
{
?>  
   <div class="row">
   <div class="col s4">&nbsp; </div>
   <div class="col s4">
  You searched for <?php echo "<i><b><font color=#000000>".$search_term."</font></b></i>&nbsp;&nbsp; "; ?>
     We found <b>
    </b>
       <b><?PHP echo $results; ?> results</b>
      
  <div class="row">
  <div class="col s12">
    <form action="" method="GET">
      <input name="search_term" type="text" value="<?PHP echo $search_term; ?>" size="40">
        <input name="search_button" type="submit" value="Search"> 
    </form>
    </div>
    </div>
  <?PHP  
    while($row = mysql_fetch_array($sql_result_query))
    {
      $author=$row['Author'];
      $pic="$author.jpg"
    ?>
<div class="row">
<div class="col s12">
        <div class='card small hoverable news'>
            <div class='card-image' style='background:url(<?php echo $row['Image']; ?>); background-size:cover; background-position:center center;'>
             
                   <a style='background: rgb(0, 0, 0); background: rgba(0, 0, 0, 0.7);height:100%;width:100%;' class='card-title'><?php echo $row['Title']; ?></a>
            </div>
            <div class='card-content'>
            <div style='background:url(pics/<?php echo $pic; ?>);background-size:cover; background-position: center center;' class='team1'></div>
       <a id='author'><?php echo $author; ?></a>
       
       <a id='date'><?php echo $row['Date']; ?></a>

            </div>
            <div style='text-align:center;' class='card-action'>
              <a style='color:#E65100;' href='<?php echo $row["Link"]; ?>'>Read Now</a>
            </div>
          </div>
          </div>
          </div>
  <?PHP
    }
    ?>
    </div>
    </div>
<?PHP
}

elseif($sql_query)
{
?>
<table border="0" cellspacing="2" cellpadding="0">
    <tr>
        <td align="center">No results for   <?PHP echo "<i><b><font color=#000000>".$search_term."</font></b></i> "; ?></td>
    </tr>
    <tr>
        <form action="" method="GET">
        <td colspan="2" align="center">
            <input name="search_term" type="text" value="<?PHP echo $search_term; ?>">
            <input name="search_button" type="submit" value="Search">
        </td>
        </form>
    </tr>
</table>
<?PHP
}
?>
<table width="300" border="0" cellspacing="0" cellpadding="0">
      <?php
      if (!isset($_GET['search_term'])) { ?>
    <tr>
        <form action="" method="GET">
        <td colspan="2" align="center">
            <input name="search_term" type="text" value="<?PHP echo $search_term; ?>">
            <input name="search_button" type="submit" value="Search">
        </td>
        </form>
    </tr>
    <?php
      }
      ?>
  <tr>
    <td align="right">
<?PHP
//displaying the number of pages where the results are sittuated
if($first_pos > 0)
{
  $back=$first_pos-$RESULTS_LIMIT;
  if($back < 0)
  {
    $back = 0;
  }
  echo "<a href='search.php?search_term=".stripslashes($search_term)."&first_pos=$back' ></a>";
}
if($results>$RESULTS_LIMIT)
{
  $sites=intval($results/$RESULTS_LIMIT);
  if($results%$RESULTS_LIMIT)
  {
    $sites++;
  }
}
for ($i=1;$i<=$sites;$i++)
{
  $fwd=($i-1)*$RESULTS_LIMIT;
  if($fwd == $first_pos)
  {
      echo "<a href='search.php?search_term=".stripslashes($search_term)."&first_pos=$fwd '><b>$i</b></a> | ";
  }
  else
  {
      echo "<a href='search.php?search_term=".stripslashes($search_term)."&first_pos=$fwd '>$i</a> | ";  
  }
}
if(isset($first_pos) && $first_pos < $results-$RESULTS_LIMIT)
{
  $fwd=$first_pos+$RESULTS_LIMIT;
  echo "<a href='search.php?search_term=".stripslashes($search_term)."&first_pos=$fwd ' > >></a>";
  $fwd=$results-$RESULTS_LIMIT;
}
?>
    </td>
  </tr>
</table>