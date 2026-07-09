<?php include 'header.php' ?>

    <!-- content -->
    <div class="content">
        <div class="container">
            <div class="box">
                <div class="box-header">
                    Tambah Lulusan
                </div>
                <div class="box-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" required>
                        </div>

                        <div class="form-group">
                            <label>Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" placeholder="Asal Sekolah" class="input-control" required>
                        </div>

                        <div class="form-group">
                            <label>Lulus</label>
                            <textarea name="lulus" class="input-control" placeholder="Lulus"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Tahun Kelulusan</label>
                            <input type="text" name="tahun" placeholder="Tahun Kelulusan" class="input-control" required>
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="input-control" required>
                        </div>

                        <button type="button" class="btn" onclick="window.location = 'lulusan.php'">Kembali</button>
                        <input type="submit" name="submit" value="Simpan" class="btn btn-blue">
                    </form>

                    <?php

                        // Koneksi ke database
                        include '../koneksi.php'; 

                        if(isset($_POST['submit'])){

                            $nama           = addslashes(ucwords($_POST['nama']));
                            $asal_sekolah   = addslashes($_POST['asal_sekolah']);
                            $lulus            = addslashes($_POST['lulus']);
                            $tahun          = addslashes($_POST['tahun']);

                            // Validasi format tahun (harus 4 digit)
                            if(!is_numeric($tahun) || strlen($tahun) != 4) {
                                echo '<div class="alert alert-error">Format tahun tidak valid. Harus berupa 4 digit angka.</div>';
                            } else {
                                // Proses upload gambar
                                $filename   = $_FILES['gambar']['name'];
                                $tmpname    = $_FILES['gambar']['tmp_name'];
                                $filesize   = $_FILES['gambar']['size'];

                                $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename     = 'lulusan_'.time().'.'.$formatfile;

                                $allowedtype = array('png', 'jpg', 'jpeg', 'gif');

                                // Validasi format file
                                if(!in_array($formatfile, $allowedtype)){
                                    echo '<div class="alert alert-error">Format file tidak diizinkan. Hanya png, jpg, jpeg, dan gif yang diperbolehkan.</div>';
                                }
                                // Validasi ukuran file
                                elseif($filesize > 1000000){
                                    echo '<div class="alert alert-error">Ukuran file tidak boleh lebih dari 1 MB.</div>';
                                }
                                else {
                                    // Proses upload gambar ke folder
                                    if(move_uploaded_file($tmpname, "../uploads/jurusan/".$rename)){
                                        // Simpan data ke database
                                        $simpan = mysqli_query($conn, "INSERT INTO lulusan VALUES (
                                            null,
                                            '".$nama."',
                                            '".$asal_sekolah."',
                                            '".$lulus."',
                                            '".$tahun."',
                                            '".$rename."',
                                            null,
                                            null
                                        )");

                                        if($simpan){
                                            echo '<div class="alert alert-success">Simpan Berhasil</div>';
                                        } else {
                                            echo 'Gagal simpan '.mysqli_error($conn);
                                        }
                                    } else {
                                        echo '<div class="alert alert-error">Gagal mengupload file gambar.</div>';
                                    }
                                }
                            }
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>
