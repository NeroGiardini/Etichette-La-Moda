<?php
	class Database {
		private static $link = null ;

		private static function getLink(){
			if(self :: $link){
				return self :: $link ;
			}

			$ini = __DIR__ ."\config.ini" ;
			$parse = parse_ini_file ($ini, true);

			$db_settings = $parse['db_settings'];
			$db_options = $parse['db_options'];
			$db_attributes = $parse['db_attributes'];
			
			if($db_settings['db_driver'] == 'sqlsrv')$dsn = "sqlsrv:Server=". $db_settings['db_host'] .",". $db_settings['db_port'] .";Database=". $db_settings['db_name'];
			
			self :: $link = new PDO ($dsn, $db_settings['db_user'], $db_settings['db_password'], $db_options) ;

			foreach($db_attributes as $k => $v){
				self :: $link -> setAttribute(constant("PDO::".$k), constant("PDO::".$v )) ;
			}
			
			return self :: $link ;
		}

		public static function __callStatic($name, $arguments){
			$callback = array(self :: getLink(), $name);
			return call_user_func_array($callback, $arguments);
		}
	}
	
	// Esempio esecuzione query
	
	// $stmt = Database :: prepare("SELECT 1");
	// $stmt -> execute();
	
	// or
	
	// $stmt = Database :: query("SELECT 1");
	
	// then
	
	// print_array ("",$stmt -> fetchAll ());
	// $stmt -> closeCursor();
	
	
	// Per info:  http://php.net/manual/en/class.pdo.php
?>