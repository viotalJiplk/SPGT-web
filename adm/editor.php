<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>SPGT-editor</title>
    </head>
    <body>
        <button type="button" onclick="getselection('heading', 1)">make heading</button>
        <button type="button" onclick="getselection('heading', 0)">unmake heading</button>
        <button type="button" onclick="getselection('bolt', 1)">make bolt</button>
        <button type="button" onclick="getselection('bolt', 0)">unmake bolt</button>
        <div class="contenteditable" contenteditable = "true" style = "">
            <p>This text can be </p><p>abc<b>jutjh</b> edited by the user.</p>
        </div>
    </body>
</html>
<!--css should be done differently-->
<style>
    .contenteditable{
        width: 99%;
        height: 800px;
        border: 1px #000000 solid;
        padding: 10px;
        overflow: scroll;
    }
</style>
<script src="editor.js"></script>