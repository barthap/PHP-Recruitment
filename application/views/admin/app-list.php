<div>
    <a class="btn btn-danger" href="<?php echo URL::site('admin/delete/all'); ?>">Usuń wszystkie podania!</a>

</div>
<div class="table-responsive">
    <table class="table table-striped app-list">
        <thead>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Wybrane kierunki</th>
            <th>Języki</th>
            <th>Notatka:</th>
            <th>Opcje:</th>
        </thead>

        <tbody>

        <?php foreach($rows as $row) { ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['specs']; ?></td>
                <td><?php echo $row['languages']; ?></td>
                <td><?php echo $row['note_short']; ?></td>
                <td><?php echo $row['options']; ?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>

<?php echo View::factory('note'); ?>

<script type="text/javascript">
    noteUrlBase = '<?php echo URL::site('api/note'); ?>/';      //needed for script
</script>
<?php echo Utils::js('note.js'); ?>
<?php echo Utils::js('applist.js'); ?>