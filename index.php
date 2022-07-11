<html>
	<head>
		<meta charset="utf-8"/>
		<title>Stampa etichette La Moda</title>
		<script src="1-simple-upload.js"></script>
		<link rel="stylesheet" href="./css/index.css?<?php echo time(); ?>">
	</head>
	<body>
		<div class="filler"></div>
		<div id="titolo">Carica file Excel etichette La Moda</div>
		<div class="filler2"></div>
		<div class="testo">Zebra GK420T RETAIL "2", ETICHETTE 100X59</div>
		<div class="filler2"></div>
		<div class="testo_rosso">AGGIUNGERE QUANTITA' ETICHETTE SU COLONNA "H" DEL FILE EXCEL</div>
		<div class="filler"></div>
		<form id="upload_s" action="simple-upload.php" method="post" enctype="multipart/form-data">
			<input name="file-upload" type="file" id="file-upload" size="20" >
			<input name="seleziona" type="hidden" value="1">
			<div class="filler2"></div>
			<input id="submit" type="submit" name="Submit" value="Upload" >
		</form>
		<div class="filler"></div>
		<div id="uploader">Oppure trascina QUI il file</div>
		</form>
	</body>
</html>