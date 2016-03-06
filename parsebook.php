<?php require_once('mbtk.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if (!empty($_POST['cid'])) {
  $cid = $_POST['cid'];
}

if (!empty($_POST['phone'])) {
  $phone = "44" . substr(preg_replace('~[^0-9]~','',$_POST['phone']),-10);
}

if (!empty($_POST['numtickets'])) {
  $numtickets = $_POST['numtickets'];
}


//CHECK DATABASE FOR PHONE NUMBER
//3 responses: false (new customer), true (old customer/correct ticket), 'type' (old customer/wrong ticket type)

mysql_select_db($database_mbtk, $mbtk);
$query_phonecheck = sprintf("SELECT ticket_type,COUNT(*) AS phonecorrect FROM user WHERE phone_number = %s", GetSQLValueString($phone, "int"));
$phonecheck = mysql_query($query_phonecheck, $mbtk) or die(mysql_error());
$row_phonecheck = mysql_fetch_assoc($phonecheck);

if ($row_phonecheck['phonecorrect'] == 1) { $phonenumbercheck = true; }
else { $phonenumbercheck = false; }

if ($phonenumbercheck == true) {
	//SEND TICKET PURCHASE CHECK MESSAGE

	mysql_select_db($database_mbtk, $mbtk);
	$ticket_type = strtolower($row_phonecheck['ticket_type']);
	$query_concert = sprintf("SELECT *,concert_name AS search, organisation_name AS organisation, venue_name AS venue, DATE_FORMAT(concert_date,'%%e-%%m-%%Y') AS datesearch, DATE_FORMAT(concert_date,'%%e-%%b-%%y %%l:%%i%%p') AS datef, $ticket_type AS ticket_price FROM concert INNER JOIN organisation ON concert.oid = organisation.oid INNER JOIN venue ON concert.vid = venue.vid INNER JOIN ticket_prices ON concert.tpid = ticket_prices.tpid WHERE concert.cid = %s", GetSQLValueString($cid, "int"));
	$concert = mysql_query($query_concert, $mbtk) or die(mysql_error());
	$row_concert = mysql_fetch_assoc($concert);

    $dateTime = date("g:ia jS F Y",strtotime($row_concert['concert_date']));
	$message = "To buy ".$numtickets." ".$typeticket." ticket(s) to ".$row_concert['concert_name']." at ".$dateTime." reply to this text with: ".$numtickets." ".$row_concert['concert_code'];

	$reply = "<h3>Thanks!</h3><p>We've just sent you a text message. To buy ".$numtickets." ".$typeticket." ticket(s) at £".$row_concert['ticket_price']." each (total £".$numtickets*$row_concert['ticket_price'].") to ".$row_concert['concert_name']." at ".$dateTime." reply to the text with:</p><h3 class='text-center'>".$numtickets." ".$row_concert['concert_code']."</h3>";

	if($row_phonecheck['ticket_type'] == ('Student' || 'Concession' || 'U18')) {
		$reply .= "
		<div class=\"panel panel-danger\">
			<div class=\"panel-heading\">".$row_phonecheck['ticket_type']." ID</div>
			<div class=\"panel-body\">Please note that your must bring ".$row_phonecheck['ticket_type']." identifcation with you to the door.  If you need to change your ticket type <a href='login.php'>click here</a>
  			</div>
		</div>";
	}
}

if ($phonenumbercheck == false) {
	//SEND AUTH CODE TO IDENTIFY PHONE
	$auth = rand(10000,99999);
	$message = "Confirmation code from mobile-ticket: ".$auth;

	$insertConfCode = sprintf("INSERT INTO conf_codes (phone_number,conf_code,ip_address) VALUES (%s, %s, %s)",
					GetSQLValueString($phone, "int"),
					GetSQLValueString($auth, "int"),
				 	GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"));

	$insertConfCodeQuery = mysql_query($insertConfCode, $mbtk) or die(mysql_error());

	$reply = $cid;
}


if (isset($cid) && isset($numtickets) && strlen($phone) == 12) {

	$msisdn = $phone;

	$test = "1";
	$sender = "mobticket";
	$repliable = "0";
	$source_id = "1";
	$url = 'http://www.bulksms.co.uk/eapi/submission/send_sms/2/2.0';
	
	$data = 'username=taggoramprod&password=postman1812&message='.urlencode($message).'&msisdn='.urlencode($msisdn).'&test_always_succeed='.urlencode($test).'&source_id='.urlencode($source_id).'&sender='.$sender.'&repliable='.$repliable;
	
	$response = do_post_request($url, $data);

	$responsechunks = explode("|", $response);
	$status_code = $responsechunks[0];
	$status = $responsechunks[1];
	$sid = $responsechunks[2];
	$batch_id = preg_replace ('/[^0-9]/', '', $sid);

	$insertSMS = sprintf("INSERT INTO send_sms (msisdn,message,source_id,status_code,status_desc,batch_id) VALUES (%s, %s, %s, %s, %s, %s)",
						GetSQLValueString($msisdn, "text"),
						GetSQLValueString($message, "text"),
						GetSQLValueString($source_id, "int"),
						GetSQLValueString($status_code, "int"),
						GetSQLValueString($status, "text"),
					 	GetSQLValueString($batch_id, "int"));
	
	$insertSMSquery = mysql_query($insertSMS, $mbtk) or die(mysql_error());

	if ($status_code == 0) {
		print $reply;
	} else  {
		print "There has been a error with your request.";
	}
}

function do_post_request($url, $data, $optional_headers = 'Content-type:application/x-www-form-urlencoded') {
		$params = array('http'      => array(
			'method'       => 'POST',
			'content'      => $data,
			));
		if ($optional_headers !== null) {
			$params['http']['header'] = $optional_headers;
		}
	
		$ctx = stream_context_create($params);
		$response = @file_get_contents($url, false, $ctx);

		return $response;
	}
 

?>