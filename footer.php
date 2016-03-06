    <center>Tagg-Oram Productions Ltd.</center>
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Validator JavaScript -->
    <script src="js/validator.min.js"></script>

    <!-- Moment JavaScript -->
    <script src="js/moment.js"></script>

    <!-- Date Range Picker JavaScript -->
    <script src="js/daterangepicker.js"></script>
    <script>

    $( document ).ready(function() {
        var cw = window.innerHeight - 130;
        $('.opaque').css({'min-height':cw+'px'});

        $('#account').html(<?php echo '"'.$cookie.'"'; ?>);

    })
    </script>