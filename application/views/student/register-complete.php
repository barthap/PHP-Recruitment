<h2>Zarejestrowano pomyślnie!</h2>
<p>Możesz teraz wydrukować swoje podanie. Pierwsza strona została za Ciebie wypełniona automatycznie. Druga strona podania powinna zostać wypełniona ręcznie przez rodziców.</p>
<?php if($account): ?>
    <p>Możesz zalogować się teraz na swoje konto wpisując dane, które podałeś(aś) w formularzu i dokonać ewentualnych zmian.</p>
<?php endif; ?>
<ul><li>
        <a href="<?php echo URL::site('student/pdf/'.$id); ?>" target="_blank">Pokaż w przeglądarce</a>
    </li>
    <li>
        <a href="<?php echo URL::site('student/download/'.$id); ?>" target="_blank">Pobierz PDF</a>
    </li>
</ul>

<?php /*
<table>
    <tbody>
    <tr>
        <td>Imię:</td>
        <td><?php echo $post['first_name']; ?><</td>
    </tr>
    <tr>
        <td>Nazwisko:</td>
        <td><?php echo $post['last_name']; ?><</td>
    </tr>
    </tbody>
</table>
 */ ?>