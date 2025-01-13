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
              <a href="/sdbpkad/"><i class="zmdi zmdi-home"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0);">OPD</a>
            </li>
           
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
            data-target="#offcanvasaddUser">
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
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="myTableopd">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>id_sipd</th>
                    <th>Name</th>
                    <th data-breakpoints="xs">Kode SIPD</th>
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


<div class="modal fade" id="offcanvasaddUser" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

    <form method="POST" id="insertForm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Tambah OPD</h4>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="ID SIPD"
              name="idsipd" />
          </div>
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Nama OPD"
              name="namaopd" />
            <!-- <div class="input-group-append">
              <span class="input-group-text"
                ><i class="zmdi zmdi-account-circle"></i
              ></span>
            </div> -->
          </div>
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="KODE SIPD"
              name="kodeopd" />
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

<div class="modal fade" id="offcanvasEditUser" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form method="POST" id="editForm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">EDIT OPD</h4>
        </div>
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
          <div class="input-group mb-3">
            <input
              type="hidden"
              class="form-control"
              name="idsipd" disabled/>
          </div>
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              name="namaopd" />
          </div>
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="KODE SIPD"
              name="kodeopd" />
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

  let table = new DataTable("#myTableopd");

  // function to fetch data from database
  function fetchData() {
    $.ajax({
      url: "proses/opd/executeopd.php?action=fetchData",
      type: "POST",
      dataType: "json",
      success: function(response) {
        var data = response.data;
        table.clear().draw();
        $.each(data, function(index, value) {
          table.row
            .add([
              value.id,
              value.id_sipd,
              value.nama_opd,
              value.kode_skpd,
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
  $("#insertForm").on("submit", function(e) {
    $("#insertBtn").attr("disabled", "disabled");
    e.preventDefault();
    $.ajax({
      url: "proses/opd/executeopd.php?action=insertData",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
        var response = JSON.parse(response);
        if (response.statusCode == 200) {
          $("#offcanvasAddUser").offcanvas("hide");
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          //   $(".preview_img").attr("src", "images/default_profile.jpg");
          // $("#successToast").toast("show");
          // $("#successMsg").html(response.message);
          Swal.fire("!", "Data Sukses Tersimpan", "success");
          fetchData();
        } else if (response.statusCode == 500) {
          $("#offcanvasAddUser").offcanvas("hide");
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          Swal.fire("!", "Data Erro Disimpan", "Warning");
          fetchData();
          //   $(".preview_img").attr("src", "images/default_profile.jpg");
          // $("#errorToast").toast("show");
          // $("#errorMsg").html(response.message);
        } else if (response.statusCode == 400) {
          $("#insertBtn").removeAttr("disabled");
          Swal.fire("!", "Data Masih Kosong", "Warning");
          // $("#errorToast").toast("show");
          // $("#errorMsg").html(response.message);
        }
      }
    });
  });

  // function to edit data
  $("#myTableopd").on("click", ".editBtn", function() {
    var id = $(this).val();
    $.ajax({
      url: "proses/opd/executeopd.php?action=fetchSingle",
      type: "POST",
      dataType: "json",
      data: {
        id: id
      },
      success: function(response) {
        var data = response.data;
        $("#editForm #id").val(data.id);
        $("#editForm input[name='idsipd']").val(data.id_sipd);
        $("#editForm input[name='namaopd']").val(data.nama_opd);
        $("#editForm input[name='kodeopd']").val(data.kode_skpd);
        // $("#editForm select[name='country']").val(data.country);
        // $("#editForm .preview_img").attr("src", "uploads/" + data.image + "");
        // $("#editForm #image_old").val(data.image);
        // if (data.gender === "male") {
        //   $("#editForm input[name='gender'][value='male']").attr("checked", true);
        // } else if(data.gender === "female") {
        //   $("#editForm input[name='gender'][value='female']").attr("checked", true);
        // }
        // show the edit user offcanvas
        $("#offcanvasEditUser").modal("show");
      }
    });
  });

  // function to update data in database
  $("#editForm").on("submit", function(e) {
    $("#editBtn").attr("disabled");
    e.preventDefault();
    $.ajax({
      url: "proses/opd/executeopd.php?action=updateData",
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
          $("#offcanvasEditUser").modal("hide");
        } else if (response.statusCode == 500) {
          $("#offcanvasEditUser").offcanvas("hide");
          $("#editBtn").removeAttr("disabled");
          $("#editForm")[0].reset();
          //   $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if (response.statusCode == 400) {
          // $("#editBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      }
    });
  });

  // function to delete data
  $("#myTableopd").on("click", ".deleteBtn", function() {
    if (confirm("Apakah yakin Menghapus Data Ini?")) {
      var id = $(this).val();
      //   var delete_image = $(this).closest("td").find(".delete_image").val();
      $.ajax({
        url: "proses/opd/executeopd.php?action=deleteData",
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