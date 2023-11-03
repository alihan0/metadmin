<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Müşteriler</h4>

            <?php 
                if($_GET['show'] == "all"){
            ?>
             <div class="page-title-right">
                <a href="?page=customer&show=add" class="btn btn-success"><i class="fas fa-plus"></i> Yeni Müşteri Ekle</a>
            </div>
            <?php 
                }elseif($_GET['show'] == "add"){
                    ?>
                    <div class="page-title-right">
                <a href="?page=customer&show=all" class="btn btn-primary"><i class="fas fa-eye"></i> Tüm Müşteriler</a>
            </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
<?php


$show = $_GET['show'];

if($show == "all"){
    ?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                     <table id="datatable3" class="table table-bordered dt-responsive  nowrap w-100">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>İsim</th>
                                <th>Telefon</th>
                                <th>Adres</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$query = $db->query("SELECT * FROM customers", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
          ?>
          <tr>
            <th scope="row"><?=$row['id']?></th>
            <td><?=$row['firstname'].' '.$row['lastname']?></td>
            <td><?=$row['phone']?></td>
            <td><?=$row['address'].', '.$row['ilce'].'/'.$row['il']?></td>
            <td id="<?=$row['id']?>">
                <a href="?page=customer&show=edit&id=<?=$row['id']?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn btn-danger delCustomer"><i class="fas fa-trash"></i></a>
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
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Yeni Müşteri Ekle</h4>

                    <form>
                        <div class="row">
                            <div class="col-3">
                                <label for="firstname" class="form-label">İsim</label>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="firstname" placeholder="Ad">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="lastname" placeholder="Soyad">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        
                        <div class="row mb-4">
                            <label for="phone" class="col-sm-3 col-form-label">Telefon</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" placeholder="Telefon">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="address" class="col-sm-3 col-form-label">Adres</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" placeholder="Adres">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="ilce" class="form-label">Konum</label>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="ilce" placeholder="İlçe">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="il" placeholder="İl">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                            <div>
                                <a  class="btn btn-primary w-md" id="addCustomer">Kaydet</a>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
                                <!-- end card -->
        </div>
    </div>
    <?php
}elseif($show == "edit"){
    $query = $db->query("SELECT * FROM customers WHERE id = '{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Müşteri Düzenle Ekle (#<?=$_GET['id']?>)</h4>
                    <form>
                        <div class="row">
                            <div class="col-3">
                                <label for="firstname" class="form-label">İsim</label>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="firstname" value="<?=$query['firstname']?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="lastname" value="<?=$query['lastname']?>">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        
                        <div class="row mb-4">
                            <label for="phone" class="col-sm-3 col-form-label">Telefon</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="phone" value="<?=$query['phone']?>">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="address" class="col-sm-3 col-form-label">Adres</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" value="<?=$query['address']?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="il" class="form-label">Konum</label>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="il" value="<?=$query['il']?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="ilce" value="<?=$query['ilce']?>">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                            <div>
                                <a  class="btn btn-primary w-md" id="updateCustomer">Güncelle</a>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
                                <!-- end card -->
        </div>
    </div>
    <?php
}
?>

 <script src="assets/libs/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
                $('#datatable3').DataTable(  {
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json"
            }
        });

            } );


        $("#addCustomer").on("click", function(e){
                e.preventDefault();
                let firstname = $("#firstname").val();
                let lastname = $("#lastname").val();
                let phone = $("#phone").val();
                let address = $("#address").val();
                let ilce = $("#ilce").val();
                let il = $("#il").val();
                $.ajax({
                    type : 'POST',
                    url  : 'core/customer.php',
                    data : {"request":"add", firstname:firstname, lastname:lastname, phone:phone, ilce:ilce,il:il, address:address},
                    dataType : 'JSON',
                    success : function(r){
                       toastr[r.status](r.message);
                       if(r.ok){
                        setTimeout(function(e){
                            window.location.assign("?page=customer&show=all");
                        },2000);
                       }
                    }
                })
            });
        $(".delCustomer").on("click",function(){
            let id = $(this).parent("td").attr("id");
            $.ajax({
                type : 'POST',
                url  : 'core/customer.php',
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
        $("#updateCustomer").on("click", function(e){
                e.preventDefault();
                let firstname = $("#firstname").val();
                let lastname = $("#lastname").val();
                let phone = $("#phone").val();
                let address = $("#address").val();
                let il = $("#il").val();
                let ilce = $("#ilce").val();
                let id = "<?=$_GET['id']?>";
                $.ajax({
                    type : 'POST',
                    url  : 'core/customer.php',
                    data : {"request":"update",id:id, firstname:firstname, lastname:lastname, phone:phone, il:il, ilce:ilce, address:address},
                    dataType : 'JSON',
                    success : function(r){
                       toastr[r.status](r.message);
                       if(r.ok){
                        setTimeout(function(e){
                            window.location.assign("?page=customer&show=all");
                        },2000);
                       }
                    }
                })
            });
</script>