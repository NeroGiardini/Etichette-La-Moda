<?php
    header('Content-Type: text/html; charset=utf-8');
    //include_once(__DIR__ . '../conf/database.php');
    require_once('simplexlsx.class.php');
    $nomefile = $_GET['nomefile'];
    //echo $nomefile;

    // //Impostazioni 50x36 ordini
    // $comando .= '
    // ~SD12 
    // ~TA000
    // ~JSN
    // ^XA
    // ^SZ2
    // ^PW400
    // ^LL288
    // ^POI
    // ^PR2,2
    // ^PMN
    // ^MNY
    // ^LS0
    // ^MTT
    // ^MMT,N
    // ^MPE
    // ^XZ
    // ^XA^LRN^CI0^XZ
    // ^XA^CWZ,E:TT0003M_.FNT^FS^XZ
    // ';

    //Impostazioni 100X59 EAC
    $comando .= '
    ~SD15 
    ~TA000
    ~JSN
    ^XA
    ^SZ2
    ^PW806
    ^LL480
    ^PON
    ^PR2,2
    ^PMN
    ^MNY
    ^LS0
    ^MTT
    ^MMT,N
    ^MPE
    ^XZ
    ^XA^LRN^CI0^XZ
    ^XA^CWZ,E:TT0003M_.FNT^FS^XZ
    ';

    $offset= 10;
    $offset_v= 5;

   
    $Excel = new SimpleXLSX($nomefile);

	if ($Excel->success()) {
		$excelRows = $Excel->rows();		
		$data = "";
		foreach($excelRows as $rowId => $rowValue){
            if(($rowValue[0] != '')&&($rowValue[0] != "articolo")&&($rowValue[0] != "АРТИКУЛ:"))
                {
                $qta = intval($rowValue[7])*1;
                if ($qta == 0) $qta = 1;
                $comando.= "
                ^XA
                ^FO".$offset.",". (0 + $offset_v) ."^CI28^AZN,24,20^FDТорговая марка:^FS
                ^FO".$offset.",". (0 + $offset_v) ."^CI28^AZN,25,20^FDТорговая марка: Nero Giardini^FS
                ^FO".$offset.",". (0 + $offset_v) ."^CI28^AZN,26,20^FDТорговая марка:^FS
                ^FO".$offset.",". (40 + $offset_v) ."^CI28^AZN,24,20^FDАРТИКУЛ:^FS
                ^FO".$offset.",". (40 + $offset_v) ."^CI28^AZN,25,20^FDАРТИКУЛ: ".preg_replace('/[^a-zA-Z0-9. ]/s', '', trim($rowValue[0]))."^FS
                ^FO".$offset.",". (40 + $offset_v) ."^CI28^AZN,26,20^FDАРТИКУЛ:^FS
                ^FO".$offset.",". (80 + $offset_v) ."^CI28^AZN,24,20^FDМатериал верха:^FS
                ^FO".$offset.",". (80 + $offset_v) ."^CI28^AZN,25,20^FDМатериал верха:^FS
                ^FO".$offset.",". (80 + $offset_v) ."^CI28^AZN,26,20^FDМатериал верха:^FS
                ^FO".$offset.",". (120 + $offset_v) ."^CI28^AZN,25,20^FD".trim($rowValue[1])."^FS
                ^FO".$offset.",". (160 + $offset_v) ."^CI28^AZN,24,20^FDМатериал подкладки:^FS
                ^FO".$offset.",". (160 + $offset_v) ."^CI28^AZN,25,20^FDМатериал подкладки:^FS
                ^FO".$offset.",". (160 + $offset_v) ."^CI28^AZN,26,20^FDМатериал подкладки:^FS
                ^FO".$offset.",". (200 + $offset_v) ."^CI28^AZN,25,20^FD".trim($rowValue[2])."^FS
                ^FO".$offset.",". (240 + $offset_v) ."^CI28^AZN,24,20^FDМатериал стельки:^FS
                ^FO".$offset.",". (240 + $offset_v) ."^CI28^AZN,25,20^FDМатериал стельки:^FS
                ^FO".$offset.",". (240 + $offset_v) ."^CI28^AZN,26,20^FDМатериал стельки:^FS
                ^FO".$offset.",". (280 + $offset_v) ."^CI28^AZN,25,20^FD".trim($rowValue[3])."^FS
                ^FO".$offset.",". (320 + $offset_v) ."^CI28^AZN,24,20^FDМатериал подошвы:^FS
                ^FO".$offset.",". (320 + $offset_v) ."^CI28^AZN,25,20^FDМатериал подошвы:^FS
                ^FO".$offset.",". (320 + $offset_v) ."^CI28^AZN,26,20^FDМатериал подошвы:^FS
                ^FO".$offset.",". (360 + $offset_v) ."^CI28^AZN,25,20^FD".trim($rowValue[4])."^FS
                ^FO".$offset.",". (400 + $offset_v) ."^CI28^AZN,24,20^FDИзготовитель:^FS
                ^FO".$offset.",". (400 + $offset_v) ."^CI28^AZN,25,20^FDИзготовитель: ".trim($rowValue[5])."^FS
                ^FO".$offset.",". (400 + $offset_v) ."^CI28^AZN,26,20^FDИзготовитель:^FS
                ^FO".$offset.",". (440 + $offset_v) ."^CI28^AZN,24,20^FDЮр. Адрес:^FS
                ^FO".$offset.",". (440 + $offset_v) ."^CI28^AZN,25,20^FDЮр. Адрес: ".trim($rowValue[6])."^FS
                ^FO".$offset.",". (440 + $offset_v) ."^CI28^AZN,26,20^FDЮр. Адрес:^FS
                ^PQ".$qta."
                ^XZ";
                }

                //if($rowId == 4) break;
            
		}
        echo "<pre>";
        //print_r($excelRows);
		
	} else echo 'Excel error: '. $Excel->error();

    //echo $comando;

	//$host = "192.168.4.217"; // Zebra GK420T Retail
    $host = "192.168.4.55"; // Zebra GK420T Retail 2
	//$host = "192.168.4.107"; // Zebra GK420T Test IT
	$port = "9100";

    echo "<pre>";
	echo "Creazione socket:\n";
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($socket === false) {
		echo "socket_create() failed, reason:\n";
        echo socket_strerror(socket_last_error()) . "\n";
	} else {
        echo " - OK\n\n";
        echo "Connessione a ". $host ." sulla porta ". $port .":\n";
        $result = socket_connect($socket, $host, $port);
        if ($result === false) {
            echo "socket_connect() failed, reason:\n";
            echo socket_strerror(socket_last_error($socket)). "\n";
        }
        usleep(1000);
        if(socket_write($socket, $comando, strlen($comando)) === false) echo socket_strerror(socket_last_error($socket));

    }

        socket_close($socket);
    
    
    echo "</pre>";
	echo "<button onclick = \"document.location = './index.php';\">Home</button>";

?>