<?php
Class dbObj{
	/* Database connection start */
	var $servername = "83.212.105.20";//Database from tsadimas project
	var $username = "it21544";
	var $password = "olympiacos";
	var $dbname = "it21544";
	var $conn;
	function getConnstring() {
		$con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		} else {
			$this->conn = $con;
		}
		return $this->conn;
	}
}

?>
