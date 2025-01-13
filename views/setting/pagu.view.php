<?php
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
              <a href="/sdbpkad/"><i class="zmdi zmdi-home"></i> HOME</a>
            </li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0);">App</a>
            </li>
            <li class="breadcrumb-item active">Alokasi Dana</li>
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
          <button
            class="btn btn-success btn-icon float-right"
            type="button"
            data-toggle="modal"
            data-target="#offcanvasaddpagu">
            <i class="zmdi zmdi-plus"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="body xl-blue">
              <?php
              include 'lib/conn.php';
              function rupiah($angka)
              {

                $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                return $hasil_rupiah;
              }
              $jumlahpagu = mysqli_query($conn, "SELECT SUM(nilai) as nilai FROM pagu");
              $fetch1 = mysqli_fetch_array($jumlahpagu);
              echo '<h5 class="m-t-0 m-b-0">' . rupiah($fetch1['nilai']) . '</h5>';
              ?>
              <p class="m-b-0">Total Pagu</p>
              <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#222"
                data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(0, 150, 136)" data-spot-Color="rgb(0, 188, 212)"
                data-offset="90" data-width="100%" data-height="40px" data-line-Width="2" data-line-Color="#ffffff"
                data-fill-Color="transparent"> 7,6,7,8,5,9,8,6,7 </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="body xl-purple">
            <?php
              $jumlahsp2d = mysqli_query($conn, "SELECT SUM(nilai_sp2d) as nilai FROM sp2d");
              $fetch2 = mysqli_fetch_array($jumlahsp2d);
                echo '<h5 class="m-t-0 m-b-0">'. rupiah($fetch2['nilai']) .'</h5>';
              ?>
              
              <p class="m-b-0 ">Total Realisasi</p>
              <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#222"
                data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(0, 150, 136)" data-spot-Color="rgb(0, 188, 212)"
                data-offset="90" data-width="100%" data-height="42px" data-line-Width="2" data-line-Color="#ffffff"
                data-fill-Color="transparent"> 6,5,7,4,5,3,8,6,5 </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="body xl-green">
            <?php
            $sisa = $fetch1['nilai'] - $fetch2['nilai']; 
             
                echo '<h5 class="m-t-0 m-b-0">'. rupiah($sisa) .'</h5>';
              ?>
              <!-- <h4 class="m-t-0 m-b-0">73</h4> -->
              <p class="m-b-0 ">Sisa Pagu</p>
              <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#222"
                data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(0, 150, 136)" data-spot-Color="rgb(0, 188, 212)"
                data-offset="90" data-width="100%" data-height="45px" data-line-Width="2" data-line-Color="#ffffff"
                data-fill-Color="transparent"> 8,7,7,5,5,4,8,7,5 </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="body xl-pink">
              <h5 class="m-t-0 m-b-0">15</h5>
              <p class="m-b-0">Categories</p>
              <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#222"
                data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(0, 150, 136)" data-spot-Color="rgb(0, 188, 212)"
                data-offset="90" data-width="100%" data-height="45px" data-line-Width="2" data-line-Color="#ffffff"
                data-fill-Color="transparent"> 7,6,7,8,5,9,8,6,7 </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card" id="">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="myTablepagu">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>NAMA OPD</th>
                    <th>NILAI PAGU</th>
                    <!-- <th>id Sumber Dana</th> -->
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
          $.each(data, function(index, value) {
            var dana = value.nilai;
            table.row
              .add([
                value.id,
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
          }else if (response.statusCode == 800) {
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

