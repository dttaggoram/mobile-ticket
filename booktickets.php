<?php include("head1.php"); ?>
<?php 

$cid = "-1";
if (isset($_GET['cid'])) {
  $cid = $_GET['cid'];
}

$numtickets = "-1";
if (isset($_GET['numtickets'])) {
  $numtickets = $_GET['numtickets'];
}

mysql_select_db($database_mbtk, $mbtk);
$query_concert = sprintf("SELECT * FROM concert INNER JOIN organisation ON concert.oid = organisation.oid INNER JOIN venue ON concert.vid = venue.vid WHERE concert.cid = %s", GetSQLValueString($cid, "int"));
$concert = mysql_query($query_concert, $mbtk) or die(mysql_error());
$row_concert = mysql_fetch_assoc($concert);

$query_ticketprices = sprintf("SELECT adult,conc,student,u18 FROM concert INNER JOIN ticket_prices ON concert.tpid = ticket_prices.tpid WHERE concert.cid = %s", GetSQLValueString($cid, "int"));
$ticketprices = mysql_query($query_ticketprices, $mbtk) or die(mysql_error());
$row_ticketprices = mysql_fetch_assoc($ticketprices);


if ($numtickets > 0) {
    $dateTime = date("g:ia jS F Y",strtotime($row_concert['concert_date']));

    $reply = "<h3>Thanks!</h3><p>We've just sent you a text message. To buy ".$numtickets." ".$typeticket." ticket(s) at £".$row_concert['ticket_price']." each (total £".$numtickets*$row_concert['ticket_price'].") to ".$row_concert['concert_name']." at ".$dateTime." reply to the text with:</p><h3 class='text-center'>".$numtickets." ".$row_concert['concert_code']."</h3>";
}


?>
<?php include("head2.php"); ?>
    <title>Mobile-Ticket - Book Tickets</title>
</head>
<body>
<?php include("navbar.php"); ?>
    <div class="container" role="main">
        <div class="row opaque">
            <div class="col-md-12">
                <center>
                <h1>Book Tickets</h1>
                </center>
            </div>
            <div id="details" class="col-md-6 col-xs-12">
                <h2><span style="color:#7A0000;"><?php echo $row_concert['concert_name'];?></span></h2>
                <h4> <?php echo $row_concert['organisation_name'];?></h4>  
                <p> <?php echo date("g:ia jS F Y",strtotime($row_concert['concert_date']))." | ".$row_concert['venue_name'];?></p>
                <p> <?php echo nl2br($row_concert['description']) ?></p>
                <h2 class="text-center"><small>Text code:</small><?php echo $row_concert['concert_code'];?></h2>
            </div>
            <div id="booking" class="col-md-6 col-xs-12">
                <form class="form-horizontal" data-toggle="validator" role="form" id="ticketForm">
                  <div class="form-group">
                  <h1></h1>
                    <label for="ticketTypeOptions" class="col-sm-4 control-label">Ticket Prices</label>
                    <div class="col-sm-8">
                        <p class="form-control-static">
                            <span id="adultticket"><?php if($row_ticketprices['adult']) echo "Adult: £".$row_ticketprices['adult']."<br />" ?></span>
                            <span id="concticket"><?php if($row_ticketprices['conc']) echo "Concession: £".$row_ticketprices['conc']."<br />" ?></span>
                            <span id="studentticket"><?php if($row_ticketprices['student']) echo "Student: £".$row_ticketprices['student']."<br />" ?></span>
                            <span id="u18ticket"><?php if($row_ticketprices['u18']) echo "Adult: £".$row_ticketprices['u18']."<br />" ?></span>
                        </p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="numberTicketOptions" class="col-sm-4 control-label">Number of tickets</label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                          <input type="radio" name="numberTicketOptions" id="numberTicket1" value="1" data-error="Please select the number of tickets." required> 1
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="numberTicketOptions" id="numberTicket2" value="2" required> 2
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="numberTicketOptions" id="numberTicket3" value="3" required> 3
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="numberTicketOptions" id="numberTicket4" value="4" required> 4
                        </label>
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="inputPhone" class="col-sm-4 control-label">Phone Number</label>
                    <div class="col-sm-8">
                      <input type="tel" class="form-control" id="inputPhone" placeholder="Phone Number" data-error="The phone number you've entered is invalid" pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" required>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                    <div id="submitbutton" class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                    <p id="loading" class="text-center" style="display:none">Loading...</p>
                  </div>
                </form>
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>    
    <script>

    $('#ticketForm').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
        } else {
      e.preventDefault()
      $("#submitbutton").hide();
      $("#loading").show();
      $('#inputPhone').prop('readonly', true);
      $("[id^=numberTicket]").prop('disabled', true);

        var $form = $('#ticketForm'),
        phone = $form.find( "input[id='inputPhone']" ).val(),
        numtickets = $form.find( "input:radio[name='numberTicketOptions']:checked" ).val(),
        cid = <?php echo $_GET['cid'];?>;
     
        // Send the data using post
        $.post(
            'parsebook.php',
            { phone: phone, numtickets: numtickets, cid: cid },
            function(result,status){
                if (status == "success") {
                    console.log(result)
                    if (result > 0) {
                        window.location = "register.php?cid="+result;  
                    }
                    else $('#ticketForm').empty().html(result);
                }
            }
        )
        }
    });


    </script>
    <script>
    //$("#booking").css("margin-top",(window.innerHeight - 250 - $("#booking").innerHeight())/2)
    </script>
</body>

</html>
