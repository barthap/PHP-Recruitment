<?php
function val($arr, $name)
{
    if(isset($arr[$name]))
        return $arr[$name];
    else return '';
}

if(!isset($post))$post=array();
?>


    <form class="form-horizontal" method="post" action="<?php echo URL::site($action); ?>" id="edit-form">
        <fieldset>

            <?php if(isset($errors)): ?>
                <div class="form-group alert alert-danger">
                    <p>
                        W formularzu wystąpiły błędy:
                    <ul>
                        <?php foreach($errors as $err):
                            echo '<li>'.$err.'</li>';
                        endforeach; ?>
                    </ul>
                    </p>
                </div>
            <?php endif; ?>

            <!-- Form Name -->
            <legend>Edycja danych</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="first_name">Imię</label>
                <div class="col-md-4">
                    <input id="first_name" name="first_name" type="text" placeholder="Imię" class="form-control input-md" value="<?php echo val($post,'first_name'); ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="last_name">Nazwisko</label>
                <div class="col-md-4">
                    <input id="last_name" name="last_name" type="text" placeholder="Nazwisko" class="form-control input-md" value="<?php echo val($post,'last_name'); ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="birth_date">Data urodzenia</label>
                <div class="col-md-4">
                    <div class="input-group date datepicker" data-provide="datepicker"></div>
                    <input type="date" name="birth_date" class="form-control"  value="<?php echo val($post,'birth_date'); ?>" required>
                    <!-- <div class="input-group-addon">
                         <span class="glyphicon glyphicon-th"></span>
                     </div> -->

                </div>
            </div>
            <script type="text/javascript">
                /* $('.datepicker').datepicker({
                 format: 'dd-mm-yyyy',
                 defaultViewDate: '01-01-2000',
                 startView: '01-01-2000',
                 weekStart: 1,
                 language: 'pl-PL',

                 }); */
            </script>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="birth_place">Miejsce urodzenia</label>
                <div class="col-md-4">
                    <input id="birth_place" name="birth_place" type="text" placeholder="Miejsce urodzenia" class="form-control input-md" value="<?php echo val($post,'birth_place'); ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="pesel">PESEL</label>
                <div class="col-md-4">
                    <input id="pesel" name="pesel" type="number" placeholder="PESEL" class="form-control input-md" value="<?php echo val($post,'pesel'); ?>" required>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="addr_street">Ulica i numer domu</label>
                <div class="col-md-4">
                    <input id="addr_street" name="addr_street" type="text" placeholder="Ulica i numer domu" class="form-control input-md" value="<?php echo val($post,'addr_street'); ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="addr_city">Miasto</label>
                <div class="col-md-4">
                    <input id="addr_city" name="addr_city" type="text" placeholder="Miasto" class="form-control input-md" value="<?php echo val($post,'addr_city'); ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="addr_zip">Kod pocztowy i poczta</label>
                <div class="col-md-4">
                    <input id="addr_zip" name="addr_zip" type="text" placeholder="Kod pocztowy i poczta" class="form-control input-md" value="<?php echo val($post,'addr_zip'); ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="addr_province">Powiat, gmina</label>
                <div class="col-md-4">
                    <input id="addr_province" name="addr_province" type="text" placeholder="Powiat, gmina" class="form-control input-md" value="<?php echo val($post,'addr_province'); ?>" required>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="tel">Numer telefonu</label>
                <div class="col-md-4">
                    <input id="tel" name="tel" type="text" placeholder="Numer telefonu (opcjonalnie)" class="form-control input-md" value="<?php echo val($post,'tel'); ?>" required>

                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="secondary_name">Nazwa i adres gimnazjum</label>
                <div class="col-md-4">
                    <input id="secondary_name" name="secondary_name" type="text" placeholder="Do jakiego gimnazjum chodziłeś?" class="form-control input-md" value="<?php echo val($post,'secondary_name'); ?>" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="secondary_langs">Jakich języków uczyłeś(aś) się w gimnazjum?</label>
                <div class="col-md-4">
                    <input id="secondary_langs" name="secondary_langs" type="text" placeholder="Wymień" class="form-control input-md" value="<?php echo val($post,'secondary_langs'); ?>" required>
                </div>
            </div>


            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <input type="hidden" name="sent" value="1">
                    <button type="submit" class="btn btn-primary">Wyślij</button>
                </div>
            </div>

        </fieldset>
    </form>

<?php echo Utils::js('edit.js'); ?>