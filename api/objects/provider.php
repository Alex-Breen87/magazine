<?php
class Student {

	private $conn;
	private $table_name = "provider";

	public $id_provider;
	public $name;
	public $address;
	public $phone;
	public $shet;

	public function __construct($db) {
		$this->conn = $db;
	}

	function read() {
		$query = "SELECT `ID_PROVIDER`,`NAME`,`ADDRESS`,`PHONE`,`SHET` FROM ".$this->table_name;

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}
	function create() {
		$query = "INSERT INTO ".$this->table_name." (`ID_PROVIDER`,`NAME`,`ADDRESS`,`PHONE`,`SHET`) VALUES (:id_provider, :name, :surname, :address, :phone, :shet)";

		$stmt = $this->conn->prepare($query);

		$this->id_provider = htmlspecialchars(strip_tags($this->id_provider));
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->address = htmlspecialchars(strip_tags($this->address));
		$this->phone = htmlspecialchars(strip_tags($this->phone));
		$this->shet = htmlspecialchars(strip_tags($this->shet));

		$stmt->bindParam(":id_provider", $this->id_provider);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":address", $this->address);
		$stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":shet", $this->shet);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
	function search($keyword){
	        $query = "SELECT `ID_PROVIDER`, `NAME`, `ADDRESS`, `PHONE`, `SHET` FROM " . $this->table_name . " ORDER BY `NAME` DESC";

	        $stmt = $this->conn->prepare($query);

	        $keywords=htmlspecialchars(strip_tags($keywords));
	        $keywords = "%{$keywords}%";

	        $stmt->bindParam(1, $keywords);

	        $stmt->execute();

                return $stmt;
    }
	function delete(){
	        $query = "DELETE FROM " . $this->table_name . " WHERE `ID` = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->id=htmlspecialchars(strip_tags($this->id));

	        $stmt->bindParam(1, $this->id);

	        if ($stmt->execute()) {
		        return true;
		}
	 
	        return false;
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