<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	//DIGUNAKAN UNTUK MENGGAMBIL ID PADA DATA
	function getUserIdByUsername($username){ //Bener
		$query = "SELECT id FROM tb_user WHERE username = '$username'";
		$this->execute($query);
		$id_user = $this->getResult();
		// echo print_r($id_user) ;
		$x = $id_user["id"];
		// Mengeksekusi query
		return $x;
	}

	function getUserIdByProjectId($project_id){ //Bener
		$query = "SELECT id_owner FROM tb_project WHERE id_project = '$project_id'";
		$this->execute($query);
		$id_user = $this->getResult();
		// echo print_r($id_user) ;
		$x = $id_user["id_owner"];
		// Mengeksekusi query
		return $x;
	}

	function getLastedIdProjectByOwnerId($owner){ //Bener
		$query = "SELECT id_project FROM tb_project WHERE id_owner = '$owner' ORDER BY tb_project.id_project DESC";
		$this->execute($query);
		$hasil = $this->getResult();
		// echo print_r($id_user) ;
		$x = $hasil["id_project"];
		// Mengeksekusi query
		return $x;
	}

	//Mengambil data project
	function getActiveProject(){
		$query = "SELECT * FROM tb_project WHERE status = 1";
		
		// Mengeksekusi query
		return $this->execute($query);
	}

	function getFilteredActiveProject($word){
		$query = "SELECT * FROM tb_project WHERE status = 1 AND title LIKE '%$word%'";
		
		// Mengeksekusi query
		return $this->execute($query);
	}

	function getProject(){//BENER
		$query = "SELECT * FROM tb_project";
		
		// Mengeksekusi query
		return $this->execute($query);
	}

	function getProjectById($id){//BENER
		$query = "SELECT * FROM tb_project WHERE id_project = '$id'";
		
		// Mengeksekusi query
		return $this->execute($query);
	}
	//Digunakan untuk mengupdate status project untuk admin
	function updateStatus($status, $id){//BENER
		$query = "UPDATE tb_project SET status = $status   WHERE tb_project.id_project = $id;";
		
		// Mengeksekusi query
		return $this->execute($query);
	}

	function updateStatusAppliedProject($status, $id){//BENER
		$query = "UPDATE tb_apply_project SET status = $status   WHERE tb_apply_project.id_apply = $id;";
		
		// Mengeksekusi query
		return $this->execute($query);
	}

	function getAppliedProjectByIdProject($id){//BENER
		$query = "SELECT * FROM tb_apply_project WHERE id_project = $id";
		// Mengeksekusi query
		return $this->execute($query);
	}

	function getAppliedProjectByIdApplicant($id){//BENER
		$query = "SELECT * FROM tb_apply_project WHERE id_applicant = $id";
		// Mengeksekusi query
		return $this->execute($query);
	}

	// function getProjectByID($id){//BENER
	// 	$query = "SELECT * FROM tb_project WHERE id_project = $id";
	// 	// Mengeksekusi query
	// 	return $this->execute($query);
	// }



	function getUserByID($id){//BENER
		$query = "SELECT * FROM tb_user WHERE id = $id";
		// Mengeksekusi query
		return $this->execute($query);
	}
	
	
	//ERROR BGSTTT--------------------------------------------------------
	

	//Penambahan data
	function addUserBaru($email , $username, $password){//BENER
		$query = "INSERT INTO tb_user (email , username, password) VALUES ('$email', '$username', '$password');";
		
		// Mengeksekusi query
		$this->execute($query);
	}
	
	function addProjectBaru($usernameOwner , $title, $location , $category, $date_project, $desc){//BENER
		$x = $this->getUserIdByUsername($usernameOwner);
		$query = "INSERT INTO tb_project (id_owner , status, title, location, category, date_project , description) VALUES ('$x' , 0, '$title','$location', '$category', '$date_project', '$desc');";
		
		// // Mengeksekusi query
		$this->execute($query);
	}


	function addApplyProject($id_applicant, $id_project, $id_owner, $full_name, $address, $sex, $birth_date, $phone_num, $req_data, $experiences ){//BENER
		$query = "INSERT INTO tb_apply_project (id_applicant , id_project, id_owner, full_name, address, sex , birth_date,phone_num,req_data,experiences,status) VALUES ('$id_applicant', '$id_project', '$id_owner', '$full_name', '$address', '$sex', '$birth_date', '$phone_num', '$req_data', '$experiences',0 );";
		// // Mengeksekusi query
		$this->execute($query);
	}
	// function update_nilai($id,$par){
	// 	// $query = "UPDATE tb_nilai_tp SET tp1 = '60'   WHERE tb_nilai_tp.id = '$id';";
		
	// 	// Mengeksekusi query
	// 	$this->execute($query);
	// }

}



?>
