<?php
// include_once 'component/session.php';

session_start();
include 'lib/conn.php';
if (!isset($_SESSION['username'])) {
    header('Location: /login');
    exit();
}
include 'views/header.view.php';

?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>SKPD</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"><i class="zmdi zmdi-home"></i> HOME</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">App</a>
                        </li>
                        <li class="breadcrumb-item active">Daftar Penguji</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button">
                        <i class="zmdi zmdi-sort-amount-desc"></i>
                    </button>
                </div>
            </div>
        </div>
        <form action="" method="post">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="container-fluid p-3 mb-2 bg-light text-dark">
                            <div class="row input-group-prepend">
                                <div class="col-lg-3">
                                    <label for="nomorpenguji">No. Penguji</label>
                                    <input type="text" class="form-control" id="nomorpenguji" placeholder="Nomor Penguji" aria-label="penguji" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="col-lg-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control " id="tanggal" placeholder="Tanggal" aria-label="tanggal" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="col-lg-3">
                                    <label for="jam">Jam</label>
                                    <input type="text" class="form-control" id="jam" placeholder="Jam" aria-label="jam" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="col-lg-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3 mb-2 bg-dark text-white">
                        <label for="exampleInputEmail1">Nominal</label>
                        <input type="text" class="form-control" aria-label="Nominal" aria-describedby="basic-addon2" style="font-size: x-large;">
                    </div>
                </div>
                <br>
                <div class="row border border-warning bg-light mb-3">
                    <div class="col-lg-4 align-items-center mt-3">
                        <label>Data SPM</label>
                        <div class="input-group mb-3 ">
                            <select name='dspm' id='dspm' class="form-control show-tick ms select2 ">

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 mt-3">
                        <label for="ket">Keterangan SPM</label>
                        <div class="input-group mb-3">
                            <textarea class="form-control" id="keterangan"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-2 mt-3">
                        <label for="nilai">Bruto</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nilai" aria-label="nilai" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>

                    <div class="col-lg-2 mt-3">
                        <label for="potongam">potongan</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="potongan" aria-label="potongan" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-2 mt-3">
                        <label for="bruto">Netto</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="bruto" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>

                </div>
                <div class="row border border-warning bg-light mb-3 display-6">
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">PPH 21</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="pph" name="pph" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">IWP 8%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="delapan" name="delapan" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">JK 4%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="empat" name="empat" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">JKK</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="jkk" name="jkk" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">JKM</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="jkm" name="jkm" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">IWP 1%</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="satu" name="satu" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">Tamperum</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="tamperum" name="tamperum" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">Taspen</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="taspen" name="taspen" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">Bulog</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="bulog" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">Zakat</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="zakat" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">PPN</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="pajaknilai" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-1 mt-2">
                        <label for="bruto">PPh 22</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="brutto" id="pajak22" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                </div>
                <div class="row border border-warning d-flex align-items-center">
                    <div class="col-lg-2 mt-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nomor Sp2d" aria-label="Nomor Sp2d" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-2 mt-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Bank Mandiri" aria-label="Nomor Sp2d" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="col-lg-2 mt-3">
                        <div class="input-group mb-3">
                            <select name='sumberdana' class="form-control show-tick ms select2">
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-1 d-flex align-items-center">
                        <div class="input-group ">
                            <button type="button" class="btn btn-info btn-sm btn-block" id="tambah">Add</button>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="input-group">
                            <button type="button" class="btn btn-info btn-sm btn-block" id="batal"><i class="zmdi zmdi-close"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="input-group">
                            <button type="button" class="btn btn-warning btn-sm btn-block"><i class="zmdi zmdi-save"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="input-group">
                            <button type="button" class="btn btn-danger btn-sm btn-block"><i class="zmdi zmdi-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">sp2d</th>
                                    <th scope="col">opd</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>dinas</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>Dinas</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>Dinas</td>
                                    <td>@social</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
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


