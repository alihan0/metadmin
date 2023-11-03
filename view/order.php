<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Siparişler</h4>

             <div class="page-title-right">

            <?php 
            	if($_GET['show'] != "add"){
            ?>
                <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-warning"><i class="fas fa-search"></i> Sipariş Bul</a>
                <a href="?page=order&show=add" class="btn btn-success"><i class="fas fa-plus"></i> Yeni Sipariş Oluştur</a>
          
            <?php 
            	}elseif($_GET['show'] == "add"){
            		?>
                         <a href="?page=order&show=all" class="btn btn-primary"><i class="fas fa-eye"></i> Aktif Siparişler</a>
           
            		<?php
            	}
            ?>
             </div>
        </div>
    </div>
</div>
<?php


$show = $_GET['show'];

if($show == "active"){
	?>


<div class="row">
	<div class="col-12">
	    <div class="card">
	        <div class="card-body">
	            <div class="table-responsive" >
	                 <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100"style=" min-height: 400px;" >

	                    <thead class="table-light">
	                        <tr>
	                            <th>#</th>
	                            <th>Nüşteri</th>
	                            <th>Şehir</th>
                                <th>Teslim Tar.</th>

                                <th>Kapora</th>
                                <th>Tutar</th>
                                <th>Durum</th>
                                <th>İşlem</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php
$query = $db->query("SELECT * FROM orders WHERE  status = 1 OR status = 2 OR status = 3 OR status = 4 ", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
        $query = $db->query("SELECT * FROM customers WHERE id = '{$row['customer']}'")->fetch(PDO::FETCH_ASSOC);

          ?>
          <tr>
            <th scope="row"><?=$row['id']?></th>
            <td><?=$query['firstname'].' '.$query['lastname']?> <br><sub><em><?=$query["phone"]?></em></sub></td>
            <td><?=$query['ilce'].'/'.$query['il']?></td>
            <td><?=$row['delivery_date']?></td>

            <td><?=$row['kapora']?>₺</td>
            <td><?=$row['total_price']?>₺</td>
            <td>
                <?php 
                    if($row['status'] == 0){
                        echo '<span class="btn btn-danger">İptal Edildi</span>';
                    }elseif($row['status'] == 1){
                        echo '<span class="btn btn-info">Hazırlanıyor</span>';
                    }elseif($row['status'] == 2){
                        echo '<span class="btn btn-primary">Üretimde</span>';
                    }elseif($row['status'] == 3){
                        echo '<span class="btn btn-primary">Beklemede</span>';
                    }elseif($row['status'] == 4){
                        echo '<span class="btn btn-primary">Depoda</span>';
                    }elseif($row['status'] == 5){
                        echo '<span class="btn btn-success">Teslim Edildi</span>';
                    }
                ?>

            </td>
            <td id="<?=$row['id']?>">
                <div  class="dropdown float-end">
                    <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        İşlem <i class="mdi mdi-chevron-down"></i>
                </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"  id="<?=$row['id']?>">
                  
                        <a href="?page=order&show=detail&id=<?=$row['id']?>"  class="dropdown-item">Görüntüle</a>
                        <a href="?page=order&show=edit&id=<?=$row['id']?>"  class="dropdown-item">Düzenle</a>
                        <a href="javascript:void(0)"  class="dropdown-item delOrder">Siparişi Sil</a>
                <hr>


                    
                <a href="javascript:void(0)"  class="dropdown-item uretimOrder">Sipariş Üretimde</a>

                <a href="javascript:void(0)"  class="dropdown-item beklemeOrder">Sipariş Bekleme</a>
                <a href="javascript:void(0)"  class="dropdown-item depoOrder">Sipariş Depoda</a>
                <a href="javascript:void(0)"   class="teslimetbuton dropdown-item"  data-bs-toggle="modal" data-bs-target="#modal2">Sipariş Teslim Edildi</a>
                <a href="javascript:void(0)"  class="dropdown-item iptalOrder">Sipariş İptal Edildi</a>
                  


            </div>
        </div>
         

            </td>
        </tr>
          <?php
     }
}
	                    	?>
	                    </tbody>
	                </table>
	            </div>

	        </div>
	    </div>
	</div>
