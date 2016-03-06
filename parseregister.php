<?php require_once('mbtk.php'); ?>
<?php require_once('auth.php'); ?>
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

$cid = "-1";
if (isset($_POST['cid'])) {
  $cid = $_POST['cid'];
}

$dob = "-1";
if (isset($_POST['dob'])) {
  $dob = substr($_POST['dob'],-4)."-".substr($_POST['dob'],3,2)."-".substr($_POST['dob'],0,2);
}

$password = "-1";
if (isset($_POST['password'])) {
  $password = crypt($_POST['password'],$passwordhash);
}

mysql_select_db($database_mbtk, $mbtk);
$query_phone = sprintf("SELECT phone_number FROM conf_codes WHERE conf_code = %s AND ip_address = %s AND timestamp > DATE_SUB(NOW(), INTERVAL 15 MINUTE)", GetSQLValueString($_POST['code'], "int"),GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"));
$phone = mysql_query($query_phone, $mbtk) or die(mysql_error());
$row_phone = mysql_fetch_assoc($phone);


  $insertUser = sprintf("INSERT INTO user (first_name,last_name,phone_number,password,email,dob,address1,address2,town,postcode,ticket_type,terms) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
            GetSQLValueString($_POST['firstname'], "text"),
            GetSQLValueString($_POST['surname'], "text"),
            GetSQLValueString($row_phone['phone_number'], "int"),
            GetSQLValueString($password, "text"),
            GetSQLValueString($_POST['email'], "text"),
            GetSQLValueString($dob, "text"),
            GetSQLValueString($_POST['address1'], "text"),
            GetSQLValueString($_POST['address2'], "text"),
            GetSQLValueString($_POST['town'], "text"),
            GetSQLValueString($_POST['postcode'], "text"),
            GetSQLValueString($_POST['type'], "text"),
            GetSQLValueString($_POST['terms'], "int"));
  
  $insertUserQuery = mysql_query($insertUser, $mbtk) or die(mysql_error());

  $uid = mysql_insert_id();

  echo $uid;
?>