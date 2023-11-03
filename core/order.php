<?php
session_start();
include '../config/db.php';
if($_POST){
	switch ($_POST['request']) {
		case 'add':

			$date = date("Y-m-d H:i:s");
			$customer = $_POST['customer'];
			$delivery = $_POST['delivery_date'];
			$kapora   = $_POST['kapora'];
			$desc     = $_POST['desc'];
			$fiyat	  = $_POST['fiyat'];
			$data = $_POST['data'];
			$delivery_at = $_POST['delivery_at'];
			$json = json_encode($data);
			$status = $_POST['status'];
		
			$say = count($data["product"]);

		
	 		

	 		$query = $db->prepare("INSERT INTO orders SET
				customer = ?,
				delivery_date = ?,
				kapora = ?,
				total_price = ?,
				order_desc = ?,
				order_detail = ?,
				status = ?,
				created_at = ?

				");
				$insert = $query->execute(array(
				   $customer,
				   $delivery,
				   $kapora,
				   $fiyat,
				   $desc,
				   $json,
				   $status,
				   $delivery_at
				));
				if ( $insert ){
				    $last_id = $db->lastInsertId();
				    echo json_encode(["status"=>"success", "message"=>"Sipariş Oluşturuldu!","ok"=>true]);
				}else{
					echo json_encode(["status"=>"error", "message"=>"Sistem Hatası!"]);
				}
	 	break;
	 	case 'update':

			$date = date("Y-m-d H:i:s");
			$customer = $_POST['customer'];
			$delivery = $_POST['delivery_date'];
			$kapora   = $_POST['kapora'];
			$desc     = $_POST['desc'];
			$fiyat	  = $_POST['fiyat'];
			$data = $_POST['data'];
			$delivery_at = $_POST['delivery_at'];
			$json = json_encode($data);
			$status = $_POST['status'];
			$id = $_POST['id'];


			$query = $db->prepare("UPDATE orders SET
				customer = :customer,
				delivery_date = :delivery_date,
				kapora = :kapora,
				total_price = :fiyat,
				order_desc = :order_desc,
				status = :stat,
				order_detail = :order_detail,
				created_at = :created_at
				WHERE id = :id");
				$update = $query->execute(array(
				 	"customer" =>$customer,
				    "delivery_date" => $delivery,
				    "kapora" => $kapora,
				    "fiyat" => $fiyat,
				    "order_desc" => $desc,
				    "stat" => $status,
				    "order_detail" => $json,
				    "id" => $id,
				    "created_at" => $delivery_at

				));
				if ( $update ){
				    echo json_encode(["status"=>"success", "message"=>"Sipariş Güncellendi!","ok"=>true]);
				}else{
					echo json_encode(["status"=>"error", "message"=>"Sistem Hatası!"]);
				}

	 	break;
	 	case 'delete':
	 		$id = $_POST["id"];
	 		



	 		$date = date("Y-m-d H:i");
		$query = $db->prepare("DELETE FROM orders WHERE id = :id");
			$delete = $query->execute(array(
			   'id' => $_POST['id']
			));

			if($delete){
				$log = $db->prepare("INSERT INTO logs SET
					user = ?,
					log_text = ?,
					created_at = ?");
					$insert = $log->execute(array(
					    $_SESSION['uid'],
					    "Sipariş Silindi",
					    $date
					));
					if ( $insert ){
						echo json_encode(["status" => "error", "message"=>"Sipariş Silindi!","ok"=>true]);
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
	 	break;
	 	case 'iptal':
	 		$id = $_POST["id"];
	 		$date = date("Y-m-d H:i");



	 		$date = date("Y-m-d H:i");
		$query = $db->prepare("UPDATE orders SET
			status = :s
			WHERE id = :id");
			$update = $query->execute(array(
			     "id" => $id,
			     "s" => 0
			));

			if($update){
				$log = $db->prepare("INSERT INTO logs SET
					user = ?,
					log_text = ?,
					created_at = ?");
					$insert = $log->execute(array(
					    $_SESSION['uid'],
					    "Sipariş İptal Edildi",
					    $date
					));
					if ( $insert ){
						echo json_encode(["status" => "success", "message"=>"Sipariş İptal Edildi!","ok"=>true]);
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
	 	break;
	 	case 'uretimOrder':
	 		$id = $_POST["id"];
	 		$date = date("Y-m-d H:i");



	 		$date = date("Y-m-d H:i");
		$query = $db->prepare("UPDATE orders SET
			status = :s
			WHERE id = :id");
			$update = $query->execute(array(
			     "id" => $id,
			     "s" => 2
			));

			if($update){
				$log = $db->prepare("INSERT INTO logs SET
					user = ?,
					log_text = ?,
					created_at = ?");
					$insert = $log->execute(array(
					    $_SESSION['uid'],
					    "Sipariş Depoda",
					    $date
					));
					if ( $insert ){
						echo json_encode(["status" => "success", "message"=>"Sipariş Depoda","ok"=>true]);
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
	 	break;
	 	case 'beklemeOrder':
	 		$id = $_POST["id"];
	 		$date = date("Y-m-d H:i");



	 		$date = date("Y-m-d H:i");
		$query = $db->prepare("UPDATE orders SET
			status = :s
			WHERE id = :id");
			$update = $query->execute(array(
			     "id" => $id,
			     "s" => 3
			));

			if($update){
				$log = $db->prepare("INSERT INTO logs SET
					user = ?,
					log_text = ?,
					created_at = ?");
					$insert = $log->execute(array(
					    $_SESSION['uid'],
					    "Sipariş Yolda",
					    $date
					));
					if ( $insert ){
						echo json_encode(["status" => "success", "message"=>"Sipariş Yolda","ok"=>true]);
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
	 	break;
	 	case 'depoOrder':
	 		$id = $_POST["id"];
	 		$date = date("Y-m-d H:i");



	 		$date = date("Y-m-d H:i");
		$query = $db->prepare("UPDATE orders SET
			status = :s,
			delivery_at = :d
			WHERE id = :id");
			$update = $query->execute(array(
			     "id" => $id,
			     "s" => 4,
			     "d" => $date
			));

			if($update){
				$log = $db->prepare("INSERT INTO logs SET
					user = ?,
					log_text = ?,
					created_at = ?");
					$insert = $log->execute(array(
					    $_SESSION['uid'],
					    "Sipariş Teslim Edildi",
					    $date
					));
					if ( $insert ){
						echo json_encode(["status" => "success", "message"=>"Sipariş depoda!","ok"=>true]);
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}
			}
	 	break;
	 	case 'teslimet':
	 		$date = date("Y-m-d");
	 		$bugun = $_POST['bugun'];
	 		$teslimtarihi = $_POST['teslimtarihi'];
	 		$id = $_POST['id'];

	 		if($bugun == 1){
	 			$tarih = $date;
	 		}elseif($bugun == 0){
	 			$tarih = $teslimtarihi;
	 		}

	 		$query = $db->prepare("UPDATE orders SET
				delivery_at = :t,
				status = :s
				WHERE id = :id");
				$update = $query->execute(array(
				     "id" => $id,
				     "s" => 5,
				     "t" => $tarih
				));
				if ( $update ){
						echo json_encode(["status" => "success", "message"=>"Sipariş Teslim Edildi!","ok"=>true]);
					}else{
						echo json_encode(["status" => "error", "message"=>"Sistem Hatası!"]);
					}

	 	break;
	 }
}	