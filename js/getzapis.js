
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
