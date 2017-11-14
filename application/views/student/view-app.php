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
                <td>Przyjęty:</td>
                <td>
                    <?php if($data['accepted'])echo 'Tak'; else echo 'Nie'; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>