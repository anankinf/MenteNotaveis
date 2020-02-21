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
		$stmt->prepare("SELECT * FROM activities WHERE id = ?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->bind_result($id,$title,$description,$status,$created_at,$updated_at );
		$stmt->fetch();

		$data = ["id" => $id,"title" => $title,"description" => $description,"status" => $status,"created_at" => $created_at,"updated_at" => $updated_at];
        return $data;

	}

	public function list($module_id){
	    $sql = "SELECT * FROM activities WHERE module_id = {$module_id}";
        $query = $this->db->query($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
	}

	public function insert($insert){
		$stmt = $this->db->stmt_init();
		$stmt->prepare("INSERT INTO activities (title,description,status, module_id) VALUES(?,?,?,?)");
		$stmt->bind_param("sssi",$insert['title'],$insert['description'], $insert['status'], $insert['module_id']);
		$stmt->execute();
		return $stmt->insert_id;
	}

	public function update($update){
		$stmt = $this->db->stmt_init();
		$stmt->prepare("UPDATE activities SET title = ?, description = ?, status = ? WHERE id = ?");
		$stmt->bind_param("sssi",$update['title'],$update['description'], $update['status'], $update['id']);
		
		return $stmt->execute();
	}

	public function delete($id){
		$stmt = $this->db->stmt_init();
		$stmt->prepare("DELETE FROM activities WHERE id = ?");
		$stmt->bind_param("i",$id);
		
		return $stmt->execute();
	}

}

