<?php

session_start(); 
include 'lib/conn.php';
if (!isset($_SESSION['username'])) { header('Location: /sdbpkad/login'); 
    exit(); }
include 'views/header.view.php';
include 'lib/conn.php';
$opd = mysqli_query($conn, "SELECT * from skpd");
$sumberdana = mysqli_query($conn, "SELECT * from subssumber");
$perubahan = mysqli_query($conn, "SELECT * from t_perubahan where status='AKTIF'");

?>
<section class="content contact">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>SUMBER DANA OPD</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/sdbpkad/"><i class="zmdi zmdi-home"></i> HOME</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">App</a>
                        </li>
                        <li class="breadcrumb-item active">Sumber Dana OPD</li>
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
                    <button
                        class="btn btn-success btn-icon float-right"
                        type="button"
                        data-toggle="modal"
                        data-target="#offcanvasaddsumberdanaopd">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card" id="">
                        <div class="table-responsive">
                            <table id="mainTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nama OPD</th>
                                        <th>Sumber Dana</th>
                                        <th>NILAI</th>
                                        <th>REALISASI</th>
                                        <th>Sisa Sumber Dana</th>
                                        <th>Progres</th>
                                        <th>Perubahan/pergeseran</th>
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

<div class="modal fade" id="offcanvasaddsumberdanaopd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="insertForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Tambah Sumber Dana OPD</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <select name='idopd' id='idopd' class="form-control ms">
                            <?php
                            function rupiah($angka)
                            {

                                $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                                return $hasil_rupiah;
                            }
                            while ($fetch = mysqli_fetch_array($opd)) {
                            ?>
                                <option value="<?= $fetch['id']; ?>"> <?= $fetch["nama_opd"]; ?> </option>";
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <label for="nilaipagu" id='labelpagu'>Nilai Pagu</label><br>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="nilaipagu" id='nilaipagu' />
                    </div>
                    <label for="sumber" id='labelsumber'>Sumber Dana</label><br>
                    <div class="input-group mb-3">
                        <select name='sumber' id='sumber' class="form-control ms">
                            <?php

                            while ($fetch = mysqli_fetch_array($sumberdana)) {
                            ?>
                                <option value="<?= $fetch['id']; ?>"> <?= $fetch["namasubsumberdana"]; ?> </option>";
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select name='perubahan' id='perubahan' class="form-control ms">
                            <?php

                            while ($fetch = mysqli_fetch_array($perubahan)) {
                            ?>
                                <option value="<?= $fetch['id']; ?>"> <?= $fetch["namaperubahan"]; ?> </option>";
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nilai Sumber Dana"
                            name="nilaisumber" id='nilaisumber' />
                    </div>

                </div>
                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-default btn-round waves-effect"
                        id="insertBtn">
                        SAVE
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger waves-effect"
                        data-dismiss="modal">
                        CLOSE
                    </button>
                </div>
            </div>
        </form>
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

<!-- <script src="assets/plugins/editable-table/mindmup-editabletable.js"></script> Editable Table Plugin Js -->
<!-- <script src="assets/js/pages/tables/editable-table.js"></script> -->
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>



<script>
    $(document).ready(function() {
        fetchData();
        modaladdhide();

        let table = new DataTable("#mainTable");

        function modaladdshow() {
            $("#insertBtn").show();
            $("#sumber").show();
            $("#nilaipagu").show();
            $("#nilaisumber").show();
            $("#labelpagu").show();
            $("#labelsumber").show();
            $("#perubahan").show();
        }

        function modaladdhide() {
            $("#insertBtn").hide();
            $("#sumber").hide();
            $("#nilaipagu").hide();
            $("#nilaisumber").hide();
            $("#labelpagu").hide();
            $("#labelsumber").hide();
            $("#perubahan").hide();
        }
        // function to fetch data from database
        function fetchData() {
            $.ajax({
                url: "proses/setting/sumberopd.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    table.clear().draw();
                    $.each(data, function(index, value) {
                        var dana = value.nilai_sumber;
                        var realisasi = value.realisasi;
                        var sisa_sumber = dana - realisasi;
                        var progres = (realisasi / dana) * 100

                        // let sisasumberdana=(formatRupiah(sisa_sumber, "Rp. "));
                        table.row
                            .add([
                                value.id,
                                value.nama_opd,
                                value.namasubsumberdana,
                                formatRupiah(dana, "Rp. "),
                                formatRupiah(realisasi, "Rp. "),
                                formatRupiah(sisa_sumber),
                                '<div class="progress"><div class="progress-bar l-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: ' + progres + '%;"></div></div><br><small>' + progres + '%</small>',
                                value.namaperubahan,
                                // '<Button type="button" class="btn editBtn" value="' +
                                // value.id +
                                // '"><i class="fa-solid fa-pen-to-square fa-xl"></i></Button>' +
                                // '<Button type="button" class="btn deleteBtnsubsumber" value="' +
                                // value.id +
                                // '"><i class="fa-solid fa-trash fa-xl"></i></Button>' +
                                // '<input type="hidden" class="delete_image" value="' +
                                // value.image +
                                // '">'
                            ])
                            .draw(false);
                    });
                }
            });
        }

        // function to edit data
        // $("#offcanvasaddsumberdanaopd").on("Change", ".idopd", function() {
        $('#idopd').change(function(e) {
            e.preventDefault();
            var id = $(this).val();
            $.ajax({
                url: "proses/setting/sumberopd.php?action=fetchSinglePagu",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.statusCode == 200) {
                        var data = response.data;
                        var nilai = data.nilai;
                        $("#insertForm input[name='nilaipagu']").val(formatRupiah(nilai, 'Rp'));
                        modaladdshow();
                    } else if (response.statusCode == 404) {
                        // $("#offcanvasaddsumberdanaopd").hide();
                        // window.location.reload('http://localhost/sdbpkad/sumberdanaopd')
                        Swal.fire("X", "Input Pagu Dulu Bro Dinas Bersangkutan", "warning");
                        fetchData();
                        modaladdhide();

                    }

                }
            });
        });

        // function to insert data to database
        $("#insertForm").on("submit", function(e) {
          $("#insertBtn").attr("disabled");
          e.preventDefault();
          $.ajax({
            url: "proses/setting/sumberopd.php?action=insertData",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              var response = JSON.parse(response);
              if (response.statusCode == 200) {
                $("#offcanvasaddsumberdanaopd").offcanvas("hide");
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                //   $(".preview_img").attr("src", "images/default_profile.jpg");
                $("#successToast").toast("show");
                $("#successMsg").html(response.message);
                // Swal.fire("!", "Data Sukses Tersimpan", "success");
                fetchData();
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

        // function to edit data
        // $("#myTablesubsumberdana").on("click", ".editBtn", function() {
        //   var id = $(this).val();
        //   $.ajax({
        //     url: "proses/subsumberdana/executesubsumber.php?action=fetchSingle",
        //     type: "POST",
        //     dataType: "json",
        //     data: {
        //       id: id
        //     },
        //     success: function(response) {
        //       var data = response.data;
        //       $("#editForm #id").val(data.id);
        //       $("#editForm input[name='namasubsumberdana']").val(data.namasubsumberdana);
        //       $("#editForm input[name='keterangan']").val(data.ket);
        //       $("#editForm select[name='idsumber']").val(data.idsumberdana);
        //       // $("#editForm select[name='country']").val(data.country);
        //       // $("#editForm .preview_img").attr("src", "uploads/" + data.image + "");
        //       // $("#editForm #image_old").val(data.image);
        //       // if (data.gender === "male") {
        //       //   $("#editForm input[name='gender'][value='male']").attr("checked", true);
        //       // } else if(data.gender === "female") {
        //       //   $("#editForm input[name='gender'][value='female']").attr("checked", true);
        //       // }
        //       // show the edit user offcanvas
        //       $("#offcanvasEditsubsumberdana").modal("show");
        //     }
        //   });
        // });

        // function to update data in database
        // $("#editForm").on("submit", function(e) {
        //   $("#editBtn").attr("disabled");
        //   e.preventDefault();
        //   $.ajax({
        //     url: "proses/subsumberdana/executesubsumber.php?action=updateData",
        //     type: "POST",
        //     data: new FormData(this),
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     success: function(response) {
        //       var response = JSON.parse(response);
        //       if (response.statusCode == 200) {
        //         Swal.fire("!", "Data Sukses Terupdate", "success");
        //         fetchData();
        //         // $("#offcanvasEditsumberdana").modal("hide");
        //       } else if (response.statusCode == 500) {
        //         $("#offcanvasEditsubsumberdana").offcanvas("hide");
        //         $("#editBtn").removeAttr("disabled");
        //         $("#editForm")[0].reset();
        //         //   $(".preview_img").attr("src", "images/default_profile.jpg");
        //         $("#errorToast").toast("show");
        //         $("#errorMsg").html(response.message);
        //       } else if (response.statusCode == 400) {
        //         $("#editBtn").removeAttr("disabled");
        //         $("#errorToast").toast("show");
        //         $("#errorMsg").html(response.message);
        //       }
        //     }
        //   });
        // });

        // function to delete data
        // $("#myTablesubsumberdana").on("click", ".deleteBtnsubsumber", function() {
        //   if (confirm("Apakah yakin Menghapus Data Ini?")) {
        //     var id = $(this).val();
        //     //   var delete_image = $(this).closest("td").find(".delete_image").val();
        //     $.ajax({
        //       url: "proses/subsumberdana/executesubsumber.php?action=deleteData",
        //       type: "POST",
        //       dataType: "json",
        //       data: {
        //         id
        //         //   delete_image
        //       },
        //       success: function(response) {
        //         if (response.statusCode == 200) {
        //           fetchData();
        //           $("#successToast").toast("show");
        //           $("#successMsg").html(response.message);
        //         } else if (response.statusCode == 500) {
        //           $("#errorToast").toast("show");
        //           $("#errorMsg").html(response.message);
        //         }
        //       }
        //     });
        //   }
        // });
    });
</script>