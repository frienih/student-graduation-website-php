<?php include 'header.php' ?>

<!-- content -->
<div class="content">

    <div class="container">

        <div class="box">

            <div class="box-header">
                Lulusan
            </div>

            <div class="box-body">
                
                <a href="tambah-lulusan.php" class="text-green"><i class="fa fa-plus"></i> Tambah</a>

                <?php
                    // Menampilkan pesan sukses
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>" . $_GET['success'] . "</div>";
                    }
                ?>

                <!-- Form Pencarian -->
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="key" placeholder="Cari Nama, Asal Sekolah, Status Lulus, Tahun" value="<?= isset($_GET['key']) ? $_GET['key'] : '' ?>">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>

                <!-- Tabel Data Lulusan -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Asal Sekolah/Instansi</th>
                            <th>Lulus</th>
                            <th>Tahun Kelulusan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        // Query dasar
                        $where = " WHERE 1=1 ";

                        // Jika pencarian diisi
                        if (isset($_GET['key'])) {
                            $key = mysqli_real_escape_string($conn, $_GET['key']);

                            // Klausa pencarian untuk beberapa kolom
                            $where .= " AND (nama LIKE '%$key%' 
                                        OR asal_sekolah LIKE '%$key%' 
                                        OR lulus LIKE '%$key%' 
                                        OR tahun LIKE '%$key%')";
                        }

                        // Query untuk mengambil data lulusan
                        $lulusan = mysqli_query($conn, "SELECT * FROM lulusan $where ORDER BY id DESC");
                        if (mysqli_num_rows($lulusan) > 0) {
                            while ($p = mysqli_fetch_array($lulusan)) {
                        ?>

                        <!-- Menampilkan Data Lulusan -->
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($p['nama']) ?></td>
                            <td><?= htmlspecialchars($p['asal_sekolah']) ?></td>
                            <td><?= htmlspecialchars($p['lulus']) ?></td>
                            <td><?= htmlspecialchars($p['tahun']) ?></td>
                            <td><img src="../uploads/jurusan/<?= htmlspecialchars($p['gambar']) ?>" width="100px"></td>
                            <td>
                                <a href="edit-lulusan.php?id=<?= $p['id'] ?>" title="Edit Data" class="text-orange"><i class="fa fa-edit"></i></a> 
                                <a href="hapus.php?idjurusan=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data" class="text-red"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                        <?php } } else { ?>
                        <!-- Jika Data Tidak Ditemukan -->
                        <tr>
                            <td colspan="7">Data tidak ada</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>

<?php include 'footer.php' ?>
