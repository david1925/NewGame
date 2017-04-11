<?php
	class DBConnection extends PDO {

		private $host;
		private $dbname;
		private $user;
		private $pass;

	    public function __construct($host, $dbname, $user, $pass) {

	    		$this->host = $host;
	    		$this->dbname = $dbname;
	    		$this->user = $user;
	    		$this->pass = $pass;

	    	try {
		        parent::__construct("mysql:host=".$this->host.";dbname=".$this->dbname, 
		        					 $user=$this->user, 
		        					 $pass=$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));		        
		        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    		}
	    	catch(PDOException $pdoe) {
	    		echo "Connection failed. Error: ".$pdoe->getMessage();
	    	}
	    }
	}
?>
