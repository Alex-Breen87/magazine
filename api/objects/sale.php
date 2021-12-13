<?php
class Student {

	private $conn;
	private $table_name = "students";

	public $id;
	public $name;
	public $surname;

	public function __construct($db) {
		$this->conn = $db;
	}

	function read() {
		$query = "SELECT `ID_SALE`,`DATE`,`KOL-VO`,`SUM`,`ID_PRODUCT` FROM ".$this->table_name;

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}
	function create() {
		$query = "INSERT INTO ".$this->table_name." (`ID_SALE`,`DATE`,`KOL-VO`,`SUM`,`ID_PRODUCT`) VALUES (:id_sale, :date, :kol-vo, :sum, :id_product)";

		$stmt = $this->conn->prepare($query);

		$this->id_sale = htmlspecialchars(strip_tags($this->id_sale));
		$this->date = htmlspecialchars(strip_tags($this->date));
		$this->kol-vo = htmlspecialchars(strip_tags($this->kol-vo));
		$this->sum = htmlspecialchars(strip_tags($this->sum));
		$this->id_product = htmlspecialchars(strip_tags($this->id_product));

		$stmt->bindParam(":id_sale", $this->id_sale);
		$stmt->bindParam(":date", $this->date);
		$stmt->bindParam(":kol-vo", $this->surname);
		$stmt->bindParam(":sum", $this->sum);
		$stmt->bindParam(":id_product", $this->id_product);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
        function update() {
	        $query = "UPDATE ".$this->table_name." SET `DATE`=:date, `KOL-VO`=:kol-vo, `SUM`=:sum, `ID_PRODUCT`=:id_product WHERE ID_SALE = :id_sale";

	        $stmt = $this->conn->prepare($query);

	        $this->name = htmlspecialchars(strip_tags($this->name));
	        $tihs->surname = htmlspecialchars(strip_tags($this->surname));

	        $stmt->bindParam(':date', $this->date);
	        $stmt->bindParam(':kol-vo', $this->kol-vo);
			$stmt->bindParam(':sum', $this->sum);
			$stmt->bindParam(':id_product', $this->id_product);
	        $stmt->bindParam(':id_sale', $this->id_sale);

	        id_sale ($stmt->execute()) {
	                return true;
		}
	 
                return false;
	}

	function search($keyword){
	        $query = "SELECT `ID_SALE`, `DATE`, `KOL-VO`, `SUM`, `ID_PRODUCT` FROM " . $this->table_name . " ORDER BY `ID_PRODUCT` DESC";

	        $stmt = $this->conn->prepare($query);

	        $keywords=htmlspecialchars(strip_tags($keywords));
	        $keywords = "%{$keywords}%";

	        $stmt->bindParam(1, $keywords);

	        $stmt->execute();

                return $stmt;
        }
	function delete(){
	        $query = "DELETE FROM " . $this->table_name . " WHERE `ID_SALE` = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->id_sale=htmlspecialchars(strip_tags($this->id_sale));

	        $stmt->bindParam(1, $this->id_sale);

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