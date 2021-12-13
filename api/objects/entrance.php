<?php
class Entrance {

	private $conn;
	private $table_name = "entrance";

	public $id_postavka;
	public $date_postavka;
	public $kol-vo;
	public $sum_postavka;
	public $id_provider;
	public $id_product;

	public function __construct($db) {
		$this->conn = $db;
	}

	function read() {
		$query = "SELECT `ID_POSTAVKA`,`DATE_POSTAVKA`,`KOL-VO`, `SUM_POSTAVKA`, `ID_PROVIDER`, `ID_PRODUCT` FROM ".$this->table_name;

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}
	function create() {
		$query = "INSERT INTO ".$this->table_name." (`ID_POSTAVKA`,`DATE_POSTAVKA`,`KOL-VO`,`SUM_POSTAVKA`,`ID_PROVIDER`,`ID_PRODUCT`) VALUES (:id_postavka, :date_postavka, :kol-vo, :sum_postavka, :id_provider, :id_product)";

		$stmt = $this->conn->prepare($query);

		$this->id_postavka = htmlspecialchars(strip_tags($this->id_postavka));
		$this->date_postavka = htmlspecialchars(strip_tags($this->date_postavka));
		$this->kol-vo = htmlspecialchars(strip_tags($this->kol-vo));
		$this->sum_postavka = htmlspecialchars(strip_tags($this->sum_postavka));
		$this->id_provider = htmlspecialchars(strip_tags($this->id_provider));
		$this->id_product = htmlspecialchars(strip_tags($this->id_product));

		$stmt->bindParam(":id_postavka", $this->id_postavka);
		$stmt->bindParam(":date_postavka", $this->date_postavka);
		$stmt->bindParam(":kol-vo", $this->kol-vo);
		$stmt->bindParam(":sum_postavka", $this->sum_postavka);
		$stmt->bindParam(":id_provider", $this->id_provider);
		$stmt->bindParam(":id_product", $this->id_product);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
        function update() {
	        $query = "UPDATE ".$this->table_name." SET `DATE_POSTAVKA`=:date_postavka, `KOL-VO`=:kol-vo, `SUM_POSTAVKA`=:sum_postavka, `ID_PROVIDER`=:id_provider, `ID_PRODUCT`=:id_product WHERE ID_POSTAVKA = :id_postavka";

	        $stmt = $this->conn->prepare($query);

	        $this->date_postavka = htmlspecialchars(strip_tags($this->date_postavka));
	        $tihs->kol-vo = htmlspecialchars(strip_tags($this->kol-vo));
			$this->sum_postavka = htmlspecialchars(strip_tags($this->sum_postavka));
			$this->id_provider = htmlspecialchars(strip_tags($this->id_provider));
			$this->id_product = htmlspecialchars(strip_tags($this->id_product));

	        $stmt->bindParam(':date_postavka', $this->date_postavka);
			$stmt->bindParam(':kol-vo', $this->kol-vo);
	        $stmt->bindParam(':sum_postavka', $this->sum_postavka);
			$stmt->bindParam(':id_provider', $this->date_postavka);
			$stmt->bindParam(':id_product', $this->date_postavka);
	        $stmt->bindParam(':id_postavka', $this->id_postavka);

	        id ($stmt->execute()) {
	                return true;
		}
	 
                return false;
	}

	function search($keyword){
	        $query = "SELECT `ID_POSTAVKA`, `DATE_POSTAVKA`, `KOL-VO`, `SUM_POSTAVKA`, `ID_PROVIDER`, `ID_PRODUCT` FROM " . $this->table_name . " ORDER BY `ID_PROVIDER` DESC";

	        $stmt = $this->conn->prepare($query);

	        $keywords=htmlspecialchars(strip_tags($keywords));
	        $keywords = "%{$keywords}%";

	        $stmt->bindParam(1, $keywords);

	        $stmt->execute();

                return $stmt;
        }
	function delete(){
	        $query = "DELETE FROM " . $this->table_name . " WHERE `ID_POSTAVKA` = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->id_postavka=htmlspecialchars(strip_tags($this->id_postavka));

	        $stmt->bindParam(1, $this->id_postavka);

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