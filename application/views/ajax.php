<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL::base(); ?>files/css/app.css">
    <link rel="stylesheet" href="<?php echo URL::base(); ?>files/datepicker/css/bootstrap-datepicker3.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo URL::base(); ?>files/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo URL::base(); ?>files/datepicker/locales/bootstrap-datepicker-pl.min.js" charset="utf-8"></script>

</head>
<body>


<a href="#" id="test1">POST note id=5 value="Test AJAX note"</a><br>
<input type="text" id="inval", value="Test AJAX note">
<a href="#" id="test2">GET note id=6</a><br>
<a href="#" id="test3">Test 3</a><br>
<p id="response"></p>

<script type="text/javascript">

    //POST test
    $('#test1').click(function () {
        $.ajax({
            url: '<?php echo URL::site('api/note/5'); ?>',
            type: 'post',
            data: $('#inval').val(),   //dont use for GET
            contentType: 'text/plain; charset=uft-8',    //send type
            dataType: 'json',   //return-type
            success: function(data, status) {
                console.log(data);
                $('#response').text(data.status);
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        }); // end ajax call
    });

    //GET test
    $('#test2').click(function () {
        $.ajax({
            url: '<?php echo URL::site('api/note/6'); ?>',
            type: 'get',
            contentType: 'text/plain',
            success: function(data, status) {
                $('#response').text(data);
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        }); // end ajax call
    });
    $('#test3').click(function () {
        $.ajax({
            url: '<?php echo URL::site('api/note/5'); ?>',
            type: 'post',
            data: {'facilityID': 2 },   //dont use for GET
            contentType: 'application/json; charset=uft-8',    //send type
            dataType: 'json',   //return-type
            success: function(data, status) {
                var d = JSON.parse(data);
                console.log(d);
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        }); // end ajax call
    });
</script>


</body>
</html>
