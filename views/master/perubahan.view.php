<?php
// include_once 'component/session.php';

session_start(); 
include 'lib/conn.php';
if (!isset($_SESSION['username'])) { header('Location: /sdbpkad/login'); 
    exit(); }
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
              <a href="/sdbpkad/"><i class="zmdi zmdi-home"></i> Jenis Perubahan/Pergeseran</a>
            </li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0);">App</a>
            </li>
            <li class="breadcrumb-item active">Perubahan</li>
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
            data-target="#offcanvasaddperubahan">
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
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="myTableperubahan">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Nama Perubahan / pergeseran</th>
                    <th>Status</th>
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


<div class="modal fade" id="offcanvasaddperubahan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

    <form method="POST" id="insertForm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Tambah Perubahan</h4>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Nama Perubahan "
              name="namaperubahan" />
          </div>
          <div class="input-group mb-3">
            <select name='status' class="form-control">
              <option value='AKTIF'> AKTIF </option>";
              <option value='NONAKTIF'> NON AKTIF </option>";
            </select>
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

<div class="modal fade" id="offcanvasEditperubahan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form method="POST" id="editForm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Edit Perubahan</h4>
        </div>
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              name="namaperubahan" />
          </div>

          <div class="input-group mb-3">
            <select name='status' class="form-control ms">
              <option value='AKTIF'> AKTIF </option>";
              <option value='NONAKTIF'> NONAKTIF </option>";
            </select>
          </div>
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

    let table = new DataTable("#myTableperubahan");

    // function to fetch data from database
    function fetchData() {
      $.ajax({
        url: "proses/perubahan/executeperubahan.php?action=fetchData",
        type: "POST",
        dataType: "json",
        success: function(response) {
          var data = response.data;
          table.clear().draw();
          var counter = 1;
          $.each(data, function(index, value) {
            if (value.status == "NON AKTIF") {
                  '<span class="badge badge-warning">' + value.status + '</span>'
                } else {
                  '<span class="badge badge-info">' + value.status + '</span>'
                }
            table.row
              .add([
                counter,
                value.namaperubahan,
                value.status,
                '<Button type="button" class="btn btn-primary btn-sm editBtn" value="' +
                value.id +
                '"><i class="zmdi zmdi-edit"></i></Button>' +
              '<Button type="button" class="btn btn-danger btn-sm deleteBtnperubahan" value="' +
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
      $("#insertBtn").attr("disabled");
      e.preventDefault();
      $.ajax({
        url: "proses/perubahan/executeperubahan.php?action=insertData",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
          var response = JSON.parse(response);
          if (response.statusCode == 200) {
            $("#offcanvasAddperubahan").offcanvas("hide");
            $("#insertBtn").removeAttr("disabled");
            $("#insertForm")[0].reset();
            //   $(".preview_img").attr("src", "images/default_profile.jpg");
            $("#successToast").toast("show");
            $("#successMsg").html(response.message);
            // Swal.fire("!", "Data Sukses Tersimpan", "success");
            fetchData();
          } else if (response.statusCode == 500) {
            $("#offcanvasAddperubahan").offcanvas("hide");
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
          }
        }
      });
    });

    // function to edit data
    $("#myTableperubahan").on("click", ".editBtn", function() {
      var id = $(this).val();
      $.ajax({
        url: "proses/perubahan/executeperubahan.php?action=fetchSingle",
        type: "POST",
        dataType: "json",
        data: {
          id: id
        },
        success: function(response) {
          var data = response.data;
          $("#editForm #id").val(data.id);
          $("#editForm input[name='namaperubahan']").val(data.namaperubahan);
          $("#editForm select[name='status']").val(data.status);

          $("#offcanvasEditperubahan").modal("show");
        }
      });
    });

    // function to update data in database
    $("#editForm").on("submit", function(e) {
      $("#editBtn").attr("disabled");
      e.preventDefault();
      $.ajax({
        url: "proses/perubahan/executeperubahan.php?action=updateData",
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
            $("#offcanvasEditperubahan").offcanvas("hide");
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
    $("#myTableperubahan").on("click", ".deleteBtnperubahan", function() {
      if (confirm("Apakah yakin Menghapus Data Ini?")) {
        var id = $(this).val();
        //   var delete_image = $(this).closest("td").find(".delete_image").val();
        $.ajax({
          url: "proses/perubahan/executeperubahan.php?action=deleteData",
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