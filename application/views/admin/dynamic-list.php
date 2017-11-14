<div style="margin:20px;">
    <label for="group">Grupuj wg. kierunku</label>
    <input type="checkbox" id="group" name="group">
    <p>Liczba widocznych podań: <span id="count">-</span></p>
</div>

<div class="table-responsive" id="applist-div">
    <table class="table table-striped app-list" id="applist">
    </table>
</div>

<?php echo View::factory('note'); ?>

<script type="text/javascript">
    noteUrlBase = '<?php echo URL::site('api/note'); ?>/';      //needed for script
    ajaxUrl = "<?php echo URL::site('api/applications'); ?>";
</script>
<?php echo Utils::js('note.js'); ?>
<?php echo Utils::js('table.js'); ?>

<script type="text/javascript">

    $('#group').click(function () {
        var checked = $(this).is(":checked");
        var options = defaultVals;

        if(checked)
        {
            options.pagination = false;
            options.groupBy = "first_spec";
        }
        else
        {
            options.groupBy = false;
            options.pagination = "local";
        }

        initTabulator(options);
    });

    initTabulator(defaultVals);


</script>