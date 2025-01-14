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
            <h6>List Tagihan</h6> <br>
            <form method="post" id='filtertanggal'>
                <div class="row clearfix flex justify-content-center">
                    <div class="col-lg-2">
                        <label for="">Dari Tanggal</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" value="<?php echo date("Y-m-01", strtotime($date_start)) ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="date_end" name="date_end" value="<?php echo date("Y-m-d", strtotime($date_end)) ?>">
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <button class="btn btn-info" id="filter"><i class="zmdi zmdi-search"></i></button>
                                <button class="btn btn-secondary" id="dataall"><i class="zmdi zmdi-refresh"></i></button>
                                <button class="btn btn-danger" id="dataprint"><i class="zmdi zmdi-print"></i></button>
                                <!-- <button class="btn btn-danger" id="dataall"><i class="zmdi zmdi-collection-pdf"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <button class="btn btn-primary" id='buattagihan' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                            data-target="#offcanvasaddtagihan">Buat Tagihan</button>
                    </div>

                </div> <br>
                <div class="row clearfix flex justify-content-center">
                    <div class="col-lg-2">
                        <label for="">REALISASI SPM</label>
                        <input type="text" class="form-control" id="total_spm" name="total_spm" value="" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Jumlah SPM</label>
                        <input type="text" class="form-control" id="jumlah_spm" name="jumlah_spm" value="" disabled>
                    </div>

                    <div class="col-lg-2">
                        <label for="">Jumlah LS</label>
                        <input type="text" class="form-control" id="jumlah_ls" name="jumlah_ls" value="" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Jumlah GU</label>
                        <input type="text" class="form-control" id="jumlah_gu" name="jumlah_gu" value="" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Jumlah UP</label>
                        <input type="text" class="form-control" id="jumlah_up" name="jumlah_up" value="" disabled>
                    </div>
                </div>
            </form>
        </div>
        <br>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
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
            </div>
        </div>


    </div>
</section>

<?php
include 'views/footer.view.php';
?>


<div class="modal fade" id="offcanvasaddtagihan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="insertdata">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Input Tagihan SPM</h4>
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
                            placeholder="Input No SPM" required /> <br>
                        <div> <a href="" class="btn btn-primary ml-2" data-toggle="modal"
                                data-target="#listspm" required>Pilih SPM</a></div>
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
                    <label for="dana" id="ldana">Dana Ready</label><br>
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
                    <label for="sumberdana" id="lnamasumber">Sumber Dana</label><br>
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
        /* Dengan Rupiah */
        var nilaispm = document.getElementById('nilaispm');
        nilaispm.addEventListener('keyup', function(e) {
            nilaispm.value = formatRupiah(this.value, 'Rp. ');
        })

        fetchspm();
        fetchVerif();

        $("#listspm").modal("hide");
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

        function sembunyi() {
            $('#nospm').hide();
            $('#ketspm').hide(); // Mengosongkan input // Mengosongkan input
            $('#nilaispm').hide();
            $('#dokumen').hide(); // Mengosongkan input
            $('#opd').hide(); // Mengosongkan input
            $('#dana').hide();
            $('#namasumber').hide();
            $('#insertBtn').hide();
            $('#keluar').hide(); // Mengosongkan input
            $('#lopd').hide(); // Mengosongkan input
            $('#ldana').hide();
            $('#lnamasumber').hide();
        }

        function muncul() {
            $('#nospm').show();
            $('#ketspm').show(); // Mengosongkan input // Mengosongkan input
            $('#nilaispm').show();
            $('#dokumen').show(); // Mengosongkan input
            $('#opd').show(); // Mengosongkan input
            $('#dana').show();
            $('#namasumber').show();
            $('#insertBtn').show();
            $('#keluar').show(); // Mengosongkan input
            $('#lopd').show(); // Mengosongkan input
            $('#ldana').show();
            $('#lnamasumber').show();
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
                                '<Button type="button" class="btn btn-primary btn-sm editBtnspm" data-target="#listspm" data-toggle="modal" value="' +
                                value.id_spm +
                                '"><i class="zmdi zmdi-assignment-check"></i></Button>',
                                value.nomor_spm,
                                value.keterangan_spm,
                                value.nama_sub_skpd,
                                value.nilai_spm,
                                value.createby
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
                    table2.clear().draw();
                    $.each(data, function(index, value) {
                        table2.row
                            .add([
                                value.nomor_spm,
                                value.nama_sub_skpd,
                                value.jenis_spm,
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
                }
            });
        }
 
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
            sembunyi();
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
                    muncul();
                    var data = response.data;
                    var dana = data.nilai_spm;
                    $("#insertdata #idspm").val(data.id);
                    $("#insertdata #nospm").val(data.nomor_spm);
                    $("#insertdata #ketspm").val(data.keterangan_spm);
                    $("#insertdata input[name='nilaispm']").val(formatRupiah(dana, "Rp. "));
                    $("#insertdata select[name='dokumen']").val(data.jenis_spm);
                    $("#insertdata select[name='opd']").val(data.id_skpd);
                    //   $("#insertdata input[name='nilai']").val(formatRupiah(dana, "Rp. "));
                    // $("#kontrol").val('2');

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
            // $('#selected').text(selectedPackage);
            // kosong();
            $.ajax({
                url: "proses/transaction/expenses.php?action=fetchSalur",
                type: "POST",
                dataType: "json",
                data: {
                    idsalur: idsalur
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
        $("#filtertanggal").on("click", "#filter", function(e) {
            e.preventDefault();
            var start = $('#date_start').val();
            var end = $('#date_end').val();


            $.ajax({
                url: "proses/transaction/expenses.php?action=filtertanggal",
                type: "POST",
                dataType: "json",
                data: {
                    start: start,
                    end: end
                },
                success: function(response) {
                    var data = response.data;
                    table2.clear().draw();
                    $.each(data, function(index, value) {
                        table2.row
                            .add([
                                value.nomor_spm,
                                value.nama_sub_skpd,
                                value.jenis_spm,
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
                            Swal.fire("!", "Data Gagal terhapus", "Warning");
                            fetchVerif();
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