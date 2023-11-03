<?php
session_start();
class Customer{

	public static function addCustomer($data){
		require "../config/db.php";
		$date = date("Y-m-d H:i");
		if(empty($data["firstname"]) || empty($data["firstname"]) || empty($data["phone"]) || empty($data["il"]) || empty($data['ilce']) ||  empty($data["address"]) ){
			echo json_encode(["status" => "warning", "message"=>"Lütfen boş alan bırakmayın!"]);
		}else{
			$query = $db->query("SELECT * FROM customers WHERE phone = '{$data["phone"]}' ")->fetch(PDO::FETCH_ASSOC);
			if($query){
				echo json_encode(["status" => "warning", "message"=>"Bu telefon zaten kayıtlı!"]);
			}else{
				$query = $db->prepare("INSERT INTO customers SET
					firstname = ?,
					lastname = ?,
					phone = ?,
					address = ?,
					il = ?,
					ilce = ?,
					status = ?,
					created_at = ?
					");
					$insert = $query->execute(array(
					    $data["firstname"],
					    $data["lastname"],
					    $data["phone"],
					    $data["address"],
					    $data['il'],
					    $data['ilce'],
					    2,
					    $date
					));
					if ( $insert ){
					    $last_id = $db->lastInsertId();

					    $log = $db->prepare("INSERT INTO logs SET
							user = ?,
							log_text = ?,
							created_at = ?");
							$insert = $log->execute(array(
							    $_SESSION['uid'],
							    "Müşteri oluşturuldu",
							    $date
							));
							if ( $insert ){
							    $last_id = $db->lastInsertId();
							    echo json_encode(["status" => "success", "message"=>"Müşteri başarıyla oluşturuldu!","ok"=>true]);
							}
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
		}
	}
	public static function deleteCustomer($data){
		require "../config/db.php";
		$date = date("Y-m-d H:i");
		$query = $db->prepare("DELETE FROM customers WHERE id = :id");
			$delete = $query->execute(array(
			   'id' => $data['id']
			));

			if($delete){
				$log = $db->prepare("INSERT INTO logs SET
					user = ?,
					log_text = ?,
					created_at = ?");
					$insert = $log->execute(array(
					    $_SESSION['uid'],
					    "Müşteri Silindi",
					    $date
					));
					if ( $insert ){
						echo json_encode(["status" => "error", "message"=>"Müşteri Silindi!","ok"=>true]);
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
	}
	public static function updateCustomer($data){
		require "../config/db.php";
		$date = date("Y-m-d H:i");
		if(empty($data['id']) || empty($data["firstname"]) || empty($data["firstname"]) || empty($data["phone"]) || empty($data["il"]) || empty($data["ilce"]) || empty($data["address"]) ){
			echo json_encode(["status" => "warning", "message"=>"Lütfen boş alan bırakmayın!"]);
		}else{
			$query = $db->query("SELECT * FROM customers WHERE id = '{$data["id"]}'")->fetch(PDO::FETCH_ASSOC);
			if(!$query){
				echo json_encode(["status" => "warning", "message"=>"Müşteri bilgisine ulaşılamadı!"]);
			}else{
					$query = $db->prepare("UPDATE customers SET
						firstname = :firstname,
						lastname = :lastname,
						phone = :phone,
						address = :address,
						il = :il,
						ilce = :ilce,
						status = :status,
						created_at = :created_at
						WHERE id = :id");
						$update = $query->execute(array(
						     "firstname" => $data["firstname"],
						     "lastname" => $data["lastname"],
						     "phone" => $data["phone"],
						     "address" => $data["address"],
						     "il" => $data["il"],
						     "ilce" => $data["ilce"],
						     "status" => 2,
						     "created_at" => $date,
						     "id" => $data["id"],
						));
					if ( $update ){
					    $log = $db->prepare("INSERT INTO logs SET
							user = ?,
							log_text = ?,
							created_at = ?");
							$insert = $log->execute(array(
							    $_SESSION['uid'],
							    "Müşteri Güncellendi",
							    $date
							));
							if ( $insert ){
							    $last_id = $db->lastInsertId();
							    echo json_encode(["status" => "success", "message"=>"Müşteri güncellendi!","ok"=>true]);
							}
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
		}
	}
}


$account = new Customer();