</div>
                        <!-- end row -->


	<?php
}elseif($show == "add"){
	?>
	<div class="row">
		<div class="col-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Yeni Sipariş</h4>

                    <form>
                        
                        
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">Müşteri</label>
                            <div class="col-sm-9">
                                <select id="customer" class="form-control select2">
                                    <option value="0">Seç</option>
                                    <?php
                                    $query = $db->query("SELECT * FROM customers", PDO::FETCH_ASSOC);
                                        if ( $query->rowCount() ){
                                             foreach( $query as $row ){
                                               ?> <option value="<?=$row['id']?>"><?=$row['firstname'].' '.$row['lastname'].' - '.$row['phone'] ?></option><?php
                                             }
                                        }
                                    ?>
                                </select>


                                
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="delivery_date" class="col-sm-3 col-form-label">Sipariş Tarihi</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" id="delivery_at">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="delivery_date" class="col-sm-3 col-form-label">Teslim Tarihi</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" id="delivery_date">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="kapora" class="col-sm-3 col-form-label">Kapora</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" id="kapora">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="fiyat" class="col-sm-3 col-form-label">Fiyat</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" id="fiyat">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="desc" class="col-sm-3 col-form-label">Açıklama</label>
                            <div class="col-sm-9">
                                <textarea id="desc" class="form-control" placeholder="Sipariş notları ve açıklaması" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">Sipariş Durumu</label>
                            <div class="col-sm-9">
                                <select id="stat" class="form-control">
                                    <option value="1">Sipariş Hazırlanıyor</option>
                                    <option value="2">Sipariş Üretimde,</option>
                                    <option value="3">Sipariş Beklemede</option>
                                    <option value="4">Sipariş Depoda</option>
                                    <option value="5">Sipariş Teslim edildi</option>
                                    <option value="0">Sipariş İptal Edildi</option>  
                                </select>


                                
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                            <div>
                                <a  class="btn btn-success w-md" id="addOrder">Sipariş Oluştur</a>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
                                <!-- end card -->
        </div>

        <div class="col-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ürün Bilgisi</h4>

                    <form class="repeater urunForm" enctype="multipart/form-data">
                    <div data-repeater-list="product">
                        <div data-repeater-item class="row">
                            <div  class="mb-3 col-4">
                                <label for="name">Ürün Adı</label>
                                <input type="text" id="name" name="ad" class="form-control" placeholder="Ad"/>
                            </div>

                            <div  class="mb-3 col-6">
                                <label for="ozellik">Özellikler</label>
                              
                                <div class="col-12">
                                <textarea name="ozellik" class="form-control" placeholder="Ürün özellikleri" rows="5"></textarea>
                            </div>
                            </div>

                            
                            
                            <div class="col-2 align-self-center">
                                <div class="d-grid">
                                    <input data-repeater-delete type="button" class="btn btn-danger" value="Kaldır"/>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                                            <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Ekle"/>
                                        </form>

                        
                    
                </div>
                <!-- end card body -->
            </div>
                                <!-- end card -->
        </div>







	</div>
	<?php
}elseif($show == "detail"){

    $id = $_GET['id'];
$s = $db->query("SELECT * FROM orders WHERE id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
$c = $db->query("SELECT * FROM customers WHERE id = '{$s['customer']}'")->fetch(PDO::FETCH_ASSOC);

    ?>



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice-title">
                    <h4 class="float-end font-size-16">Sipariş No: #<?=$id?></h4>
                    <div class="mb-4">
                       Sipariş Detayları
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <strong>Müşteri Detayları:</strong><br>
                            <?=$c['firstname'].' '.$c['lastname']?><br>
                            <?=$c['email']?><br>
                            <?=$c['phone']?><br>
                            <?=$c['address']?>
                        </address>
                    </div>
                     <div class="col-sm-6 text-sm-end">
                        <img src="assets/images/logo.png" width="200">
                        <address class="mt-2 mt-sm-0">
                            <strong>Sipariş Durumu:</strong><br><br>
                            
                            <?php 
                            if($s['status'] == 0){
                        echo '<span class="btn btn-danger">İptal Edildi</span>';
                    }elseif($s['status'] == 1){
                        echo '<span class="btn btn-info">Hazırlanıyor</span>';
                    }elseif($s['status'] == 2){
                        echo '<span class="btn btn-primary">Üretimde</span>';
                    }elseif($s['status'] == 3){
                        echo '<span class="btn btn-primary">Beklemede</span>';
                    }elseif($s['status'] == 4){
                        echo '<span class="btn btn-primary">Depoda</span>';
                    }elseif($s['status'] == 5){
                        echo '<span class="btn btn-success">Teslim Edildi</span>';
                    }
                            ?>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <address>
                            <strong>Sipariş Notları:</strong><br>
                            
                            <?php 
                            if(!empty($s['order_desc'])){
                                echo  $s['order_desc'];
                            }else{
                                echo "yok";
                            }
                            ?>
                        </address>
                    </div>
                    <div class="col-sm-6 mt-3 text-sm-end">
                        <address>
                            <strong>Tarih</strong><br>
                            <strong>Sipariş Tarihi:</strong> <?=$s['created_at']?><br>
                            <strong>Teslim Tarihi:</strong> <?=$s['delivery_date']?><br><br>
                        </address>
                    </div>
                </div>
                <div class="py-2 mt-3">
                    <h3 class="font-size-15 fw-bold">Sipariş Detayları</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 70px;">No.</th>
                                <th>Ürün</th>
                                <th>Detay</th>

                            </tr>
                        </thead>
                        <tbody>

<?php 

$json = $s['order_detail'];

$decode = json_decode($json);



$say = count($decode->product);


//$decode->product[0]->ad



for($i=0;$i<$say;$i++){
    ?>
    <tr>
        <td><?=$i+1?></td>
        <td><?=$decode->product[$i]->ad;?></td>
        <td><?=$decode->product[$i]->ozellik;?></td>
    </tr>
    <?php
}
?>

                            <tr>
                                 <td></td>
                                <td colspan="2" class="text-end">Kapora</td>
                                <td class="text-end"><?=$s['kapora']?>₺</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="border-0 text-end">
                                    <strong>Tutar</strong></td>
                                <td class="border-0 text-end"><?=$s['total_price']?>₺</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="border-0 text-end">
                                    <strong>Kalan</strong></td>
                                <td class="border-0 text-end"><h4 class="m-0"><?=$s['total_price'] - $s['kapora']?>₺</h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-print-none">
                    <div class="float-end">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i> Yazdır</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <?php
}elseif($show == "all"){
    ?>


<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100"style=" min-height: 400px;" >

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nüşteri</th>
                                <th>Son T.</th>
                                <th>Teslim T.</th>
                                <th>Kapora</th>
                                <th>Tutar</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$query = $db->query("SELECT * FROM orders WHERE status = 0 || status = 5", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
        $query = $db->query("SELECT * FROM customers WHERE id = '{$row['customer']}'")->fetch(PDO::FETCH_ASSOC);

          ?>
          <tr>
            <th scope="row"><?=$row['id']?></th>
            <td><?=$query['firstname'].' '.$query['lastname']?></td>
            <td><?=$row['delivery_date']?></td>
            <td><?=$row['delivery_at']?></td>

            <td><?=$row['kapora']?>₺</td>
            <td><?=$row['total_price']?>₺</td>
            <td>
                <?php 
                    if($row['status'] == 0){
                        echo '<span class="btn btn-danger">İptal Edildi</span>';
                    }elseif($row['status'] == 1){
                        echo '<span class="btn btn-info">Hazırlanıyor</span>';
                    }elseif($row['status'] == 2){
                        echo '<span class="btn btn-primary">Üretimde</span>';
                    }elseif($row['status'] == 3){
                        echo '<span class="btn btn-primary">Beklemede</span>';
                    }elseif($row['status'] == 4){
                        echo '<span class="btn btn-primary">Depoda</span>';
                    }elseif($row['status'] == 5){
                        echo '<span class="btn btn-success">Teslim Edildi</span>';
                    }
                ?>

            </td>
            <td id="<?=$row['id']?>">
                <div  class="dropdown float-end">
                    <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        İşlem <i class="mdi mdi-chevron-down"></i>
                </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"  id="<?=$row['id']?>">
                  
                        <a href="?page=order&show=detail&id=<?=$row['id']?>"  class="dropdown-item">Görüntüle</a>
                        <a href="?page=order&show=edit&id=<?=$row['id']?>"  class="dropdown-item">Düzenle</a>
                        <a href="javascript:void(0)"  class="dropdown-item delOrder">Siparişi Sil</a>
                <hr>


                    
                <a href="javascript:void(0)"  class="dropdown-item uretimOrder">Sipariş Üretimde</a>

                <a href="javascript:void(0)"  class="dropdown-item beklemeOrder">Sipariş Bekleme</a>
                <a href="javascript:void(0)"  class="dropdown-item depoOrder">Sipariş Depoda</a>
                <a href="javascript:void(0)"  class="dropdown-item iptalOrder">Sipariş İptal Edildi</a>
                  


            </div>
        </div>
         

            </td>
        </tr>
          <?php
     }
}
                            ?>
                        </tbody>
                    </table>
     
        
                                         
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->


    <?php
}elseif($show == "edit"){
    $gid = $_GET['id'];
    $e = $db->query("SELECT * FROM orders WHERE id = '{$gid}'")->fetch(PDO::FETCH_ASSOC);
    $s = $e['status'];
    ?>
    <div class="row">
        <div class="col-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Siparişi Güncelle</h4>

                    <form>
                        
                        
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">Müşteri</label>
                            <div class="col-sm-9">
                                <select id="customer2" class="form-control select2">
                                    <option value="0">Seç</option>
                                    <?php
                                    $query = $db->query("SELECT * FROM customers", PDO::FETCH_ASSOC);
                                        if ( $query->rowCount() ){
                                             foreach( $query as $row ){
                                               ?> <option <?php if($e['customer'] == $row['id']){echo "selected";} ?>  value="<?=$row['id']?>"><?=$row['firstname'].' '.$row['lastname'].' - '.$row['phone'] ?></option><?php
                                             }
                                        }
                                    ?>
                                </select>


                                
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="delivery_at2" class="col-sm-3 col-form-label">Sipariş Tarihi</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" value="<?=$e['created_at']?>" id="delivery_at2">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="delivery_date2" class="col-sm-3 col-form-label">Teslim Tarihi</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" value="<?=$e['delivery_date']?>" id="delivery_date2">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="kapora2" class="col-sm-3 col-form-label">Kapora</label>
                            <div class="col-sm-9">
                              <input type="number" value="<?=$e['kapora']?>" class="form-control" id="kapora2">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="fiyat2" class="col-sm-3 col-form-label">Fiyat</label>
                            <div class="col-sm-9">
                              <input type="number" value="<?=$e['total_price']?>" class="form-control" id="fiyat2">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="desc2" class="col-sm-3 col-form-label">Açıklama</label>
                            <div class="col-sm-9">
                                <textarea id="desc2" class="form-control" placeholder="Sipariş notları ve açıklaması" rows="5"><?=$e['order_desc']?></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">Sipariş Durumu</label>
                            <div class="col-sm-9">
                                <select id="stat2" class="form-control">
                                    <option <?php if($s == 1){echo "selected";}?> value="1">Sipariş Hazırlanıyor</option>
                                    <option <?php if($s == 2){echo "selected";}?> value="2">Sipariş Üretimde,</option>
                                    <option <?php if($s == 3){echo "selected";}?> value="3">Sipariş Beklemede</option>
                                    <option <?php if($s == 4){echo "selected";}?> value="4">Sipariş Depoda</option>
                                    <option <?php if($s == 5){echo "selected";}?> value="5">Sipariş Teslim edildi</option>
                                    <option <?php if($s == 0){echo "selected";}?> value="0">Sipariş İptal Edildi</option>  
                                </select>


                                
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                            <div>
                                <a  class="btn btn-primary w-md" id="updateOrder">Siparişi Güncelle</a>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
                                <!-- end card -->
        </div>

        <div class="col-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ürün Bilgisi</h4>

                    <form class="repeater urunForm2" enctype="multipart/form-data">
                    
                    <div data-repeater-list="product">

<?php

$siparis = $e['order_detail'];
$decode = json_decode($siparis);


 $say = count($decode->product);


for($i=0;$i<$say;$i++){
  ?>
<div data-repeater-item class="row">
        <div  class="mb-3 col-4">
            <label for="name">Ürün Adı</label>
            <input type="text" id="name" name="ad" class="form-control" value="<?=$decode->product[$i]->ad?>"/>
        </div>

        <div  class="mb-3 col-6">
            <label for="ozellik">Özellikler</label>
          
            <div class="col-12">
            <textarea name="ozellik" class="form-control" placeholder="Ürün özellikleri" rows="5"><?=$decode->product[$i]->ozellik?></textarea>
        </div>
        </div>

        
        
        <div class="col-2 align-self-center">
            <div class="d-grid">
                <input data-repeater-delete type="button" class="btn btn-danger" value="Kaldır"/>
            </div>
        </div>
    </div>
  <?php
}

    ?>
    



                        
                        
                    </div>
                                            <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Ekle"/>
                                        </form>

                        
                    
                </div>
                <!-- end card body -->
            </div>
                                <!-- end card -->
        </div>







    </div>
    <?php
}elseif($show == "find"){
    ?>
<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100"style=" min-height: 400px;" >

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nüşteri</th>
                                <th>Son T.</th>
                                <th>Teslim T.</th>
                                <th>Kapora</th>
                                <th>Tutar</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>

    <?php
    $tip = $_GET['tip'];
    $tarih1 = $_GET['tarih1'];
    $tarih2 = $_GET['tarih2'];

    if($tip == 0){
        // OLUŞTURMA TARİHİ

        $Veriler = $db->prepare("SELECT * FROM orders WHERE created_at >= ? and created_at <= ? ORDER BY id DESC"); $Veriler->execute(array( $tarih1, $tarih2 ));
            foreach($Veriler as $Cek){
                $query = $db->query("SELECT * FROM customers WHERE id = '{$Cek['customer']}'")->fetch(PDO::FETCH_ASSOC);
                ?>
                    <tr>
            <th scope="row"><?=$Cek['id']?></th>
            <td><?=$query['firstname'].' '.$query['lastname']?></td>
            <td><?=$Cek['delivery_date']?></td>
            <td><?=$Cek['delivery_at']?></td>

            <td><?=$Cek['kapora']?>₺</td>
            <td><?=$Cek['total_price']?>₺</td>
            <td>
                <?php 
                    if($Cek['status'] == 0){
                        echo '<span class="btn btn-danger">İptal Edildi</span>';
                    }elseif($Cek['status'] == 1){
                        echo '<span class="btn btn-info">Hazırlanıyor</span>';
                    }elseif($Cek['status'] == 2){
                        echo '<span class="btn btn-primary">Üretimde</span>';
                    }elseif($Cek['status'] == 3){
                        echo '<span class="btn btn-primary">Beklemede</span>';
                    }elseif($Cek['status'] == 4){
                        echo '<span class="btn btn-primary">Depoda</span>';
                    }elseif($Cek['status'] == 5){
                        echo '<span class="btn btn-success">Teslim Edildi</span>';
                    }
                ?>

            </td>
            <td id="<?=$Cek['id']?>">
                <div  class="dropdown float-end">
                    <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        İşlem <i class="mdi mdi-chevron-down"></i>
                </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"  id="<?=$Cek['id']?>">
                  
                        <a href="?page=order&show=detail&id=<?=$Cek['id']?>"  class="dropdown-item">Görüntüle</a>
                        <a href="?page=order&show=edit&id=<?=$Cek['id']?>"  class="dropdown-item">Düzenle</a>
                        <a href="javascript:void(0)"  class="dropdown-item delOrder">Siparişi Sil</a>
                <hr>


                    
                <a href="javascript:void(0)"  class="dropdown-item uretimOrder">Sipariş Üretimde</a>

                <a href="javascript:void(0)"  class="dropdown-item beklemeOrder">Sipariş Bekleme</a>
                <a href="javascript:void(0)"  class="dropdown-item depoOrder">Sipariş Depoda</a>
                <a href="javascript:void(0)"  class="dropdown-item teslimOrder">Sipariş Teslim Edildi</a>
                <a href="javascript:void(0)"  class="dropdown-item iptalOrder">Sipariş İptal Edildi</a>
                  


            </div>
        </div>
         

            </td>
        </tr>
                <?php
            }



    }elseif($tip == 1){
        // TESLİM TARİHİ




$Veriler = $db->prepare("SELECT * FROM orders WHERE delivery_date >= ? and delivery_date <= ? ORDER BY id DESC"); $Veriler->execute(array( $tarih1, $tarih2 ));
            foreach($Veriler as $Cek){
                $query = $db->query("SELECT * FROM customers WHERE id = '{$Cek['customer']}'")->fetch(PDO::FETCH_ASSOC);
                ?>
                    <tr>
            <th scope="row"><?=$Cek['id']?></th>
            <td><?=$query['firstname'].' '.$query['lastname']?></td>
            <td><?=$Cek['delivery_date']?></td>
            <td><?=$Cek['delivery_at']?></td>

            <td><?=$Cek['kapora']?>₺</td>
            <td><?=$Cek['total_price']?>₺</td>
            <td>
                <?php 
                    if($Cek['status'] == 0){
                        echo '<span class="btn btn-danger">İptal Edildi</span>';
                    }elseif($Cek['status'] == 1){
                        echo '<span class="btn btn-info">Hazırlanıyor</span>';
                    }elseif($Cek['status'] == 2){
                        echo '<span class="btn btn-primary">Üretimde</span>';
                    }elseif($Cek['status'] == 3){
                        echo '<span class="btn btn-primary">Beklemede</span>';
                    }elseif($Cek['status'] == 4){
                        echo '<span class="btn btn-primary">Depoda</span>';
                    }elseif($Cek['status'] == 5){
                        echo '<span class="btn btn-success">Teslim Edildi</span>';
                    }
                ?>

            </td>
            <td id="<?=$Cek['id']?>">
                <div  class="dropdown float-end">
                    <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        İşlem <i class="mdi mdi-chevron-down"></i>
                </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"  id="<?=$Cek['id']?>">
                  
                        <a href="?page=order&show=detail&id=<?=$Cek['id']?>"  class="dropdown-item">Görüntüle</a>
                        <a href="?page=order&show=edit&id=<?=$Cek['id']?>"  class="dropdown-item">Düzenle</a>
                        <a href="javascript:void(0)"  class="dropdown-item delOrder">Siparişi Sil</a>
                <hr>


                    
                <a href="javascript:void(0)"  class="dropdown-item uretimOrder">Sipariş Üretimde</a>

                <a href="javascript:void(0)"  class="dropdown-item beklemeOrder">Sipariş Bekleme</a>
                <a href="javascript:void(0)"  class="dropdown-item depoOrder">Sipariş Depoda</a>
                <a href="javascript:void(0)"  class="dropdown-item teslimOrder">Sipariş Teslim Edildi</a>
                <a href="javascript:void(0)"  class="dropdown-item iptalOrder">Sipariş İptal Edildi</a>
                  


            </div>
        </div>
         

            </td>
        </tr>
                <?php
            }






        
    }elseif($tip == 2){
        // TESLİM EDİLME TARİHİ



        $Veriler = $db->prepare("SELECT * FROM orders WHERE delivery_at >= ? and delivery_at <= ? ORDER BY id DESC"); $Veriler->execute(array( $tarih1, $tarih2 ));
            foreach($Veriler as $Cek){
                $query = $db->query("SELECT * FROM customers WHERE id = '{$Cek['customer']}'")->fetch(PDO::FETCH_ASSOC);
                ?>
                    <tr>
            <th scope="row"><?=$Cek['id']?></th>
            <td><?=$query['firstname'].' '.$query['lastname']?></td>
            <td><?=$Cek['delivery_date']?></td>
            <td><?=$Cek['delivery_at']?></td>

            <td><?=$Cek['kapora']?>₺</td>
            <td><?=$Cek['total_price']?>₺</td>
            <td>
                <?php 
                    if($Cek['status'] == 0){
                        echo '<span class="btn btn-danger">İptal Edildi</span>';
                    }elseif($Cek['status'] == 1){
                        echo '<span class="btn btn-info">Hazırlanıyor</span>';
                    }elseif($Cek['status'] == 2){
                        echo '<span class="btn btn-primary">Üretimde</span>';
                    }elseif($Cek['status'] == 3){
                        echo '<span class="btn btn-primary">Beklemede</span>';
                    }elseif($Cek['status'] == 4){
                        echo '<span class="btn btn-primary">Depoda</span>';
                    }elseif($Cek['status'] == 5){
                        echo '<span class="btn btn-success">Teslim Edildi</span>';
                    }
                ?>

            </td>
            <td id="<?=$Cek['id']?>">
                <div  class="dropdown float-end">
                    <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        İşlem <i class="mdi mdi-chevron-down"></i>
                </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"  id="<?=$Cek['id']?>">
                  
                        <a href="?page=order&show=detail&id=<?=$Cek['id']?>"  class="dropdown-item">Görüntüle</a>
                        <a href="?page=order&show=edit&id=<?=$Cek['id']?>"  class="dropdown-item">Düzenle</a>
                        <a href="javascript:void(0)"  class="dropdown-item delOrder">Siparişi Sil</a>
                <hr>


                    
                <a href="javascript:void(0)"  class="dropdown-item uretimOrder">Sipariş Üretimde</a>

                <a href="javascript:void(0)"  class="dropdown-item beklemeOrder">Sipariş Bekleme</a>
                <a href="javascript:void(0)"  class="dropdown-item depoOrder">Sipariş Depoda</a>
                <a href="javascript:void(0)"  class="dropdown-item teslimOrder">Sipariş Teslim Edildi</a>
                <a href="javascript:void(0)"  class="dropdown-item iptalOrder">Sipariş İptal Edildi</a>
                  


            </div>
        </div>
         

            </td>
        </tr>
                <?php
            }



    }
?>





 </tbody>
</table>


                     

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->





<?php
}
?>









