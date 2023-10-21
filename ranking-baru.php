<?php
include_once 'header.php';
include_once 'includes/alternatif.inc.php';
$pgn1 = new Alternatif($db);
include_once 'includes/kriteria.inc.php';
$pgn2 = new Kriteria($db);
include_once 'includes/nilai.inc.php';
$pgn3 = new Nilai($db);
if($_POST){
	
	include_once 'includes/ranking.inc.php';
	$eks = new ranking($db);

	$eks->ia = $_POST['ia'];
	$eks->ik = $_POST['ik'];
	$eks->nn = $_POST['nn'];
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="ranking.php">lihat semua data</a>.
</div>
<?php
	}
	
	else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Tambah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-6 col-md-6">
		  <div class="well">
		  	<div class="page-header">
			  <h3>Tambah ranking</h3>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="ia">Alternatif</label>
				    <select class="form-control" id="ia" name="ia">
				    	<?php
						$stmt3 = $pgn1->readAll();
						while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							extract($row3);
							echo "<option value='{$id_alternatif}'>{$nama_alternatif}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="ik">Kriteria</label>
				    <select class="form-control" id="ik" name="ik">
				    	<?php
						$stmt2 = $pgn2->readAll();
						while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
							extract($row2);
							echo "<option value='{$id_kriteria}'>{$nama_kriteria}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="nn">Nilai</label>
				    <select class="form-control" id="nn" name="nn">
<option value="1">di bawah 500.000</option><option value="2">500.000 - 1.000.000</option><option value="3">1.000.000 - 2.000.000</option><option value="4">2.000.000 - 3.000.000</option><option value="5">3.000.000 - 4.000.000</option>
				    </select>
				  </div>
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='ranking.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  </div>
		  <div class="col-xs-12 col-sm-3 col-md-3">
		  	<?php include_once 'sidebar.php'; ?>
		</div>
		
		<script>
document.addEventListener('DOMContentLoaded', function () {
  const ik = document.getElementById('ik');
  const nn = document.getElementById('nn');

  ik.addEventListener('change', function () {
    // Ambil nilai bobot yang dipilih oleh pengguna
    const selectedBobot = ik.value;
    
    // Ganti keterangan bobot kriteria sesuai dengan bobot yang dipilih
    switch (selectedBobot) {
      case '15':
       nn.innerHTML =
	   '<option value="1">di bawah 500.000</option><option value="2">500.000 - 1.000.000</option><option value="3">1.000.000 - 2.000.000</option><option value="4">2.000.000 - 3.000.000</option><option value="5">3.000.000 - 4.000.000</option>';
        break;
		case '16':
       nn.innerHTML =
	   '<option value="1">Lebih dari 8 anggota</option><option value="2">7 - 8 anggota</option><option value="3">5 - 6 anggota</option><option value="4">3 - 4 anggota</option><option value="5">Kurang dari 3 anggota</option>';
        break;
		case '17':
       nn.innerHTML =
	   '<option value="1">Sangat Buruk</option><option value="2">Buruk</option><option value="3">Cukup</option><option value="4">Baik</option><option value="5">Sangat Baik</option>';
        break;
		case '18':
       nn.innerHTML =
	   '<option value="1">Tidak Tamat SD</option><option value="2">SD/SMP</option><option value="3">SMA/SMK/D3</option><option value="4">S1</option><option value="5">S2 atau Lebih</option>';
        break;
		case '19':
       nn.innerHTML =
	   '<option value="1">Sangat Buruk</option><option value="2">Buruk </option><option value="3">Cukup</option><option value="4">Baik</option><option value="5">Sangat Baik</option>';
        break;
		default:
       nn.innerHTML =
	   '<option value="1">Kurang dari 50 m²</option><option value="2">50 m² - 100 m²</option><option value="3">100 m² - 150 m²</option><option value="4">150 m² - 200 m² </option><option value="5">Lebih dari 200 m²</option>';
        break;

    }
  });
});
</script>
		<?php
include_once 'footer.php';
?>
