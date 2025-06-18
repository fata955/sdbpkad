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

<section class="content">
    <div class="body_scroll">
        <div class="container-fluid">
            <div class="row clearfix flex justify-content-between">
                <div class="col-lg-10">
                    <h6>DAFTAR PENGUJI</h6> <br>
                </div>
                <div class="col-lg-2">
                    <!-- <button class="btn btn-primary" id='buattagihan' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                        data-target="#listspm"><i class="zmdi zmdi-assignment"></i><br>Input Tagihan</button> -->
                </div>
            </div>
            <form method="post" id='filtertanggal'>
                <div class="row flex justify-content-between ">
                    <div class="col-lg-2">
                        <label for="">Nomor Penguji</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nomor Penguji" aria-label="Masukkan Nomor Penguji" aria-describedby="button-addon2">
                        <!-- <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button> -->

                    </div>
                    <div class="col-lg-2">
                        <label for="">Dari Tanggal</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" value="<?php echo date("Y-m-01") ?>">

                    </div>
                    <div class="col-lg-2">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="date_end" name="date_end" value="<?php echo date("Y-m-d") ?>">
                    </div>
                    <!-- <div class="col-lg-1">
                        <br>
                        <button class="btn btn-info" id="filter"><i class="zmdi zmdi-search mr-2"></i>Berdasarkan Tanggal SPM</button>
                    </div>
                    <div class="col-lg-1">
                        <br>
                        <button class="btn btn-secondary" id="tglverif"><i class="zmdi zmdi-search mr-2"></i>Berdasarkan Tanggal Verfikasi</button>
                    </div> -->
                    <div class="col-lg-2">
                        <!-- <button class="btn btn-primary" id='buattagihan' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                            data-target="#listspm"><i class="zmdi zmdi-assignment"></i>Input Tagihan</button> -->
                            <!-- <label for="">Action</label> -->
                            <br>
                        <button class="btn btn-success" id="cetak" id='buattagihan' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                            data-target="#listspm"><i class="zmdi zmdi-assignment"></i>Input Tagihan</button>

                    </div>
                    <!-- <div class="col-sm-1">
                        <button class="btn btn-secondary" id="cetak"><i class="zmdi zmdi-print mr-2"></i>Cetak Daftar Penguji</button>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</section>

<?php
include 'views/footer.view.php';
?>