<div class="modal fade" id="offcanvasaddpagu" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">

        <form method="POST" id="insertForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Tambah Alokasi Dana</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <select name='idopd' class="form-control show-tick ms select2">
                            <?php
                            include '../../lib/conn.php';
                            $skpd = mysqli_query($conn, "SELECT * FROM skpd");
                            while ($fetch = mysqli_fetch_array($skpd)) {
                                echo "<option value='$fetch[id]'> $fetch[nama_opd] </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Nilai Alokasi Dana"
                            name="nilai" />
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

<div class="modal fade" id="offcanvasEditpagu" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="editForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Edit Pagu</h4>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <select name='idopd' class="form-control show-tick ms">
                            <?php
                            include '../../lib/conn.php';
                            $skpd = mysqli_query($conn, "SELECT * FROM skpd");
                            while ($fetch = mysqli_fetch_array($skpd)) {
                                echo "<option value='$fetch[id]'> $fetch[nama_opd] </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Nilai Alokasi Dana"
                            name="nilai" />
                    </div>
                    <div class="modal-footer">
                        <button
                            type="submit"
                            class="btn btn-default btn-round waves-effect"
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


<script>
    $(document).ready(function() {
        fetchspm();
        nomorpenguji();
        defau();

        let table = new DataTable("#myTablepagu");

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

        // Tampilan Tanggal
        function tanggal() {
            arrbulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            date = new Date();
            millisecond = date.getMilliseconds();
            detik = date.getSeconds();
            menit = date.getMinutes();
            jam = date.getHours();
            hari = date.getDay();
            tanggal = date.getDate();
            bulan = date.getMonth();
            tahun = date.getFullYear();
            // document.write(tanggal + "-" + arrbulan[bulan] + "-" + tahun + "<br/>" + jam + " : " + menit + " : " + detik + "." + millisecond);
            $("#tanggal").val(tanggal + "/" + arrbulan[bulan] + "/" + tahun);
            $("#jam").val(jam + ":" + menit);
        }
        setInterval(tanggal, 100);
        // function to fetch data from database
        function fetchspm() {
            $.ajax({
                url: "proses/transaction/transfer.php?action=spmaktif",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    var select = $('#dspm');
                    select.empty();
                    data.forEach(function(item) {
                        select.append(new Option(item.nomor_spm + '-----' + item.namaopd + '-----' + item.nilai_spm, item.id_spm));
                    });
                }
            });
        }

        function nomorpenguji() {
            $.ajax({
                url: "proses/transaction/transfer.php?action=cekid",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    $('#nomorpenguji').val(data);
                }
            })
        }

        function defau() {
            $('#nomorpenguji').attr("disabled", true);
            $('#tanggal').attr("disabled", true);
            $('#jam').attr("disabled", true);
            $('#keterangan').attr("disabled", true);
            $('#bruto').attr("disabled", true);
            $('#potongan').attr("disabled", true);
            $('#nilai').attr("disabled", true);
        }


        $("#dspm").on("change", function() {
            var dspm = $(this).val();
            // $('#selected').text(selectedPackage);
            // kosong();
            // alert('Tidak tau');
            $.ajax({
                url: "proses/transaction/transfer.php?action=data_spm",
                type: "POST",
                dataType: "json",
                data: {
                    idspm: dspm
                    // idopd: idopd
                },
                success: function(response) {
                    var data = response.data;
                    var potongan = response.sum;
                    var nilai = data.nilai_spm;
                    var pph = response.pph;
                    var iwp8 = response.iwp8;
                    var ijk4 = response.ijk4;
                    var jkk = response.jkk;
                    var jkm = response.jkm;
                    var iwp1 = response.iwp;
                    var tamperum = response.tamperum;
                    var taspen = response.taspen;
                    var beras = response.beras;
                    var zakat = response.zakat;
                    var ppn = response.ppn;
                    var pph22 = response.pph22;
                    // console.log(potongan);
                    var bruto = nilai - potongan;
                    // $("#pph").val(formatRupiah(pph));
                    $("#keterangan").val(data.keterangan_spm);
                    $("#nilai").val(formatRupiah(data.nilai_spm));
                    $("#bruto").val(bruto);
                    if (potongan != null) {
                        $("#potongan").val(formatRupiah(potongan));
                    } else {
                        $("#potongan").val('0');
                    }

                    if (pph != null) {
                        $("#pph").val(formatRupiah(pph));
                    } else {
                        $("#pph").val('0');
                    }
                    if (iwp8 != null) {
                        $("#delapan").val(formatRupiah(iwp8));
                    } else {
                        $("#delapan").val('0');
                    }
                    if (ijk4 != null) {
                        $("#empat").val(formatRupiah(ijk4));
                    } else {
                        $("#empat").val('0');
                    }
                    if (jkk != null) {
                        $("#jkk").val(formatRupiah(jkk));
                    } else {
                        $("#jkk").val('0');
                    }
                    if (jkm != null) {
                        $("#jkm").val(formatRupiah(jkm));
                    } else {
                        $("#jkm").val('0');
                    }
                    if (iwp1 != null) {
                        $("#satu").val(formatRupiah(iwp1));
                    } else {
                        $("#satu").val('0');
                    }
                    if (tamperum != null) {
                        $("#tamperum").val(formatRupiah(tamperum));
                    } else {
                        $("#tamperum").val('0');
                    }
                    if (taspen != null) {
                        $("#taspen").val(formatRupiah(taspen));
                    } else {
                        $("#taspen").val('0');
                    }
                    if (beras != null) {
                        $("#bulog").val(formatRupiah(beras));
                    } else {
                        $("#bulog").val('0');
                    }
                    if (zakat != null) {
                        $("#zakat").val(formatRupiah(zakat));
                    } else {
                        $("#zakat").val('0');
                    }
                    if (ppn != null) {
                        $("#pajaknilai").val(formatRupiah(ppn));
                    } else {
                        $("#pajaknilai").val('0');
                    }
                    if (pph22 != null) {
                        $("#pajak22").val(formatRupiah(pph22));
                    } else {
                        $("#pajak22").val('0');
                    }



                    //  console.log(idspm)
                    // fetchspm();
                    // kosong();
                    // $('#idspm').val('11111');
                }
            });

        });



        // function to insert data to database
        $("#insertForm").on("submit", function(e) {
            $("#insertBtn").attr("disabled", "disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/pagu/executepagu.php?action=insertData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        $("#offcanvasAddpagu").offcanvas("hide");
                        $("#insertBtn").removeAttr("disabled");
                        $("#insertForm")[0].reset();
                        //   $(".preview_img").attr("src", "images/default_profile.jpg");
                        $("#successToast").toast("show");
                        $("#successMsg").html(response.message);
                        // Swal.fire("!", "Data Sukses Tersimpan", "success");
                        fetchData();
                    } else if (response.statusCode == 500) {
                        $("#offcanvasAddpagu").offcanvas("hide");
                        $("#insertBtn").removeAttr("disabled");
                        $("#insertForm")[0].reset();
                        //   $(".preview_img").attr("src", "images/default_profile.jpg");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    } else if (response.statusCode == 400) {
                        $("#insertBtn").removeAttr("disabled");
                        // $("#errorToast").toast("show");
                        // $("#errorMsg").html(response.message);
                        Swal.fire("!", "Data Masih Kosong", "Warning");
                    } else if (response.statusCode == 800) {
                        Swal.fire("!", "Data So Ada Terinput, Edit jo !", "warning");
                        fetchData();
                    }

                }
            });
        });

        // function to edit data
        $("#myTablepagu").on("click", ".editBtn", function() {
            var id = $(this).val();
            $.ajax({
                url: "proses/pagu/executepagu.php?action=fetchSingle",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    var data = response.data;
                    var dana = data.nilai;
                    $("#editForm #id").val(data.id);
                    $("#editForm select[name='idopd']").val(data.idopd1);
                    $("#editForm input[name='nilai']").val(formatRupiah(dana, "Rp. "));

                    // show the edit user offcanvas
                    $("#offcanvasEditpagu").modal("show");
                }
            });
        });

        // function to update data in database
        $("#editForm").on("submit", function(e) {
            $("#editBtn").attr("disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/pagu/executepagu.php?action=updateData",
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

        // function to delete data
        $("#myTablepagu").on("click", ".deleteBtnpagu", function() {
            if (confirm("Apakah yakin Menghapus Data Ini?")) {
                var id = $(this).val();
                //   var delete_image = $(this).closest("td").find(".delete_image").val();
                $.ajax({
                    url: "proses/pagu/executepagu.php?action=deleteData",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id
                        //   delete_image
                    },
                    success: function(response) {
                        if (response.statusCode == 200) {
                            fetchData();
                            $("#successToast").toast("show");
                            $("#successMsg").html(response.message);
                        } else if (response.statusCode == 500) {
                            $("#errorToast").toast("show");
                            $("#errorMsg").html(response.message);
                        }
                    }
                });
            }
        });


    });
</script>