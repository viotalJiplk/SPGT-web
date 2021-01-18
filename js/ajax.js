function ajax(url, method, callback, payload){
    var xhttp = new XMLHttpRequest();
    url =  "https://" + location.host + url;
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4) {
            if(this.status == 200){    
                if(callback != ""){
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