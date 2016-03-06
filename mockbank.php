<?php include("head1.php"); ?>
<?php 
mysql_select_db($database_mbtk, $mbtk);

$query_user = sprintf("SELECT * FROM user WHERE uid = %s", GetSQLValueString($_GET['uid'], "int"));

$user = mysql_query($query_user, $mbtk) or die(mysql_error());

$row_user = mysql_fetch_assoc($user);

?>
<?php include("head2.php"); ?>
    <title>Mobile-Ticket - Book Tickets</title>
    <style>

</style>
</head>
<body>
<?php include("navbar.php"); ?>
    <div class="container" role="main">
        <div class="row opaque">
            <div class="col-md-12">
                <h2>Mock Bank Registration Page</h2>
                <h4>Hi <?php echo $row_user['first_name']." ".$row_user['last_name'];?></p>
                <p>In real life at this point there would be a few financial details to put in with a bank</p>
                <p>But for now just press Next</p>
                <a class="btn btn-default" href="#" role="button">Next</a>
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>
   

</body>

</html>
