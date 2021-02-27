document.execCommand('defaultParagraphSeparator', false, 'p');
const tags = {
    "b": {
        tagname: "bolt",
        type: "inline",
        in_tags: ["p"],
        replace_tags:[],
    },
    "h1":{
        tag: "heading",
        type: "newline",
        in_tags: [],
        replace_tags:["p"],
    }
};

/**
 * function which get curent selection(s), make documentFragment(s) from it (them) and passes it (them) to edit function and after processing from edit() put documentFragment(s) back to document
 * @param {string} tag - name of tag from tags object (h1, b...). (would be passed to edit())
 * @param {boolean} on - 0 = undotag, 0 != add tag (would be passed to edit())
 */
function getselection(tag, on){
    var selection = window.getSelection();

    for(i = 0; i< selection.rangeCount; i++){
        var range = selection.getRangeAt(i);
        var onew = 1;
        if(range.startContainer != range.endContainer){
            if (range.startContainer.nodeType != 1){
                startContainer = range.startContainer.parentElement;
            }else{
                startContainer = range.startContainer;
            }
            if(range.endContainer.nodeType != 1){
                endContainer = range.endContainer.parentElement;
            }else{
                endContainer = range.endContainer;
            }
            onew = 0;
        }

        documentFragment = range.extractContents();
        if(documentFragment.firstChild != null){
            //var firstchild_before = documentFragment.firstChild.cloneNode(false).outerHTML;

            /*
            code to manipulate selected elements (in documentFragment)
            */
            edit(documentFragment, tag, on);

        
            /*
            end of code to manipulate selected elements (in documentFragment)
            */
            if(onew == 0){
                if(startContainer.tagName == documentFragment.firstChild.tagName){
                    move_childNodes(documentFragment.firstChild, startContainer);
                    documentFragment.firstChild.remove();
                }if(endContainer.tagName == documentFragment.lastChild.tagName){
                    //move_childNodes(documentFragment.lastChild, endContainer);

                    while(documentFragment.lastChild.lastChild != null){
                        endContainer.insertBefore(documentFragment.lastChild.lastChild, endContainer.firstChild);
                    }
                    documentFragment.lastChild.remove();
                }else{
                    range.insertNode(documentFragment.childNodes[documentFragment.childNodes.length - 1])
                }
            }

            //last node first
            while(0 < documentFragment.childNodes.length){
                range.insertNode(documentFragment.childNodes[documentFragment.childNodes.length - 1])                 
            }

            range.detach();
            document.getElementsByClassName("contenteditable")[0].innerHTML = document.getElementsByClassName("contenteditable")[0].innerHTML.replaceAll(/(<[^<,\/]*>)(<[^<]*>)*\s*(<\/[^<]*>)(<\/[^<]*>)*/gm, ""); //this should delete all empety tags should be runed 
            document.getElementById("html").value = document.getElementsByClassName("contenteditable")[0].innerHTML;
        }
    }
}

/**
 * main edit function decides if tag is inline or newline and calls specific function to do the "dirty job" 
 * @param {Node} documentFragment - part of the document to edit.
 * @param {string} tag - name of tag from tags object (h1, b...).
 * @param {boolean} state - 0 = undotag, 0 != add tag
 */
function edit(documentFragment, tag, state){
    if(state != 0){
        var j = null;
        for(i = documentFragment.firstChild; i != null;){
            j = i;
            i = i.nextSibling;
            if(j.nodeType == 3){
                encalpsulatetag(j, tag);
            }
        }
    }
    
    tags[tag].replace_tags.forEach(function(replace_tag){
        if(state != 0){
            var tag_to_replace_selector = replace_tag;
            var replacement = tag;

            //firstandlastnodeon(documentFragment, tag);
        }else{
            var tag_to_replace_selector = tag;
            var replacement = replace_tag;
        }
        documentFragment.querySelectorAll(tag_to_replace_selector).forEach(tag_to_replace => replacetag(tag_to_replace, replacement))
    });
    tags[tag].in_tags.forEach(function(in_tag){
        if(state != 0){
            //firstandlastnodeon(documentFragment, tag);

            documentFragment.querySelectorAll(in_tag).forEach(tag_to_add => addtag(tag_to_add, tag));
        }else{
            documentFragment.querySelectorAll(tag).forEach(tag => removetag(tag));
            //documentFragment.querySelectorAll(in_tag).forEach(in_tag =>in_tag.querySelectorAll(tag).forEach(tag => removetag(tag)));
        }
    });

    if((tags[tag].type == "inline")&&(state == 0)){
        var j = null;
        var i = documentFragment.firstChild;
        while(i != null){
            j = i;
            i = i.nextSibling;
            if(j.nodeType == 1){
                if(j.tagName == tag){
                    encalpsulatetag(j, tags[tag].in_tags[0]);
                }
            }
        }
    }
}

/**
 * textnode to element
 * @param {Node} node - part of the document to edit.
 * @param {string} element_name - name of element from tags object (h1, b...).
 */
function textnode(node, element_name){
    if(node.firstChild.nodeType == 3){
        encalpsulatetag(node.firstChild, element_name);
    }

    if(node.lastChild.nodeType == 3){
        encalpsulatetag(node.lastChild, tag);
    }
}

/**
 * function to replace node with element
 * @param {Node} node node to replace
 * @param {string} replace_element_name nodeName of the replace element
 * @example <p></p> => <h1></h1>
 */
function replacetag(node, replace_element_name){
    var replace_element = document.createElement(replace_element_name);
    move_childNodes(node, replace_element);
    node.parentNode.insertBefore(replace_element, node);
    node.remove();
}

/**
 * moves child nodes from node to node
 * @param {Node} old_node node from which should be childNodes taken from
 * @param {Node} new_node node to which should be childNodes taken to
 */
function move_childNodes (old_node, new_node){
    while(old_node.firstChild != null){
        new_node.appendChild(old_node.firstChild);
    }
}

/**
 * function to add new element into node and transfer all child nodes to new element (as child nodes)
 * @param {Node} node node into which shuld be note added 
 * @param {string} add_element_name nodeName of the created element
 * @example <div><b></b><b></b></div> => <div><p><b></b><b></b></p></div>
 */
function addtag(node, add_element_name){
    var add_element = document.createElement(add_element_name);
    move_childNodes(node, add_element);
    node.appendChild(add_element);
}

/**
 * removes node but all childnodes go to parent node
 * @param {Node} node node which should be removed
 * @example <div><p><b></b></p></div> => <div><b></b></div>
 */
function removetag(node){
    while(node.firstChild != null){
        node.parentNode.insertBefore(node.firstChild, node);
    }
    node.remove();
}

/**
 * crates an element after a node and moves the element into node
 * @param {Node} node node which shuld be encapsulated
 * @param {string} add_element_name nodeName of the created element
 * @example <b></b> => <p><b></b></p>
 */
function encalpsulatetag(node, add_element_name){
    var add_element = document.createElement(add_element_name);
    insertAfter(add_element, node);
    add_element.appendChild(node);
}

/**
 *function oposit to node.insertBefore (inserts node after ref_node)
 *@param {Node} newChild
 *@param {Node} refChild
 *@example <h1></h1> => <h1></h1><p></p>
*/
function insertAfter(newChild, refChild){
    if(refChild.nextSibling == null){
        refChild.parentNode.appendChild(newChild);
    }else{
        refChild.parentNode.insertBefore(newChild, refChild.nextSibling);
    }
}