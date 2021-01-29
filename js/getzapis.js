
/**
 * function for filling record from HttpResponse
 * @param {string} text text from HttpResponse
 */
function callbackzapis_all(text){
    const json = JSON.parse(text);
    const obj = document.getElementById(json[0].id).getElementsByClassName("zasedaniCont")[0];
    const result = json[0];
    const hlasovani = result.hlasovani;
    const dochazkaZ = result.dochazkaZ;
    const dochazkaD = result.dochazkaD;
    const program = result.program;
    const materialy = result.materialy;
    const zasedaniCont = "<div class=\"program\"><h4>Program Zasedání</h4>" + program + "</div><div class=\"downloads\"><h4>Ke stažení</h4><button class=\"zapis\">Stáhnout zápis</button><div class=\"materialy\"><h5>Materiály</h5>" + materialy +"</div></div><div class=\"statistiky\"><div class=\"dochazka\"><h4>Docházka</h4><p>Zástupci tříd: " + dochazkaZ + "</p><p>Dobrovolníci: " + dochazkaD +"</p></div><div class=\"hlasovani\"><h4>Hlasování</h4>" + hlasovani + "</div></div>";
    obj.innerHTML = zasedaniCont;
    
}

/**
 * function for filling record
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
