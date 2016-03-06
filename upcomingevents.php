<?php 
mysql_select_db($database_mbtk, $mbtk);
$query_concert = "SELECT *,DATE_FORMAT(concert_date,'%W, %e %M %Y | %l:%i%p') AS datef FROM concert INNER JOIN organisation ON concert.oid = organisation.oid INNER JOIN venue ON concert.vid = venue.vid INNER JOIN genre ON concert.gid = genre.gid WHERE sale_date < NOW() AND sale_expiry > NOW() ORDER BY concert_date ASC LIMIT 3";
$concert = mysql_query($query_concert, $mbtk) or die(mysql_error());
$row_concert = mysql_fetch_assoc($concert);
$totalRows_concert = mysql_num_rows($concert);

?>
<table class="table table-hover">
<tbody>
<?php   
  do { 
   echo "<tr>";
  echo '<td>
		<a href="booktickets.php?cid='.$row_concert['cid'].'">
		<div style="margin:5px;">
	  <p style="font-size:x-small; color:#B2B2B2; margin-bottom:0px; margin-top:0px;">'.$row_concert['genre'].'</p>
    <h2 style="margin-bottom:3px; margin-top:3px; color:#7A0000; line-height:20px;">'.$row_concert['concert_name'].'</h2>
	  <h2 style="margin-bottom:3px; margin-top:3px;" class="pull-right">'.$row_concert['concert_code'].'</h2>
	  <h4 style="margin-bottom:2px; margin-top:2px;color:#B2B2B2;">'.$row_concert['organisation_name'].'</h4>
	  
	<p style="margin-bottom:1px; margin-top:1px;">'.$row_concert['datef']." | ".$row_concert['venue_name'].'</p>
	</div></a>
	  </td>
      </tr>
	  
	  ';
     } while ($row_concert = mysql_fetch_assoc($concert)); 
?>
</tbody>
</table>