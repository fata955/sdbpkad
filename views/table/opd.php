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
            
            $data = mysqli_query($conn,"SELECT * from sipd.skpd") or die (mysqli_error($koneksi));
            while ($opd=mysqli_fetch_array($data)){   
        ?>
      <tr>
        <td>
          <?=$no;?>
        </td>
        <td>
          <!-- <img src="assets/images/xs/avatar1.jpg" class="avatar w30" alt=""> -->
          <p class="c_name"><?= $opd['nama_opd'];?></p>
        </td>
        <td>
          <span class="phone"
            ><i class="zmdi zmdi-whatsapp mr-2"></i
            ><?= $opd['kode_skpd'];?></span
          >
        </td>

        <td>
          <button class="btn btn-primary btn-sm">
            <i class="zmdi zmdi-edit"></i>
          </button>
          <button class="btn btn-danger btn-sm">
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
