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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 d-flex align-items-center">
                    <div class="container-fluid p-3 mb-2 bg-light text-dark">
                        <div class="row input-group-prepend">
                            <div class="col-lg-3">
                                <label for="nomorpenguji">No. Penguji</label>
                                <input type="text" class="form-control" placeholder="Nomor Penguji" aria-label="penguji" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="col-lg-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="text" class="form-control " placeholder="Tanggal" aria-label="tanggal" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="col-lg-3">
                                <label for="jam">Jam</label>
                                <input type="text" class="form-control" placeholder="Jam" aria-label="jam" aria-describedby="inputGroup-sizing-sm">
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
                    <input type="text" class="form-control" placeholder="Rp.-" aria-label="Nominal" aria-describedby="basic-addon2" style="font-size: x-large;">
                </div>
            </div>
            <br>
            <div class="row border border-warning bg-light mb-3">
                <div class="col-lg-4 align-items-center mt-3">
                    <div class="input-group mb-3 ">
                        <select name='dspm' id='dspm' class="form-control show-tick ms select2 ">
                            <?php
                            include '../../lib/conn.php';
                            $skpd = mysqli_query($conn, "SELECT * FROM t_spm");
                            while ($fetch = mysqli_fetch_array($skpd)) {
                                echo "<option value='$fetch[id]'> $fetch[nomor_spm] ** $fetch[nama_sub_skpd] ** $fetch[nilai_spm]  </option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 mt-3">
                    <div class="input-group mb-3">
                        <textarea class="form-control" placeholder="Keterangan SPM"></textarea>
                    </div>
                </div>
                <div class="col-lg-2 mt-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Brutto" aria-label="brutto" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-lg-2 mt-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Potongan" aria-label="potongan" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-lg-2 mt-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="nilai" aria-label="nilai" aria-describedby="inputGroup-sizing-sm">
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
                <div class="col-lg-1 d-flex align-items-center">
                    <div class="input-group ">
                        <button type="button" class="btn btn-info btn-sm btn-block">Add</button>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="input-group">
                        <button type="button" class="btn btn-info btn-sm btn-block"><i class="zmdi zmdi-close"></i></button>
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
        fetchData();

        let table = new DataTable("#myTablepagu");


        // function to fetch data from database
        function fetchData() {
            $.ajax({
                url: "proses/pagu/executepagu.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    table.clear().draw();
                    var counter = 1;
                    $.each(data, function(index, value) {
                        var dana = value.nilai;
                        table.row
                            .add([
                                counter,
                                value.nama_opd,
                                formatRupiah(dana, "Rp. "),
                                // value.idsumberdana,
                                '<Button type="button" class="btn btn-primary btn-sm editBtn" value="' +
                                value.id +
                                '"><i class="zmdi zmdi-edit"></i></Button>' +
                                '<Button type="button" class="btn btn-danger btn-sm deleteBtnpagu" value="' +
                                value.id +
                                '"><i class="zmdi zmdi-delete"></i></Button>'
                            ])
                            .draw(false);
                        counter++;
                    });
                }
            });
        }

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

        $("#dspm").on("change", function() {

            // $('#selected').text(selectedPackage);
            // kosong();
            $.ajax({
                url: "proses/transaction/transfer.php?action=dataspm",
                type: "POST",
                dataType: "json",
                data: {
                    idspm: dspm
                    // idopd: idopd
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
    });
</script>