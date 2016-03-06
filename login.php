<?php include("head1.php"); ?>
<?php

$email = "";
if (isset($_POST['inputEmail'])) {
  $email = $_POST['inputEmail'];
}

$password = "";
if (isset($_POST['inputPassword'])) {
  $password = $_POST['inputPassword'];
}

if(!empty($email) && !empty($password)) {
    mysql_select_db($database_mbtk, $mbtk);
    $password = crypt($_POST['inputPassword'],$passwordhash);
    $query_user = sprintf("SELECT * FROM user WHERE email = %s AND password = %s", GetSQLValueString($_POST['inputEmail'], "text"),GetSQLValueString($password, "text"));
    $user = mysql_query($query_user, $mbtk) or die(mysql_error());
    $row_user = mysql_fetch_assoc($user);
    $numusers = mysql_num_rows($user);

    if ($numusers == 1) {

        $_SESSION['name'] = $row_user['first_name'];
        $_SESSION['uid'] = $row_user['uid'];
        $_SESSION['logon'] = time();
        $_SESSION['mb'] = crypt(($row_user['uid'].$_SERVER['REMOTE_ADDR'].time()),$salt);
        header( 'Location: index.php' ) ;
    } else {
        $attempts = 1;
    }

}

?>
<?php include("head2.php"); ?>
    <title>Mobile-Ticket</title>
</head>
<body>
<?php include("navbar.php"); ?>
    <!-- Put your page content here! -->
    <div class="container" role="main">
        <div class="row opaque">
            <div class="col-md-12">
                <center>
                    <h1>Sign in to Mobile-Ticket <br /><small>Your hassle-free way of getting tickets by SMS.</small></h1>
                </center>
                <div class="col-md-offset-3 col-md-6">
                    <?php if($attempts > 0) echo "<div class=\"alert alert-danger\" role=\"alert\">The email/password combination you tried does not work.</div>"; ?>
                    <form class="form-horizontal" action="login.php" method="POST">
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <center>
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </center>
                        </div>
                      </div>
                    </form>
                    <a class="btn btn-default" href="logout.php" role="button">Logout</a>
                </div>
                
        </div>
    </div>
<?php include("footer.php"); ?>    

</body>

</html>
