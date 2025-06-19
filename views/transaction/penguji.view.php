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
                <div class="row flex justify-content-center ">
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
                    <div class="col-lg-6">
                        <br>
                        <button class="btn btn-primary" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                            data-target=""><i class="zmdi zmdi-search"></i><br>Search Berdasarkan Tanggal</button>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-lg-12 d-flex justify-content-end">
                        <br>
                        <button class="btn btn-light " id='buattagihan' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                            data-target="#offcanvasaddtagihan">
                            <i class="zmdi zmdi-file-add"></i>
                        </button>
                        <button class="btn btn-info" id="cetak" id='cetak' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                            data-target=""><i class="zmdi zmdi-print"></i></button>

                    </div>
                </div>

                <!-- insert daftar penguji -->
                <div class="row flex justify-content-center " id="insertspm">
                    <div class="col-lg-2">
                        <br>
                        <label for="">Nomor Penguji</label>
                        <input type="text" class="form-control" aria-label="Masukkan Nomor Penguji" aria-describedby="button-addon2" disabled>
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <label for="">Nomor Penguji</label>
                        <input type="text" class="form-control" aria-label="Masukkan Nomor Penguji" aria-describedby="button-addon2" disabled>
                    </div>
                    <div class="col-lg-2">
                        <br><br>
                        <button class="btn btn-success" data-id="" data-toggle="modal"
                            data-target="#listspm"><i class="zmdi zmdi-search"></i><br>Cari SPM</button>
                    </div>
                </div>
                <div class="row flex justify-content-center ">
                    <div class="col-lg-12">
                        <br>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nomor Penguji</th>
                                    <th scope="col">Total Sp2d</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>
                                        <button class="btn btn-success" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-eye"></i></button>
                                        <button class="btn btn-secondary" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-print"></i></button>
                                        <button class="btn btn-danger" id='cekspm' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-delete"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>Otto</td>
                                    <td>
                                        <button class="btn btn-success" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-eye"></i><br></button>
                                        <button class="btn btn-secondary" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-print"></i></button>
                                        <button class="btn btn-danger" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-delete"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>Otto</td>
                                    <td>
                                        <button class="btn btn-success" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-eye"></i> </button>
                                        <button class="btn btn-secondary" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-eye"></i><br></button>
                                        <button class="btn btn-danger" data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#listspm"><i class="zmdi zmdi-delete"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

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
        $('#insertspm').hide();


    });
    $("#buattagihan").on("click", function() {
        $('#insertspm').show();
    });
</script>