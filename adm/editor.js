var rangearray;
function getselection(funct, on){
    var selection = window.getSelection();

    for(i = 0; i< selection.rangeCount; i++){
        var firstnode;
        var endnode;
        var range = selection.getRangeAt(i);

        firstnode = range.startContainer;
        endnode = range.endContainer;
        console.log(firstnode);
        console.log(endnode);
        console.log();

        documentFragment = range.extractContents();
        /*
        code to manipulate selected elements (in documentFragment)
        */
        if (funct == "heading"){
            heading(documentFragment, on);
        }else if(funct == "bolt"){
            bolt(documentFragment, on);
        }
        
        /*
        end of code to manipulate selected elements (in documentFragment)
        */
        //last node first
        console.log(firstnode);
        console.log(endnode);
        while(0 < documentFragment.childNodes.length){
            range.insertNode(documentFragment.childNodes[documentFragment.childNodes.length - 1])                 
        }
        document.getElementsByClassName("contenteditable")[0].innerHTML = document.getElementsByClassName("contenteditable")[0].innerHTML.replaceAll(/(<[^<,/]*>)(<[^<]*>)*\s*(<\/[^<]*>)(<\/[^<]*>)*/gm, ""); //this should delete all empety tags
    }
}

function replacetag(html, tags, replace, check_rep){
    if(tags.length > replace.length){
        throw "not enought replace tags (replace tag function)"
    }
    for(i2 = 0; i2 < tags.length; i2++){
        var rep_openingtag = "";
        var rep_closingtag = "";

        if (!(replace[i2] == "")){
            rep_openingtag = "<" + replace[i2] + ">";
            rep_closingtag = rep_openingtag.replaceAll(/</g, "</");
        }
        if(check_rep == 0){
            var openingtag = new RegExp("<" + tags[i2] + ">", "g");
            var closingtag = new RegExp("</" + tags[i2] + ">", "g");
        }else{
            var openingtag = new RegExp("<" + tags[i2] + ">(?!" + "<" + replace[i2] + ">)", "g");
            var closingtag = new RegExp("</" + tags[i2] + ">(?!" + "</" + replace[i2] + ">)", "g");
        }

        html = html.replaceAll(openingtag, rep_openingtag);
        html = html.replaceAll(closingtag, rep_closingtag);
    }
    return html;
}

function heading(documentFragment, on){
    if((documentFragment.childElementCount == 0 ) && (documentFragment.childNodes.length == 1)){
        var h1 = document.createElement("h1");
        h1.innerHTML =  documentFragment.childNodes[0].nodeValue;
        documentFragment.replaceChild(h1, documentFragment.childNodes[0])
        documentFragment.appendChild(h1);
    }else{
        for(i = 0; i < documentFragment.childElementCount; i++){
            var html = documentFragment.children[i].outerHTML;
            if(on == 1){
                html = replacetag(html, ["p"], ["h1"], 1);
            }else if(on == 0){
                html = replacetag(html, ["h1"], ["p"], 1);
            }else{
                throw "set valid input"
            }
            documentFragment.children[i].outerHTML = html;
        }
    }

    return documentFragment;
}

function bolt(documentFragment, on){
    for(i = 0; i < documentFragment.childElementCount; i++){
        var html = documentFragment.children[i].outerHTML;
        if(on == 1){
            html = replacetag(html, ["p"], ["p><b"], 1);
        }else if(on == 0){
            html = replacetag(html, ["b"], [""], 1);
        }else{
            throw "set valid input"
        }
        documentFragment.children[i].outerHTML = html;
    }

    return documentFragment;
}