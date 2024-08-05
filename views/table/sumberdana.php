<form action="" method="post">
  <div class="table-responsive">
    <table class="table table-hover mb-0 c_list c_table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name sumberdana</th>
          <!-- <th data-breakpoints="xs">Kode SIPD</th> -->
          <th data-breakpoints="xs">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include '../../lib/conn.php';
              $no = 1 ;
              
              $data = mysqli_query($conn,"SELECT * from sdana.t_sumber") or die (mysqli_error($koneksi));
              while ($sumber=mysqli_fetch_array($data)){   
          ?>
        <tr>
          <td>
            <?=$no;?>
          </td>
          <td>
            <!-- <img src="assets/images/xs/avatar1.jpg" class="avatar w30" alt=""> -->
            <p class="c_name"><?= $sumber['nm_sumber'];?></p>
          </td>
          
  
          <td>
            <button class="btn btn-primary btn-sm ">
              <i class="zmdi zmdi-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm hapus_datasumberdana"  id="<?= $sumber['id_sumber'];?>">
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

  $(document).on('click','.hapus_datasumberdana', function (e) {
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
                         tampil_datasumber();
                }
            });

        }
    })
});




</script>




