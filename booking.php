<style>
<?php
session_start();
include 'style.css';
include 'bookingform.css';
include 'insertbooking.php';
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
                            <input class="form-textbox" type="tel" size="20" name="telefonszam" id="gazditel"  maxlength="20" placeholder="+36(99)123-456" pattern="[\+]36[\(]\d{1,2}[\)]\d{3}[\-]\d{3,4}" required><br>
                            <label class="form-sub-label">Formátum: +36(körzetszám)123-4567</label>
                        </div>
                    </div>
                </li>
                <li id="1kutya-adatai" class="form-header-group kutya-adatok">
                    <ul class="kutya-ul">
                        <li>
                            <h2 class="form-header">Kutya adatai</h2>
                            <div class="form-subHeader">Az alábbi mezőkbe a kutya adatait kell megadni!</div>
                        </li>
                        <li>
                            <span>Kutya neve</span><br>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox kutyaneve variable" type="text" required><br>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span>Kutya fajtája</span><br>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox kutyafajtaja variable" type="text"><br>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span>Hány hónapos?</span><br>
                            <div class="row">
                                <div class="col">
                                    <input min="0" class="form-textbox honapos variable" type="number"/>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span>Foglalás kezdő napja</span><br>
                                <div class="col-md-3">  
                                    <input id='1from_date' type="text" name="from_date" class="form-control form-textbox from_date variable"/>
                                </div>
                            <span>Foglalás vége</span><br> 
                                <div class="col-md-3">  
                                    <input id='1to_date' type="text" name="to_date" class="form-control form-textbox to_date variable"/>
                                </div>                         
                        </li>
                        <li>
                            <span>Szállítást:</span>
                            <div class="szallitasDiv">
                                <div class="checkbox-wrapper-12 row checkbox-row ">
                                    <div class="cbx col label-col" >
                                        <input class="szallitas1" name="1szallitas" value='kerek' type="radio"/>
                                        <label></label>
                                    </div>
                                    <div class="col category-col">Kérek</div>
                                </div>
                                <div class="checkbox-wrapper-12 row checkbox-row">
                                    <div class="cbx col label-col">
                                        <input class="szallitas2" name="1szallitas" value='nemkerek' type="radio"/>
                                        <label for="szallitas2"></label>
                                    </div>
                                    <div class="col category-col">Nem kérek</div>
                                </div>
                            </div>
                        </li>
                        <li id="szallitas-li">
                            <span>Adja meg a gazdi címét! (Ha bármely kutyának kér szállítást, a mezők kitöltése kötelező!) </span>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox irsz" type="number" name="iranyitoszam" placeholder="Irányítószám">
                                    <input class="form-textbox telepules" type="text" name="telepules" placeholder="Település">
                                    <input class="form-textbox utca" type="text" name="utca" placeholder="Utca">
                                    <input class="form-textbox hazszam" type="text" name="hazszam" placeholder="Házszám">
                                </div>
                            </div>
                        </li>
                        <li>
                            <span>Jelölje be mely szolgáltatásokat kéri:</span>
                            <div class="szolgaltatasok">
                                <div class="checkbox-wrapper-12 row checkbox-row">
                                    <div class="cbx col label-col">
                                        <input class="szolgaltatas" name="1szolgaltatas" value="furdetes" type="checkbox"/>
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
                                        <input class="szolgaltatas" name="1szolgaltatas" value="setaltatas" type="checkbox"/>
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
                                        <input class="szolgaltatas" name="1szolgaltatas" type="checkbox" value="kozmetika"/>
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
                                        <input class="szolgaltatas" name="1szolgaltatas" type="checkbox" value="tanitas"/>
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
                                    <input type="text" class="form-textbox specigeny variable" />
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

            <div id="confirm" class="modal">
                <span id='confClose' class="close" title="Close Modal">×</span>
                <form class="modal-content">
                    <div class="container">
                    <h1>Mégsem foglalok</h1>
                    <p>Biztos nem foglal ennek a kutyának?</p>                
                    <div class="clearfix">
                        <button type="button" class="cancelbtn">Mégsem</button>
                        <button id="delDog" type="button" class="deletebtn">Törlés</button>
                    </div>
                    </div>
                </form>
            </div>
        </form>

        <!-- jQuery -->
        <script>
            $(document).ready(function(){ 

                //Default datepicker formátum
                $.datepicker.setDefaults({
                    dateFormat: 'yy-mm-dd',
                    altFormat: 'yy-mm-dd',
                    minDate: 1,
                });

                //Alapértelmezetten nem kérjük a címét a gazdinak, csak ha szállítást is kér
                // $('#szallitas-li').hide();

                //Foglalás új kutyának
                $('#addDog').click(function(){
                    var el = $('.kutya-adatok:last').get(0); 
                    var original_radio = $(el).find(':radio:checked');
                    var el_from_date = parseInt($(el).find('.from_date').attr('id').charAt(0)); 
                    var el_to_date = parseInt($(el).find('.to_date').attr('id').charAt(0)); 
                    var el_hanyadik_kutya = parseInt($(el).attr('id').charAt(0)); 
                    var el_szallitas = parseInt($(el).find(':radio').attr('name').charAt(0)); 
                    var el_szolgaltatas = parseInt($(el).find(':checkbox').attr('name').charAt(0));
                    var newEl = $(el).clone().insertAfter('.kutya-adatok:last');
                    $(newEl).attr('id',(el_hanyadik_kutya+1)+'kutya-adatai');
                    $(newEl).find('.removeDog').remove();
                    $(newEl).find('.form-subHeader').remove();
                    $(newEl).find('#szallitas-li').remove();
                    $(newEl).find(':checkbox:checked').prop('checked', false);
                    $(newEl).find(':radio:checked').prop('checked', false);
                    $(newEl).find('.variable').val('');
                    $(newEl).find(':radio').attr('name',(el_szallitas+1)+'szallitas');
                    $(newEl).find(':checkbox').attr('name',(el_szolgaltatas+1)+'szolgaltatas');
                    var removeButt = $('<button type=\"button\" class=\"btn btn-warning removeDog\"><span class=\"bi bi-dash-circle\"></span> Neki mégsem szeretnék foglalni</button>');
                    $('#'+(el_hanyadik_kutya+1)+'kutya-adatai').prepend(removeButt);
                    $(newEl).find('#'+el_from_date+'from_date').attr('id',(el_from_date+1)+'from_date');
                    $(newEl).find('#'+el_to_date+'to_date').attr('id',(el_to_date+1)+'to_date');
                    $(newEl).find('#'+(el_to_date+1)+'to_date').removeClass('hasDatepicker').removeData('datepicker').datepicker();
                    $(newEl).find('#'+(el_from_date+1)+'from_date').removeClass('hasDatepicker').removeData('datepicker').datepicker({
                        maxDate: '+2y',
                        onSelect: function(date){

                        var selectedDate = new Date(date);
                        var msecsInADay = 86400000;
                        var endDate = new Date(selectedDate.getTime() + msecsInADay);

                        //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                        $('#'+(el_to_date+1)+'to_date').datepicker( "option", "minDate", endDate );
                        $('#'+(el_to_date+1)+'to_date').datepicker( "option", "maxDate", '+2y' )
                        }
                    });
                
                    $(original_radio).prop('checked', true);
                });

                //Foglalás gomb
                $('#submitbooking').click(function(e){
                    e.preventDefault();
                    var dogs = new Array();
                    $('.kutya-adatok').each(function(){
                        dogs.push(this); //this refers to current DOM node inside of each loop
                    });

                    //gazdi adatok
                    var gazdiveznev = $('#gazdiveznev').val();
                    var gazdikernev = $('#gazdikernev').val();
                    var gazdiemail = $('#gazdiemail').val();
                    var gazditel = $('#gazditel').val();
                    var gazdiirsz = $('#szallitas-li .irsz').val();
                    var gazditelepules = $('#szallitas-li .telepules').val();
                    var gazdiutca = $('#szallitas-li .utca').val();
                    var gazdihazszam = $('#szallitas-li .hazszam').val();

                    //kutyák adatai
                    var kutyak = new Array();

                    $.each(dogs,function(){
                        var kutyaneve = $(this).find('.kutyaneve').val();
                        var kutyafajtaja = $(this).find('.kutyafajtaja').val();
                        var honapos = $(this).find('.honapos').val();
                        var start = convert($(this).find('.from_date').datepicker('getDate'));
                        var end = convert($(this).find('.to_date').datepicker('getDate'));
                        var szall = getSzall($(this).find(':radio:checked').val());
                        function getSzall(szallitas){
                                if (szallitas == "kerek"){
                                    return 1;
                                }else{
                                    return 2;
                                }
                        };

                        var szolgaltatasok = new Array();
                        $(this).find(':checkbox:checked').each(function(){
                            szolgaltatasok.push($(this).val());
                        });

                        var specigeny = ($(this).find('.specigeny').val());
                        var kutya = {
                            "nev" : kutyaneve,
                            "fajta" : kutyafajtaja,
                            "kor" : honapos,
                            "kezdo" : start,
                            "veg" : end,
                            "szallitas" : szall,
                            "szolg" : szolgaltatasok,
                            "spec" : specigeny,
                        }

                        kutyak.push(kutya);                        
                    });

                    if(gazdiveznev != ''){
                        $.ajax({
                            url:"insertbooking.php",
                            method:"post",   
                            data:{
                                gazdivez: gazdiveznev,
                                gazdiker: gazdikernev,
                                gazdiemail: gazdiemail,
                                gazditel: gazditel,
                                gazdiirsz : gazdiirsz,
                                gazditelepules : gazditelepules,
                                gazdiutca : gazdiutca,
                                gazdihazszam : gazdihazszam,
                                kutyak : kutyak,
                            },
                            contentType: "application/x-www-form-urlencoded",
                            success: function(response){
                                alert(response);
                            },
                            error : function(err){
                                alert(err);
                            }
                        });
                    }else{
                        alert("A foglaláshoz kötelező megadni a gazdi teljes nevét, e-mail címét és telefonszámát, illetve a kutya nevét!");
                    };

                });

                //Kutya törlése
                $(document).on('click', '.removeDog', function() {
                    //$(this).parent().remove();
                    var removable = $(this).parent();
                    $('#confirm').show();
                    $('#delDog').click(function(){
                        removable.remove();
                        $('#confirm').hide();
                    })
                });

                //datepicker az első kutyára
                $('#1from_date').datepicker({
                    maxDate: '+2y', // 2 évre előre lehet foglalni
                    minDate: 1,
                        onSelect: function(date){

                        var selectedDate = new Date(date);
                        var msecsInADay = 86400000;
                        var endDate = new Date(selectedDate.getTime() + msecsInADay);

                        //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                        $("#1to_date").datepicker( "option", "minDate", endDate ); //vége időpont csak kezdő után egy nappal (min. 1 napra lehet foglalni)
                        $("#1to_date").datepicker( "option", "maxDate", '+2y' )
                        }
                });

                $("#1to_date").datepicker();

            });

            function convert(str) {
                var date = new Date(str),
                    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                    day = ("0" + date.getDate()).slice(-2);
                return [date.getFullYear(), mnth, day].join("-");
            }

            //szállítás eseménykezelés
            // $('#1kutya-adatai .szallitas1').click(function(){
            //         $('#szallitas-li').show();
            //     });
                
            // $('#1kutya-adatai .szallitas2').click(function(){
            //     $('#szallitas-li').hide();
            // });

            //megerősítés eseménykezelés
            $('#confClose, .cancelbtn').click(function(){
                $('#confirm').hide();
            })

        </script>
    </div>
</div>

