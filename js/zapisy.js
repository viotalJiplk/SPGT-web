function ajax(url, method, callback, payload){
    var xhttp = new XMLHttpRequest();
    url = "http://" + "localhost/viotal/projekty/SPGT-web" + url; //for testing jinak document.root and https://
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4) {
            if(this.status == 200){    
                if(callback != ""){
                    callback(this.responseText);
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
ajax("/endpoints/zapisy.php","POST","","{\"date\":\"2020-02-03\"}");