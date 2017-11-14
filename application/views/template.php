<!DOCTYPE html>
<html lang="pl">
<head>
    <title><?php echo $title.' - '.$site_title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?php echo Utils::css('app.css'); ?>
    <link rel="stylesheet" href="<?php echo URL::base(); ?>files/datepicker/css/bootstrap-datepicker3.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo URL::base(); ?>files/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo URL::base(); ?>files/datepicker/locales/bootstrap-datepicker-pl.min.js" charset="utf-8"></script>
    <script src="<?php echo URL::base(); ?>files/validator/jquery.validate.min.js"></script>
    <script src="<?php echo URL::base(); ?>files/validator/localization/messages_pl.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <?php echo Utils::css('tabulator.min.css'); ?>
    <?php echo Utils::css('tabulator_bootstrap.min.css'); ?>
    <?php echo Utils::js('tabulator.min.js'); ?>

    <script type="text/javascript">
        urlbase = '<?php echo URL::site(); ?>';
        apiUrlBase = urlbase+'api/';
    </script>

</head>
<body>

<div class="container">
    <?php echo $menu; ?>

    <h2><?php echo $title; ?></h2>
    <hr>
    <p ><?php echo $content; ?></p>
</div>


</body>
</html>
