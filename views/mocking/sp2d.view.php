
<?php
include 'views/header.view.php';

?>
         <style>
        table.dataTable tbody tr {
            height: 20px; /* Adjust height as needed */
        }
        table.dataTable tbody td {
            padding: 4px; /* Adjust padding as needed */
            line-height: 1; /* Adjust line height as needed */
        }
    </style>
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
                        <li class="breadcrumb-item active">SP2D</li>
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
                   <textarea class="form-control" name="datasp2d" placeholder="Masukkan Json" rows="20"></textarea>
                </div> <br>
                <div class="col-md-2">
                        <button class="btn btn-primary" type="submit" id='insertBtn'>Tarik Data SP2D</button>
                    </div>
            </form>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card" id="">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="myTablesp2d">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID_SP2D</th>
                                        <th>JENIS</th>
                                        <th>Nomor_sp2d</th>
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


<?php
include 'views/footer.view.php';
?>
<script>
    $(document).ready(function() {
        fetchData();
        
        let table = new DataTable("#myTablesp2d", {
            "order": [
                [5, "desc"]
            ]
        });

        // function to fetch data from database
        function fetchData() {
            $.ajax({
                url: "proses/mocking/registersp2d.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    table.clear().draw();
                    $.each(data, function(index, value) {
                        table.row
                            .add([
                                value.id,
                                value.id_sp_2_d,
                                value.jenis_sp_2_d,
                                value.nomor_sp_2_d,
                                value.keterangan_sp_2_d,
                                value.nama_sub_skpd,
                                value.nilai_sp_2_d
                            ])
                            .draw(false);
                    });
                }
            });
        }

        // function to insert data to database
        $("#insertForm").on("submit", function(e) {
            $("#insertBtn").attr("disabled");
            e.preventDefault();
            $.ajax({
                url: "proses/mocking/registersp2d.php?action=insertData",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        Swal.fire("!", "Data Sukses Tersimpan", "success");
                        $("#successToast").toast("show");
                        fetchData();
                        location.reload();
                    } else if (response.statusCode == 500) {
                        Swal.fire("!", "Data ERROR", "Warning");
                        $("#errorToast").toast("show");
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