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
            <li class="breadcrumb-item active">Contact</li>
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
          <div class="card" id="listopd"></div>
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
          <h4 class="title" id="largeModalLabel">Tambah OPD</h4>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Nama OPD"
              id="namaopd" name="namaopd"
              value="" required
            />
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
              id="kodeopd" name="kodeopd"
              value="" required 
            />
            <!-- <div class="input-group-append">
              <span class="input-group-text"
                ><a
                  href="forgot-password.html"
                  class="forgot"
                  title="Forgot Password"
                  ><i class="zmdi zmdi-lock"></i></a
              ></span>
            </div> -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-round waves-effect" id="btnsaveopd">
            SAVE CHANGES
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
