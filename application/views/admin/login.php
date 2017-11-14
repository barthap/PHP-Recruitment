<form class="form-signin" method="post" action="<?php echo URL::site('admin/login'); ?>">


<?php
   echo Utils::render_alert($alert, $alert_class);
?>


    <h3 class="form-signin-heading">Zaloguj się</h3>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password"  name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
</form>