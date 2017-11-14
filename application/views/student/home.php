<?php echo Utils::render_alert($alert, $alert_class); ?>
<p style="font-weight: bold;">Witaj <?php echo $name; ?>!</p>
<p>Witaj w panelu ucznia! Możesz tu sprawdzić swoje dane, dokonać poprawek oraz wygenerować ponownie swoje podanie.</p>
<p>Twoje wygenerowane podanie jest dostępne tutaj:
<ul><li>
        <a href="<?php echo URL::site('student/pdf/'.$id); ?>" target="_blank">Pokaż w przeglądarce</a>
    </li>
    <li>
        <a href="<?php echo URL::site('student/download/'.$id); ?>" target="_blank">Pobierz PDF</a>
    </li>
</ul></p>