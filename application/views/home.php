<!DOCTYPE html>
<html lang="pl">
<head>
    <title><?php echo $site_title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?php echo Utils::css('app.css'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
                <span class="sr-only">Rozwiń menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-right: 10px;"></span>School name</a>
        </div>
        <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo URL::site('admin'); ?>">Panel administratora</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="margin-top:30px;">
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <h3>
            Witamy w portalu kandydatów!
        </h3>
        <p>Portal służy do składania wniosków oraz do przekazywania kandydatom  komunikatów o ich sytuacji w procesie rekrutacyjnym.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Strona główna Szkoły &raquo;</a></p>
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-8">
            <h2>Złóż wniosek</h2>
            <p>Wniosek możesz złożyć elektronicznie na tej stronie albo pobrać PDF, wydrukować i wypełnić własnoręcznie.</p>
            <p><a class="btn btn-primary" href="<?php echo URL::site('student/register'); ?>" role="button">Złóż wniosek elektronicznie &raquo;</a></p>
            <p><a class="btn btn-default" href="emptyApplication.pdf" role="button">Pobierz PDF &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <?php echo Utils::render_alert($alert, $alert_class); ?>
            <h2>Sprawdź swoje dane</h2>
            <p>Jeśli podczas rejestracji założyłeś konto to wpisz tu swoje dane i sprawdź czy się dostałeś edytuj dane itp</p>

            <?php echo $student_panel; ?>

        </div>
    </div>

    <hr>

    <footer>
        <p><a href="<?php echo URL::site('admin'); ?>">Panel administratora</a></p>
    </footer>
</div> <!-- /container -->


</body>
</html>
