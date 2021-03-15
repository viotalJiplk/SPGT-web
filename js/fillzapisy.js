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

// let payload = {
//     "startdate": "2020-1-8",
//     "nrecords": 100
// }


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