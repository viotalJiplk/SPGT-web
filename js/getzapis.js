
/**
 * function for filling record - processing HttpResponse
 * @param {string} text text from HttpResponse
 */
function callbackzapis_all(text){
    const json = JSON.parse(text);
    const result = json[0];
    push_zapis(result);
}

/**
 * function for filling record - calling endpoint
 * @param {string} id id of record to fill
 */
function fill(id){
    if(!(document.getElementById(id).getElementsByClassName("zasedaniCont")[0].hasChildNodes())){
        let payload = {
            "id": Number(id)
        }
        ajax("/endpoints/zapisy.php","POST", callbackzapis_all, JSON.stringify(payload));
    }
}

function push_zapis(json){
    const obj = document.getElementById(json.id).getElementsByClassName("zasedaniCont")[0];
    const hlasovani = json.hlasovani;
    const dochazkaZ = json.dochazkaZ;
    const dochazkaD = json.dochazkaD;
    const program = json.program;
    const materialy = json.materialy;
    const zasedaniCont = "<div class=\"program\"><h4>Program Zasedání</h4><div>" + program + "</div></div><div class=\"downloads\"><h4>Ke stažení</h4><button class=\"zapis\">Stáhnout zápis</button><div class=\"materialy\"><h5>Materiály</h5><div>" + materialy +"</div></div></div><div class=\"statistiky\"><div class=\"dochazka\"><h4>Docházka</h4><p>Zástupci tříd: " + dochazkaZ + "</p><p>Dobrovolníci: " + dochazkaD +"</p><div class=\"hlasovani\"><h4>Hlasování</h4>" + hlasovani + "</div></div>";
    obj.innerHTML = zasedaniCont;
}