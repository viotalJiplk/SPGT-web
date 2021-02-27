<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Zápisy</title>
		<link rel="stylesheet" href="/css/zasedani.css">
		<link rel="shortcut icon" href="/favicon.svg" type="image/svg+xml">
		<script>
			document.execCommand('defaultParagraphSeparator', false, 'p');
		</script>
	</head>
	<body>
		<?php require '../include/nav.html';?><!--shuld be replaced with adm nav -->
		<button type="button" onclick="getselection('h1', 1)">make heading</button>
        <button type="button" onclick="getselection('h1', 0)">unmake heading</button>
        <button type="button" onclick="getselection('b', 1)">make bolt</button>
        <button type="button" onclick="getselection('b', 0)">unmake bolt</button>
		<div class="mainContent">			
		</div>
	</body>
</html>
<script src="/js/ajax.js"></script>
<script src="/js/fillzapisy.js"></script>
<script src="/js/getzapis.js"></script>
<script src="editor.js"></script>
<script>
	function push_zapis(json){
		const obj = document.getElementById(json.id).getElementsByClassName("zasedaniCont")[0];
		const hlasovani = json.hlasovani;
	    const dochazkaZ = json.dochazkaZ;
	    const dochazkaD = json.dochazkaD;
	    const program = json.program;
	    const materialy = json.materialy;
	    const zasedaniCont = "<div class=\"program\"><h4>Program Zasedání</h4><div class=\"contenteditable\" contenteditable=\"true\">" + program + "</div></div><div class=\"downloads\"><h4>Ke stažení</h4><button class=\"zapis\">Stáhnout zápis</button><div class=\"materialy\"><h5>Materiály</h5><div class=\"contenteditable\" contenteditable=\"true\">" + materialy +"</div></div></div><div class=\"statistiky\"><div class=\"dochazka\"><h4>Docházka</h4><p>Zástupci tříd: " + dochazkaZ + "</p><p>Dobrovolníci: " + dochazkaD +"</p><div class=\"hlasovani\"><h4>Hlasování</h4>" + hlasovani + "</div></div>";
	    obj.innerHTML = zasedaniCont;
	 }
</script>
<style>
	.contenteditable{
    	border: 1px #000000 solid;
	}
</style>