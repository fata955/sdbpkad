<?php
    include 'header.view.php';
    
?>
<section class="content contact">
  <div class="body_scroll">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>SKPD</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/budget/"><i class="zmdi zmdi-home"></i>Budget</a>
            </li>
            <li class="breadcrumb-item">
              <a href="javascript:void(0);">App</a>
            </li>
            <li class="breadcrumb-item active">Sub Sumber Dana</li>
          </ul>
          <button class="btn btn-primary btn-icon mobile_menu" type="button">
            <i class="zmdi zmdi-sort-amount-desc"></i>
          </button>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <button
            class="btn btn-primary btn-icon float-right right_icon_toggle_btn"
            type="button"
          >
            <i class="zmdi zmdi-arrow-right"></i>
          </button>
          <button
            class="btn btn-success btn-icon float-right"
            type="button"
            data-toggle="modal"
            data-target="#largeModal"
          >
            <i class="zmdi zmdi-plus"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card" id="listsubsumberdana"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form action="" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Tambah Sub Sumber Dana</h4>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <select
              class="form-control show-tick ms select2"
              data-placeholder="Select" id="namasumberdana"
              name="namasumberdana"
            >
              <option>Pilih Sumber Dana</option>
              <option>DAU</option>
              <option>DBH PROV</o ption>
              <option>PAD</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Nama Sub Sumber dana"
              id="namasubsumberdana"
              name="namasubsumberdana"
              value=""
              required
            />
            
          </div>
          
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Ket Sub Sumber Dana"
              id="ketsubsumberdana"
              name="ketsubsumberdana"
              value=""
              required
            />
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="submit"
            class="btn btn-default btn-round waves-effect"
            id="btnsavesubsumberdana"
          >
            SAVE
          </button>
          <button
            type="button"
            class="btn btn-danger waves-effect"
            data-dismiss="modal"
          >
            CLOSE
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
    include 'footer.view.php';
?>
<script>
  $(document).ready(function () {
    tampil_datasubsumber();

    $("#btnsavesubsumberdana").on("click", function (e) {
      e.preventDefault();
      Swal.fire({
        title: "Apakah anda yakin ?",
        text: "Menyimpan Sub Sumber Dana Baru ini ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            type: "GET",
            url: "proses/subsumberdana/savesubsumberdana.php",
            data: {
              nama: $("#namasubsumberdana").val(),
              keterangan: $("#ketsubsumberdana").val(),
            },
            success: function () {
              Swal.fire(
                "!",
                "No antrian sukses dipilih",
                "success"
                // console.log(nama);
              );
              tampil_datasubsumber();
              document.getElementById("namasubsumberdana").value = "";
              document.getElementById("ketsubsumberdana").value = "";
              swal.close();
              // swal.close();
            },
          });
        }
      });
    });
  });

  function tampil_datasubsumber() {
    $.ajax({
      url: "views/table/subsumberdana.php",
      type: "get",
      success: function (data) {
        $("#listsubsumberdana").html(data);
      },
    });
  }
  // end list opd
</script>
