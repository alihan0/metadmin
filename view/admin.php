<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Yöneticiler</h4>

            <?php 
            	if($_GET['show'] == "all"){
            ?>
             <div class="page-title-right">
                <a href="?page=admin&show=add" class="btn btn-success"><i class="fas fa-plus"></i> Yeni Yönetici Ekle</a>
            </div>
            <?php 
            	}elseif($_GET['show'] == "add"){
            		?>
            		<div class="page-title-right">
                <a href="?page=admin&show=all" class="btn btn-primary"><i class="fas fa-eye"></i> Tüm Yöneticiler</a>
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
	                <table class="table mb-0">

	                    <thead class="table-light">
	                        <tr>
	                            <th>#</th>
	                            <th>İsim</th>
	                            <th>Kullanıcı Adı</th>
	                            <th>E-posta</th>
	                            <th>Son Giriş</th>
	                            <th>İşlem</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php
$query = $db->query("SELECT * FROM accounts", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
          ?>
          <tr>
            <th scope="row"><?=$row['id']?></th>
            <td><?=$row['firstname'].' '.$row['lastname']?></td>
            <td><?=$row['username']?></td>
            <td><?=$row['email']?></td>
            <td><?=$row['last_login']?></td>
            <td id="<?=$row['id']?>">
            	<a href="javascript:void(0)" class="btn btn-danger delAdmin"><i class="fas fa-trash"></i></a>
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
                    <h4 class="card-title mb-4">Yeni Yönetici Ekle</h4>

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
                            <label for="username" class="col-sm-3 col-form-label">Kullanıcı Adı</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" placeholder="Kullanıcı adı">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">E-posta</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" placeholder="E-posta adresi">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="password" class="col-sm-3 col-form-label">Şifre</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" id="password" placeholder="Şifre">
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">

                                

                            <div>
                                <a  class="btn btn-primary w-md" id="addAdmin">Kaydet</a>
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
		$("#addAdmin").on("click", function(e){
                e.preventDefault();
                let firstname = $("#firstname").val();
                let lastname = $("#lastname").val();
                let username = $("#username").val();
                let email = $("#email").val();
                let password = $("#password").val();
                $.ajax({
                    type : 'POST',
                    url  : 'core/account.php',
                    data : {"request":"register", firstname:firstname, lastname:lastname, username:username, email:email, password:password},
                    dataType : 'JSON',
                    success : function(r){
                       toastr[r.status](r.message);
                       if(r.ok){
                        setTimeout(function(e){
                            window.location.assign("?page=admin&show=all");
                        },2000);
                       }
                    }
                })
            });

		$(".delAdmin").on("click",function(){
			let id = $(this).parent("td").attr("id");
			
			$.ajax({
				type : 'POST',
				url  : 'core/account.php',
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
</script>