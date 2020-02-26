
var cookies = new Object();


cookies.convertToOriginalVariableType = function (JSONstr) {
    
    try {
        var ret = JSON.parse(JSONstr)[0];
    }
    catch (er) { return JSONstr; }
    return typeof ret !== 'undefined' ? ret : JSONstr;
}
cookies.expiryGMT = function (expDays) {
    if (isNaN(parseInt(expDays))) expDays = 7;
    var now = new Date();
    var expiry = now;
    expiry.setFullYear(now.getFullYear());
    expiry.setMonth(now.getMonth());
    expiry.setDate(now.getDate() + expDays);
    expiry.setHours(0);
    expiry.setMinutes(0);
    return expiry.toGMTString();
};
cookies.save = function (name, value, GMT) {
    document.cookie = name + "=" + value + "; expires=" + GMT + ";";
}
cookies.set = function (name, value, expDays, reserveVariableType) {
    if (reserveVariableType) {
        value = JSON.stringify([value]);
    };
    return this.save(name, value, cookies.expiryGMT(expDays));
};
cookies.setMore = function (dataObj, expDays, reserveVariableTypes) {
    var self = this;
    var GMT = self.expiryGMT(expDays);
    for (var i in dataObj) {
        self.save(i, dataObj[i], GMT, reserveVariableTypes);
    };
};
cookies.remove = function (name) {
     return this.save(name,"", "Thu, 01 Jan 1970 00:00:00 GMT");
};
cookies.removeMore = function (dataArr) {
    for (var i in dataArr) {
        this.remove(dataArr[i]);
    }
};
cookies.removeAll = function () {
    var self = this;
    document.cookie.split(/;\s/).forEach(function (i) {
        self.remove(i.split("=")[0]);
    });
};
cookies.get = function (name) {

    var cookiesSplitBy = ";";
    var str = document.cookie + cookiesSplitBy;
    var reg = new RegExp(name + "=.+?(?=" + cookiesSplitBy + ")", "gi");   
    if (str.search(reg) > -1) {          
        return this.convertToOriginalVariableType(str.match(reg)[0].split("=")[1]);
    }
    return false;
};
cookies.replace = function (name, value) {
    var self = this;
    if (self.get(name)) document.cookie = name + "=" + value;
    else return self.set(name, value);
};
cookies.exists = function (name) {
    return this.get(name) ? true : false;
};
cookies.getAll = function () {
    var retObj = new Object();
    var self = this;
    document.cookie.split(/;\s/).forEach(function (i) {
           var arr = i.split('=');
           retObj[arr[0]] = self.convertToOriginalVariableType(arr[1]);
    });
    return retObj;
}







 
//   cookies.removeAll();               /* remove all old cookie properties */
//console.log(document.cookie);
//  cookies.set("a", 1, 14);           /* set one cookie property (its name, its value, expiry days) */
//   cookies.set("b", ["John","Alex"] , 14, true);     /* set one cookie property with reserved value variable type (array) (its name, its value, expiry days, reserveVariableType) */
//console.log(document.cookie);
//console.log(cookies.get("b"));      /* get value of cookie property with reserved variable type */
//   console.log(cookies.exists("b"))    /* checks if cookie property exists */
//   console.log(cookies.exists("x"))    /* checks if cookie property exists */     
//   cookies.setMore({                  /* set more cookie properties ({data object}, expiry days) */
//     "c": 2,                         
//     "d": 3,                         
//     "e": 4,                         
//     "f": 5,                         
//     "g": 6, 
//     "h":7                        
//   }, 30);
//console.log(document.cookie);                              
//   console.log(cookies.get("c"));     /* get value of cookie property or false if the name doesnt exist */
//   console.log(cookies.getAll());     /* get object of all cookie properties */   
//   cookies.replace("c", 8);          /* replace existing cookie property's value or set if the name doesnt exist */
//console.log(document.cookie);
//   cookies.remove("d");               /* remove existing cookie property */
//console.log(document.cookie);
//   cookies.removeMore(["e", "f"]);    /* remove more existing cookie properties ([properties names array]) */
//console.log(document.cookie);
//   cookies.removeAll();               /* remove all cookie properties */
//console.log(document.cookie);


         

