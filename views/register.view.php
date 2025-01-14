<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>:: Aero Bootstrap4 Admin :: Sign Up</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush">

    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form class="card auth_form" id="formData">
                        <div class="header">
                            <img class="logo" src="assets/images/logo.svg" alt="">
                            <h5>Sign Up</h5>
                            <span>Halaman Pendaftaran</span>
                        </div>
                        <div class="body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="nm_pengguna" placeholder="Nama Pengguna">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="username" placeholder="Username">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-account"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="pwd_password" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">SIGN UP</button>

                        </div>
                    </form>
                    <div class="copyright text-center">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        <span><a href="templatespoint.net">Penatausahaan BPKAD Kota Palu</a></span>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="assets/images/signup.svg" alt="Sign Up" />
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Toast container  -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <!-- Success toast  -->
        <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>Success!</strong>
                    <span id="successMsg"></span>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <!-- Error toast  -->
        <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>Error!</strong>
                    <span id="errorMsg"></span>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>


    <?php
    include 'views/footer.view.php';
    ?>

  
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    
<script>
    $(document).ready(function() {
      kosong();

        // let table = new DataTable("#mainTable");

        function kosong() {
            $("#nm_pengguna").val('');
            $("#username").val('');
            $("#pwd_password").val('');
            
        }


        // function to insert data to database
        $("#formData").on("submit", function(e) {
        //   $("#insertBtn").attr("disabled");
          e.preventDefault();
          $.ajax({
            url: "proses/sign-up.proses.php?action=insertData",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              var response = JSON.parse(response);
              if (response.statusCode == 200) {
                // $("#offcanvasaddsumberdanaopd").offcanvas("hide");
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                //   $(".preview_img").attr("src", "images/default_profile.jpg");
                $("#successToast").toast("show");
                $("#successMsg").html(response.message);
                // Swal.fire("!", "Data Sukses Tersimpan", "success");
               kosong();
              } else if (response.statusCode == 500) {
                $("#offcanvasaddsumberdanaopd").offcanvas("hide");
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                //   $(".preview_img").attr("src", "images/default_profile.jpg");
                $("#errorToast").toast("show");
                $("#errorMsg").html(response.message);
              } else if (response.statusCode == 400) {
                $("#insertBtn").removeAttr("disabled");
                $("#errorToast").toast("show");
                $("#errorMsg").html(response.message);
              }
            }
          });
        });

    });
</script>

