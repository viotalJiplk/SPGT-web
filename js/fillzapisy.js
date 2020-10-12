var root = document.getElementsByClassName("mainContent")[0];
function callbackfall(text){
    var json = JSON.parse(text);
    console.log(json);
    
    json.forEach(record => foreachzapis(record));
    //root.appendChild(textnode);
    
}
function foreachzapis(record){
    console.log(record);
    id = record.id;
    time = record.time;

    var rec = document.createElement("div");
    rec.setAttribute("class", "zasedani");
    rec.setAttribute("id", id);
    var result = "<input id=\"checkbox" + id + "\" class=\"checkbox\" type=\"checkbox\" onclick=\"fill("+ id +")\"><label for=\"checkbox"+ id +"\"><div class=\"zasedaniTopWrap\"><div class=\"zasedaniTop\"><span>Zasedání "+ time +"</span><div class=\"dropdownButtonWrap\"><div class=\"dropdownButton\"></div></div></div></div></label><div class=\"zasedaniCont\"></div><!--dyn from callbackf(text)--><!--dont add anything betven <div></div>-->"
    rec.innerHTML = result;
    root.appendChild(rec)
}
ajax("/endpoints/zapisygetall.php","GET","callbackfall","");
