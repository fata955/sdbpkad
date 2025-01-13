<?php
include 'views/header.view.php';

?>
<section class="content contact">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>LACAK SALUR</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/sdbpkad/lacaksalur"><i class="zmdi zmdi-home">Lacak Salur</i> </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">App</a>
                        </li>
                        <li class="breadcrumb-item active">Lacak Salur</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button">
                        <i class="zmdi zmdi-sort-amount-desc"></i>
                    </button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                    <button class="btn btn-success btn-icon float-right" type="button" data-toggle="modal"
                        data-target="#offcanvasaddsalur">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card" id="">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable"
                                id="tabelsalur">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Tanggal Salur</th>
                                        <th>Jenis Dana</th>
                                        <th>Tujuan</th>
                                        <th>Nilai</th>
                                        <th>Realisasi</th>
                                        <th>Sisa</th>
                                        <th>Status</th>
                                        <th data-breakpoints="xs">Action</th>
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
</section>

<?php
include 'views/footer.view.php';
?>


<div class="modal fade" id="offcanvasaddsalur" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">

        <form method="POST" id="insertdata">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Tambah Dana Salur</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="tanggal" id="tanggal" />
                    </div>
                    <div class="input-group mb-3">
                        <select name='jenissumberdana' id='jenissumberdana' class="form-control ms select2 ">
                            <?php
                            include '../../lib/conn.php';
                            $sumberdana = mysqli_query($conn, "SELECT * from t_sumberdana");
                            while ($fetch = mysqli_fetch_array($sumberdana)) {
                            ?>
                                <option value='<?= $fetch['id']; ?>'>
                                    <?= $fetch['namasumberdana']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <textarea class="form-control" name="tujuandana" placeholder="Tujuan Dana" rows="5"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nilai Dana" name="nilai" id="nilai" />
                    </div>
                    <div class="input-group mb-3">
                        <select name='status' class="form-control">
                            <option value='NON AKTIF'> NON AKTIF</option>
                            <option value='AKTIF'> AKTIF</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-round waves-effect" id="insertBtn">
                        SAVE
                    </button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                        CLOSE
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="offcanvasEditsalur" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="editForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Edit Salur</h4>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="tanggal" />
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control ms " name="jnsumber">
                            <?php
                            include '../../lib/conn.php';
                            $sumberdana = mysqli_query($conn, "SELECT * from t_sumberdana");
                            while ($fetch = mysqli_fetch_array($sumberdana)) {
                            ?>
                                <option value='<?= $fetch['id']; ?>'>
                                    <?= $fetch['namasumberdana']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <textarea class="form-control" name="tujuansalur"></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nilai" id="va" />
                    </div>

                    <div class="input-group mb-3">
                        <select class="form-control ms" name="statusnya">
                            <option value='NON AKTIF'> NON AKTIF</option>
                            <option value='AKTIF'> AKTIF</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-round waves-effect">
                        UPDATE
                    </button>
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">
                        CLOSE
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Toast container  -->
<div class="toast-container position-fixed bottom-0 end-0 p-3 ml-8">
    <!-- Success toast  -->
    <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true"
        id="successToast">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Success!</strong>
                <span id="successMsg"></span>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <!-- Error toast  -->
    <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
        id="errorToast">
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

    $(document).ready(function() {
        fetchData();
        let table = new DataTable("#tabelsalur", {
            "order": [
                [7, "desc"]
            ]
        });

        var rupiah = document.getElementById('nilai');
        rupiah.addEventListener('keyup', function(e) {
            // Tambahkan 'Rp.' pada saat form di ketik
            // Gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
        // var rupiah = document.getElementById('nilainya');
        // rupiah.addEventListener('keyup', function(e) {
        //     // Tambahkan 'Rp.' pada saat form di ketik
        //     // Gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        //     rupiah.value = formatRupiah(this.value, 'Rp. ');
        // });



        // function to fetch data from database
        function fetchData() {
            $.ajax({
                url: "proses/transaction/incomelacaksalur.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    table.clear().draw();
                    $.each(data, function(index, value) {
                        var dana = value.nilai_dana;
                        var sisa = dana - value.realisasi;
                        var sisa = sisa.toString();
                        var realisasi = (value.realisasi).toString();
                        table.row
                            .add([
                                value.id,
                                value.tanggal_salur,
                                value.namasumberdana,
                                value.tujuan_dana,
                                formatRupiah(dana, "Rp. "),
                                formatRupiah(realisasi, "Rp. "),
                                
                                formatRupiah(sisa, "Rp. "),
                                value.status,
                                // value.createby,
                                '<Button type="button" class="btn btn-primary btn-sm editBtn" value="' +
                                value.id +
                                '"><i class="zmdi zmdi-edit"></i></Button>' +
                                '<Button type="button" class="btn btn-danger btn-sm deleteBtn" value="' +
                                value.id +
                                '"><i class="zmdi zmdi-delete"></i></Button>'
                            ])
                            .draw(false);
                    });
                }
            });
        }

        // function to insert data to database
        $("#insertdata").on("submit", function(e) {
            $("#insertBtn").attr("disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/transaction/incomelacaksalur.php?action=insertData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        $("#offcanvasAddsalur").offcanvas("hide");
                        $("#insertBtn").removeAttr("disabled");
                        $("#insertdata")[0].reset();
                        //   $(".preview_img").attr("src", "images/default_profile.jpg");
                        $("#successToast").toast("show");
                        $("#successMsg").html(response.message);
                        // Swal.fire("!", "Data Sukses Tersimpan", "success");
                        fetchData();
                    } else if (response.statusCode == 500) {
                        $("#offcanvasAddsalur").offcanvas("hide");
                        $("#insertBtn").removeAttr("disabled");
                        $("#insertdata")[0].reset();
                        //   $(".preview_img").attr("src", "images/default_profile.jpg");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    } else if (response.statusCode == 400) {
                        $("#insertBtn").removeAttr("disabled");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    }
                }
            });
        });

        // function to edit data
        $("#tabelsalur").on("click", ".editBtn", function() {
            var id = $(this).val();
            $.ajax({
                url: "proses/transaction/incomelacaksalur.php?action=fetchSingle",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    var data = response.data;
                    var dana = data.nilai_dana;
                    $("#editForm #id").val(data.id);
                    $("#editForm input[name='tanggal']").val(data.tanggal_salur);
                    $("#editForm select[name='jnsumber']").val(data.jenis_dana);
                    $("#editForm textarea[name='tujuansalur']").val(data.tujuan_dana);
                    $("#editForm input[name='nilai']").val(formatRupiah(dana, "Rp. "));
                    $("#editForm select[name='statusnya']").val(data.status);
                    // show the edit user offcanvas
                    $("#offcanvasEditsalur").modal("show");
                }
            });
        });


        // function to delete data
        $("#tabelsalur").on("click", ".deleteBtn", function() {
            if (confirm("Apakah yakin Menghapus Data Ini?")) {
                var id = $(this).val();
                //   var delete_image = $(this).closest("td").find(".delete_image").val();
                $.ajax({
                    url: "proses/transaction/incomelacaksalur.php?action=deleteData",
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

        // function to update data in database
        $("#editForm").on("submit", function(e) {
            $("#editBtn").attr("disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/transaction/incomelacaksalur.php?action=updateData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        $("#successToast").toast("show");
                        $("#successMsg").html(response.message);
                        // Swal.fire("!", "Data Sukses Terupdate", "success");
                        fetchData();
                        $("#offcanvasEditsalur").modal("hide");
                    } else if (response.statusCode == 500) {
                        $("#offcanvasEditsalur").offcanvas("hide");
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