<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Sipariş Bul</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
        

<form>
    <div class="row mb-4">
        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Tarihe Göre:</label>
        <div class="col-sm-9">
          <select class="form-select" id="tip">
              <option value="0">Sipariş Oluşturma Tarihi</option>
              <option value="1">Sipariş Teslim Tarihi</option>
              <option value="2">Sipariş Teslim Edilme Tarihi</option>
          </select>
        </div>
    </div>
    <p class="text-muted">Şu tarihlerin Arası:</p>
    <div class="row mb-4">
        <label for="tarih1" class="col-sm-3 col-form-label">Başlangıç</label>
        <div class="col-sm-9">
            <input type="date" class="form-control" id="tarih1" 
            >
        </div>
    </div>
    <div class="row mb-4">
        <label for="tarih2" class="col-sm-3 col-form-label">Bitiş</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" id="tarih2" >
        </div>
    </div>

    
</form>










                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Vazgeç</button>
                <button id="findOrder" type="button" class="btn btn-primary waves-effect waves-light">Ara</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->







<div id="modal2" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Siparişi Teslim Et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
        

<form>
    <input type="hidden" id="siparisid" value="">
    <p class="text-muted">Sipariş Şu Tarihte Teslim Edildi:</p>
    <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="formCheck2">
            <label class="form-check-label" for="formCheck2">
                Teslim Tarihini <b>bugün</b> olarak işaretle
            </label>
        </div>
    <div class="row mb-4">
        <label for="tarih2" class="col-sm-3 col-form-label">Teslim Tarihi:</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" id="teslimtarihi" >
        </div>
    </div>

    
