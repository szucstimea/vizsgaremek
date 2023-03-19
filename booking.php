<style>
<?php include 'style.css'; ?>
<?php include 'bookingform.css'; ?>
</style>

<div class="container-fluid" id="booking">
    <div class="text-center">
        <h1 h1 style="padding:2%;"><i class="bi bi-calendar2-check"></i>  Foglalás</h1>
    </div>
    <div class="booking-form-container">
        <form class="booking-form" action="" method="post" name="" id="" autocomplete="on">
            <ul>
                <li id="" class="form-header-group">
                    <h2 id="header_2" class="form-header">Gazdi adatai</h2>
                    <div id="subHeader_1" class="form-subHeader">Az alábbi mezőkbe a foglaló gazdi adatait kell megadni!</div>
                </li>
                <li>
                    <span>Név</span><br>
                    <div class="row">
                        <div class="col">
                            <input class="form-textbox" type="text" id="gazdikernev" class=""><br>
                            <label class="form-sub-label" for="gazdikernev">Keresztnév</label>
                        </div>
                        <div class="col">
                            <input class="form-textbox" type="text" id="gazdiveznev" class=""><br>
                            <label class="form-sub-label" for="lgazdiveznev">Vezetéknév</label>
                        </div>
                    </div>
                </li>
                <li>
                    <span>E-mail</span><br>
                    <div class="col">
                        <input class="form-textbox" type="email" id="gazdiveznev" class=""><br>
                        <label class="form-sub-label" for="lgazdiveznev">pelda@pelda.hu</label>
                    </div>
                </li>
                <li>
                    <span>Telefonszám</span><br>
                    <div class="row">
                        <div class="col">
                            <input class="form-textbox" type="text" id="gazdikernev" class=""><br>
                            <label class="form-sub-label" for="gazdikernev">Körzetszám</label>
                        </div>
                        <div class="col">
                            <input class="form-textbox" type="text" id="gazdiveznev" class=""><br>
                            <label class="form-sub-label" for="lgazdiveznev">Telefonszám</label>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Hány kutya számára kíván foglalni?</span><br>
                    <div class="row">
                        <div class="col">
                            <input min="1" max="5" type="number" id="kutyakszama" class="form-textbox" />
                        </div>
                    </div>
                </li>
                <li id="kutya-adatai" class="form-header-group">
                    <h2 id="header_2" class="form-header">Kutya adatai</h2>
                    <div id="subHeader_1" class="form-subHeader">Az alábbi mezőkbe a kutya adatait kell megadni!</div>
                </li>
                <li>
                    <span>Kutya neve</span><br>
                    <div class="row">
                        <div class="col">
                            <input class="form-textbox" type="text" id="kutyaneve" class=""><br>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Kutya fajtája</span><br>
                    <div class="row">
                        <div class="col">
                            <input class="form-textbox" type="text" id="kutyaneve" class=""><br>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Hány hónapos?</span><br>
                    <div class="row">
                        <div class="col">
                            <input min="0" type="number" id="kutyakszama" class="form-textbox" />
                        </div>
                    </div>
                </li>
                <li>
                    <span>Foglalás kezdő napja</span><br>
                    <div class="row">
                        <div class="col">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='date' class="form-textbox" />
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Foglalás vége</span><br>
                    <div class="row">
                        <div class="col">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='date' class="form-textbox" />
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <fieldset>
                        <legend>Szállítás</legend>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked> Kérek
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="options" id="option2" autocomplete="off"> Nem kérek
                            </label>                            
                        </div>
                    </fieldset>
                </li>
                <li>
                    <fieldset>
                        <legend>Jelölje be mely szolgáltatásokat kéri:</legend>
                            <div>
                                <input type="checkbox" id="furdetes" name="szolgaltatas" value="furdetes">
                                <label for="furdetes">Fürdetés</label>
                            </div>
                            <div>
                                <input type="checkbox" id="setaltatas" name="szolgaltatas" value="setaltatas">
                                <label for="setaltatas">Sétáltatás</label>
                            </div>
                            <div>
                                <input type="checkbox" id="kozmetika" name="szolgaltatas" value="kozmetika">
                                <label for="kozmetika">Kozmetika</label>
                            </div>
                            <div>
                                <input type="checkbox" id="tanitas" name="szolgaltatas" value="tanitas">
                                <label for="tanitas">Tanítás</label>
                            </div>
                    </fieldset>
                </li>
                <li>
                <span>Egéyb speciális igényeit ide írhatja:</span><br>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="specigeny" class="form-textbox" />
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary" type="submit" name="submitbooking" id="submitbooking">Foglalás</button>
                        </div>
                    </div>
                </li>
            </ul>
        </form>

        <!-- Dátum script -->
        <script type="text/javascript">
         $(function () {
             $('#datetimepicker1').datetimepicker();
         });
      </script>
    </div>
</div>

