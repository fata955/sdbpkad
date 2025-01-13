<?php
include 'views/header.view.php';
// $date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d", strtotime(date("Y-m-d") . " -7 days"));
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d");
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] :  date("Y-m-d");
?>
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Tagihan SPM</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Sdbpkad</li>
                        <li class="breadcrumb-item active">tagihan</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>

                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <form method="post" id="salur">
                <div class="row clearfix d-flex justify-content-center">

                    <?php
                    function formatRupiah($number)
                    {
                        return 'Rp ' . number_format($number, 0, ',', '.');
                    }
                    // $sql = "SELECT a.id, a.nilai_dana,a.jenis_dana,b.namasumberdana from t_salur a, t_sumberdana b where a.jenis_dana=b.id AND a.status='AKTIF'";
                    $sql = "select b.id, sum(a.nilai_dana) as nilai, b.namasumberdana, a.jenis_dana, (SELECT COALESCE(sum(nilai_spm),0) from sipd.t_spm where id_salur=a.jenis_dana) as realisasi, (sum(a.nilai_dana)-(SELECT COALESCE(sum(nilai_spm),0) from sipd.t_spm where id_salur=a.jenis_dana)) as sisa from t_salur a, t_sumberdana b where a.jenis_dana=b.id group by b.id";
                    $cek = mysqli_query($conn, $sql);
                    while ($result = mysqli_fetch_array($cek)) {
                    ?>

                        <!-- <div class="card pricing pricing-item">

                                <div class="pricing-deco l-blue">
                                    <svg class="pricing-deco-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" y="0px">
                                        <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729&#x000A;	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729&#x000A;	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                        <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716&#x000A;	H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                        <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428&#x000A;	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                                    </svg>
                                    <input
                                        type="hidden"
                                        class="form-control"
                                        name="idsalur" id="idsalur" value="<?= $result['id'] ?>" />
                                    <h6 id="danamasuk" class="pricing-title"><?= $result['namasumberdana']; ?></h6> <br>
                                    <div class="pricing-price">
                                        <h6 id='nilaikas' class="" style="font-size:x-large;"><?= formatRupiah($result['sisa']); ?></h6>
                                    </div>

                                </div>
                                <div class="body">
                                    <small>Sisa <?= formatRupiah($result['sisa']); ?> dari <?= formatRupiah($result['nilai']); ?></small>
                                    <div class="progress">
                                        <div id="progress" class="progress-bar l-amber" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                    </div><br>
                                    <button class="btn btn-primary" id='buattagihan' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                        data-target="#offcanvasaddtagihan">Buat Tagihan</button>
                                </div>

                            </div> -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="card">
                                <div class="body product_item">
                                    <span class="label new">Aktif</span><br><br>
                                    <!-- <img src="assets/images/ecommerce/1.png" alt="Product" class="img-fluid cp_img" /> -->
                                    <div class="product_details">
                                        <a href="ec-product-detail.html" style="font-weight: bold;"><?= $result['namasumberdana']; ?></a>
                                        <ul class="product_price list-unstyled">
                                            <li class="old_price"><?= formatRupiah($result['sisa']); ?></li>
                                            <!-- <li class="new_price">$45.00</li> -->
                                        </ul>
                                    </div>
                                    <div class="action">
                                        <!-- <a href="javascript:void(0);" class="btn btn-info waves-effect"><i class="zmdi zmdi-eye"></i></a> -->
                                        <button class="btn btn-primary" id='buattagihan' data-id="<?php echo $result['jenis_dana']; ?>" data-toggle="modal"
                                            data-target="#offcanvasaddtagihan">Buat Tagihan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </form>
        </div>

        <div class="container-fluid">
            <form method="post" id='filtertanggal'>
                <div class="row clearfix">
                    <div class="col-lg-2">
                        <label for="">Dari Tanggal</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" value="<?php echo date("Y-m-d", strtotime($date_start)) ?>"> <br>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="date_end" name="date_end" value="<?php echo date("Y-m-d", strtotime($date_end)) ?>"> <br>
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <button class="btn btn-info" id="filter"><i class="zmdi zmdi-search"></i></button>
                                <button class="btn btn-secondary" id="dataall"><i class="zmdi zmdi-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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
                            name="nsalur" id='nsalur' readonly />
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="hidden"
                            class="form-control"
                            name="idspm" id='idspm' readonly />
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="nospm" id='nospm'
                            placeholder="Input No SPM" readonly /> <br>
                        <div> <a href="" class="btn btn-primary ml-2" data-toggle="modal"
                                data-target="#listspm">Pilih SPM</a></div>
                    </div>

                    <div class="input-group mb-3">
                        <textarea
                            type="text"
                            class="form-control"
                            name="ketspm" id='ketspm'
                            placeholder="Keterangan"
                            rows="4" cols="50" readonly></textarea>
                        <!-- <button class="btn">...</button> -->
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Nilai SPM"
                            name="nilaispm" id='nilaispm' readonly />
                    </div>
                    <div class="input-group mb-3">
                        <select name='dokumen' id='dokumen' class="form-control show-tick ms " readonly>
                            <option value="0" default>--JENIS DOKUMEN--</option>
                            <option value="LS">LS</option>
                            <option value="GU">GU</option>
                            <option value="UP">UP</option>
                            <option value="TU">TU</option>
                        </select>
                    </div>
                    <label for="opd">Nama OPD</label><br>
                    <div class="input-group mb-3">
                        <select name='opd' id='opd' class="form-control show-tick ms" readonly>
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
                        class="btn btn-default waves-effect"
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
                <!-- <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-default waves-effect"
                        id="insertBtn">
                        SAVE
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger waves-effect"
                        data-dismiss="modal">
                        CLOSE
                    </button>
                </div> -->

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
        }


        let table = new DataTable("#myTablespm");
        let table2 = new DataTable("#nilaisumberdana");
        /* Dengan Rupiah */
        var nilaispm = document.getElementById('nilaispm');
        nilaispm.addEventListener('keyup', function(e) {
            nilaispm.value = formatRupiah(this.value, 'Rp. ');
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
                                value.id +
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

        // function fetchData() {
        //     var id = $('#idopd').val();
        //     $.ajax({
        //         url: "proses/transaction/expenses.php?action=fetchSinglePagu",
        //         type: "POST",
        //         dataType: "json",
        //         data: {
        //             id: id
        //         },
        //         success: function(response) {
        //             if (response.statusCode == 200) {
        //                 var data = response.data;
        //                 $("#pagu input[name='pagu']").val(formatRupiah(value.nilai, "Rp. "));
        //                 $("#totalnya input[name='total']").val(formatRupiah(value.Total, "Rp. "));
        //                 $("#totalnya input[name='perubahan1']").val(value.namaperubahan);
        //                 $("#offcanvasaddsumberdanaopd input[name='namaopd']").val(value.nama_opd);
        //                 $("#offcanvasaddsumberdanaopd input[name='idopd']").val(value.idopd);
        //                 modaladdshow();
        //             } else if (response.statusCode == 404) {
        //                 Swal.fire("X", "sync untuk perubahan Baru", "warning");
        //                 // fetchData();
        //                 modaladdhide();
        //             } else if (response.statusCode == 505) {
        //                 Swal.fire("X", "OPD Belum Mempunyai Pagu", "warning");
        //                 // fetchData();
        //                 modaladdhide();
        //             } else if (response.statusCode == 600) {
        //                 Swal.fire("X", "Silahkan Memilih OPD dengan Benar", "warning");
        //                 // fetchData();
        //                 modaladdhide();
        //             }

        //         }
        //     });
        // }

        // function to edit data
        $("#salur").on("click", "#buattagihan", function() {
            // var select2 = $('#namasumber');
            // e.preventDefault();
            // var id = $('#buattagihan').attr('datanya');
            var idsalur = $(this).data('id');
            // select2.clear().draw();
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
                    // $("#nsalur").val(data.idsumberdana);
                    // var sumberdana = $('#nsalur');
                    var select = $('#namasumber');
                    select.empty();
                    data.forEach(function(item) {
                        select.append(new Option(item.name, item.id));
                    });
                    $("#nsalur").val(data1);
                    fetchspm();
                    kosong();
                }
            });
        });


        // function to insert data to database
        $("#insertdata").on("submit", function(e) {
            $("#insertBtn").attr("disabled");
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
                        // fetchData();
                        fetchVerif();
                        // window.location.href = '/sdbpkad/expenses';
                    } else if (response.statusCode == 400) {
                        Swal.fire("!", "Alokasi Dana Belum Terinput", "warning");
                    } else if (response.statusCode == 402) {
                        Swal.fire("!", "Pagu Sumberdana opd Belum terinput !", "warning");
                    } else if (response.statusCode == 600) {
                        Swal.fire("!", "Pagu Sumberdana sudah tidak mencukupi, cek kembali sisa pagu opd bersangkutan !", "warning");
                    } else if (response.statusCode == 500) {
                        Swal.fire("!", "Perhatikan inputan anda, sepertinya ada kekeliruan", "warning");
                    }
                }
            });
        });
        // function to edit data
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
                    var data = response.data;
                    var dana = data.nilai_spm;
                    $("#insertdata #idspm").val(data.id);
                    $("#insertdata #nospm").val(data.nomor_spm);
                    $("#insertdata #ketspm").val(data.keterangan_spm);
                    $("#insertdata input[name='nilaispm']").val(formatRupiah(dana, "Rp. "));
                    $("#insertdata select[name='dokumen']").val(data.jenis_spm);
                    $("#insertdata select[name='opd']").val(data.id_skpd);
                    //   $("#insertdata input[name='nilai']").val(formatRupiah(dana, "Rp. "));

                    if (response.statusCode == 200) {
                        // $("#offcanvasaddtagihan").offcanvas("hide");
                        // $("#insertBtn").removeAttr("disabled");
                        // $("#insertdata")[0].reset();
                        // //   $(".preview_img").attr("src", "images/default_profile.jpg");
                        $("#successToast").toast("show");
                        $("#successMsg").html(response.message);
                        // Swal.fire("!", "Data Sukses Tersimpan", "success");
                        // fetchData();
                    } else if (response.statusCode == 400) {
                        // $("#offcanvasaddtagihan").offcanvas("hide");
                        // $("#insertBtn").removeAttr("disabled");
                        // $("#insertdata")[0].reset();
                        //   $(".preview_img").attr("src", "images/default_profile.jpg");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    } else if (response.statusCode == 401) {
                        $("#insertBtn").removeAttr("disabled");
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
        $("#filtertanggal").on("click", "#filter", function(e) {
            // var select2 = $('#namasumber');
            e.preventDefault();
            // var id = $('#buattagihan').attr('datanya');
            var start = $('#date_start').val();
            var end = $('#date_end').val();
            // var e = "T00:00:00Z";
            // var start = waktustart+e;
            // var end = waktuend+e;
            // select2.clear().draw();
            // console.log(start);
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
        $("#filtertanggal").on("click", "#dataall", function() {
            fetchVerif();
            var today = new Date();
            var day = String(today.getDate()).padStart(2, '0');
            var month = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
            var year = today.getFullYear();
            var currentDate = day + '/' + month + '/' + year;

            $('#date_start').val(currentDate);
            $('#date_end').val(currentDate);

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