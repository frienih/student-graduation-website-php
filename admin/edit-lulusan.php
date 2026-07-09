<?php include 'header.php' ?>

<?php
	$lulusan 	= mysqli_query($conn, "SELECT * FROM lulusan WHERE id = '".$_GET['id']."' ");

	if(mysqli_num_rows($lulusan) == 0){
		echo "<script>window.location='lulusan.php'</script>";
	}

	$p 			= mysqli_fetch_object($lulusan);
?>

		<!-- content -->
		<div class="content">

			<div class="container">

				<div class="box">

					<div class="box-header">
						Edit Lulusan
					</div>

					<div class="box-body">
						
						<form action="" method="POST" enctype="multipart/form-data">
							
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" placeholder="Nama" value="<?= $p->nama ?>" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Asal Sekolah</label>
								<input type="text" name="asal_sekolah" placeholder="Asal Sekolah" value="<?= $p->asal_sekolah ?>" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Lulus</label>
								<textarea name="lulus" class="input-control" placeholder="Lulus"><?= $p->lulus ?></textarea>
							</div>
							
							<div class="form-group">
								<label>Tahun Kelulusan</label>
								<input type="text" name="tahun" placeholder="Tahun Kelulusan" value="<?= $p->tahun ?>" class="input-control" required>
							</div>

							<div class="form-group">
								<label>Gambar</label>
								<img src="../uploads/jurusan/<?= $p->gambar ?>" width="200px" class="image">
								<input type="hidden" name="gambar2" value="<?= $p->gambar ?>">
								<input type="file" name="gambar" class="input-control">
							</div>

							<button type="button" class="btn" onclick="window.location = 'lulusan.php'">Kembali</button>
							<input type="submit" name="submit" value="Simpan" class="btn btn-blue">

						</form>

						<?php

							if(isset($_POST['submit'])){

								$nama 	= addslashes(ucwords($_POST['nama']));
								$asal_sekolah 	= addslashes(ucwords($_POST['asal_sekolah']));
								$lulus	= addslashes($_POST['lulus']);
								$tahun 	= addslashes(ucwords($_POST['tahun']));
								$currdate = date('Y-m-d H:i:s');

								if($_FILES['gambar']['name'] != ''){

									// echo 'user ganti gambar';

									$filename 	= $_FILES['gambar']['name'];
									$tmpname 	= $_FILES['gambar']['tmp_name'];
									$filesize 	= $_FILES['gambar']['size'];

									$formatfile = pathinfo($filename, PATHINFO_EXTENSION);
									$rename 	= 'jurusan'.time().'.'.$formatfile;
									$allowedtype = array('png', 'jpg', 'jpeg', 'gif');

									if(!in_array($formatfile, $allowedtype)){

										echo '<div class="alert alert-error">Format file tidak diizinkan.</div>';

										return false;

									}elseif($filesize > 1000000){

										echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';

										return false;

									}else{

										if(file_exists("../uploads/jurusan/".$_POST['gambar2'])){

											unlink("../uploads/jurusan/".$_POST['gambar2']);

										}

										move_uploaded_file($tmpname, "../uploads/jurusan/".$rename);

									}

								}else{

									// echo 'user tidak ganti gambar';

									$rename 	= $_POST['gambar2'];

								}

								$update = mysqli_query($conn, "UPDATE lulusan SET
										nama = '".$nama."',
										asal_sekolah = '".$asal_sekolah."',
										lulus = '".$lulus."',
										tahun = '".$tahun."',
										gambar = '".$rename."',
										updated_at = '".$currdate."'
										WHERE id = '".$_GET['id']."'
									");


								if($update){
									echo "<script>window.location='lulusan.php?success=Edit Data Berhasil'</script>";
								}else{
									echo 'gagal edit '.mysqli_error($conn);
								}

							}

						?>

					</div>

				</div>

			</div>

		</div>

<?php include 'footer.php' ?>