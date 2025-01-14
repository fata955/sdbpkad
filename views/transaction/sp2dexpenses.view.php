<?php
include_once 'component/session.php';
    include 'views/header.view.php';
?>

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Expenses</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Budget</a></li>
                        <li class="breadcrumb-item active">Tagihan</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <h5>Dana Ready</h5>
        <div class="container-fluid ">
            <div class="row clearfix d-flex justify-content-center">
                <?php

                    include 'lib/conn.php';
                    function rupiah($angka)
                    {

                        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                        return $hasil_rupiah;
                    }
                    $lacaksalur = mysqli_query($conn, "SELECT a.id,a.tanggal_salur,a.tujuan_dana,a.periode,a.nilai_dana,b.namasubsumberdana, (SELECT sum(nilai_spm) from sipd.t_spm where id_sumberdana=a.jenis_dana) as tagihan from subssumber b, t_salur a where a.jenis_dana=b.id AND a.status='AKTIF'");
                    while ($fetch = mysqli_fetch_array($lacaksalur)) {

                ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-center ">
                    <div class="card">
                        <div class="body">
                            <input type="text" class="knob" value="<?php $nilaisalur=$fetch['nilai_dana'];$nilaitagihan=$fetch['tagihan']; $sisa = ($nilaitagihan/$nilaisalur)*100; echo round($sisa)?>" data-linecap="round" data-width="100"
                                data-height="100" data-thickness="0.08" data-fgColor="#ee2558" readonly>
                            <p>
                                <?=$fetch['namasubsumberdana'];?>
                            </p>
                            <div class="d-flex bd-highlight text-center mt-4">
                                <div class="flex-fill bd-highlight">
                                    <small class="text-muted">Nilai Salur</small>
                                    <h6 class="mb-0">
                                        <?= rupiah($fetch['nilai_dana']);?> 
                                    </h6>
                                </div>
                                <div class="flex-fill bd-highlight">
                                    <small class="text-muted">Tagihan SP2D</small>
                                    <h6 class="mb-0"><?= rupiah($fetch['tagihan']);?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
            ?>
            </div>
           
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="d-flex">
                        <div class="mobile-left">
                            <a class="btn btn-info btn-icon toggle-email-nav collapsed" data-toggle="collapse"
                                href="#email-nav" role="button" aria-expanded="false" aria-controls="email-nav">
                                <span class="btn-label"><i class="zmdi zmdi-more"></i></span>
                            </a>
                        </div>
                        <div class="inbox left" id="email-nav">
                            <div class="mail-side">
                                <ul class="nav">
                                    <li ><a href="/sdbpkad/expenses"><i
                                                class="zmdi zmdi-inbox"></i>SPM<span
                                                class="badge badge-primary">6</span></a></li>
                                    <!-- <li><a href="javascript:void(0);"><i class="zmdi zmdi-mail-send"></i>Sudah Diverifikasi<span class="badge badge-primary">2</span></a></li> -->
                                    <li class="active"><a href="javascript:void(0);"><i class="zmdi zmdi-badge-check"></i>SP2D </a>
                                    </li>
                                    <li><a href="javascript:void(0);"><i class="zmdi zmdi-file"></i>Daftar Penguji<span
                                                class="badge badge-info">3</span></a></li>

                                </ul>

                            </div>
                        </div>
                        <div class="inbox right">

                            <div class="container-fluid">
                                <!-- Example Tab -->
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2><strong>Tagihan</strong> SPM</h2>
                                            </div>
                                            <div class="body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs p-0 mb-3">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                            href="#home">SP2D</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                            href="#profile">TELAH VERIFIKASI</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                            href="#messages">DHAPUS</a></li>
                                                    <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                            href="#settings">LAPORAN</a></li> -->
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane in active" id="home">
                                                        <div class="container-fluid">
                                                            <div class="row clearfix">
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table table-bordered table-striped table-hover dataTable js-exportable"
                                                                                style="width: 600px;" id="tablesp2d">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th data-breakpoints="xs">Verif
                                                                                        </th>
                                                                                        <th>id</th>
                                                                                        <th>Nomor SP2D</th>
                                                                                        <th>Opd</th>
                                                                                        <th>Keterangan</th>
                                                                                        <th>Nilai</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="profile">
                                                        <div class="container-fluid">
                                                            <div class="row clearfix">
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table table-bordered table-striped table-hover dataTable js-exportable"
                                                                                style="width: 600px;" id="tablesp2dver">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th data-breakpoints="xs">Verif
                                                                                        </th>
                                                                                        <th>id</th>
                                                                                        <th>Nomor SP2D</th>
                                                                                        <th>Opd</th>
                                                                                        <th>Keterangan</th>
                                                                                        <th>Nilai</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="messages">
                                                        <b>Message Content</b>
                                                        <p> ius impedit mediocritatem an. Pri ut tation electram
                                                            moderatius.
                                                            Per te suavitate democritum. Duis nemore probatus ne quo, ad
                                                            liber essent aliquid
                                                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est,
                                                            eu munere gubergren
                                                            sadipscing mel. </p>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="settings">
                                                        <b>Settings Content</b>
                                                        <p> Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius
                                                            impedit mediocritatem an. Pri ut tation electram moderatius.
                                                            Per te suavitate democritum. Duis nemore probatus ne quo, ad
                                                            liber essent aliquid
                                                            pro. </p>
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
</section>
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

<script src="assets/bundles/morrisscripts.bundle.js"></script> <!-- Morris Plugin Js -->
<script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->
<!-- <script src="assets/bundles/mainscripts.bundle.js"></script> -->
<script src="assets/js/pages/ecommerce.js"></script>
<script src="assets/js/pages/charts/jquery-knob.min.js"></script>



<div class="modal fade" id="offcanvasEditopd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="editForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">VERIFIKASI SP2D</h4>
                </div>
                <input type="hidden" name="id" id="id">

                <div class="modal-body">
                    <h6>Nomor Sp2d</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nomorspm" disabled />
                    </div>
                    <h6>Keperluan</h6>
                    <div class="input-group mb-3">
                        <!-- <input
              type="text"
              class="form-control"
              name="keterangan" disabled/> -->
                        <textarea class="form-control" name="keterangan" rows="5" disabled></textarea>
                    </div>
                    <h6>Nama OPD</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="opd" disabled />
                    </div>
                    <h6>Nilai Spm</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nilai_spm" disabled />
                    </div>
                    <h6>Sumber Dana</h6>
                    <div class="input-group mb-3">

                        <select name='idsumber' class="form-control ms">
                            <option value=''> -PILIH SUMBER DANA-</option>
                            <?php
                            include '../../lib/conn.php';
                            $sumberdana = mysqli_query($conn, "SELECT * from subssumber");
                            while ($fetch = mysqli_fetch_array($sumberdana)) {
                                echo "<option value='$fetch[id]'> $fetch[namasubsumberdana] </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <h6>Berkas SPM</h6>
                    <div class="input-group mb-3">
                        <input type="file" class="dropify" name="berkasspm">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-round waves-effect" id="editBtn">
                        Approve
                    </button>
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        fetchData();
        fetchDataVer();
        let table = new DataTable("#tablesp2d");
        let table1 = new DataTable("#tablesp2dver");
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

        // function to fetch data from database
        function fetchData() {
            $.ajax({
                url: "proses/transaction/executesp2d.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function (response) {
                    var data = response.data;
                    table.clear().draw();
                    $.each(data, function (index, value) {
                        var dana = value.nilai_sp2d;
                        table.row
                            .add([
                                '<Button type="button" class="btn-primary btn-sm editBtn" value="' + value
                                    .id +
                                '"><i class="zmdi zmdi-edit"></Button>',
                                value.id,
                                value.nomor_sp2d,
                                value.nama_skpd,
                                value.keterangan_sp2d,
                                formatRupiah(dana, "Rp. "),

                            ])
                            .draw(false);
                    });
                }
            });
        }
        // function to fetch data from database
        function fetchDataVer() {
            $.ajax({
                url: "proses/transaction/executespm.php?action=fetchDataVer",
                type: "POST",
                dataType: "json",
                success: function (response) {
                    var data = response.data;
                    table1.clear().draw();
                    $.each(data, function (index, value) {
                        var dana = value.nilai_sp2d;
                        table1.row
                            .add([
                                '<Button class="btn-primary btn-sm editBtn" value="' + value
                                    .id +
                                '"><i class="zmdi zmdi-edit"></i></Button>',
                                value.id,
                                value.nomor_sp2d,
                                value.nama_skpd,
                                value.keterangan_sp2d,
                                formatRupiah(dana, "Rp. "),

                            ])
                            .draw(false);
                    });
                }
            });
        }

        $("#tablesp2d").on("click", ".editBtn", function () {

            var id = $(this).val();
            $.ajax({
                url: "proses/transaction/executesp2d.php?action=fetchSingle",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function (response) {
                    var data = response.data;
                    var danasp2d = data.nilai_sp2d;
                    $("#editForm #id").val(data.id);
                    $("#editForm input[name='nomorspm']").val(data.nomor_sp2d);
                    $("#editForm textarea[name='keterangan']").val(data.keterangan_sp2d);
                    $("#editForm input[name='opd']").val(data.nama_skpd);
                    $("#editForm input[name='nilai_spm']").val(formatRupiah(danasp2d, "Rp. "));
                    // $("#editForm select[name='country']").val(data.country);
                    // $("#editForm .preview_img").attr("src", "uploads/" + data.image + "");
                    // $("#editForm #image_old").val(data.image);
                    // if (data.gender === "male") {
                    //   $("#editForm input[name='gender'][value='male']").attr("checked", true);
                    // } else if(data.gender === "female") {
                    //   $("#editForm input[name='gender'][value='female']").attr("checked", true);
                    // }
                    // show the edit user offcanvas
                    $("#offcanvasEditopd").modal("show");
                }
            });
        });



    });
</script>