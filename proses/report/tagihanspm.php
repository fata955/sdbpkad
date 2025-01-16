<?php
    $start = $_POST['start'];
    $end = $_POST['end'];
    $idopd = $_POST['opdlg'];
  
    if ($idopd > 1) {
      $opd = $idopd;
      $sql = "SELECT sum(a.nilai_spm) as realisasi from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND id_skpd=$opd";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $datarealisasi = $row['realisasi'];
  
      //jumlah jumlah SPM
      $sql = "SELECT count(*) as totalspm from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND id_skpd=$opd";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $spm = $row['totalspm'];
  
      //jumlah jumlah LS
      $sql = "SELECT count(*) as totalls from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='LS' AND id_skpd=$opd";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $ls = $row['totalls'];
  
      //jumlah jumlah gu
      $sql = "SELECT count(*) as totalgu from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='GU' AND id_skpd=$opd";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $gu = $row['totalgu'];
  
      //jumlah jumlah UP
      $sql = "SELECT count(*) as totalup from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='UP' AND id_skpd=$opd";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $up = $row['totalup'];
      $start = $conn->real_escape_string($start);
      $end = $conn->real_escape_string($end);
  
      // echo $start;
      // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
      // $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where Date(c.updateby) between '$start' AND '$end' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user AND status>0";
      $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where Date(c.updateby) BETWEEN '$start' AND '$end' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user AND a.id_skpd=$opd";
      $result = mysqli_query($conn, $sql);
      $data = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
      }
      mysqli_close($conn);
      header('Content-Type: application/json');
      echo json_encode([
        "data" => $data,
        "realisasi" => $datarealisasi,
        "spm" => $spm,
        "ls" => $ls,
        "gu" => $gu,
        "up" => $up
      ]);
      
    } else {
  
      $sql = "SELECT sum(a.nilai_spm) as realisasi from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $datarealisasi = $row['realisasi'];
    
      //jumlah jumlah SPM
      $sql = "SELECT count(*) as totalspm from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $spm = $row['totalspm'];
    
      //jumlah jumlah LS
      $sql = "SELECT count(*) as totalls from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='LS'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $ls = $row['totalls'];
    
      //jumlah jumlah gu
      $sql = "SELECT count(*) as totalgu from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='GU'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $gu = $row['totalgu'];
    
      //jumlah jumlah UP
      $sql = "SELECT count(*) as totalup from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='UP'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $up = $row['totalup'];
      $start = $conn->real_escape_string($start);
      $end = $conn->real_escape_string($end);
    
      // echo $start;
      // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
      $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where Date(c.updateby) BETWEEN '$start' AND '$end' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user";
      $result = mysqli_query($conn, $sql);
      $data = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
      }
      mysqli_close($conn);
      header('Content-Type: application/json');
      echo json_encode([
        "data" => $data,
        "realisasi" => $datarealisasi,
        "spm" => $spm,
        "ls" => $ls,
        "gu" => $gu,
        "up" => $up
      ]);
    }
  