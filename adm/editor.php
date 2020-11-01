<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>SPGT-editor</title>
    </head>
    <body>
        <button type="button" onclick="getselection()">select</button>
        <div class="contenteditable" contenteditable = "true" style = "">
            <p>This text can be </p><p>abc<b>jutjh</b> edited by the user.</p>
        </div>
    </body>
</html>
<style>
    .contenteditable{
        width: 99%;
        height: 200px;
        border: 1px #000000 solid;
        padding: 10px;
        overflow: scroll;
    }
</style>
<script>
    var rangearray;
    function getselection(){
        var selection = window.getSelection();

        for(i = 0; i< selection.rangeCount; i++){
            var firstnode;
            var endnode;
            var range = selection.getRangeAt(i);

            firstnode = range.startContainer;
            endnode = range.endContainer;
            console.log(firstnode);
            console.log(endnode);

            documentFragment = range.extractContents();
            /*
            code to manipulate selected elements (in documentFragment)
            */
            range.insertNode(documentFragment)
        }
    }
</script>