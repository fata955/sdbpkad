
<?php
include_once 'component/session.php';
include 'views/header.view.php';

?>
<section class="content contact">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>SKPD</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/sdbpkad/"><i class="zmdi zmdi-home"></i>Sumber Dana</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">App</a>
                        </li>
                        <li class="breadcrumb-item active">SPM</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button">
                        <i class="zmdi zmdi-sort-amount-desc"></i>
                    </button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button
                        class="btn btn-primary btn-icon float-right right_icon_toggle_btn"
                        type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form method="POST" id="insertForm">
                <div class="row clearfix">
                    <div class="col-md-4">
                        <input class="form-control mb-2 form-control-lg" type="text" name='token' placeholder="Masukkan Tokken">
                    </div>
                    <div class="col-md-2">
                        <select name='jenisdokumen' class="form-control">
                            <option value='UP'> UP </option>
                            <option value='GU'> GU </option>
                            <option value='TU'> TU </option>
                            <option value='LS'> LS </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control mb-2 form-control-lg" name='hal' type="text" placeholder="Sampai hal ke-">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary" type="submit" id='insertBtn'>Tarik Data SPM</button>
                    </div>

                </div>
            </form>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card" id="">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 c_list c_table" id="myTablespm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nomor_spm</th>
                                        <th>Keterangan</th>
                                        <th>OPD</th>
                                        <th>Nilai</th>
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
</section>

<?php
include 'views/footer.view.php';
?>
<script>
    $(document).ready(function() {
        fetchData();
        let table = new DataTable("#myTablespm");

        // function to fetch data from database
        function fetchData() {
            $.ajax({
                url: "proses/mocking/spmexecute.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    table.clear().draw();
                    $.each(data, function(index, value) {
                        table.row
                            .add([
                                value.id,
                                value.nomor_spm,
                                value.keterangan_spm,
                                value.nama_sub_skpd,
                                value.nilai_spm,
                            ])
                            .draw(false);
                    });
                }
            });
        }

        // function to insert data to database
        $("#insertForm").on("submit", function(e) {
            $("#insertBtn").attr("disabled", "disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/mocking/spmexecute.php?action=insertData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        Swal.fire("!", "Data Sukses Tersimpan", "success");
                        // fetchData();
                    } else if (response.statusCode == 500) {
                        Swal.fire("!", "Data ERROR", "Warning");
                    } else if (response.statusCode == 400) {
                        $("#insertBtn").removeAttr("disabled");
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    }
                }
            });
        });

    })
</script>