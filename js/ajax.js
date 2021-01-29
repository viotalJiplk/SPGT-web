/**
 * function to handle ajax (using XMLHttpRequest object)
 * @param {string} url where to ask for resource url of this server would be the base for exp. https://spgt.online + url - it shuld begin with /
 * @param {string} method http method (GET, POST, PUT etc..)
 * @param {Function} callback function to call after request is done (text of response would be passed as parameter)
 * @param {string} payload payload of httprequest
 * @throws httpStatusCode on error
 */

function ajax(url, method, callback, payload){
    const xhttp = new XMLHttpRequest();
    url =  "https://" + location.host + url;
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4) {
            if(this.status == 200){    
                if(typeof callback == "function"){
                    callback(this.responseText );
                }else{
                    console.log(this.responseText);
                }
            }else{
                throw this.status;
            }
        }
    }
    xhttp.open(method, url , true);
    xhttp.send(payload);
}