<form id='form_input' method='POST'>
  <div class="table-responsive">
    <table class="table table-hover mb-0 c_list c_table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th data-breakpoints="xs">Kode SIPD</th>
          <th data-breakpoints="xs">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include '../../lib/conn.php';
              $no = 1 ;
              
              $data = mysqli_query($conn,"SELECT * from sipd.skpd order by id desc") or die (mysqli_error($conn));
              while ($opd=mysqli_fetch_array($data)){   
          ?>
        <tr>
          <td>
            <?=$no;?>
          </td>
          <td>
            <!-- <img src="assets/images/xs/avatar1.jpg" class="avatar w30" alt=""> -->
            <p class="c_name" idnama="<?=$opd['nama_opd'];?>"><?= $opd['nama_opd'];?></p>
          </td>
          <td>
            <span class="phone"
              ><i class="zmdi zmdi-whatsapp mr-2"></i
              ><?= $opd['kode_skpd'];?></span
            >
          </td>
  
          <td>
            <button class="btn btn-primary btn-sm edit_data" data-toggle="modal"
            data-target="#Modaledit" id='btneditopd' idopd=<?= $opd['id'];?> >
              <i class="zmdi zmdi-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm hapus_data" id="<?= $opd['id'];?>" name="btndeleteopd" idopd="">
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



<div class="modal fade" id="Modaledit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form action="" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="Modaleditlabel">Edit Sumber Dana</h4>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Nama Sumber dana"
              id="namasumberdana" name="namasumberdana"
              value="" required
            />
          </div>
          <div class="input-group mb-3">
            <input
              type="text"
              class="form-control"
              placeholder="Ket Sumber Dana"
              id="ketsumberdana" name="ketsumberdana"
              value="" required 
            />
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect" id="btnupdateopd">
            UPDATE
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
<script>

$(document).on('click','.hapus_data', function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Menghapus OPD ini ?",
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
                url: 'proses/opd/deleteopd.php',
                data: {
                    id : id,
                    // kodeopd : $("#kodeopd").val()
                },
                success: function () {
                    Swal.fire(
                        '!',
                        'No antrian sukses dipilih',
                        'success'
                   
                        // close();s
                    )
                         tampil_data();
                }
            });

        }
    })
});

</script>

