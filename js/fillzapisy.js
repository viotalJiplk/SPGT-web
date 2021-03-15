var root = document.getElementsByClassName("mainContent")[0];

/**
 * function to add records placeholder (prepares clickable object for them) in website after httpResponse was recived
 * @param {string} text text from httpRequest 
 */
function callbackzapis_fill(text){
    var json = JSON.parse(text);
    console.log(json);
    
    json.forEach(record => foreachzapis(record));
}
/**
 * function to add records placeholder in site
 * @param {object} record object with id of record from server and date of the record
 */
function foreachzapis(record){
    console.log(record);
    id = record.id;
    time = record.time;

    const rec = document.createElement("div");
    rec.setAttribute("class", "zasedani");
    rec.setAttribute("id", id);
    const result = "<input id=\"checkbox" + id + "\" class=\"checkbox\" type=\"checkbox\" onclick=\"fill("+ id +")\"><label for=\"checkbox"+ id +"\"><div class=\"zasedaniTopWrap\"><div class=\"zasedaniTop\"><span>Zasedání "+ time +"</span><div class=\"dropdownButtonWrap\"><div class=\"dropdownButton\"></div></div></div></div></label><div class=\"zasedaniCont\"></div><!--dyn from callbackf(text)--><!--dont add anything betwen <div></div>-->"
    rec.innerHTML = result;
    root.appendChild(rec);
}

// let payload = {
//     "startdate": "2020-1-8",
//     "nrecords": 100
// }

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

let datum = new Date();
let payload = {
    "startdate": datum.getUTCFullYear() + "-" + datum.getUTCMonth() + "-" + datum.getUTCDay(),
    "nrecords": 100
}

/**
 * function to add records to webpages
 * @param {Object} payload control structure
 */

function fillzapis(payload){
    ajax("/endpoints/zapisy.php","POST", callbackzapis_fill, JSON.stringify(payload));
}

fillzapis(payload);