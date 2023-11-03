 <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Kontrol Paneli</h4>

                                    

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="bg-primary bg-soft">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
                                                    <h5 class="text-primary">Holgedin!</h5>
                                                    <p><b>Metadmin Panel</b></p>
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-md profile-user-wid mb-4">
                                                    <img src="assets/images/users/user.jpg" alt="" class="img-thumbnail rounded-circle">
                                                </div>
                                                <h5 class="font-size-15 text-truncate"><?=$account['firstname'].' '.$account['lastname']?></h5>
                                                <p class="text-muted mb-0 text-truncate">@<?=$account['username']?></p>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-5">İşlem Geçmişi <span class="text-muted justify-content-end">(SON 10)</span></h4>
                                        <div class="">
                                            <ul class="verti-timeline list-unstyled">
                                                
    <?php 

$query = $db->query("SELECT * FROM logs WHERE user = '{$_SESSION['uid']}' ORDER BY id DESC LIMIT 10", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
          ?>
<li class="event-list">
        <div class="event-timeline-dot">
            <i class="bx bx-right-arrow-circle"></i>
        </div>
        <div class="d-flex">
            
            <div class="flex-grow-1">
                <div>
                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark"><?=$row['log_text']?></a></h5>
                    <span class="text-primary"><?=$row['created_at']?></span>
                    
                </div>
            </div>
        </div>
    </li>
          <?php
        }
}
    ?>    
                                                
                                            </ul>
                                        </div>

                                    </div>
                                </div>  
                            </div>
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">Aktif Sipariş</p>
                                                        <h4 class="mb-0"><?=$say2?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-copy-alt font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">Toplam Sipariş</p>
                                                        <h4 class="mb-0"><?=$say1?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center ">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-archive-in font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">Toplam Kazanç</p>
                                                        <h4 class="mb-0"><?=$FiyatYaz['takma_ad']?>₺</h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Bekleyen Siparişler</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>İsim</th>
                                <th>Sipariş Tarihi</th>
                                <th>Teslim tarihi</th>
                                <th>Tutar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$query = $db->query("SELECT * FROM orders WHERE status = 1 ORDER BY ID DESC LIMIT 10", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
        $query = $db->query("SELECT * FROM customers WHERE id = '{$row['customer']}'")->fetch(PDO::FETCH_ASSOC);

          ?>
          <tr>
            <th scope="row"><?=$row['id']?></th>
            <td><?=$query['firstname'].' '.$query['lastname']?></td>
            <td><?=$row['created_at']?></td>
            <td><?=$row['delivery_date']?></td>
            <td><?=$row['total_price']?></td>
        </tr>
          <?php
     }
}
                            ?>
                        </tbody>
                    </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>

                                <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Son Siparişler</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>İsim</th>
                                <th>Sipariş Tarihi</th>
                                <th>Teslim tarihi</th>
                                <th>Tutar</th>
                                <th>Durum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$query = $db->query("SELECT * FROM orders ORDER BY ID DESC LIMIT 10", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
        $query = $db->query("SELECT * FROM customers WHERE id = '{$row['customer']}'")->fetch(PDO::FETCH_ASSOC);

          ?>
          <tr>
            <th scope="row"><?=$row['id']?></th>
            <td><?=$query['firstname'].' '.$query['lastname']?></td>
            <td><?=$row['created_at']?></td>
            <td><?=$row['delivery_date']?></td>
            <td><?=$row['total_price']?></td>
            <td>
                <?php 
                if($row['status'] == 0){
                                echo '<span class="btn btn-danger">İptal Edildi</span>';
                            }elseif($row['status'] == 1){
                                echo '<span class="btn btn-info">Açık/Bekliyor</span>';
                            }elseif($row['status'] == 2){
                                echo '<span class="btn btn-primary">Depoda</span>';
                            }elseif($row['status'] == 3){
                                echo '<span class="btn btn-primary">Yolda</span>';
                            }elseif($row['status'] == 4){
                                echo '<span class="btn btn-success">Teslim Edildi</span>';
                            }elseif($row['status'] == 5){
                                echo '<span class="btn btn-warning">İade Edildi</span>';
                            }
                ?>
            </td>
        </tr>
          <?php
     }
}
                            ?>
                        </tbody>
                    </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                        <!-- end row -->

                        
                        <!-- end row -->

                        