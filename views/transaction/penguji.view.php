<?php
// include_once 'component/session.php';

session_start();
include 'lib/conn.php';
if (!isset($_SESSION['username'])) {
    header('Location: /login');
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
                    <h3>ENTRY PENGUJI</h3> <br>
                </div>
                <div class="col-lg-2">
                    <!-- <h6>ENTRY PENGUJI</h6> <br> -->
                </div>
            </div>
        </div>
        <div class="container-fluid ">
            <div class="d-flex">
                <div class="p-2">
                    <h6>INVOICE PENGUJI</h6>
                    <label for="">20221212132</label>
                </div>
                <!-- <div class="p-2">Flex item</div> -->
                <div class="ml-auto p-2">
                    <input
                        type="text"
                        class="form-control"
                        name="kodespm" id='kodespm'
                        placeholder="kode SPM" required />

                </div>
                <div class="p-2">
                    <button
                        type="button"
                        class="btn btn-danger waves-effect"
                        data-dismiss="modal" id="cari">
                        Cari
                    </button>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description">List SPM</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#review">List Daftar Penguji</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about">Penguji terhapus</a></li>
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
                                    <div class="container-fluid ">
                                        <div class="d-flex">
                                            <!-- <div class="p-2">Flex item</div> -->
                                            <div class="ml-auto p-2">
                                               <h4>Total</h4>

                                            </div>
                                            <div class="p-2">
                                                <h4>2.000.000</h4>
                                            </div>
                                        </div>

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
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Sumber Dana Per OPD</a></li>
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
                                                            <th>Nama OPD</th>
                                                            <th>Alokasi Pagu</th>
                                                            <th>DAU BG</th>
                                                            <th>PAD</th>
                                                            <!-- <th>DBH PROV</th> -->
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
</section>>
<?php
include 'views/footer.view.php';
?>

<div class="modal fade " id="listspm" tabindex="-1" role="dialog">
    <button>Print</button><br><br><br>
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