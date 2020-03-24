function ajax(url, method, callback, payload){
    var xhttp = new XMLHttpRequest();
    url = "http://" + "localhost/viotal/projekty/SPGT-web" + url; //for testing jinak document.root and https://
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
function assign(obj1, obj2){
    obj2.getElementsByClassName("program")[0].getElementsByTagName("p")[0].innerHTML = obj1.program;
}

function callbackf(text){
    var json = JSON.parse(text);
    console.log(json);
    var obj = document.getElementById(json[0].id);
    assign(json[0], obj);
}

function fill(date){
    ajax("/endpoints/zapisy.php","POST","callbackf","{\"date\":\""+ date +"\"}");
}

fill("2020-02-03");
