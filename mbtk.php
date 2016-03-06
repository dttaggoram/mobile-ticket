<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_mbtk = "localhost";
$database_mbtk = "mobileticket";
$username_mbtk = "mbweb";
$password_mbtk = "sh0rtm3ssage";
/*
$hostname_mbtk = "cust-mysql-123-04";
$database_mbtk = "mobileticketcouk_707102_db1";
$username_mbtk = "umob_707102_0001";
$password_mbtk = "2obfk&2i0(&";*/
$mbtk = mysql_pconnect($hostname_mbtk, $username_mbtk, $password_mbtk) or trigger_error(mysql_error(),E_USER_ERROR); 
?>