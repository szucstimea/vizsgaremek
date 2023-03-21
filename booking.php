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
                            <input class="form-textbox" type="text" id="gazdiveznev" placeholder="Vezetéknév" required><br>
                        </div>
                        <div class="col">
                            <input class="form-textbox" type="text" id="gazdikernev" placeholder="Keresztnév" required><br>
                        </div>
                    </div>
                </li>
                <li>
                    <span>E-mail</span><br>
                    <div class="col">
                        <input class="form-textbox" type="email" id="gazdiemail" placeholder="pelda@pelda.hu" pattern="^[0-9a-z\.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$" required><br>
                    </div>
                </li>
                <li>
                    <span>Telefonszám</span><br>
                    <div class="row">
                        <div class="col">
                            <input class="form-textbox" type="tel" size="20" name="telefonszam" id="telefonszam"  maxlength="20" placeholder="+36(99)123-456" pattern="[\+]36[\(]\d{1,2}[\)]\d{3}[\-]\d{3,4}" required><br>
                            <label class="form-sub-label">Formátum: +36(körzetszám)123-4567</label>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Hány kutya számára kíván foglalni?</span><br>
                    <div class="row">
                        <div class="col">
                            <input min="1" max="5" type="number" id="kutyakszama" class="form-textbox" />
                            <label class="form-sub-label">Egyszerre maximum 5 kutyának foglalhat.</label>
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
                            <input class="form-textbox" type="text" id="kutyaneve" required><br>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Kutya fajtája</span><br>
                    <div class="row">
                        <div class="col">
                            <input class="form-textbox" type="text" id="kutyafajtaja" class=""><br>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Hány hónapos?</span><br>
                    <div class="row">
                        <div class="col">
                            <input min="0" type="number" id="honapos" class="form-textbox" />
                        </div>
                    </div>
                </li>
                <li>
                    <span>Foglalás kezdő napja</span><br>
                    <div class="row">
                        <div class="col">
                            <div class='input-group date' id='datetimepicker1' required>
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
                            <div class='input-group date' id='datetimepicker2' required>
                                <input type='date' class="form-textbox" />
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Szállítást:</span>
                    <div class="szallitas">
                        <div class="checkbox-wrapper-12 row checkbox-row ">
                            <div class="cbx col label-col" >
                                <input onclick="showCim('szallitas1')" id="szallitas1" name="szallitas" type="radio"/>
                                <label for="szallitas1"></label>
                            </div>
                            <div class="col category-col">Kérek</div>
                        </div>
                        <div class="checkbox-wrapper-12 row checkbox-row">
                            <div class="cbx col label-col">
                                <input onclick="showCim('szallitas2')" id="szallitas2" name="szallitas" type="radio"/>
                                <label for="szallitas2"></label>
                            </div>
                            <div class="col category-col">Nem érek</div>
                        </div>
                    </div>
                </li>
                <li id="szallitas-li" style="display:none">
                    <span>Adja meg a gazdi címét:</span>
                    <div class="row">
                        <div class="col irsz">
                            <input class="form-textbox" type="number" name="iranyitoszam" placeholder="Irányítószám">
                            <input class="form-textbox" type="text" name="telepules" placeholder="Település">
                            <input class="form-textbox" type="text" name="utca" placeholder="Utca">
                            <input class="form-textbox" type="text" name="hazszam" placeholder="Házszám">
                        </div>
                    </div>
                </li>

                <li>
                    <span>Jelölje be mely szolgáltatásokat kéri:</span>
                    <div class="szolgaltatasok">
                        <div class="checkbox-wrapper-12 row checkbox-row">
                            <div class="cbx col label-col">
                                <input id="furdetes" type="checkbox"/>
                                <label for="furdetes"></label>                                                                                       
                                <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                </svg>
                            </div>
                            <!-- Gooey-->
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                <defs>
                                <filter id="goo-12">
                                    <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                    <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                    <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                </filter>
                                </defs>
                            </svg>
                            <div class="col category-col">Fürdetés</div>
                        </div>
                        <div class="checkbox-wrapper-12 row checkbox-row">
                            <div class="cbx col label-col">
                                <input id="setaltatas" type="checkbox"/>
                                <label for="setaltatas"></label>                                                                                       
                                <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                </svg>
                            </div>
                            <!-- Gooey-->
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                <defs>
                                <filter id="goo-12">
                                    <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                    <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                    <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                </filter>
                                </defs>
                            </svg>
                            <div class="col category-col">Sétáltatás</div>
                        </div>
                        <div class="checkbox-wrapper-12 row checkbox-row">
                            <div class="cbx col label-col">
                                <input id="kozmetika" type="checkbox"/>
                                <label for="kozmetika"></label>                                                                                       
                                <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                </svg>
                            </div>
                            <!-- Gooey-->
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                <defs>
                                <filter id="goo-12">
                                    <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                    <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                    <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                </filter>
                                </defs>
                            </svg>
                            <div class="col category-col">Kozmetika</div>
                        </div>
                        <div class="checkbox-wrapper-12 row checkbox-row">
                            <div class="cbx col label-col">
                                <input id="tanitas" type="checkbox"/>
                                <label for="tanitas"></label>                                                                                       
                                <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                </svg>
                            </div>
                            <!-- Gooey-->
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                <defs>
                                <filter id="goo-12">
                                    <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                    <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                                    <feblend in="SourceGraphic" in2="goo-12"></feblend>
                                </filter>
                                </defs>
                            </svg>
                            <div class="col category-col">Tanítás</div>
                        </div>
                    </div>                  
                </li>
                <li>
                <span>Egyéb speciális igényeit ide írhatja:</span><br>
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
             $('#datetimepicker2').datetimepicker();
         });

         function showCim(id) {
            var x = document.getElementById("szallitas-li");
            if(id=="szallitas1"){
                x.style.display = "block";
            }else{
                x.style.display = "none";
            }
        }
      </script>
    </div>
</div>

