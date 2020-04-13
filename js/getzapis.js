
function callbackf(text){
    var json = JSON.parse(text);
    var obj = document.getElementById(json[0].id).getElementsByClassName("zasedaniCont")[0];
    var result = json[0];
    var hlasovani = result.hlasovani;
    var dochazkaZ = result.dochazkaZ;
    var dochazkaD = result.dochazkaD;
    var program = result.program;
    var materialy = result.materialy;
    var zasedaniCont = "<div class=\"program\"><h4>Program Zasedání</h4>" + program + "</div><div class=\"downloads\"><h4>Ke stažení</h4><button class=\"zapis\">Stáhnout zápis</button><div class=\"materialy\"><h5>Materiály</h5>" + materialy +"</div></div><div class=\"statistiky\"><div class=\"dochazka\"><h4>Docházka</h4><p>Zástupci tříd: " + dochazkaZ + "</p><p>Dobrovolníci: " + dochazkaD +"</p></div><div class=\"hlasovani\"><h4>Hlasování</h4>" + hlasovani + "</div></div>";
    obj.innerHTML = zasedaniCont;
    
}

function fill(id){
    if(!(document.getElementById(id).getElementsByClassName("zasedaniCont")[0].hasChildNodes())){
        ajax("/endpoints/zapisy.php","POST","callbackf","{\"id\":"+ id +"}");
    }
}
