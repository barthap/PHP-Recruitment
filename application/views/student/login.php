<form class="form-signin" method="post" action="<?php echo URL::site('student/login'); ?>">
    <div class="form-group">
        <label for="inputEmail" class="sr-only">E-mail</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adres E-mail" required autofocus>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="sr-only">Hasło</label>
        <input type="password"  name="password" id="inputPassword" class="form-control" placeholder="Hasło" required>
    </div>
    <div class="form-group">
        <button class="btn btn-default" type="submit">Zaloguj się &raquo;</button>
    </div>
</form>