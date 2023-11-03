<?php
session_start();
class Account{

	public static function registerUser($data){
		require "../config/db.php";
		$pass = md5(sha1($data["password"])).sha1(md5($data["password"]));
		$date = date("Y-m-d H:i");
		if(empty($data["firstname"]) || empty($data["firstname"]) || empty($data["username"]) || empty($data["email"]) || empty($data["password"]) ){
			echo json_encode(["status" => "warning", "message"=>"Lütfen boş alan bırakmayın!"]);
		}else{
			$query = $db->query("SELECT * FROM accounts WHERE email = '{$data["email"]}' || username = '{$data["username"]}' ")->fetch(PDO::FETCH_ASSOC);
			if($query){
				echo json_encode(["status" => "warning", "message"=>"Bu bilgiler zaten kayıtlı!"]);
			}else{
				$query = $db->prepare("INSERT INTO accounts SET
					firstname = ?,
					lastname = ?,
					username = ?,
					email = ?,
					password = ?,
					status = ?,
					last_login = ?,
					created_at = ?
					");
					$insert = $query->execute(array(
					    $data["firstname"],
					    $data["lastname"],
					    $data["username"],
					    $data["email"],
					    $pass,
					    2,
					    null,
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
							    "Hesap oluşturuldu",
							    $date
							));
							if ( $insert ){
							    $last_id = $db->lastInsertId();
							    echo json_encode(["status" => "success", "message"=>"Hesap başarıyla oluşturuldu!","ok"=>true]);
							}
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
		}
	}
	public static function loginUser($data){
		require "../config/db.php";
		$pass = md5(sha1($data["password"])).sha1(md5($data["password"]));
		$date = date("Y-m-d H:i");
		if(empty($data["username"]) || empty($data["password"]) ){
			echo json_encode(["status" => "warning", "message"=>"Lütfen boş alan bırakmayın!"]);
		}else{
			$query = $db->query("SELECT * FROM accounts WHERE username = '{$data["username"]}' && password = '{$pass}' ")->fetch(PDO::FETCH_ASSOC);
			if($query){
				$_SESSION['login'] = true;
				$_SESSION['uid'] = $query['id'];
				

				$log = $db->prepare("INSERT INTO logs SET
					user = ?,
					log_text = ?,
					created_at = ?");
					$insert = $log->execute(array(
					    $query['id'],
					    "Giriş Yapıldı",
					    $date
					));
					if ( $insert ){
					    $last_id = $db->lastInsertId();
					    $query2 = $db->prepare("UPDATE accounts SET
							last_login = :login
							WHERE id = :id");
							$update = $query2->execute(array(
							     "id" => $query['id'],
							     "login" => $date
							));

					    echo json_encode(["status" => "success", "message"=>"Başarıyla giriş yaptınız!","ok"=>true]);
					}
			}else{
				echo json_encode(["status" => "warning", "message"=>"E-posta ya da şifre hatalı!"]);
			}
		}
	}
	public static function deleteUser($data){
		require "../config/db.php";
		$date = date("Y-m-d H:i");
		$query = $db->prepare("DELETE FROM accounts WHERE id = :id");
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
					    "Yönetici Silindi",
					    $date
					));
					if ( $insert ){
						echo json_encode(["status" => "error", "message"=>"Yönetici Silindi!","ok"=>true]);
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
	}
}


$account = new Account();