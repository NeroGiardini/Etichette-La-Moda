<?php
header('Content-Type: text/html; charset=utf-8');
// SOURCE + DESTINATION
$source = $_FILES["file-upload"]["tmp_name"];
$destination = __DIR__.'/upload/'.date("Y-m-d_H-i-s ").$_FILES["file-upload"]["name"];

$error = "";

// CHECK IF FILE ALREADY EXIST
if (file_exists($destination)) {
  $error = "File gia esistente";
}

// ALLOWED FILE EXTENSIONS
if ($error == "") {
  $allowed = ["xlsx", "xls"];
  $ext = strtolower(pathinfo($_FILES["file-upload"]["name"], PATHINFO_EXTENSION));
  if (!in_array($ext, $allowed)) {
    $error = "Tipo file non consentito";
  }
}

// FILE SIZE CHECK
if ($error == "") {
  // 1,000,000 = 1MB
  if ($_FILES["file-upload"]["size"] > 50000000000) {
    $error = "File troppo grande";
  }
}

// ALL CHECKS OK - MOVE FILE
if ($error == "") {
  if (!move_uploaded_file($source, $destination)) {
    $error = "ZZZZZ_Errore copia da $source a $destination";
  }
}

// ERROR OCCURED OR OK?
if ($error == "") {
  
  echo "<script> document.location = 'http://serv-gth/Integrazioni SEPI/Etichette Wildberries/Stampa_Wildberries_articolo.php?nomefile=". str_replace("\\", "\\\\", $destination) ."'; </script>";
} else {
  echo $error;
}

?>