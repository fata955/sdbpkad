<?php
// include_once 'component/session.php';

session_start();
include 'lib/conn.php';
if (!isset($_SESSION['username'])) {
    header('Location: /sdbpkad/login');
    exit();
}
include 'views/header.view.php';
// $date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d", strtotime(date("Y-m-d") . " -7 days"));
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d");
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] :  date("Y-m-d");
?>
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">

<section class="content">
    <div class="body_scroll">
        <div class="container-fluid ">
            <div class="row clearfix flex justify-content-between">
                <div class="col-lg-10">
                    <h6>Halaman Kerja Verifikasi SPM</h6> <br>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary" id='buattagihan' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                        data-target="#listspm"><i class="zmdi zmdi-assignment"></i><br>Input Tagihan</button>
                </div>
            </div><br>

            <form method="post" id='filtertanggal'>
                <div class="row clearfix flex justify-content-center">
                    <div class="col-lg-2">
                        <label for="skpd">Nama OPD</label><br>
                        <select name='opdlg' id='opdlg' class="form-control show-tick ms select2" required>
                            <option value="1">Konsolidasi</option>
                            <?php
                            $opd = mysqli_query($conn, "SELECT * from skpd") or die(mysqli_error($conn));
                            while ($fetch = mysqli_fetch_array($opd)) {
                            ?>
                                <option value="<?= $fetch['id_sipd']; ?>"> <?= $fetch["nama_opd"]; ?> </option>";
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Dari Tanggal</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" value="<?php echo date("Y-m-01") ?>">

                    </div>
                    <div class="col-lg-2">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="date_end" name="date_end" value="<?php echo date("Y-m-d") ?>">
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <button class="btn btn-info" id="filter"><i class="zmdi zmdi-search mr-2"></i>Berdasarkan Tanggal SPM</button>
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <button class="btn btn-secondary" id="tglverif"><i class="zmdi zmdi-search mr-2"></i>Berdasarkan Tanggal Verfikasi</button>
                    </div>



                </div><br>

                <div class="row clearfix flex justify-content-center">
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>
                                    <h6 id="total_spm" name="total_spm"></h6>
                                    <span><i class="zmdi zmdi-money col-amber mr-2"></i> Realisasi SPM</span>
                                </div>
                                <!-- <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#FFC107">5,2,3,7,6,4,8,1</div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>
                                    <h6 id="jumlah_spm" name="jumlah_spm"></h6>
                                    <span><i class="zmdi zmdi-file col-blue mr-2"></i>SPM</span>
                                </div>
                                <!-- <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#46b6fe">8,2,6,5,1,4,4,3</div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>
                                    <h6 id="jumlah_ls" name="jumlah_ls"></h6>
                                    <span><i class="zmdi zmdi-file col-red mr-2"></i>LS</span>
                                </div>
                                <!-- <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#ee2558">4,4,3,9,2,1,5,7</div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>
                                    <h6 id="jumlah_gu" name="jumlah_gu"></h6>
                                    <span><i class="zmdi zmdi-file text-secondary mr-2"></i>GU</span>
                                </div>
                                <!-- <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#04BE5B">7,5,3,8,4,6,2,9</div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card state_w1">
                            <div class="body d-flex justify-content-between">
                                <div>
                                    <h6 id="jumlah_up" name="jumlah_up"></h6>
                                    <span><i class="zmdi zmdi-file text-success mr-2"></i>UP</span>
                                </div>
                                <!-- <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#04BE5B">7,5,3,8,4,6,2,9</div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description">List SPM</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#review">Dihapus</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about">Sumber Dana</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="description">
                                    <div class="table-responsive" id="tabelnya">
                                        <table class="table table-hover c_table theme-color table-striped table-hover dataTable js-exportable" id="nilaisumberdana">
                                            <thead>
                                                <tr>
                                                    <!-- <th>No</th> -->
                                                    <th>No SPM</th>
                                                    <th>Nama OPD</th>
                                                    <th>Jenis Dokumen</th>
                                                    <th>Nilai SPM</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="review">
                                    <div class="table-responsive" id="hapus">
                                        <table class="table table-hover c_table theme-color table-striped table-hover dataTable js-exportable" id="spmterhapus">
                                            <thead>
                                                <tr>
                                                    <!-- <th>No</th> -->
                                                    <th>No SPM</th>
                                                    <th>Nama OPD</th>
                                                    <th>Jenis Dokumen</th>
                                                    <th>Nilai SPM</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="about">
                                    <ul class="nav nav-tabs p-0 mb-3">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Rekapan Sumber Dana</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Rekapan Pembagian Sumber dana</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane in active" id="home">
                                            <div class="table-responsive" id="tabelsumberdana">
                                                <table class="table table-hover c_table theme-color table-striped table-hover dataTable js-exportable" id="lpsumberdana">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th>No</th> -->
                                                            <th>Sumber dana</th>
                                                            <th>Pagu Sumberdana</th>
                                                            <th>Realisasi</th>
                                                            <th>Sisa Sumber Dana</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="profile">
                                            <b>Profile Content</b>
                                            <p> Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate essent aliquid
                                                pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                                sadipscing mel. </p>
                                        </div>
                                        <!-- <div role="tabpanel" class="tab-pane" id="messages">
                                            <b>Message Content</b>
                                            <p> ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                                pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                                sadipscing mel. </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="settings">
                                            <b>Settings Content</b>
                                            <p> Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                                pro. </p>
                                        </div> -->
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

<div class="modal fade " id="listspm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-col-pink" role="document">
        <form method="POST" id="loaddata">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">DATA SPM</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card" id="">
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color table-striped table-hover dataTable js-exportable" id="myTablespm">
                                        <thead>
                                            <tr style="height: 10%;">
                                                <!-- <th>ID</th> -->
                                                <th>action</th>
                                                <th>Nomor_spm</th>
                                                <th>Keterangan</th>
                                                <th>OPD</th>
                                                <th>Nilai</th>
                                                <th>tanggal Inputan</th>
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
        </form>
    </div>
</div>

<div class="modal fade" id="offcanvasaddtagihan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="insertdata">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Input Dana dan Alokasi Sumber Dana</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input
                            type="hidden"
                            class="form-control"
                            name="idspm" id='idspm' required />
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="nospm" id='nospm'
                            placeholder="Input No SPM" required />
                    </div>
                    <div class="input-group mb-3">
                        <textarea
                            type="text"
                            class="form-control"
                            name="ketspm" id='ketspm'
                            placeholder="Keterangan"
                            rows="4" cols="50" required></textarea>
                        <!-- <button class="btn">...</button> -->
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nilai SPM"
                            name="nilaispm" id='nilaispm' required />
                    </div>
                    <div class="input-group mb-3">
                        <select name='dokumen' id='dokumen' class="form-control show-tick ms " required>
                            <option value="0" default>--JENIS DOKUMEN--</option>
                            <option value="LS">LS</option>
                            <option value="GU">GU</option>
                            <option value="UP">UP</option>
                            <option value="TU">TU</option>
                        </select>
                    </div>
                    <label for="opd" id="lopd">Nama OPD</label><br>
                    <div class="input-group mb-3">
                        <select name='opd' id='opd' class="form-control show-tick ms" required>
                            <?php
                            $opd = mysqli_query($conn, "SELECT * from skpd") or die(mysqli_error($conn));
                            while ($fetch = mysqli_fetch_array($opd)) {
                            ?>
                                <option value="<?= $fetch['id_sipd']; ?>"> <?= $fetch["nama_opd"]; ?> </option>";
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <label for="dana" id="ldana">Dana Ready (KAS)</label><br>
                    <div class="input-group mb-3">
                        <select name='dana' id='dana' class="form-control show-tick ms" required>
                            <?php
                            $opd = mysqli_query($conn, "SELECT a.jenis_dana,b.namasumberdana from t_salur a, t_sumberdana b where b.id=a.jenis_dana") or die(mysqli_error($conn));
                            while ($fetch = mysqli_fetch_array($opd)) {
                            ?>
                                <option value="<?= $fetch['jenis_dana']; ?>"> <?= $fetch["namasumberdana"]; ?> </option>";
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <label for="sumberdana" id="lnamasumber">Alokasi Sumber Dana</label><br>
                    <div class="input-group mb-3">
                        <select name='namasumber' id='namasumber' class="form-control show-tick ms" required>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-default waves-effect"
                        id="insertBtn">
                        SAVE
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger waves-effect"
                        data-dismiss="modal" id="keluar">
                        CLOSE
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>



<div class="modal fade" id="offcanvaedittagihan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="editdata">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Edit Tagihan SPM</h4>
                </div>
                <div class="modal-body">
                    <!-- <div class="input-group mb-3">
                        <input
                            type="hidden"
                            class="form-control"
                            name="nsalur" id='nsalur' readonly />
                    </div> -->
                    <div class="input-group mb-3">
                        <input
                            type="hidden"
                            class="form-control"
                            name="idspm" id='idspm' disabled />
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="nospm" id='nospm'
                            placeholder="Input No SPM" disabled /> <br>
                        <!-- <div> <a href="" class="btn btn-primary ml-2" data-toggle="modal"
                                data-target="#listspm">Pilih SPM</a></div> -->
                    </div>

                    <div class="input-group mb-3">
                        <textarea
                            type="text"
                            class="form-control"
                            name="ketspm" id='ketspm'
                            placeholder="Keterangan"
                            rows="4" cols="50" disabled></textarea>
                        <!-- <button class="btn">...</button> -->
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nilai SPM"
                            name="nilaispm" id='nilaispm' disabled />
                    </div>
                    <div class="input-group mb-3">
                        <select name='dokumen' id='dokumen' class="form-control show-tick ms " disabled>
                            <option value="0">--JENIS DOKUMEN--</option>
                            <option value="LS">LS</option>
                            <option value="GU">GU</option>
                            <option value="UP">UP</option>
                            <option value="TU">TU</option>
                        </select>
                    </div>
                    <label for="opd">Nama OPD</label><br>
                    <div class="input-group mb-3">
                        <select name='opd' id='opd' class="form-control show-tick ms" disabled>
                            <?php
                            $opd = mysqli_query($conn, "SELECT * from skpd") or die(mysqli_error($conn));
                            while ($fetch = mysqli_fetch_array($opd)) {
                            ?>
                                <option value="<?= $fetch['id_sipd']; ?>"> <?= $fetch["nama_opd"]; ?> </option>";
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <label for="dana">Sumber Dana</label><br>
                    <div class="input-group mb-3">
                        <select name='namasumber' id='namasumber' class="form-control show-tick ms">
                            <option value="">Pilih Sumberdana</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-success waves-effect"
                        id="updateBtn">
                        UPDATE
                    </button>
                    <!-- <button
                        type="button"
                        class="btn btn-danger waves-effect"
                        data-dismiss="modal">
                        CLOSE
                    </button> -->
                </div>

            </div>
        </form>
    </div>
</div>

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
        // sembunyi();
        let table = new DataTable("#myTablespm");
        let table2 = new DataTable("#nilaisumberdana");
        let rekapsumberdana = new DataTable("#lpsumberdana");
        /* Dengan Rupiah */
        var nilaispm = document.getElementById('nilaispm');
        nilaispm.addEventListener('keyup', function(e) {
            nilaispm.value = formatRupiah(this.value, 'Rp. ');
        })

        fetchspm();
        fetchVerif();

        // $("#listspm").modal("hide");
        $('#s_sumber').show();

        function kosong() {
            $('#idspm').prop('value', ''); // Mengosongkan input
            // $('#nsalur').prop('value', ''); // Mengosongkan input
            $('#nospm').prop('value', ''); // Mengosongkan input
            $('#ketspm').prop('value', ''); // Mengosongkan input
            $('#nilaispm').prop('value', ''); // Mengosongkan input
            $('#dokumen').prop('value', '--JENIS DOKUMEN--'); // Mengosongkan input
            $('#opd').prop('value', ''); // Mengosongkan input
            $('#namasumber').prop('value', ''); // Mengosongkan input
            $('#ketspm').prop('disabled', false);
            $('#nospm').prop('disabled', false);
            $('#nilaispm').prop('disabled', false);
            $('#opd').prop('disabled', false);
        }


        function enbld() {
            $('#ketspm').prop('disabled', false);
            $('#nospm').prop('disabled', false);
            $('#nilaispm').prop('disabled', false);
            $('#dokumen').prop('disabled', false);
            $('#opd').prop('disabled', false);
        }

        function disbled() {
            $('#ketspm').prop('disabled', true);
            $('#nospm').prop('disabled', true);
            $('#nilaispm').prop('disabled', true);
            $('#dokumen').prop('disabled', true);
            $('#opd').prop('disabled', true);
        }

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
        function fetchspm() {
            $.ajax({
                url: "proses/transaction/expenses.php?action=fetchVerifikasi",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    table.clear().draw();
                    $.each(data, function(index, value) {
                        table.row
                            .add([
                                // value.id,
                                '<Button type="button" class="btn btn-primary btn-sm editBtnspm" data-target="#offcanvasaddtagihan" data-toggle="modal" value="' +
                                value.id +
                                '"><i class="zmdi zmdi-assignment-check"></i></Button>',
                                value.nomor_spm,
                                value.keterangan_spm,
                                value.nama_sub_skpd,
                                value.nilai_spm,
                                value.tanggal_spm
                            ])
                            .draw(false);
                    });
                }
            });
        }

        // function to fetch data from database
        function fetchVerif() {
            $.ajax({
                url: "proses/transaction/expenses.php?action=fetchVerif",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    var data2 = response.data2;
                    var realisasi = response.realisasi;
                    var spm = response.spm;
                    var ls = response.ls;
                    var gu = response.gu;
                    var up = response.up;
                    var realisasi = formatRupiah(realisasi, "Rp.");
                    $('#total_spm').text(realisasi);
                    $('#jumlah_spm').text(spm);
                    $('#jumlah_ls').text(ls);
                    $('#jumlah_gu').text(gu);
                    $('#jumlah_up').text(up);

                    table2.clear().draw();
                    $.each(data, function(index, value) {
                        table2.row
                            .add([
                                value.nomor_spm,
                                value.skpd,
                                value.jenis,
                                formatRupiah(value.nilai_spm, "Rp. "),
                                // value.nilai_spm,
                                '<Button type="button" class="btn btn-warning btn-sm viewBtnsubsumber" value="' +
                                value.id +
                                '"><i class="zmdi zmdi-eye"></i></Button>' +
                                '<Button type="button"  class="btn btn-primary btn-sm EditBtnsubsumber" data-toggle="modal" data-target="#offcanvaedittagihan" value="' +
                                value.id +
                                '"><i class="zmdi zmdi-edit"></i></Button>' +
                                '<Button type="button" class="btn btn-danger btn-sm deleteBtnsubsumber" value="' +
                                value.id +
                                '"><i class="zmdi zmdi-delete"></i></Button>'
                            ])
                            .draw(false);
                    });
                    rekapsumberdana.clear().draw();
                    $.each(data2, function(index, value) {
                        rekapsumberdana.row
                            .add([
                                value.namasumberdana,
                                formatRupiah(value.nilai, "Rp. "),
                                formatRupiah(value.realisasinya, "Rp. "),
                                formatRupiah(value.sisanya, "Rp. "),
                                // value.sisanya
                            ])
                            .draw(false);
                    });



                }
            });
        }
        // function to edit data
        $("#filtertanggal").on("click", "#filter", function(e) {
            e.preventDefault();
            var start = $('#date_start').val();
            var end = $('#date_end').val();
            var opdlg = $('#opdlg').val();
            $.ajax({
                url: "proses/transaction/expenses.php?action=filtertanggal",
                type: "POST",
                dataType: "json",
                data: {
                    start: start,
                    end: end,
                    opdlg: opdlg
                },
                success: function(response) {
                    if (response.data == 0) {
                        $('#total_spm').text('0');
                        $('#jumlah_spm').text('0');
                        $('#jumlah_ls').text('0');
                        $('#jumlah_gu').text('0');
                        $('#jumlah_up').text('0');
                        table2.clear().draw();
                    } else {
                        var data = response.data;
                        var realisasi = response.realisasi;
                        var spm = response.spm;
                        var ls = response.ls;
                        var gu = response.gu;
                        var up = response.up;
                        var realisasi = formatRupiah(realisasi, "Rp.");
                        $('#total_spm').text(realisasi);
                        $('#jumlah_spm').text(spm);
                        $('#jumlah_ls').text(ls);
                        $('#jumlah_gu').text(gu);
                        $('#jumlah_up').text(up);

                        table2.clear().draw();
                        // var counter = 1;
                        $.each(data, function(index, value) {

                            table2.row
                                .add([
                                    // counter,
                                    value.nomor_spm,
                                    value.skpd,
                                    value.jenis,
                                    formatRupiah(value.nilai_spm, "Rp. "),
                                    // value.nilai_spm,
                                    '<Button type="button" class="btn btn-warning btn-sm viewBtnsubsumber" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-eye"></i></Button>' +
                                    '<Button type="button"  class="btn btn-primary btn-sm EditBtnsubsumber" data-toggle="modal" data-target="#offcanvaedittagihan" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-edit"></i></Button>' +
                                    '<Button type="button" class="btn btn-danger btn-sm deleteBtnsubsumber" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-delete"></i></Button>'
                                    // '<div class="progress"><div class="progress-bar l-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: ' + progres + '%;"></div></div><br><small>' + progres + '%</small>'
                                ])
                                .draw(false);
                            // counter++;
                        });

                        rekapsumberdana.clear().draw();
                        $.each(data2, function(index, value) {
                            rekapsumberdana.row
                                .add([
                                    value.namasumberdana,
                                    formatRupiah(value.nilai, "Rp. "),
                                    formatRupiah(value.realisasinya, "Rp. "),
                                    formatRupiah(value.sisanya, "Rp. "),
                                    // value.sisanya
                                ])
                                .draw(false);
                        });

                    }
                }
            });
        });


        $("#filtertanggal").on("click", "#tglverif", function(e) {
            e.preventDefault();
            var start = $('#date_start').val();
            var end = $('#date_end').val();
            var opdlg = $('#opdlg').val();
            $.ajax({
                url: "proses/transaction/expenses.php?action=filtertglverif",
                type: "POST",
                dataType: "json",
                data: {
                    start: start,
                    end: end,
                    opdlg: opdlg
                },
                success: function(response) {
                    if (response.data == 0) {
                        $('#total_spm').text('0');
                        $('#jumlah_spm').text('0');
                        $('#jumlah_ls').text('0');
                        $('#jumlah_gu').text('0');
                        $('#jumlah_up').text('0');
                        table2.clear().draw();
                    } else {
                        var data = response.data;
                        var data = response.data2;
                        var realisasi = response.realisasi;
                        var spm = response.spm;
                        var ls = response.ls;
                        var gu = response.gu;
                        var up = response.up;
                        var realisasi = formatRupiah(realisasi, "Rp.");
                        $('#total_spm').text(realisasi);
                        $('#jumlah_spm').text(spm);
                        $('#jumlah_ls').text(ls);
                        $('#jumlah_gu').text(gu);
                        $('#jumlah_up').text(up);

                        table2.clear().draw();
                        // var counter = 1;
                        $.each(data, function(index, value) {

                            table2.row
                                .add([
                                    // counter,
                                    value.nomor_spm,
                                    value.skpd,
                                    value.jenis,
                                    formatRupiah(value.nilai_spm, "Rp. "),
                                    // value.nilai_spm,
                                    '<Button type="button" class="btn btn-warning btn-sm viewBtnsubsumber" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-eye"></i></Button>' +
                                    '<Button type="button"  class="btn btn-primary btn-sm EditBtnsubsumber" data-toggle="modal" data-target="#offcanvaedittagihan" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-edit"></i></Button>' +
                                    '<Button type="button" class="btn btn-danger btn-sm deleteBtnsubsumber" value="' +
                                    value.id +
                                    '"><i class="zmdi zmdi-delete"></i></Button>'
                                    // '<div class="progress"><div class="progress-bar l-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: ' + progres + '%;"></div></div><br><small>' + progres + '%</small>'
                                ])
                                .draw(false);
                            // counter++;
                        });

                        rekapsumberdana.clear().draw();
                        $.each(data2, function(index, value) {
                            rekapsumberdana.row
                                .add([
                                    value.namasumberdana,
                                    formatRupiah(value.nilai, "Rp. "),
                                    formatRupiah(value.realisasinya, "Rp. "),
                                    formatRupiah(value.sisanya, "Rp. "),
                                    // value.sisanya
                                ])
                                .draw(false);
                        });

                    }
                }
            });
        });



        function getFormattedDate() {
            const today = new Date();
            const formattedDate = today.toLocaleDateString('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            });
            return formattedDate;
        }
        $("#buattagihan").on("click", function() {
            // kosong();
            fetchspm();
        });

        $("#myTablespm").on("click", ".editBtnspm   ", function() {

            var id = $(this).val();
            $.ajax({
                url: "proses/transaction/expenses.php?action=fetchSingle",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {

                    // muncul();
                    var data = response.data;
                    var dana = data.nilai_spm;
                    $("#insertdata #idspm").val(data.id);
                    $("#insertdata #nospm").val(data.nomor_spm);
                    $("#insertdata #ketspm").val(data.keterangan_spm);
                    $("#insertdata input[name='nilaispm']").val(formatRupiah(dana, "Rp. "));
                    $("#insertdata select[name='dokumen']").val(data.jenis);
                    $("#insertdata select[name='opd']").val(data.id_skpd);
                    // $('#listspm').hide();
                    if (response.statusCode == 200) {
                        disbled();
                    } else if (response.statusCode == 400) {

                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    } else if (response.statusCode == 401) {

                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // function to edit data
        $("#dana").on("change", function() {
            var idsalur = $('#dana').val();
            var idopd = $('#opd').val();
            // $('#selected').text(selectedPackage);
            // kosong();
            $.ajax({
                url: "proses/transaction/expenses.php?action=fetchSalur",
                type: "POST",
                dataType: "json",
                data: {
                    idsalur: idsalur,
                    idopd: idopd
                },
                success: function(response) {
                    var data1 = response.sum;
                    var data = response.data;

                    var select = $('#namasumber');
                    select.empty();
                    data.forEach(function(item) {
                        select.append(new Option(item.name, item.id));
                    });
                    // fetchspm();
                    // kosong();
                    // $('#idspm').val('11111');
                }
            });
        });
        // function to edit data

        // function to insert data to database
        // function to insert data to database
        $("#insertdata").on("submit", function(e) {
            // $("#insertBtn").attr("disabled");
            enbld();
            e.preventDefault();
            $.ajax({
                url: "proses/transaction/expenses.php?action=insertData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        Swal.fire("!", "Tagihan Berhasil terinput", "success");
                        kosong();
                        fetchVerif();
                        disbled();

                        // window.location.href = '/sdbpkad/expenses';
                    } else if (response.statusCode == 400) {
                        Swal.fire("!", "Alokasi Dana Belum Terinput", "warning");
                    } else if (response.statusCode == 402) {
                        Swal.fire("!", "Pagu Sumberdana opd Belum terinput !", "warning");
                    } else if (response.statusCode == 600) {
                        Swal.fire("!", "Pagu Sumberdana sudah tidak mencukupi, cek kembali sisa pagu opd bersangkutan !", "warning");
                    } else if (response.statusCode == 500) {
                        Swal.fire("!", "Perhatikan inputan anda, sepertinya ada kekeliruan", "warning");
                    } else if (response.statusCode == 503) {
                        Swal.fire("!", "Inputan Belum Terisi");
                    } else if (response.statusCode == 504) {
                        Swal.fire("!", "Function Bermasalah Segera Hubungi Admin Sistem");
                    }
                }

            });
        });


        // function to edit data
        $("#dataall").on("click", function() {

            // var today = new date();
            window.location.href = '/sdbpkad/expenses';

            $('#date_start').val(getFormattedDate());
            $('#date_end').val(getFormattedDate());

        });
        // function print laporan 
        $("#filtertanggal").on("click", "#dataprint", function(e) {
            e.preventDefault();
            var start = $('#date_start').val();
            var end = $('#date_end').val();

            $.ajax({
                url: "proses/transaction/expenses.php?action=printData",
                type: "POST",
                dataType: "json",
                data: {
                    start: start,
                    end: end
                },
                success: function(response) {
                    // var printWindow = window.open('', '_blank');
                    // printWindow.document.write(response);
                    // printWindow.document.close();
                    // printWindow.print();
                    window.print(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
        // function to delete data
        $("#nilaisumberdana").on("click", ".deleteBtnsubsumber", function() {
            if (confirm("Apakah yakin Menghapus Beranda Anda?")) {
                var id = $(this).val();
                //   var delete_image = $(this).closest("td").find(".delete_image").val();
                $.ajax({
                    url: "proses/transaction/expenses.php?action=deleteSB",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id
                        //   delete_image
                    },
                    success: function(response) {
                        if (response.statusCode == 200) {
                            fetchVerif();
                            Swal.fire("!", "Data Sukses Terhapus dari Beranda", "success");
                            //   window.location.href = '/sdbpkad/expenses';

                        } else if (response.statusCode == 500) {
                            fetchVerif();
                            Swal.fire("!", "Data Gagal terhapus", "Warning");

                        }
                    }
                });
            }
        });
        // function to edit data
        $("#nilaisumberdana").on("click", ".EditBtnsubsumber", function() {
            var id = $(this).val();
            $.ajax({
                url: "proses/transaction/expenses.php?action=Single",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    var data = response.data;
                    var dana = data.nilai;
                    $("#editdata #idspm").val(data.id);
                    $("#editdata #nospm").val(data.nomor_spm);
                    $("#editdata #ketspm").val(data.keterangan_spm);
                    $("#editdata input[name='nilaispm']").val(formatRupiah(dana, "Rp. "));
                    $("#editdata select[name='dokumen']").val(data.jenis_spm);
                    $("#editdata select[name='opd']").val(data.id_skpd);
                    $("#editdata select[name='namasumber']").val(data.id_sumberdana);

                    // show the edit user offcanvas
                    $("#offcanvaedittagihan").modal("show");
                }
            });
        });

    });
</script>