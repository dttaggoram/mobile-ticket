<?php include("head1.php"); ?>
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
                <h1>Welcome to Mobile-Ticket <br /><small>Your hassle-free way of getting tickets by SMS.</small></h1>
                </center>
            </div>
            <div class="col-md-6 col-xs-12">
                <center>
                <h2>Upcoming Events and Gigs</h2>
                </center>
                <?php 
                    include("upcomingevents.php");
                ?>
                <h3>Or Search</h3>
            </div>
            <div class="col-md-6 col-xs-12">
                <center>
                <h2>How it works</h2>
                </center>
                <p>Pretty graphic explaining</p>
            </div>
        </div>
    </div>
<?php include("footer.php"); ?>    

</body>

</html>
