window.addEventListener("load", function(){
  // GET THE DROP ZONE
  var uploader = document.getElementById('uploader');
  
  // STOP THE DEFAULT BROWSER ACTION FROM OPENING THE FILE
  uploader.addEventListener("dragover", function (e) {
    e.preventDefault();
    e.stopPropagation();
  });

  // ADD OUR OWN UPLOAD ACTION
  uploader.addEventListener("drop", function (e) {
    e.preventDefault();
    e.stopPropagation();
    // RUN THROUGH THE DROPPED FILES + AJAX UPLOAD
    for (var i = 0; i < e.dataTransfer.files.length; i++) {
      var xhr = new XMLHttpRequest(),
          data = new FormData();
      data.append('file-upload', e.dataTransfer.files[i]);
      xhr.open('POST', 'simple-upload.php', true);
      xhr.onload = function (e) {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            // OK - Do something
            //alert("Upload OK!");
			//alert('http://serv-gth/ControlloListini/controllo_fornitore.php?nomefile=' + xhr.responseText);
			window.location.href = 'http://serv-gth/Integrazioni SEPI/Etichette Wildberries/Stampa_Wildberries_articolo.php?nomefile=' + xhr.responseText + '&SID=' + Math.random();
          } else {
            // ERROR - Do something
            alert("Upload error!");
          }
        }
      };
      xhr.onerror = function (e) {
        // ERROR - Do something
        alert("Upload error!");
      };
      xhr.send(data);
	  
    }
    
  });


});