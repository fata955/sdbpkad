<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: /sdbpkad/');
    exit();
}
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>Aplikasi Sumber Dana dan Verifikasi Penatausahaan</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/> -->
    <!-- <link rel="stylesheet" href="assets/plugins/charts-c3/plugin.css"/> -->
    <!-- <link rel="stylesheet" href="assets/plugins/morrisjs/morris.min.css" /> -->
    <!-- Font Awesome  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/style.min.css">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->

    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- <link rel="stylesheet" href="assets/plugins/select2/select2.css" /> -->
    <!-- <link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css"> -->
</head>

<body class="theme-blush">


    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form class="card auth_form" id="logIn" method="POST">
                        <div class="header">
                            <img class="logo" src="assets/images/logo.svg" alt="">
                            <h5>Log in</h5>
                        </div>
                        <div class="body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username" name="signinSrUsername" id="signinSrUsername">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="signinSrPassword" id="signinSrPassword">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                                </div>
                            </div>
                            <!-- <div class="checkbox">
                            <input id="remember_me" type="checkbox">
                            <label for="remember_me">Remember Me</label>
                        </div> -->
                            <Button class="btn btn-primary btn-block waves-effect waves-light" type="submit">SignIn</Button>
                            <!-- <div class="signin_with mt-3">
                            <p class="mb-0">or <a href="/sdbpkad/register"> Sign Up</a> using</p>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round facebook"><i class="zmdi zmdi-facebook"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round twitter"><i class="zmdi zmdi-twitter"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round google"><i class="zmdi zmdi-google-plus"></i></button>
                        </div> -->
                        </div>
                    </form>
                    <div class="copyright text-center">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        <span><a href="https://bpkad.palukota.go.id">Penatausahaan BPKAD Kota Palu</a></span>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="assets/images/signin.svg" alt="Sign In" />
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Toast container  -->
    <!-- <div class="toast-container position-fixed bottom-0 end-0 p-3"> -->
    <!-- Success toast  -->
    <!-- <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>Success!</strong>
                    <span id="successMsg"></span>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div> -->
    <!-- Error toast  -->
    <!-- <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>Error!</strong>
                    <span id="errorMsg"></span>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div> -->
    <!-- </div> -->

    <?php
    include 'views/footer.view.php';
    ?>
     <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // function to insert data to database

            const liveToast = new bootstrap.Toast(document.querySelector('#liveToast'));
            const kosong = new bootstrap.Toast(document.querySelector('#kosong'));
            const passwrong = new bootstrap.Toast(document.querySelector('#passwrong'));
            const userwong = new bootstrap.Toast(document.querySelector('#userwong'));
            const approve = new bootstrap.Toast(document.querySelector('#approve'));

            function reset() {
                $("#signinSrUsername").val('');
                $("#signinSrPassword").val('');
            }

            $("#logIn").on("submit", function(e) {
                // $("#insertBtn").attr("disabled", "disabled");
                e.preventDefault();
                const username = $('#signinSrUsername').val(); 
                const password = $('#signinSrPassword').val();
                $.ajax({
                    url: "proses/sign-in.php?action=LoginData",
                    type: "POST",
                    data: { username: username, password: password }, 
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.statusCode == 200) {
                            // liveToast.show();
                            window.location.href = '/sdbpkad/';
                        } else if (response.statusCode == 500) {
                            approve.show();
                            reset();
                        } else if (response.statusCode == 300) {
                            passwrong.show();
                            reset();
                        } else if (response.statusCode == 400) {
                            kosong.show();
                        } else if (response.statusCode == 600) {
                            userwong.show();
                            reset();
                        }
                    }
                });

            });
        });
    </script>

    <div id="liveToast" class="position-fixed toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="top: 20px; right: 20px; z-index: 1000;">
        <div class="toast-header">
            <div class="d-flex align-items-center flex-grow-1">
                <!-- <div class="flex-shrink-0">
          <img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img4.jpg" alt="Image description">
        </div> -->
                <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0">Anda Berhasil Login</h5>
                    <small class="ms-auto"></small>
                </div>
                <div class="text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <div id="kosong" class="position-fixed toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="top: 20px; right: 20px; z-index: 1000;">
        <div class="toast-header">
            <div class="d-flex align-items-center flex-grow-1">
                <!-- <div class="flex-shrink-0">
          <img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img4.jpg" alt="Image description">
        </div> -->
                <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0">Inputan Username/Password Anda Belum Terisi</h5>
                    <small class="ms-auto"></small>
                </div>
                <div class="text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <div id="passwrong" class="position-fixed toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="top: 20px; right: 20px; z-index: 1000;">
        <div class="toast-header">
            <div class="d-flex align-items-center flex-grow-1">
                <!-- <div class="flex-shrink-0">
          <img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img4.jpg" alt="Image description">
        </div> -->
                <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0">Password Anda Salah</h5>
                    <small class="ms-auto"></small>
                </div>
                <div class="text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <div id="userwong" class="position-fixed toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="top: 20px; right: 20px; z-index: 1000;">
        <div class="toast-header">
            <div class="d-flex align-items-center flex-grow-1">
                <!-- <div class="flex-shrink-0">
          <img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img4.jpg" alt="Image description">
        </div> -->
                <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0">Username Belum Terdaftar </h5>
                    <small class="ms-auto">Silhkan Klik Signup here untuk mendaftar</small>
                </div>
                <div class="text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <div id="approve" class="position-fixed toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="top: 20px; right: 20px; z-index: 1000;">
        <div class="toast-header">
            <div class="d-flex align-items-center flex-grow-1">
                <!-- <div class="flex-shrink-0">
          <img class="avatar avatar-sm avatar-circle" src="../assets/img/160x160/img4.jpg" alt="Image description">
        </div> -->
                <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0">User Anda belum di Approve </h5>
                    <small class="ms-auto">Silahkan Menghubungi Admin Anda</small>
                </div>
                <div class="text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        $(document).ready(function() {
            // function to i nsert data to database
            $("#loginForm").on("submit", function(e) {
                // $("#saveBtn").attr("disabled");
                e.preventDefault();
                $.ajax({
                    url: "proses/access.php?action=Loginuser",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.statusCode == 200) {
                            window.location.href = "/sdbpkad";
                            // window.location.href = "/sdbpkad";
                        } else if (response.statusCode == 500) {
                            $("#offcanvasaddsumberdanaopd").offcanvas("hide");
                            $("#saveBtn").removeAttr("disabled");
                            $("#insertdata")[0].reset();
                            //   $(".preview_img").attr("src", "images/default_profile.jpg");
                            // $("#errorToast").toast("show");
                            // $("#errorMsg").html(response.message);
                            Swal.fire("!", "Data Error", "error");
                            fetchData();
                        } else if (response.statusCode == 400) {
                            $("#saveBtn").removeAttr("disabled");
                            // $("#errorToast").toast("show");
                            // $("#errorMsg").html(response.message);
                            Swal.fire("!", "Data Masih Kosong", "Warning");
                            fetchData();
                        }
                    }
                });
            });
        });
    </script> -->