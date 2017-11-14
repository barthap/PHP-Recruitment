<?php
function val($arr, $name)
{
    if(isset($arr[$name]))
        return $arr[$name];
    else return '';
}

if(!isset($post))$post=array();
?>


<form class="form-horizontal" method="post" action="<?php URL::site('/home/register'); ?>" id="register-form">
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
        <legend>Rejestracja</legend>

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

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="region">Województwo</label>
            <div class="col-md-4">
                <select id="region" name="region" class="form-control">
                    <option value="0">dolnośląskie</option>
                    <option value="1">kujawsko-pomorskie</option>
                    <option value="2">lubelskie</option>
                    <option value="3">lubuskie</option>
                    <option value="4">łódzkie</option>
                    <option value="5">małopolskie</option>
                    <option value="6">mazowieckie</option>
                    <option value="7">opolskie</option>
                    <option value="8" selected>podkarpackie</option>
                    <option value="9">podlaskie</option>
                    <option value="10">pomorskie</option>
                    <option value="11">śląskie</option>
                    <option value="12">świętokrzyskie</option>
                    <option value="13">warmińsko-mazurskie</option>
                    <option value="14">wielkopolskie</option>
                    <option value="15">zachodniopomorskie</option>
                </select>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="tel">Numer telefonu</label>
            <div class="col-md-4">
                <input id="tel" name="tel" type="text" placeholder="Numer telefonu (opcjonalnie)" class="form-control input-md" value="<?php echo val($post,'tel'); ?>" required>

            </div>
        </div>

        <!-- kierunek główny -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="school-first">Kierunek główny</label>
            <div class="col-md-4">
                <select id="school-first" name="school-first" class="form-control">
                    <option disabled style="font-weight: bold;">───────────Technikum:───────────</option>
                    <option value="0">Technik informatyk</option>
                    <option value="1">Technik elektronik</option>
                    <option value="2">Technik mechatronik</option>
                    <option value="3">Technik pojazdów samochodowych</option>
                    <option value="4">Technik mechanik (spec. CNC)</option>
                    <option value="5">Technik mechanik (spawalnictwo)</option>
                    <option value="6">Technik handlowiec</option>
                    <option value="7">Technik hotelarstwa</option>
                    <option value="8">Technik mechanizacji rolnictwa</option>
                    <option value="9">Technik żywienia i usług gastronomicznych</option>
                    <option value="10">Technik urządzeń i systemów energetyki odnawialnej</option>
                    <option disabled style="font-weight: bold;">────Zasadnicza szkoła zawodowa:────</option>
                    <option value="11">Mechanik pojazdów samochodowych</option>
                    <option value="12">Operator obrabiarek skrawających</option>
                    <option value="13">Stolarz</option>
                    <option value="14">Elektryk</option>
                    <option value="15">Murarz - tynkarz</option>
                    <option value="16">Ślusarz</option>
                    <option value="17">Mechanik - operator pojazdów i maszyn rolniczych</option>
                    <option value="18">Sprzedawca</option>
                    <option value="19">Fryzjer</option>
                    <option value="20">Cukiernik</option>
                    <option value="21">Piekarz</option>
                    <option value="22">Kucharz</option>
                    <option value="23">Kelner</option>
                </select>
            </div>
        </div>

        <!-- kierunek zapasowy 1 -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="school-second">Kierunek rezerwowy pierwszy</label>
            <div class="col-md-4">
                <select id="school-second" name="school-second" class="form-control">
                    <option disabled style="font-weight: bold;">───────────Technikum:───────────</option>
                    <option value="0">Technik informatyk</option>
                    <option value="1">Technik elektronik</option>
                    <option value="2">Technik mechatronik</option>
                    <option value="3">Technik pojazdów samochodowych</option>
                    <option value="4">Technik mechanik (spec. CNC)</option>
                    <option value="5">Technik mechanik (spawalnictwo)</option>
                    <option value="6">Technik handlowiec</option>
                    <option value="7">Technik hotelarstwa</option>
                    <option value="8">Technik mechanizacji rolnictwa</option>
                    <option value="9">Technik żywienia i usług gastronomicznych</option>
                    <option value="10">Technik urządzeń i systemów energetyki odnawialnej</option>
                    <option disabled style="font-weight: bold;">────Zasadnicza szkoła zawodowa:────</option>
                    <option value="11">Mechanik pojazdów samochodowych</option>
                    <option value="12">Operator obrabiarek skrawających</option>
                    <option value="13">Stolarz</option>
                    <option value="14">Elektryk</option>
                    <option value="15">Murarz - tynkarz</option>
                    <option value="16">Ślusarz</option>
                    <option value="17">Mechanik - operator pojazdów i maszyn rolniczych</option>
                    <option value="18">Sprzedawca</option>
                    <option value="19">Fryzjer</option>
                    <option value="20">Cukiernik</option>
                    <option value="21">Piekarz</option>
                    <option value="22">Kucharz</option>
                    <option value="23">Kelner</option>
                </select>
            </div>
        </div>

        <!-- Kierunek zapasowy2 -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="school-third">Kierunek rezerwowy drugi</label>
            <div class="col-md-4">
                <select id="school-third" name="school-third" class="form-control">
                    <option disabled style="font-weight: bold;">───────────Technikum:───────────</option>
                    <option value="0">Technik informatyk</option>
                    <option value="1">Technik elektronik</option>
                    <option value="2">Technik mechatronik</option>
                    <option value="3">Technik pojazdów samochodowych</option>
                    <option value="4">Technik mechanik (spec. CNC)</option>
                    <option value="5">Technik mechanik (spawalnictwo)</option>
                    <option value="6">Technik handlowiec</option>
                    <option value="7">Technik hotelarstwa</option>
                    <option value="8">Technik mechanizacji rolnictwa</option>
                    <option value="9">Technik żywienia i usług gastronomicznych</option>
                    <option value="10">Technik urządzeń i systemów energetyki odnawialnej</option>
                    <option disabled style="font-weight: bold;">────Zasadnicza szkoła zawodowa:────</option>
                    <option value="11">Mechanik pojazdów samochodowych</option>
                    <option value="12">Operator obrabiarek skrawających</option>
                    <option value="13">Stolarz</option>
                    <option value="14">Elektryk</option>
                    <option value="15">Murarz - tynkarz</option>
                    <option value="16">Ślusarz</option>
                    <option value="17">Mechanik - operator pojazdów i maszyn rolniczych</option>
                    <option value="18">Sprzedawca</option>
                    <option value="19">Fryzjer</option>
                    <option value="20">Cukiernik</option>
                    <option value="21">Piekarz</option>
                    <option value="22">Kucharz</option>
                    <option value="23">Kelner</option>
                </select>
            </div>
        </div>

        <!-- Multiple Checkboxes -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="languages_en languages_de languages_ru">Wybierz języki</label>
            <div class="col-md-4">
                <div class="checkbox">
                    <label for="languages_en">
                        <input type="checkbox" name="languages_en" id="languages_en" value="en" checked>
                        angielski
                    </label>
                </div>
                <div class="checkbox">
                    <label for="languages_de">
                        <input type="checkbox" name="languages_de" id="languages_de" value="de">
                        niemiecki
                    </label>
                </div>
                <div class="checkbox">
                    <label for="languages_ru">
                        <input type="checkbox" name="languages_ru" id="languages_ru" value="ru">
                        rosyjski
                    </label>
                </div>
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


        <div class="form-group">
            <label class="col-md-4 control-label" for="register">Załóż konto</label>
            <div class="col-md-4">
                <div class="checkbox">
                    <label for="account">
                        <input type="checkbox" name="account" id="account" value="yes" <?php if(val($post, 'account')=='yes')echo 'checked';?>>
                        Chcę założyć konto, aby mieć możliwość edycji swoich danych i podglądu statusu rekrutacji.
                    </label>
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group" id="login-data" <?php if(val($post, 'account')!='yes')echo 'style="display: none;"';?>>
            <div style="display: block; text-align: center;"><em>Podaj dane do rejestracji</em></div>
            <div class="form-group">
                <label for="inputEmail" class="col-md-4 control-label">E-mail</label>
                <div class="col-md-4"><input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adres E-mail"></div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-md-4 control-label">Hasło</label>
                <div class="col-md-4"><input type="password"  name="password" id="inputPassword" class="form-control" placeholder="Hasło"></div>
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

<?php echo Utils::js('register.js'); ?>