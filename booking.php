<style>
<?php
session_start();
include 'style.css';
include 'bookingform.css';
include 'bookingback.php';
setcookie('loggedin', '2', time()-3600);
?>
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
<div class="container-fluid" id="booking">
    <div class="text-center">
        <h1 h1 style="padding:2%;"><i class="bi bi-calendar2-check"></i>  Foglalás</h1>
    </div>
    <div id="booking-form-guest" class="booking-form-container" <?php if((isset($_SESSION["loggedin"]) or isset($_COOKIE["loggedin"])) && ($_SESSION["loggedin"]==true || $_COOKIE["loggedin"]=='1')){echo "style=\"display:none\"";} ?>>
        <form class="booking-form" action="" method="post">
            <ul id="booking-list">
                <li id="gazdi-adatai" class="form-header-group">
                    <h2 id="gazdi_header" class="form-header">Gazdi adatai</h2>
                    <div class="form-subHeader">Az alábbi mezőkbe a foglaló gazdi adatait kell megadni!</div>
                </li>
                <li>
                    <span>Név</span><br>
                    <div class="row">
                        <div class="col">
                            <input class="form-textbox" type="text" id="gazdiveznev" placeholder="Vezetéknév" autocomplete="off"required><br>
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
                <li id=kutya-adatai1 class="form-header-group">
                    <ul>
                        <li>
                            <h2 id="kutya-header1" class="form-header">Kutya adatai</h2>
                            <div class="form-subHeader">Az alábbi mezőkbe a kutya adatait kell megadni!</div>
                            <!-- <button type="button" id="removeDog" class="btn btn-warning"><span class="bi bi-dash-circle"></span> Neki mégsem szeretnék foglalni</button> -->
                        </li>
                        <li>
                            <span>Kutya neve</span><br>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox" type="text" id="kutyaneve1" required><br>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span>Kutya fajtája</span><br>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox" type="text" id="kutyafajtaja1"><br>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span>Hány hónapos?</span><br>
                            <div class="row">
                                <div class="col">
                                    <input min="0" class="form-textbox" type="number" id="honapos1"  />
                                </div>
                            </div>
                        </li>
                        <li>
                            <span>Foglalás kezdő napja</span><br>
                                <div class="col-md-3">  
                                    <input type="text" id="from_date1" class="form-control form-textbox"/>
                                </div>
                            <span>Foglalás vége</span><br> 
                                <div class="col-md-3">  
                                    <input type="text" id="to_date1" class="form-control form-textbox"/>
                                </div>                         
                        </li>
                        <li>
                            <span>Szállítást:</span>
                            <div class="szallitas">
                                <div class="checkbox-wrapper-12 row checkbox-row ">
                                    <div class="cbx col label-col" >
                                        <input id="szallitas1" name="szallitas1" value='kerek' type="radio"/>
                                        <label id="label-szallitas1" for="szallitas1"></label>
                                    </div>
                                    <div class="col category-col">Kérek</div>
                                </div>
                                <div class="checkbox-wrapper-12 row checkbox-row">
                                    <div class="cbx col label-col">
                                        <input id="szallitas2" name="szallitas1" value='nemkerek' type="radio"/>
                                        <label id="label-szallitas2" for="szallitas2"></label>
                                    </div>
                                    <div class="col category-col">Nem kérek</div>
                                </div>
                            </div>
                        </li>
                        <li id="szallitas-li">
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
                                        <input id="furdetes" type="checkbox" name="szolgaltatas1[]"/>
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
                                        <input id="setaltatas" type="checkbox" name="szolgaltatas1[]"/>
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
                                        <input id="kozmetika" type="checkbox" name="szolgaltatas1[]"/>
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
                                        <input id="tanitas" type="checkbox" name="szolgaltatas1[]"/>
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
                    </ul>
                </li><!--kutya adatai-->
                <li>
                        <div class="row">
                            <div class="col">
                                <button type="button" id="addDog" class="btn btn-primary"><span class="bi bi-plus"></span> Még egy kutyának foglalok</button>
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
                </li>                
            </ul>
        </form>

        <!-- jQuery -->
        <script>
            $(document).ready(function(){ 
                var count = 1;

                $.datepicker.setDefaults({  
                    dateFormat: 'yy-mm-dd'   
                });  
                
                $(function(){  
                    $("#from_date"+count).datepicker();  
                    $("#to_date"+count).datepicker();  
                });

                $('#szallitas-li').hide();

                $('#addDog').click(function(){
                    count++;
                    var el = $('#kutya-adatai'+(count-1)).get(0); 
                    var original_radio = $(el).find(':radio:checked');  
                    var newEl = $(el).clone().insertAfter('#kutya-adatai'+(count-1));
                    $(newEl).find(':checkbox:checked').prop('checked', false);
                    $(newEl).find(':radio:checked').prop('checked', false);
                    $(newEl).find(':input').val('');
                    $(newEl).attr('id','kutya-adatai'+(count))
                    $(newEl).find("#kutya-header"+(count-1)).attr('id','kutya-header'+(count))
                    $(newEl).find("#kutyaneve"+(count-1)).attr('id','kutyaneve'+(count))
                    $(newEl).find("#kutyafajtaja"+(count-1)).attr('id','kutyafajtaja'+(count))
                    $(newEl).find("#honapos"+(count-1)).attr('id','honapos'+(count))
                    $(newEl).find('#from_date'+(count-1)).attr('id','from_date'+count).datepicker();
                    $(newEl).find('#to_date'+(count-1)).attr('id','to_date'+count).datepicker();
                    $(newEl).find('#szallitas'+((count-1)*2-1)).attr('id','szallitas'+(count*2-1)).attr('name','szallitas'+count);
                    $(newEl).find('#szallitas'+(count-1)*2).attr('id','szallitas'+(count*2)).attr('name','szallitas'+count);
                    $(newEl).find('#label-szallitas'+((count-1)*2-1)).attr('id','label-szallitas'+(count*2-1)).attr('for','szallitas'+(count*2-1));
                    $(newEl).find('#label-szallitas'+(count-1)*2).attr('id','label-szallitas'+(count*2)).attr('for','szallitas'+(count*2));
                    $(newEl).find(':checkbox').attr('name','szolgaltatas'+count+'[]');

                    $(original_radio).prop('checked', true);

                }).change();

                $('#submitbooking').click(function(){
                    alert($('#kutya-adatai'+(count)).find(':input').val());
                });
            });

            $('#kutya-adatai1 #szallitas1').click(function(){
                    $('#szallitas-li').show();
                });
                
            $('#kutya-adatai1 #szallitas2').click(function(){
                $('#szallitas-li').hide();
            });
            

        </script>
    </div>
</div>

