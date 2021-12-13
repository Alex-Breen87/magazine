<?php
class Main {

	private $conn;
	private $table_name = "main";

	public $main_name;
	public $name;
	public $address;
	public $phone;
	public $KPP;
	public $INN;

	public function __construct($db) {
		$this->conn = $db;
	}

	function read() {
		$query = "SELECT `MAIN_NAME`,`NAME`,`ADDRESS`,`PHONE`,`KPP`,`INN` FROM ".$this->table_name;

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}
        public function count(){
	        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

	        $stmt = $this->conn->prepare( $query );
	        $stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

	        return $row['total_rows'];
	}	
}
?>