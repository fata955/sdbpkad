<?php
// include_once 'component/session.php';

session_start(); 
include 'lib/conn.php';
if (!isset($_SESSION['username'])) { header('Location: /sdbpkad/login'); 
    exit(); }
include 'views/header.view.php';
// include 'lib/conn.php';
$opd = mysqli_query($conn, "SELECT * from skpd");
$sumberdana = mysqli_query($conn, "SELECT * from subssumber");
$perubahan = mysqli_query($conn, "SELECT * from t_perubahan where status='AKTIF'");

?>
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>SUMBER DANA OPD</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/sdbpkad/"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">App</li>
                        <li class="breadcrumb-item active">Sumber Dana OPD</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form method="POST" id="insertForm">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body">
                                <div class="row mb-2">
                                    <div class="col-md-10 col-sm-10">
                                        <h5>Pilih OPD</h5>
                                        <select name='idopd' id='idopd' class="form-control show-tick ms select2">\
                                            <option value="0">--PILIH--</option>";
                                            <?php
                                            while ($fetch = mysqli_fetch_array($opd)) {
                                            ?>
                                                <option value="<?= $fetch['id']; ?>"> <?= $fetch["nama_opd"]; ?> </option>";
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <a href="javascript:void(0);" class="btn btn-success " id='addperubahan'>Sync Perubahan</a>
                                    </div>
                                </div>

                            </div>
                            <div class="body mt-2">
                                <div class="row" id="pagu">
                                    <!-- <div class="col-md-6">
                                    <h5>Note</h5>
                                    <p>Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.</p>
                                </div> -->
                                    <div class="col-md-12 text-center">
                                        <!-- <ul class="list-unstyled">
                                            <li><strong>Nilai Pagu</strong> 2930.00</li>
                                            <li class="text-danger"><strong>Discout:-</strong> 12.9%</li>
                                            <li><strong>VAT:-</strong> 12.9%</li>
                                        </ul> -->
                                        <!-- <h3 class="mb-0 text-success">TOTAL PAGU <br> <input
                                                type="text"
                                                class="form-control text-center"
                                                name="pagu" id="pagu" disabled /></h3> -->
                                        <a href="javascript:void(0);" class="btn btn-info"><i class="zmdi zmdi-print"></i></a>
                                        <button
                                            class="btn btn-success btn-icon float-center"
                                            type="button"
                                            data-toggle="modal"
                                            data-target="#offcanvasaddsumberdanaopd">
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>
                                        <!-- <a href="javascript:void(0);" class="btn btn-success addBtn">Add</a> -->
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive" id="tabelnya">
                                        <table class="table table-hover c_table theme-color table-striped table-hover dataTable js-exportable" id="nilaisumberdana">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Sumber Dana</th>
                                                    <th>Nilai</th>
                                                    <th>Realisasi</th>
                                                    <th>Sisa</th>
                                                    <th>Action</th>

                                                    <!-- <th>Total</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <div class="row" id="totalnya">
                                    <div class="col-md-4 text-left">
                                        <!-- <ul class="list-unstyled">
                                            <li><strong>Total Realisasi</strong> 2930.00</li>
                                            <li class="text-danger"><strong>Total Sisa</strong> 12.9%</li>
                                            <li><strong>VAT:-</strong> 12.9%</li>
                                            <li class="text-warning"><strong>Progres</strong> 12.9%</li>
                                        </ul> -->
                                        <h6 class="mb-0">Total Alokasi Dana</h6>
                                        <input
                                            type="text"
                                            class="form-control text-right" style="font-size: 20px;"
                                            name="pagunya" id="pagunya" disabled /> <br>
                                        <h6 class="mb-0">Total Sumber Dana</h6>
                                        <input
                                            type="text"
                                            class="form-control text-right" style="font-size: 20px;"
                                            name="total" id="total" disabled /> <br>

                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="mb-0">Total Realisasi</h6>
                                        <input
                                            type="text"
                                            class="form-control text-right" style="font-size: 20px;"
                                            name="trealisasi" id="trealisasi" disabled /><br>
                                        
                                            <h6 class="mb-0">Sisa Alokasi</h6> 
                                            <input
                                                type="text"
                                                class="form-control text-right" style="font-size: 20px;"
                                                name="sisarealisasi" id="sisarealisasi" disabled />
                                        
                                    </div>

                                    <div class="col-md-4">
                                        <h6 class="mb-0">Jenis Perubahan</h6>
                                        <input
                                            type="text"
                                            class="form-control text-center " style="font-size: 20px;"
                                            name="perubahan1" id="perubahan1" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



<div class="modal fade" id="offcanvasaddsumberdanaopd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="insertdata">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Tambah Sumber Dana OPD</h4>
                </div>

                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input
                            type="hidden"
                            class="form-control"
                            name="idopd" id='idopd' />
                        <input
                            type="text"
                            class="form-control"
                            name="namaopd" id='namaopd' />
                    </div>
                    <label for="sumber" id='labelsumber'>Sumber Dana</label><br>
                    <div class="input-group mb-3">
                        <select name='sumber' id='sumber' class="form-control ms select2">
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
                            name="nilaisumber1" id='nilaisumber1' />
                    </div>

                </div>
                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-default waves-effect"
                        id="saveBtn">
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

<div class="modal fade" id="offcanvaseditsumberdanaopd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="editForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">edit Sumber Dana OPD</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input
                            type="hidden"
                            class="form-control"
                            name="idsumberdana" id='idsumberdana' />
                        <input
                            type="hidden"
                            class="form-control"
                            name="idopd" id='idopd' />
                        <input
                            type="text"
                            class="form-control"
                            name="namaopd" id='namaopd' disabled />
                    </div>
                    <label for="sumber" id='labelsumber'>Sumber Dana</label><br>
                    <div class="input-group mb-3">
                        <select name='sumber' id='sumber' class="form-control ms">
                            <?php
                            $sumberdana1 = mysqli_query($conn, "SELECT * from subssumber");
                            while ($fetch = mysqli_fetch_array($sumberdana1)) {
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
                            $perubahan1 = mysqli_query($conn, "SELECT * from t_perubahan where status='AKTIF'");
                            while ($fetch = mysqli_fetch_array($perubahan1)) {
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
                            name="nilaisumber" id='nilaisumber' />
                    </div>

                </div>
                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-default waves-effect "
                        id="editBtn">
                        UPDATE
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger waves-effect"
                        data-bs-dismiss="modal"
                        aria-label="Close">
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
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<!-- <script src="lib/formatrupiah.js"></script> -->



<script>
    $(document).ready(function() {
        /* Dengan Rupiah */
        var nilaisumber1 = document.getElementById('nilaisumber1');
        nilaisumber1.addEventListener('keyup', function(e) {
            nilaisumber1.value = formatRupiah(this.value, 'Rp. ');
        })

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }


        function modaladdshow() {
            $("#insertBtn").show();
            $("#totalnya").show();
            $("#pagu").show();
            $("#tabelnya").show();
        }

        function modaladdhide() {
            $("#insertBtn").hide();
            $("#totalnya").hide();
            $("#pagu").hide();
            $("#tabelnya").hide();
        }
        fetchData();
        modaladdhide();
        let table = new DataTable("#nilaisumberdana");
        // function to fetch data from database
        function fetchData() {
            var id = $('#idopd').val();
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
                        table.clear().draw();
                        var counter = 1;
                        $.each(data, function(index, value) {
                            var dana = value.nilai_sumber;
                            var totallra = value.totalrealisasi;
                            var total = value.Total;
                            var realisasi = value.realisasi;
                            var sisasumber = dana - realisasi;
                            var totalsisa = total - totallra;
                            var totalsisa = totalsisa.toString();
                            var rp = sisasumber.toString();
                            var progres = (realisasi / dana) * 100;
                            $("#totalnya input[name='pagunya']").val(formatRupiah(value.nilai, "Rp. "));
                            $("#totalnya input[name='total']").val(formatRupiah(value.Total, "Rp. "));
                            $("#totalnya input[name='perubahan1']").val(value.namaperubahan);
                            $("#totalnya input[name='trealisasi']").val(formatRupiah(value.totalrealisasi, "Rp. "));
                            $("#totalnya input[name='sisarealisasi']").val(formatRupiah(totalsisa, "Rp. "));
                            $("#offcanvasaddsumberdanaopd input[name='namaopd']").val(value.nama_opd);
                            $("#offcanvasaddsumberdanaopd input[name='idopd']").val(value.idopd);
                            table.row
                                .add([
                                    counter,
                                    // value.nama_opd,
                                    value.namasubsumberdana,
                                    formatRupiah(dana, "Rp. "),
                                    formatRupiah(realisasi, "Rp. "),
                                    formatRupiah(rp, "Rp. "),
                                    '<Button type="button" class="btn btn-primary btn-sm editBtn" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-edit"></i></Button>' +
                                    '<Button type="button" class="btn btn-danger btn-sm deleteBtn" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-delete"></i></Button>'
                                    // '<div class="progress"><div class="progress-bar l-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: ' + progres + '%;"></div></div><br><small>' + progres + '%</small>'
                                ])
                                .draw(false);
                                counter++;

                        });
                        modaladdshow();
                    } else if (response.statusCode == 404) {
                        Swal.fire("X", "sync untuk perubahan Baru", "warning");
                        // fetchData();
                        modaladdhide();
                    } else if (response.statusCode == 505) {
                        Swal.fire("X", "OPD Belum Mempunyai Pagu", "warning");
                        // fetchData();
                        modaladdhide();
                    } else if (response.statusCode == 600) {
                        // Swal.fire("X", "Silahkan Memilih OPD dengan Benar", "warning");
                        // fetchData();
                        modaladdhide();
                    }

                }
            });
        }

        // function to edit data
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
                    // var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        var data = response.data;
                        // console.log(data);
                        table.clear().draw();
                        var counter = 1;
                        $.each(data, function(index, value) {
                            // var totalsisa = value.Total - value.totalrealisasi;
                            var totallra = value.totalrealisasi;
                            var total = value.Total;
                            var totalsisa = total - totallra;
                            var totalsisa = totalsisa.toString();
                            var dana = value.nilai_sumber;
                            var realisasi = value.realisasi;
                            var sisasumber = dana - realisasi;
                            var rp = sisasumber.toString();

                            // var sisasumber = Number(sisasumber);
                            // var ceknilai = formatRupiah(sisasumber, "Rp. ");
                            var progres = (realisasi / dana) * 100;
                            $("#totalnya input[name='pagunya']").val(formatRupiah(value.nilai, "Rp. "));
                            $("#totalnya input[name='total']").val(formatRupiah(value.Total, "Rp. "));
                            $("#totalnya input[name='perubahan1']").val(value.namaperubahan);
                            $("#totalnya input[name='trealisasi']").val(formatRupiah(value.totalrealisasi, "Rp. "));
                            $("#totalnya input[name='sisarealisasi']").val(formatRupiah(totalsisa, "Rp. "));
                            $("#offcanvasaddsumberdanaopd input[name='namaopd']").val(value.nama_opd);
                            $("#offcanvasaddsumberdanaopd input[name='idopd']").val(value.idopd);
                            table.row
                                .add([
                                    counter,
                                    // value.nama_opd,
                                    value.namasubsumberdana,
                                    formatRupiah(dana, "Rp. "),
                                    formatRupiah(realisasi, "Rp. "),
                                    formatRupiah(rp, "Rp. "),
                                    '<Button type="button" class="btn btn-primary btn-sm editBtn" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-edit"></i></Button>' +
                                    '<Button type="button" class="btn btn-danger btn-sm deleteBtn" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-delete"></i></Button>'
                                    // '<div class="progress"><div class="progress-bar l-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: ' + progres + '%;"></div></div><br><small>' + progres + '%</small>'
                                ])
                                .draw(false);
                                counter++;

                        });
                        modaladdshow();
                    } else if (response.statusCode == 404) {
                        Swal.fire("X", "sync untuk perubahan Baru", "warning");
                        // fetchData();
                        modaladdhide();
                    } else if (response.statusCode == 505) {
                        Swal.fire("X", "OPD Belum Mempunyai Pagu", "warning");
                        // fetchData();
                        modaladdhide();
                    } else if (response.statusCode == 600) {
                        Swal.fire("X", "Silahkan Memilih OPD dengan Benar", "warning");
                        // fetchData();
                        modaladdhide();
                    }


                }
            });
        });

        $('#addperubahan').on('click', function(e) {
            e.preventDefault();
            var id = $('#idopd').val();
            // console.log(id);
            $.ajax({
                url: "proses/setting/sumberopd.php?action=fetchperubahan",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    // var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        Swal.fire("X", "Sukses", "warning");
                        // $("#idopd").change();
                        modaladdshow();
                    } else if (response.statusCode == 404) {
                        Swal.fire("X", "Ini Sudah Sinkron dengan perubahan yang aktif", "warning");
                        // fetchData();
                        modaladdhide();
                    } else if (response.statusCode == 505) {
                        Swal.fire("X", "Tentukan OPD dengan Benar", "warning");
                        // fetchData();
                        modaladdhide();
                    }

                }
            });
        });
        // function to i nsert data to database
        $("#insertdata").on("submit", function(e) {
            $("#saveBtn").attr("disabled");
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
                        $("#saveBtn").removeAttr("disabled");
                        $("#insertdata")[0].reset();
                        Swal.fire("!", "Data Sukses Tersimpan", "success");
                        fetchData();
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

        // function to edit data
        $("#nilaisumberdana").on("click", ".editBtn", function() {
            var id = $(this).val();
            $.ajax({
                url: "proses/setting/sumberopd.php?action=fetchSingle",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    var data = response.data;
                    $("#editForm input[name='idsumberdana']").val(data.id);
                    $("#editForm input[name='idopd']").val(data.id_opd);
                    $("#editForm input[name='namaopd']").val(data.nama_opd);
                    $("#editForm select[name='sumber']").val(data.id_subsumberdana);
                    $("#editForm select[name='perubahan']").val(data.id_perubahan);
                    $("#editForm input[name='nilaisumber']").val(formatRupiah(data.nilai_sumber, "Rp. "));
                    $("#offcanvaseditsumberdanaopd").modal("show");
                }
            });
        });

        // function to update data in database
        $("#editForm").on("submit", function(e) {
            $("#editBtn").attr("disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/setting/sumberopd.php?action=updateData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        Swal.fire("!", "Data Sukses Terupdate", "success");
                        fetchData();
                        // $("#offcanvasEditsumberdana").modal("hide");
                    } else if (response.statusCode == 500) {
                        $("#offcanvasEditsubsumberdana").offcanvas("hide");
                        $("#editBtn").removeAttr("disabled");
                        $("#editForm")[0].reset();
                        //   $(".preview_img").attr("src", "images/default_profile.jpg");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    } else if (response.statusCode == 400) {
                        $("#editBtn").removeAttr("disabled");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    }
                }
            });
        });

        // function to delete data
        $("#nilaisumberdana").on("click", ".deleteBtn", function() {
            if (confirm("Apakah yakin Menghapus Data Ini?")) {
                var id = $(this).val();
                //   var delete_image = $(this).closest("td").find(".delete_image").val();
                $.ajax({
                    url: "proses/setting/sumberopd.php?action=deleteData",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id
                        //   delete_image
                    },
                    success: function(response) {
                        if (response.statusCode == 200) {

                            $("#successToast").toast("show");
                            $("#successMsg").html(response.message);
                            fetchData()
                        } else if (response.statusCode == 500) {
                            $("#errorToast").toast("show");
                            $("#errorMsg").html(response.message);
                            fetchData();
                        }
                    }
                });
            }
        });


        $("#editForm").on("submit", function(e) {
            $("#editBtn").attr("disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/setting/sumberopd.php?action=updateData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        Swal.fire("!", "Data Sukses Terupdate", "success");
                        fetchData();
                        // $("#offcanvasEditsumberdana").modal("hide");
                    } else if (response.statusCode == 500) {
                        $("#offcanvasEditpagu").offcanvas("hide");
                        $("#editBtn").removeAttr("disabled");
                        $("#editForm")[0].reset();
                        //   $(".preview_img").attr("src", "images/default_profile.jpg");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    } else if (response.statusCode == 400) {
                        $("#editBtn").removeAttr("disabled");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    }
                }
            });
        });
    });
</script>