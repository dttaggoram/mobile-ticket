<?php include("head1.php"); ?>
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
                <h2>Register for Mobile-Ticket</h2>
                <div class="row">
                <form class="form-horizontal" id="registrationForm"  data-toggle="validator" role="form">
                    <div class="col-md-6">
                        <p>To be able to use Mobile-Ticket we just need a few details off you first. Once we have these, you will be redirected to our secure payment partner who holds all those tricky card details for us.</p>
                          <div class="form-group has-feedback">
                            <label for="firstName" class="col-sm-3 control-label">Firstname</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="firstName" data-error="Everyone has a name." placeholder="Firstname" required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                          </div>
                          <div class="form-group has-feedback">
                            <label for="surname" class="col-sm-3 control-label">Surname</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="surname" data-error="Even Gandalf has a surname." placeholder="Surname" required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                          </div>
                          <div class="form-group has-feedback">
                            <label for="address1" class="col-sm-3 control-label">Address 1</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="address1" data-error="I.e., where do you live?" placeholder="Address line 1" required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="address2" class="col-sm-3 control-label">Address 2</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="address2" placeholder="Address line 2">
                            </div>
                          </div>
                          <div class="form-group has-feedback">
                            <label for="town" class="col-sm-3 control-label">Town/City</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="town" data-error="Thee Midniters - The Town I Live In" placeholder="Town/City" required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                          </div>
                          <div class="form-group has-feedback">
                            <label for="postcode" class="col-sm-3 control-label">Postcode</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="postcode" data-minlength="6" placeholder="Postcode" data-error="Liverpool was the first provincial town to be divided into postal districts in 1864." required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="dob" class="col-sm-3 control-label">Date of Birth</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control " name="dob" id="dob" placeholder="01/01/1990" data-error="Combine your birthday with the year you were born - da da!" required>
                            </div>
                          </div>   
                    </div>
                    <div class="col-md-6 form-horizontal">                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                              <p class="form-control-static">Bit of blurp about having sent a text message</p>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="code" class="col-sm-3 control-label">Confirmation code</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="code" data-minlength="5" placeholder="5 digit code" data-error="It came wizzing over to your via SMS..." required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" placeholder="Email" data-error="Come on now - a real email address please." required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" data-minlength="6" placeholder="Password" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block">Minimum of 6 characters</span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="inputPassword" class="col-sm-3 control-label">Password confirmation</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" id="passwordConfirm" data-match="#password" data-error="Invalid passwords" data-match-error="Whoops, these don't match" placeholder="Confirm password" required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                              <p class="form-control-static">Another bit of blurb about choosing the right ticket type.</p>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="ticketType" class="col-sm-3 control-label">Ticket type</label>
                            <div class="col-sm-9">
                            <label class="radio-inline">
                              <input type="radio" name="ticketType" id="inlineRadio1" value="adult" required> Adult
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="ticketType" id="inlineRadio2" value="conc"> Concession
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="ticketType" id="inlineRadio3" value="student"> Student
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="ticketType" id="inlineRadio4" value="u18"> Under 18 years
                            </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                              <p class="form-control-static">Terms and conditions blurb.</p>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                            <input type="checkbox" value="yes" id="terms" data-error="Sorry - but you have to agree to the terms and conditions to register for mobile-ticket" required>
                            Yes - I agree to mobile-ticket's terms and conditions.
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
    </div>

<?php include("footer.php"); ?>
 
<script type="text/javascript">
$(function() {
    $('input[name="dob"]').daterangepicker({
        minDate: "01/01/1900",
        startDate: "01/01/1990",
        maxDate: "01/01/2001",
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        locale: {
            format: 'DD/MM/YYYY'
        },
    });
});
</script>    
 <script>

    $('#registrationForm').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
        } else {
      e.preventDefault()
      $("#submitbutton").hide();
      $("#loading").show();

        var $form = $('#registrationForm'),
        firstname = $form.find( "input[id='firstName']" ).val(),
        surname = $form.find( "input[id='surname']" ).val(),
        address1 = $form.find( "input[id='address1']" ).val(),
        address2 = $form.find( "input[id='address2']" ).val(),
        town = $form.find( "input[id='town']" ).val(),
        postcode = $form.find( "input[id='postcode']" ).val(),
        dob = $form.find( "input[id='dob']" ).val(),
        code = $form.find( "input[id='code']" ).val(),
        email = $form.find( "input[id='email']" ).val(),
        password = $form.find( "input[id='password']" ).val(),
        type = $form.find( "input:radio[name='ticketType']:checked" ).val(),
        terms = $form.find( "input:checkbox[id='terms']:checked" ).val(),
        cid = <?php echo $_GET['cid'];?>;
     
        // Send the data using post
        $.post(
            'parseregister.php',
            { firstname: firstname, surname: surname, address1: address1, address2: address2, town: town, postcode: postcode, dob: dob, code: code, email: email, password: password, type: type, terms: terms, cid: cid },
            function(result,status){
                if (status == "success") {
                    alert(result)
                    window.location = "mockbank.php?uid="+result;  
                }
            }
        )
        }
    });


    </script>
</body>

</html>
