<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
                <span class="sr-only">Rozwiń menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL::site('home'); ?>">
                <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-right: 10px;"></span>Strona główna
            </a>
        </div>

        <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="nav navbar-nav">
                <?php
                echo $public_items;
                if($logged_in) {
                 echo $private_items;
                } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php if($logged_in) { ?>
                        <a href="<?php echo URL::site('student/logout'); ?>">Wyloguj się</a>
                    <?php } else { ?>
                        <a href="<?php echo URL::site('student/login'); ?>">Zaloguj się</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>