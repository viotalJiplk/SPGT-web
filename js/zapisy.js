function ajax(url, method, callback){
    var xhttp = new XMLHttpRequest();
    url = "http://" + document.domain + url;
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
    xhttp.send();
}
ajax("","POST","");