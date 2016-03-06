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

if (!isset($_SESSION)) {
  session_start();
}

include('auth.php');

if(isset($_SESSION['name']) && (crypt(($_SESSION['uid'].$_SERVER['REMOTE_ADDR'].$_SESSION['logon']),$salt) == $_SESSION['mb'])) {

    mysql_select_db($database_mbtk, $mbtk);
    $query_user = sprintf("SELECT * FROM user WHERE uid = %s", GetSQLValueString($_SESSION['uid'], "int"));
    $user = mysql_query($query_user, $mbtk) or die(mysql_error());
    $row_user = mysql_fetch_assoc($user);

    $cookie = "<p class='navbar-text navbar-right'>Signed in as <a href='login.php' class='navbar-link'>".$_SESSION['name']."</a></p>";
} else {
    $cookie = "<p class='navbar-text navbar-right'><a href='login.php' class='navbar-link'>Sign in</a></p>";
}
    
?>