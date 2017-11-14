
<div class="table-responsive">
    <table class="table app-info">
        <tbody>
        <tr>
            <td>Imię i nazwisko:</td>
            <td><?php echo $data['first_name'].' '.$data['last_name'];; ?></td>
        </tr>
        <tr>
            <td>Adres:</td>
            <td><?php echo $data['address']; ?></td>
        </tr>
        <tr>
            <td>PESEL:</td>
            <td><?php echo $data['pesel']; ?></td>
        </tr>
        <tr>
            <td>Data i miejsce urodzenia:</td>
            <td><?php echo $data['birth']; ?></td>
        </tr>
        <tr>
            <td>Numer telefonu:</td>
            <td><tel><?php echo $data['tel']; ?></tel></td>
        </tr>
        <tr>
            <td>Wybrane zawody:</td>
            <td><?php echo $data['specs']; ?></td>
        </tr>
        <tr>
            <td>Wybrane języki:</td>
            <td><?php echo $data['languages']; ?></td>
        </tr>
        <tr>
            <td>Gimnazjum:</td>
            <td>
                <p><?php echo $data['secondary_name']; ?></p>
                <p>Wybrane języki: <?php echo $data['secondary_langs']; ?></p>
            </td>
        </tr>
        <tr>
            <td>Data złożenia wniosku:</td>
            <td><?php echo $data['register_date']; ?></td>
        </tr>
        <tr>
            <td>Ma konto użytkownika</td>
            <td>
                <?php
                    if(isset($data['has_account']) and $data['has_account'] === true)
                        echo 'Tak';
                    else
                        echo 'Nie';
                ?>
            </td>
        </tr>
        <tr>
            <td>Dane były edytowane</td>
            <td>
                <?php
                if(isset($data['edited']) and $data['edited'] == 1)
                    echo '<span class="text-warning" style="font-weight: bold;">Tak!</span>';
                else
                    echo 'Nie';
                ?>
            </td>
        </tr>
        <tr>
            <td>Notatka do zgłoszenia:<br>
                <button class="edit-note btn btn-sm btn-info" data-id="<?php echo $data['id']; ?>">Edytuj</button>
            </td>
            <td id="note-content"><?php echo $data['note']; ?></td>
        </tr>
        </tbody>
        <tr>
            <td>Dodatkowe opcje:</td>
            <td>
                <ul>
                    <li>
                        <label for="accept-checkbox">Oznacz jako przyjęty: </label>
                        <input type="checkbox" id="accept-checkbox" name="accept-checkbox" data-id="<?php echo $data['id']; ?>">
                    </li>
                    <li><a href="<?php echo URL::site('student/pdf/'.$data['id']); ?>">Pokaż PDF</a> </li>
                </ul>

            </td>
        </tr>
    </table>
</div>

<?php echo View::factory('note'); ?>

<script type="text/javascript">
    noteUrlBase = apiUrlBase+'note/';      //needed for script
    acceptUrlBase = apiUrlBase+'accept/';

    function getFullName(obj) {
        return '<?php echo $data['first_name'] .' '. $data['last_name']; ?>';
    }

    $('#accept-checkbox').click(function () {
        var checked = $('#accept-checkbox').is(':checked');
        var id = $(this).data('id');

        setAccepted(id, checked);

    });


</script>
<?php echo Utils::js('accept.js'); ?>
<?php echo Utils::js('note.js'); ?>
<?php echo Utils::js('app.js'); ?>
<script type="text/javascript">

    var accepted = false;
    getAccepted($('#accept-checkbox').data('id'), function (data) {
        $('#accept-checkbox').attr('checked', data.accepted);
    });

</script>
