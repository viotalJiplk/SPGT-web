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
		<div class="mainContent">			
		</div>
	</body>
</html>
<script src="/js/ajax.js"></script>
<script src="/js/fillzapisy.js"></script>
<script src="/js/getzapis.js"></script>
<script>
	/**
 	* function to add records placeholder in site
 	* @param {object} record object with id of record from server and date of the record
 	*/
	function foreachzapis(record){
    	console.log(record);
    	id = record.id;
    	time = record.time;

    	const rec = document.createElement("div");
    	rec.setAttribute("class", "zasedani");
    	rec.setAttribute("id", id);
    	const result = "<input id=\"checkbox" + id + "\" class=\"checkbox\" type=\"checkbox\" onclick=\"fill("+ id +")\"><label for=\"checkbox"+ id +"\"><div class=\"zasedaniTopWrap\"><div class=\"zasedaniTop\"><span>Zasedání "+ time +"</span><div class=\"dropdownButtonWrap\"><div class=\"dropdownButton\"></div></div></div></div></label><div class=\"zasedaniCont\"></div><!--dyn from callbackf(text)--><!--dont add anything betwen <div></div>--><div onclick=\"edit(" + id + ")\">edit</div>"
    	rec.innerHTML = result;
    	root.appendChild(rec);
	}

	function edit(id){
		console.log(id);
		location.href=encodeURI("editzapis.php?id=" + id);
	}
</script>
<style>
	.contenteditable{
    	border: 1px #000000 solid;
	}
</style>