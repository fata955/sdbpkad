
<?php
// include_once 'component/session.php';
session_start(); 
include 'lib/conn.php';
if (!isset($_SESSION['username'])) { header('Location: /sdbpkad/login'); 
    exit(); }
include 'views/header.view.php';

?>
<section class="content contact">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>SKPD</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/sdbpkad/"><i class="zmdi zmdi-home"></i>Sumber Dana</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">App</a>
                        </li>
                        <li class="breadcrumb-item active">SPM</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button">
                        <i class="zmdi zmdi-sort-amount-desc"></i>
                    </button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button
                        class="btn btn-primary btn-icon float-right right_icon_toggle_btn"
                        type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form method="POST" id="insertForm">
                <div class="row clearfix">
                   <textarea class="form-control" name="dataspm" placeholder="Masukkan Json" rows="20"></textarea>
                </div> <br>
                <div class="col-md-2">
                        <button class="btn btn-primary" type="submit" id='insertBtn'>Tarik Data SPM</button>
                    </div>
            </form>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card" id="">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="myTablespm">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Nomor_spm</th>
                                        <th>Keterangan</th>
                                        <th>OPD</th>
                                        <th>Nilai</th>
                                        <th>Tanggal SPM</th>
                                        <th>Tanggal Masuk file</th>
                                        <!-- <th data-breakpoints="xs">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'views/footer.view.php';
?>

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
<script>
    $(document).ready(function() {
        fetchData();
        
        let table = new DataTable("#myTablespm", {
            "order": [
                [4, "desc"]
            ]
        });

        // function to fetch data from database
        function fetchData() {
            $.ajax({
                url: "proses/mocking/spmexecute.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    // var limitedContent = content .substring(0, 50) + (content.length > 50 ? "..." : "");
                    table.clear().draw();
                    $.each(data, function(index, value) {
                        var ket = value.keterangan_spm;
                        var slice = ket.slice(0,70);

                        table.row
                            .add([
                                value.nomor_spm,
                                slice,
                                value.nama_opd,
                                value.nilai_spm,
                                value.tanggal_spm,
                                value.tanggal_masuk
                            ])
                            .draw(false);
                    });
                }
            });
        }

        // function to insert data to database
        $("#insertForm").on("submit", function(e) {
            $("#insertBtn").attr("disabled", "disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/mocking/spmexecute.php?action=insertData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        $("#successToast").toast("show");
                        // Swal.fire("!", "Data Sukses Tersimpan", "success");
                        // fetchData();
                    } else if (response.statusCode == 500) {
                        $("#errorToast").toast("show");
                    } else if (response.statusCode == 400) {
                        $("#errorToast").toast("show");
                    }
                }
            });
        });

    })
</script>