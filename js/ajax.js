function ajax(url, method, callback, payload){
    var xhttp = new XMLHttpRequest();
    url =  "http://" + location.host + url; //for testing jinak and https://
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4) {
            if(this.status == 200){    
                if(callback != ""){
                    eval(callback + "(\'" + this.responseText + "\')");
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