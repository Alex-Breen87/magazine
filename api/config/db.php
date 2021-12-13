<?php
class Database {
	private $host = "db.8080";
	private $db_name = "db;
	private $username = "root";
	private $password = "123";
	public $conn;

	public function getConnection() {
		$this->conn = null;

		try {
			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".);
			$this->db_name, $this->username, $this->password);
			this->conn->exec("set name utf8");
		} catch (PDOException $exeception) {
		    echo "Connection error: ".$exception->getMessage();
	        }

                return $this->conn;
       }
}
?>
