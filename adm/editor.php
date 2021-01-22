<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>SPGT-editor</title>
    </head>
    <body>
        <button type="button" onclick="getselection('h1', 1)">make heading</button>
        <button type="button" onclick="getselection('h1', 0)">unmake heading</button>
        <button type="button" onclick="getselection('b', 1)">make bolt</button>
        <button type="button" onclick="getselection('b', 0)">unmake bolt</button>
        <div class="contenteditable" contenteditable = "true" style = "">
            <p>The</p>
            <h1> quick</h1>
            <p> brown </p>
            <p>fox <b>jumps</b> over</p>
            <p>the <b>lazy</b> dog</p>
            <p>The <b> quick </b> brown </p>
            <p>fox <b>jumps</b> over</p>
            <p>the </p>
            <h1>lazy</h1>
            <p> dog</p>
        </div>
        <textarea id="html">
        </textarea>
    </body>
</html>
<script>
    document.getElementById("html").value = document.getElementsByClassName("contenteditable")[0].innerHTML;
</script>
<!--css should be done differently-->
<style>
    .contenteditable, #html{
        width: 99%;
        height: 800px;
        border: 1px #000000 solid;
        padding: 10px;
        overflow: scroll;
    }
</style>
<script src="editor.js"></script>