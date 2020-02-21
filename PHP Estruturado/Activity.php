<?php 

class Activity
{
	
	private $db;
	
	function __construct(Mysqli $mysqli)
	{
		$this->db =  $mysqli;
	}

	public function find($id){
		$stmt = $this->db->stmt_init();
		$stmt->prepare("SELECT * FROM modules WHERE id = ?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->bind_result($id,$title,$description,$status,$created_at,$updated_at );
		$stmt->fetch();

		$data = ["id" => $id,"title" => $title,"description" => $description,"status" => $status,"created_at" => $created_at,"updated_at" => $updated_at];
        return $data;

	}

	public function list($order = null){
		if($order){
			$sql = "SELECT * FROM modules ORDER BY {$order}";
		}else{
			$sql = "SELECT * FROM modules";
		}		

		$query = $this->db->query($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}

	public function insert($insert){
		$stmt = $this->db->stmt_init();
		$stmt->prepare("INSERT INTO modules(title,description,status) VALUES(?,?,?)");
		$stmt->bind_param("sss",$insert['title'],$insert['description'], $insert['status']);
		$stmt->execute();
		return $stmt->insert_id;
	}

	public function update($update){
		$stmt = $this->db->stmt_init();
		$stmt->prepare("UPDATE modules SET title = ?, description = ?, status = ? WHERE id = ?");
		$stmt->bind_param("sssi",$update['title'],$update['description'], $update['status'], $update['id']);
		
		return $stmt->execute();
	}

	public function delete($id){
		$stmt = $this->db->stmt_init();
		$stmt->prepare("DELETE FROM modules WHERE id = ?");
		$stmt->bind_param("i",$id);
		
		return $stmt->execute();
	}

}

