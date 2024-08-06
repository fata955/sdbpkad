<form action="" method="post">
  <div class="table-responsive">
    <table class="table table-hover mb-0 c_list c_table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name Sub Sumberdana</th>
          <th>Ket Sub Sumberdana</th>
          <!-- <th data-breakpoints="xs">Kode SIPD</th> -->
          <th data-breakpoints="xs">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include '../../lib/conn.php';
              $no = 1 ;
              
              $data = mysqli_query($conn,"SELECT * from sdana.t_sumber_sub") or die (mysqli_error($conn));
              while ($subsumber=mysqli_fetch_array($data)){   
          ?>
        <tr>
          <td>
            <?=$no;?>
          </td>
          <td>
            <!-- <img src="assets/images/xs/avatar1.jpg" class="avatar w30" alt=""> -->
            <p class="c_name">
              <?= $subsumber['nm_sumber_sub'];?>
            </p>
          </td>
          <td>
            <!-- <img src="assets/images/xs/avatar1.jpg" class="avatar w30" alt=""> -->
            <p class="c_name">
              <?= $subsumber['ket'];?>
            </p>
          </td>



          <td>
            <a href="#modaledit<?=$subsumber['id_sub'];?>" class="btn btn-primary btn-sm edit_data" data-toggle="modal">
              <i class="zmdi zmdi-edit"></i>
            </a>
            <div class="modal fade" id="modaledit<?=$subsumber['id_sub'];?>" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document">
                <form action="" method="post">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="title" id="Modaleditlabel">Edit OPD</h4>
                    </div>
                    <div class="modal-body">
                      <div class="input-group mb-3">
                        <select class="form-control show-tick ms select2" data-placeholder="Select" id="namasumberdana"
                          name="namasumberdana">
                          <option>Pilih Sumber Dana</option>
                          <option>DAU</option>
                          <option>DBH PROV</o ption>
                          <option>PAD</option>
                        </select>
                      </div>
                      <div class="input-group mb-3">
                        <input type="hidden" class="form-control" id="idop" name="idopd"
                          value="<?=$subsumber['id_sub'];?>" required />
                        <input type="text" class="form-control" id="namaop" name="namaop"
                          value="<?=$subsumber['nm_sumber_sub'];?>" required />
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" id="kodeop" name="kodeop"
                          value="<?=$subsumber['ket'];?>" required />
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-round waves-effect update_opd" id="btnupdateopd">
                        UPDATE
                      </button>
                      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                        CLOSE
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <button class="btn btn-danger btn-sm hapus_datasubsumberdana" id="<?= $subsumber['id_sub'];?>">
              <i class="zmdi zmdi-delete"></i>
            </button>
          </td>
        </tr>
        <?php
                  $no++;
              }
          ?>
      </tbody>
    </table>
  </div>
</form>

<script>

  $(document).on('click', '.hapus_datasumberdana', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin ?',
      text: "Menghapus Sumber Dana ini ?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.value) {
        var id = $(this).attr('id');
        $.ajax({
          type: 'GET',
          url: 'proses/sumberdana/deletesumberdana.php',
          data: {
            id: id,
            // kodeopd : $("#kodeopd").val()
          },
          success: function () {
            Swal.fire(
              '!',
              'No antrian sukses dipilih',
              'success'

              // close();s
            )
            tampil_datasumber();
          }
        });

      }
    })
  });




</script>