</form>


                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Vazgeç</button>
                <button id="onayla" type="button" class="btn btn-primary waves-effect waves-light">Onayla</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
















<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
         <script src="assets/js/pages/datatables.init.js"></script>    
<script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
        <script src="assets/js/pages/form-repeater.int.js"></script>
 <script src="assets/libs/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        

                $('#datatable1').DataTable(  {
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json"
            }
        });
                 $('#datatable2').DataTable(  {
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json"
            }
        });
            } );
 $("#addOrder").on("click", function(){
            let formData = $(".urunForm").serializeArray();
            let customer = $("#customer").val();
            let delivery_date = $("#delivery_date").val();
            let kapora = $("#kapora").val();
            let fiyat = $("#fiyat").val();
            let desc = $("#desc").val();
            let delivery_at = $("#delivery_at").val();
           let data = $('.repeater').repeaterVal();
           let status = $("#stat").val();
     

            $.ajax({
                type : 'POST',
                url  : 'core/order.php',
                data : {"request":"add",status:status,fiyat:fiyat, customer:customer,delivery_at:delivery_at, delivery_date:delivery_date, kapora:kapora, desc:desc, "data":data},
                dataType : 'JSON',
                success : function(r){
                       toastr[r.status](r.message);
                       if(r.ok){
                        setTimeout(function(e){
                            window.location.assign("?page=order&show=active");
                        },2000);
                       }
                    }
            })
        });


 $("#updateOrder").on("click", function(){
    let id = "<?=$_GET['id']?>";
    let formData = $(".urunForm").serializeArray();
            let customer = $("#customer2").val();
            let delivery_date = $("#delivery_date2").val();
            let kapora = $("#kapora2").val();
            let fiyat = $("#fiyat2").val();
            let desc = $("#desc2").val();
            let delivery_at = $("#delivery_at2").val();
           let data = $('.urunForm2').repeaterVal();
           let status = $("#stat2").val();

           $.ajax({
                type : 'POST',
                url  : 'core/order.php',
                data : {"request":"update",id:id,status:status,fiyat:fiyat, customer:customer,delivery_at:delivery_at, delivery_date:delivery_date, kapora:kapora, desc:desc, "data":data},
                dataType : 'JSON',
                success : function(r){
                       toastr[r.status](r.message);
                       if(r.ok){
                        setTimeout(function(e){
                            window.location.assign("?page=order&show=active");
                        },2000);
                       }
                    }
            })

 });






        $(".iptalOrder").on("click",function(){
            let id = $(this).parent("div").attr("id");
            $.ajax({
                type : 'POST',
                url  : 'core/order.php',
                data : {"request":"iptal", id:id},
                dataType : 'JSON',
                success : function(r){
                    toastr[r.status](r.message);
                    if(r.ok){
                        setTimeout(function(e){
                            window.location.reload(1);
                        },2000)
                    }
                }
            })
        });
        $(".uretimOrder").on("click",function(){
            let id = $(this).parent("div").attr("id");
            $.ajax({
                type : 'POST',
                url  : 'core/order.php',
                data : {"request":"uretimOrder", id:id},
                dataType : 'JSON',
                success : function(r){
                    toastr[r.status](r.message);
                    if(r.ok){
                        setTimeout(function(e){
                            window.location.reload(1);
                        },2000)
                    }
                }
            })
        });

        $(".beklemeOrder").on("click",function(){
            let id = $(this).parent("div").attr("id");
            $.ajax({
                type : 'POST',
                url  : 'core/order.php',
                data : {"request":"beklemeOrder", id:id},
                dataType : 'JSON',
                success : function(r){
                    toastr[r.status](r.message);
                    if(r.ok){
                        setTimeout(function(e){
                            window.location.reload(1);
                        },2000)
                    }
                }
            })
        });
        $(".depoOrder").on("click",function(){
            let id = $(this).parent("div").attr("id");
            $.ajax({
                type : 'POST',
                url  : 'core/order.php',
                data : {"request":"depoOrder", id:id},
                dataType : 'JSON',
                success : function(r){
                    toastr[r.status](r.message);
                    if(r.ok){
                        setTimeout(function(e){
                            window.location.reload(1);
                        },2000)
                    }
                }
            })
        });

        $(".iptalOrder").on("click",function(){
            let id = $(this).parent("div").attr("id");
            $.ajax({
                type : 'POST',
                url  : 'core/order.php',
                data : {"request":"iptal", id:id},
                dataType : 'JSON',
                success : function(r){
                    toastr[r.status](r.message);
                    if(r.ok){
                        setTimeout(function(e){
                            window.location.reload(1);
                        },2000)
                    }
                }
            })
        });

            $(".delOrder").on("click",function(){
            let id = $(this).parent("div").attr("id");
            $.ajax({
                type : 'POST',
                url  : 'core/order.php',
                data : {"request":"delete", id:id},
                dataType : 'JSON',
                success : function(r){
                    toastr[r.status](r.message);
                    if(r.ok){
                        setTimeout(function(e){
                            window.location.reload(1);
                        },2000)
                    }
                }
            })
        });

            $("#findOrder").on("click", function(){

                let tip = $("#tip").val();
                let tarih1 = $("#tarih1").val();
                let tarih2 = $("#tarih2").val();



                if(!tarih1.length){
                    $("#tarih1").addClass("bg-danger");
                     
                }else if(!tarih2.length){
                        $("#tarih2").addClass("bg-danger");
                }else{
                    window.location.assign("main.php?page=order&show=find&tip="+tip+"&tarih1="+tarih1+"&tarih2="+tarih2);
                }
               
            })
       $("#formCheck2").on("click", function(){
         if ($("#formCheck2").is(":checked")) {
             $('#teslimtarihi').prop('disabled', 'disabled');
            }
            else {
                $('#teslimtarihi').prop('disabled', false);
            }
       });

       $(".teslimetbuton").on("click", function(){
        $("#siparisid").val($(this).parent("div").attr("id"));
       })

       $("#onayla").on("click", function(){
        let bugun;
        let id = $("#siparisid").val();
        let teslimtarihi = $("#teslimtarihi").val();
            if ($("#formCheck2").is(":checked")) {
                bugun = 1;
            }
            else {
                bugun = 0;
            }

           $.ajax({
            type : 'POST',
            url  : 'core/order.php',
            data : {"request":"teslimet",id:id, bugun:bugun, teslimtarihi:teslimtarihi},
            dataType : 'JSON',
                success : function(r){
                    toastr[r.status](r.message);
                    if(r.ok){
                        setTimeout(function(e){
                            window.location.reload(1);
                        },2000)
                    }
                }
           })
       })
        </script>