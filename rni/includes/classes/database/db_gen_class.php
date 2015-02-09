<?

class extendsClassDB extends classDB {
	function extendsClassDB() {
		global $global_config;
		$this->classDB();
		$this->dbServer 	= $global_config["DBHost"];
		$this->dbDatabase 	= $global_config["DBDatabaseName"];
		$this->dbUser 		= $global_config["DBUserName"];
		$this->dbPass 		= $global_config["DBPassword"];
		$this->tblPrefix	= $global_config["DBTablePrefix"];
	}
}

?>