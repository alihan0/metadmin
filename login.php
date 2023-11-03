<?php 

session_start();
ob_start();

if(isset($_SESSION['login'])){
    header("location:index.php");
}

?>
<!doctype html>
<html lang="tr">
<head>
        
        <meta charset="utf-8" />
        <title>Oturum Aç - Metatige</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo-ikon.png">

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.carousel.min.css">

        <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.theme.default.min.css">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/libs/toastr/build/toastr.min.css">

    </head>

<body class="auth-body-bg">
    
    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">
                
                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">

                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">
                                                
                                                <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">Metadmin</span> Panelde Oturum Aç</h4>
                                                
                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" Kullanıcı adı ve şifrenle <b>Metadmin Panel</b>'de oturum açabilirsin. Oturum açtığın zaman siparişlerini yönetebileceksin.' "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">
                                                                        <a href="https://metatige.com">
                                                                        - Metatige
                                                                    </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="https://metatige.com" class="d-block auth-logo">
                                        <img src="assets/images/logo-yatay.png" alt="" width="200" class="auth-logo-dark">
                                    </a>
                                </div>
                                <div class="my-auto">
                                    
                                    <div>
                                        <h5 class="text-primary">Hoşgeldin!</h5>
                                        <p class="text-muted">Profilini düzenlemek için oturum aç.</p>
                                    </div>
        
                                    <div class="mt-4">
                                        <form id="loginForm" action="">
            
                                            <div class="mb-3">
                                                <label for="emai" class="form-label">Kullanıcı Adı</label>
                                                <input type="text" class="form-control" id="username" placeholder="Kullanıcı Adı" name="email">
                                            </div>
                    
                                            <div class="mb-3">
                                                
                                                <label class="form-label">Şifre</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input name="password" id="password" type="password" class="form-control" placeholder="Şifre" aria-label="Password" aria-describedby="password-addon">
                                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>

                                                </div>
                                                
                                            </div>
                    
                                            
                                            
                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light" id="loginBtn" type="submit">Oturum Aç</button>
                                            </div>
                
                                            
                                            

                                        </form>
                                        
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0 justify-content-start">© <script>document.write(new Date().getFullYear())</script> - Metatige | Tüm hakları saklıdır. <span class=" justify-content-end">v1.9</span></p>
                                    
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- owl.carousel js -->
    <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>

    <!-- auth-2-carousel init -->
    <script src="assets/js/pages/auth-2-carousel.init.js"></script>
    <script src="assets/libs/toastr/build/toastr.min.js"></script>
        <script src="assets/js/pages/toastr.init.js"></script>
    
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script type="text/javascript">
        $("#loginBtn").on("click", function(e){
            e.preventDefault();
            let username = $("#username").val();
            let password = $("#password").val();
            $.ajax({
                type : 'POST',
                url  : 'core/account.php',
                data : {"request":"login", username:username, password:password},
                dataType : 'JSON',
                success : function(r){
                    toastr[r.status](r.message);
                       if(r.ok){
                        setTimeout(function(e){
                            window.location.assign("index.php");
                        },2000);
                       }
                }
            })
        })
    </script>

</body>
</html>
