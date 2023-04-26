<?php
include 'inndata.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script src='./jQuery/datepicker-hu.js' type='text/javascript'></script> 
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
<div class="container-fluid" id="booking">
    <div class="text-center" data-aos="fade-right">
        <h1  style="padding:2%; color: white; text-shadow: 2px 2px 6px #080000;" ><i class="bi bi-calendar2-check"></i>  Foglalás</h1>
    </div>
    <div data-aos="fade-right" id="booking-form-guest" class="booking-form-container">
        <form id="booking-form" class="booking-form" action="" method="post">
            <ul id="booking-list">
                <li id="gazdi-adatai" class="form-header-group gazdi-adatok">
                    <ul class="gazdi-ul">
                        <li class="form-header-group">
                            <h2 id="gazdi_header" class="form-header" style="color: white; text-shadow: 2px 2px 6px #080000;"><i class="bi bi-person"></i>Gazdi adatai</h2>
                            <div class="form-subHeader">Az alábbi mezőkbe a foglaló gazdi adatait kell megadni!</div>
                            <?php if((isset($_COOKIE["loggedin"]) && ($_COOKIE["loggedin"]=='1')) || (isset($_SESSION["login"]) && $_SESSION["login"]==true)){
                                echo "<button class=\"btn btn-success\" id=\"profilbol\" type=\"button\">Gazdi adatainak betöltése a profilból</button>";
                            }?>
                        </li>
                        <li>
                            <span><i class="bi bi-person"></i> Név</span><br>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox" type="text" id="gazdiveznev" placeholder="Vezetéknév" pattern="^[\p{L}]{2,}" required data-aos="fade-right" /><br>
                                </div>
                                <div class="col">
                                    <input class="form-textbox" type="text" id="gazdikernev" placeholder="Keresztnév" pattern="^[\p{L}]{2,}" required data-aos="fade-right"/><br>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span><i class="bi bi-envelope-paper-heart" ></i> E-mail</span><br>
                            <div class="col">
                                <input class="form-textbox" type="email" id="gazdiemail" placeholder="pelda@pelda.hu" pattern="^[0-9a-z\.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$" required data-aos="fade-right"/><br>
                            </div>
                        </li>
                        <li>
                            <span><i class="bi bi-telephone" data-aos="fade-right"></i> Telefonszám</span><br>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox" type="tel" size="20" name="telefonszam" id="gazditel"  maxlength="20" placeholder="+36(99)123-4567" pattern="[\+]36[\(]\d{1,2}[\)]\d{3}[\-]\d{3,4}" required data-aos="fade-right"/><br>
                                    <label class="form-sub-label">Formátum: +36(körzetszám)123-4567</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>                
                <li id="1kutya-adatai" class="form-header-group kutya-adatok" data-aos="fade-right">
                    <ul class="kutya-ul">
                        <li>
                            <h2 class="form-header" style="color: white; text-shadow: 2px 2px 6px #080000;"><i class="bi bi-heart" data-aos="fade-right"></i> Kutya adatai</h2>
                            <div class="form-subHeader">Az alábbi mezőkbe a kutya adatait kell megadni!</div>
                        </li>
                        <li>
                            <span>Kutya neve</span><br>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox kutyaneve variable" type="text" required data-aos="fade-right"/>
                                </div>
                                <?php if((isset($_COOKIE["loggedin"]) && ($_COOKIE["loggedin"]=='1')) || (isset($_SESSION["login"]) && $_SESSION["login"]==true)){
                                echo "<div class=\"col dropdown\" style=\"display: flex; float: right; align-items: center\">
                                        <button id=\"kutyaim\" class=\"btn btn-success dropdown-toggle\" data-bs-toggle=\"dropdown\" type=\"button\" style=\"padding: 0.2rem; font-size: 1rem\">Kutyáim</button>
                                        <div id=\"kutyaim-dropdown\" class=\"dropdown-menu\" aria-labelledby=\"kutyaim\">
                                        </div>
                                    </div>";
                                }?>
                            </div>
                        </li>
                        <li>
                            <span>Kutya fajtája</span><br>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox kutyafajtaja variable" type="text" data-aos="fade-right"><br>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span>Hány hónapos?</span><br>
                            <div class="row">
                                <div class="col">
                                    <input min="0" class="form-textbox honapos variable" type="number" data-aos="fade-right"/>
                                </div>
                            </div>
                        </li>
                        <li class="idopontok">
                            <span>Foglalás kezdő napja</span><br>
                                <div class="col-md-3">  
                                    <input id='1from_date' type="text" name="from_date" class="form-control form-textbox from_date variable" readonly="true" data-aos="fade-right"/>
                                </div>
                            <span>Foglalás vége</span><br> 
                                <div class="col-md-3">  
                                    <input id='1to_date' type="text" name="to_date" class="form-control form-textbox to_date variable" readonly="true" data-aos="fade-right"/>
                                </div>                         
                        </li>
                        <li>
                            <span>Szállítást:</span>
                            <div class="szallitasDiv">
                                <div class="checkbox-wrapper-12 row checkbox-row ">
                                    <div class="cbx col label-col" >
                                        <input class="szallitas1" name="1szallitas" value='kerek' type="radio" required data-aos="fade-right"/>
                                        <label></label>
                                    </div>
                                    <div class="col category-col" data-aos="fade-right">Kérek</div>
                                </div>
                                <div class="checkbox-wrapper-12 row checkbox-row">
                                    <div class="cbx col label-col">
                                        <input class="szallitas2" name="1szallitas" value='nemkerek' type="radio"/>
                                        <label for="szallitas2"></label>
                                    </div>
                                    <div class="col category-col" data-aos="fade-right">Nem kérek</div>
                                </div>
                            </div>
                        </li>
                        <li id="szallitas-li">
                            <span>Adja meg a gazdi címét! (Ha bármely kutyának kér szállítást, a mezők kitöltése kötelező!) </span>
                            <div class="row">
                                <div class="col">
                                    <input class="form-textbox irsz variable" type="number" name="iranyitoszam" placeholder="Irányítószám" data-aos="fade-right"/>
                                    <input class="form-textbox megye variable" type="text" name="megye" placeholder="Megye" data-aos="fade-right"/>
                                    <input class="form-textbox telepules variable" type="text" name="telepules" placeholder="Település" data-aos="fade-right"/>
                                    <input class="form-textbox utca variable" type="text" name="utca" placeholder="Utca" data-aos="fade-right">
                                    <input class="form-textbox hazszam variable" type="text" name="hazszam" placeholder="Házszám" data-aos="fade-right"/>
                                </div>
                            </div>
                        </li>
                        <?php if ($szolgaltatas != "nincs"){
                            echo "<li>
                            <span>Jelölje be mely szolgáltatásokat kéri:</span>
                            <div class=\"szolgaltatasok\" data-aos=\"fade-right\">";
                            foreach ($szolgaltatas as $szolg)
                            { if($szolg["kategoria"] != "alapár"){
                                echo                                                                
                                    "<div class=\"checkbox-wrapper-12 row checkbox-row\">
                                        <div class=\"cbx col label-col\">
                                            <input class=\"szolgaltatas\"name=\"1szolgaltatas\" value=\"".$szolg["kategoria"]."\" type=\"checkbox\"/>
                                            <label for=\"".$szolg["kategoria"]."\"></label>                                                                                       
                                            <svg width=\"15\" height=\"14\" viewbox=\"0 0 15 14\" fill=\"none\">
                                                <path d=\"M2 8.36364L6.23077 12L13 2\"></path>
                                            </svg>
                                        </div>
                                        <!-- Gooey-->
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\">
                                            <defs>
                                            <filter id=\"goo-12\">
                                                <fegaussianblur in=\"SourceGraphic\" stddeviation=\"4\" result=\"blur\"></fegaussianblur>
                                                <fecolormatrix in=\"blur\" mode=\"matrix\" values=\"1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7\" result=\"goo-12\"></fecolormatrix>
                                                <feblend in=\"SourceGraphic\" in2=\"goo-12\"></feblend>
                                            </filter>
                                            </defs>
                                        </svg>
                                        <div class=\"col category-col\">".$szolg["kategoria"]."</div>
                                    </div>";
                                }
                            }
                            echo "</div>                  
                            </li>"
                        ;}?>
                        <li>
                        <span>Egyéb speciális igényeit ide írhatja:</span><br>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-textbox specigeny variable" data-aos="fade-right" />
                                </div>
                            </div>
                        </li>
                    </ul>
                </li><!--kutya adatai-->
                <li>
                    <li>
                        <div class="row" data-aos="fade-right">
                            <div class="col">
                                <button type="button" id="addDog" class="btn btn-primary"><span class="bi bi-plus"></span> Még egy kutyának foglalok</button>
                            </div>
                        </div>
                    </li>
                    <li>
                    <div class="container">
                        <div class="row gombok" data-aos="fade-right">
                        
                            <div class="col">
                            <div id ="toltes" style = "display:none;">
                                <img src="<?php echo $kepek["loadergif"]?>" id="gif" style="width:50%; height:auto;">

                            </div>
                            <div class="row">
                                <button class="btn btn-primary btn-lg" type="submit" name="submitbooking" id="submitbooking"><i class="bi bi-calendar2-check"></i> Foglalás</button>
                            </div>
                            </div>
                            <div class="col">
                                <p id="vegosszeg"></p>
                            </div>
                            
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
                // $.datepicker.setDefaults($.datepicker.regional['de']);
                $.datepicker.setDefaults({
                    dateFormat: 'yy-mm-dd',
                    altFormat: 'yy-mm-dd',
                    minDate: 1,},
                    $.datepicker.regional['hu']);

                //datepicker az első kutyára
                var betelt = [];
                var osszes_nap = [];
                var string;
                var kezdo;
                var veg;
                var minnap;
                var maxnap;
                var kapacitas;
                var hanyadik = 0;
                var akt_kezdo;

                function getNapok(){
                    $.ajax({
                        url:"checkcapacity.php",
                        method:"get",   
                        contentType: "application/x-www-form-urlencoded",
                        success: function(response) {
                            var respData = JSON.parse(response);
                            kapacitas = respData.kapacitas;
                            if(respData.napok.length != 0){
                                osszes_nap = respData.napok;
                                minnap = new Date(respData.minnap);
                                maxnap = new Date(respData.maxnap);
                                var nincs_kapacitas = new Date();                    
                                for (let j=0;j<osszes_nap.length;j++){
                                    if(osszes_nap[j]==0){
                                        nincs_kapacitas.setDate(minnap.getDate() + j);
                                        betelt.push(convert(nincs_kapacitas));
                                    }
                                }
                            }
                        },
                        error : function(err){
                            alert(err);
                        }
                    });
                }

                $('#1from_date').datepicker({
                    minDate: 1, //a foglalás napjáramár nem lehet foglalni
                    beforeShow: getNapok(),
                    beforeShowDay: function (date){ 
                        string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        if(betelt.length>0){
                            return [betelt.indexOf(string) == -1];
                        }else{
                            return[string];
                        }
                    },
                    onSelect: function(date){
                        kezdo = new Date(date);
                        var msecsInADay = 86400000;
                        var endDate = new Date(kezdo.getTime() + msecsInADay);
                        if(betelt.length>0){
                            for (let i=0;i<betelt.length;i++){
                                if(betelt[i]>date){
                                    maxDate = betelt[i];
                                    break;
                                }else{
                                    maxDate='+2y'
                                };
                            };
                        }else{
                            maxDate='+2y'
                        }

                        //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                        $("#1to_date").datepicker( "option", "minDate", endDate ); //vége időpont csak kezdő után egy nappal (min. 1 napra lehet foglalni)
                        $("#1to_date").datepicker( "option", "maxDate", maxDate );
                        
                        //végösszeghez
                        var to = $('#1to_date').datepicker( "getDate" );
                        if(to != null){
                            VegCalc(0,"napok");
                        }
                    }
                });

                $("#1to_date").datepicker({
                    onSelect: function(date){
                        //végösszeghez
                        var from = $('#1from_date').datepicker( "getDate" );
                        if(from != null){
                            VegCalc(0,"napok");
                        }
                    }
                });

                //Foglalás új kutyának
                $('#addDog').click(function(){
                    var countDog = $('.kutya-adatok').length;
                    if(countDog<kapacitas){ //max annyi kutyának lehet egyszerre foglalni, amennyi a kapacitása a pnaziónak
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
                        $(newEl).find('#'+(el_from_date+1)+'from_date').removeClass('hasDatepicker').removeData('datepicker').datepicker({
                            minDate: 1, //a foglalás napjáramár nem lehet foglalni
                            beforeShow: getNapok(),
                            beforeShowDay: function (date){ 
                                string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                                if(betelt.length>0){
                                    return [betelt.indexOf(string) == -1];
                                }else{
                                    return[string];
                                }
                            },
                            onSelect: function(date){
                                kezdo = new Date(date);
                                var msecsInADay = 86400000;
                                var endDate = new Date(kezdo.getTime() + msecsInADay);
                                if(betelt.length>0){
                                    for (let i=0;i<betelt.length;i++){
                                        if(betelt[i]>date){
                                            maxDate = betelt[i];
                                            break;
                                        }else{
                                            maxDate='+2y'
                                        };
                                    };
                                }else{
                                    maxDate='+2y'
                                }

                                //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                                $('#'+(el_to_date+1)+'to_date').datepicker( "option", "minDate", endDate );
                                $('#'+(el_to_date+1)+'to_date').datepicker( "option", "maxDate", maxDate );

                                var to = $('#'+(el_to_date+1)+'to_date').datepicker( "getDate" );
                                if(to != null){
                                    VegCalc(0,"napok");
                                }
                            }
                        });
                        $(newEl).find('#'+(el_to_date+1)+'to_date').removeClass('hasDatepicker').removeData('datepicker').datepicker({
                            onSelect: function(date){
                                var from = $('#'+(el_from_date+1)+'from_date').datepicker( "getDate" );
                                if(from != null){
                                    VegCalc(0,"napok");
                                }
                            }
                        });              
                        $(original_radio).prop('checked', true);
                        countDog++;
                    }else{
                        alert("Sajnos egy alkalommal csak "+kapacitas+" kutyának lehet foglalni.")
                        return false;
                    }
                });
                //kutya hozzáadása vége

                //Árkalkulátor  
                //Alapár lekérdezése
                var alapar = 0;
                var napok_ara = 0;
                var szolg_ara = 0;
                var vegosszeg = 0;
                var call = 0;

                $.ajax({
                    url:"getprice.php",
                    method:"post",   
                    contentType: "application/x-www-form-urlencoded",
                    data:{neve: "alapár"},
                    success: function(ar) {
                        VegCalc(ar,"alapar");
                    },
                    error : function(err){
                        alert(err);
                    }
                });
                
                function VegCalc(data,eset){
                    vegosszeg = 0;
                    call++;
                    switch(eset){
                        case "napok":
                            var napszam = 0;
                            napok_ara = 0;
                            $('.kutya-adatok').find('.idopontok').each(function(){
                                from = $(this).find('.from_date').datepicker('getDate');
                                to = $(this).find('.to_date').datepicker('getDate');
                                napszam = napszam + ((to-from)/1000/(60*60)/24);
                            });
                            if(napszam>0){                            
                            napok_ara = (alapar*napszam);
                            }else{
                                napok_ara = 0;
                            }
                            break;
                        case "alapar":
                            alapar = data;
                            break;
                        case "remove":
                            eleje = data.find('.from_date').datepicker('getDate');
                            vege = data.find('.to_date').datepicker('getDate');
                            del_nap = ((vege-eleje)/1000/(60*60)/24);
                            napok_ara = napok_ara - (alapar*del_nap);
                            szolg = data.find('.szolgaltatas:checked').each(function(){
                                szolg_ara = szolg_ara - parseInt((kategoriak[$(this).val()]));
                            });
                            break;
                        case "szolgaltatas":
                            szolg_ara = szolg_ara + parseInt(data);
                            break;
                        default: console.log("switch");
                    }
                    if(call==2){
                        $('#vegosszeg').css('display','block'); //amikor valamelyik esetet beklikkeli, akkor jelenik meg először
                    }
                    vegosszeg = napok_ara + szolg_ara;
                    $('#vegosszeg').text("Végösszeg: "+vegosszeg+" Ft");
                }
                
                var kategoriak = {};
                $(document).on("click", ".szolgaltatas", function () {
                    kategoria = $(this);
                    neve = kategoria.val();
                    if((neve in kategoriak)){
                        if(kategoria.prop('checked')==true){
                            VegCalc(kategoriak[neve],"szolgaltatas");
                        }else{
                            VegCalc(-kategoriak[neve],"szolgaltatas");
                        }
                    }else{
                        $.ajax({
                            url:"getprice.php",
                            method:"post",   
                            contentType: "application/x-www-form-urlencoded",
                            data:{neve: neve},
                            success: function(ar) {
                                if(kategoria.prop('checked')==true){
                                    VegCalc(ar,"szolgaltatas");
                                }else{
                                    VegCalc(-ar,"szolgaltatas");
                                }
                                addToDict(neve,ar);
                            },
                            error : function(err){
                                alert(err);
                            }
                        });
                    }
                    function addToDict(nev,ertek){
                        kategoriak[nev] = ertek;
                    }
                });

                //Foglalás gomb
                $('#booking-form').submit(function(e){   
                    var osszes = [];
                    for(let m = 0; m < osszes_nap.length; m++){ //azért, hogy ha nem helyes a foglalás, újra töltse be a számokat, ne a csökkentettel számoljon
                        osszes.push(osszes_nap[m]);
                    }
             
                    //Az összes kutya adatait tartalmazó elemek hozzáfűzése a dogs tömbhöz
                    var dogs = new Array();
                    $('.kutya-adatok').each(function(){
                        dogs.push(this);
                    });

                    //gazdi adatok
                    var gazdiveznev = $('#gazdiveznev').val();
                    var gazdikernev = $('#gazdikernev').val();
                    var gazdiemail = $('#gazdiemail').val();
                    var gazditel = $('#gazditel').val();
                    var gazdiirsz = $('#szallitas-li .irsz').val();
                    var gazdimegye = $('#szallitas-li .megye').val();
                    var gazditelepules = $('#szallitas-li .telepules').val();
                    var gazdiutca = $('#szallitas-li .utca').val();
                    var gazdihazszam = $('#szallitas-li .hazszam').val();

                    //kutyák adatai
                    var kutyak = new Array();
                    var van_idopont = true;
                    var foglalhato = true;
                    var kell_cim = false;
                    var van_cim = true;

                    $.each(dogs,function(){
                        var kutyaneve = $(this).find('.kutyaneve').val();
                        var kutyafajtaja = $(this).find('.kutyafajtaja').val();
                        var honapos = $(this).find('.honapos').val();
                        var start = convert($(this).find('.from_date').datepicker('getDate')); //string
                        var end = convert($(this).find('.to_date').datepicker('getDate')); //string
                        var date = new Date();
                        var today = date.getFullYear()+"-"+('0' + (date.getMonth()+1)).slice(-2)+"-"+('0' + date.getDate()).slice(-2);//ezzel megoldható, hogy ugynolyan formátuma legyen, mint a datepicker-es formátum

                        //kapacitás csökkentése
                        var kezdo = new Date($(this).find('.from_date').datepicker('getDate')); //date
                        var veg = new Date($(this).find('.to_date').datepicker('getDate')); //date
                        kezdo.setHours(kezdo.getHours() + 2);
                        veg.setHours(veg.getHours() + 2);
                        if(osszes.length>0){ //már van az adatbázisban foglalás
                            if(kezdo<maxnap && veg>minnap){   //ütközés
                                if(kezdo>minnap){
                                    if(veg<maxnap){ //közép
                                        var kezdoindex = (kezdo-minnap)/1000/(60*60)/24;
                                        var vegindex = (veg-minnap)/1000/(60*60)/24;
                                        for(let k=kezdoindex;k<vegindex;k++){
                                            osszes[k]--;
                                            if(osszes[k]<0){
                                                foglalhato = false;
                                                var melyik = new Date(minnap);
                                                melyik.setDate(melyik.getDate()+k);
                                                alert("Sajnos "+(convert(melyik))+" -ára(ére) csak "+osszes_nap[k]+" szabad hely áll rendelkezésre.");
                                            }
                                        }
                                    }else{ //jobb
                                        var kezdoindex = (kezdo-minnap)/1000/(60*60)/24;
                                        for(let k = kezdoindex ; k < (osszes.length) ; k++){
                                            osszes[k]--;
                                            if(osszes[k]<0){
                                                foglalhato = false;
                                                var melyik = new Date(minnap);
                                                melyik.setDate(melyik.getDate()+k);
                                                alert("Sajnos "+(convert(melyik))+" -ára(ére) csak "+osszes_nap[k]+" szabad hely áll rendelkezésre.");
                                            }
                                        }
                                    }
                                }else{ //bal
                                    var vegindex = (veg-minnap)/1000/(60*60)/24;
                                    for(let k = 0 ; k < vegindex; k++){
                                        osszes[k]--;
                                        if(osszes[k]<0){
                                            foglalhato = false;
                                            alert("Sajnos "+(minnap.getDate()+k)+" -ára(ére) csak "+osszes_nap[k]+" szabad hely áll rendelkezésre.");
                                        }
                                    }
                                } 
                            }
                        }
                        //kapacitás csökkentése vége

                        if(start < today || end < today){ //Azért, hogy ne lehessen üresen hagyni (required nem működik együtt a readonly-val)
                            van_idopont=false;
                            foglalhato=false;
                        }

                        var szall = getSzall($(this).find(':radio:checked').val()); //ha bármely kutyánál kér szállítást,kötelező a gazdi címét megadni
                        function getSzall(szallitas){
                                if (szallitas == "kerek"){
                                    kell_cim = true;
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
                    //each dog vége

                    //Kell-e szállítási cím?
                    $('#szallitas-li input').each(function(){
                        if($(this).val() == ''){
                            van_cim = false;
                        }
                    });

                    if(kell_cim && !van_cim){
                        foglalhato = false;
                    };

                    //Foglalás mentése adatbázisba
                    if(foglalhato){
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
                                gazdimegye : gazdimegye,
                                gazdiutca : gazdiutca,
                                gazdihazszam : gazdihazszam,
                                kutyak : kutyak,
                                vegosszeg : vegosszeg
                            },
                            contentType: "application/x-www-form-urlencoded",
                            beforeSend : function(){
                                $('#submitbooking').hide();
                                $('#toltes').show();
                                },

                            success: function(response){
                                $('#gazdi-adatai').find('input').each(function(){
                                    $(this).val('');
                                });
                                $('#booking-list').find('.kutya-adatok').each(function(){
                                    if($(this).attr('id') != '1kutya-adatai'){
                                        $(this).remove();
                                    }else{
                                        $(this).find(':checkbox:checked').prop('checked', false);
                                        $(this).find(':radio:checked').prop('checked', false);
                                        $(this).find('.variable').val('');
                                    };
                                })

                                $(location).attr('href', 'confirmbooking.php');
                            },
                            error : function(err){
                                alert(err);
                            }
                        });
                    }else if(!van_idopont){
                        alert("A foglaláshoz kötelező megadni a foglalási intervallumot!");
                    }else if (kell_cim && !van_cim){                        
                        alert("Amennyiben szállítást kér bármely kutyának, a gazdi címét meg kell adni!");
                    };

                    return false;
                });
                //Foglalás vége

                //Kutya törlése
                var removable;
                $(document).on('click', '.removeDog', function() {
                    //$(this).parent().remove();
                    removable = $(this).parent();
                    $('#confirm').show();
                    $('#delDog').click(function(){
                        removable.remove();
                        $('#confirm').hide();
                    })
                });

                $('#delDog').click(function(){
                    VegCalc(removable,"remove");
                });

                //username session-ből/cookie-ból
                $('#profilbol').click(function(){
                    <?php   if((isset($_SESSION["login"]) && $_SESSION["login"]==true)){$uname=$_SESSION['username'];?>
                        uname = "<?php echo $uname ?>";
                    <?php }elseif((isset($_COOKIE["loggedin"]) && ($_COOKIE["loggedin"]=='1'))){$uname=$_COOKIE['username'];?>
                        uname = "<?php echo $uname ?>";   
                    <?php }?>
                    
                    $.ajax({
                        url:"userdata.php",
                        method:"post",   
                        data:{ uname : uname
                        },
                        contentType: "application/x-www-form-urlencoded",
                        success: function(response){
                            adatok = JSON.parse(response)
                            $('#gazdiveznev').val(adatok["vezNev"]);                               
                            $('#gazdikernev').val(adatok["kerNev"]);                               
                            $('#gazdiemail').val(adatok["email"]);                               
                            $('#gazditel').val(adatok["telszam"]);                               
                            $('.irsz').val(adatok["iranyitoszam"]);                               
                            $('.megye').val(adatok["megye"]);                               
                            $('.telepules').val(adatok["varos"]);                               
                            $('.utca').val(adatok["utca"]);                               
                            $('.hazszam').val(adatok["hazszam"]);                               
                        },
                        error : function(err){
                            alert(err);
                        }
                    });
                });

                var kutyaim=[];

                $('#kutyaim').one('click', function(){
                    <?php   if((isset($_SESSION["login"]) && $_SESSION["login"]==true)){$uname=$_SESSION['username'];?>
                        uname = "<?php echo $uname ?>";
                    <?php }elseif((isset($_COOKIE["loggedin"]) && ($_COOKIE["loggedin"]=='1'))){$uname=$_COOKIE['username'];?>
                        uname = "<?php echo $uname ?>";   
                    <?php }?>
                    
                    $.ajax({
                        url:"userdata.php",
                        method:"post",   
                        data:{ gazdaja : uname
                        },
                        contentType: "application/x-www-form-urlencoded",
                        success: function(response){
                            kutyaim = JSON.parse(response);
                            if(kutyaim.length>0){ 
                                for (var k=0;k<kutyaim.length;k++){
                                    var elem = "<p class=\"dropdown-item kutya-load\">"+kutyaim[k]["kutyaNev"]+"</p>";
                                    $('#kutyaim-dropdown').append(elem);
                                }
                            }else{
                                var elem = "<p class=\"dropdown-item\">A kutyáim menüpontban felveheti kutyája adatait</p>";
                                $('#kutyaim-dropdown').append(elem);
                            }  
                        },
                        error : function(err){
                            alert(err);
                        }
                    });
                });

                $(document).on("click", ".kutya-load", function () {                       
                    for (var l=0;l<kutyaim.length;l++){
                        if($(this).text()==kutyaim[l]["kutyaNev"]){
                            var kutya_adatok = $(this).closest('.kutya-adatok');
                            kutya_adatok.find('.kutyaneve').val(kutyaim[l]["kutyaNev"]);
                            kutya_adatok.find('.kutyafajtaja').val(kutyaim[l]["fajta"]);
                            kutya_adatok.find('.honapos').val(kutyaim[l]["kor"]);
                            return;
                        }
                    }
                });
            });
            //document.ready vége

            function convert(str) {
                var date = new Date(str),
                    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                    day = ("0" + date.getDate()).slice(-2);
                return [date.getFullYear(), mnth, day].join("-");
            };

            //megerősítés eseménykezelés
            $('#confClose, .cancelbtn').click(function(){
                $('#confirm').hide();
            });

        </script>
    </div>
</div>

