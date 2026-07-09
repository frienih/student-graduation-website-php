<?php
// Koneksi ke database
include 'header.php';

// Dapatkan tahun dan pencarian dari URL (jika ada)
$tahun = isset($_GET['year']) ? $_GET['year'] : '2023'; // Tahun default 2023
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Ambil data lulusan berdasarkan tahun dan pencarian
$lulusan = mysqli_query($conn, "SELECT * FROM lulusan WHERE tahun = '$tahun' AND (nama LIKE '%$search%' OR asal_sekolah LIKE '%$search%' OR lulus LIKE '%$search%' OR tahun LIKE '%$search%') ORDER BY nama ASC, id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lulusan Terbaik</title>
</head>
<body>

<div class="section">
    <div class="container text-center">
        <h3>Lulusan Terbaik</h3>

        <!-- Form Pencarian -->
        <form method="GET" action="" class="search-form">
            <input type="text" name="search" placeholder="Cari Berdasarkan Nama/Asal Sekolah/Lulus..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Cari</button>
        </form>
        
        <!-- Tab Tahun -->
        <div class="year-tabs">
            <a href="?year=2022&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2022' ? 'active' : '' ?>">2022</a>
            <a href="?year=2023&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2023' ? 'active' : '' ?>">2023</a>
            <a href="?year=2024&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2024' ? 'active' : '' ?>">2024</a>
            <a href="?year=2025&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2025' ? 'active' : '' ?>">2025</a>
            <a href="?year=2026&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2026' ? 'active' : '' ?>">2026</a>
            <a href="?year=2027&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2027' ? 'active' : '' ?>">2027</a>
            <a href="?year=2028&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2028' ? 'active' : '' ?>">2028</a>
            <a href="?year=2029&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2029' ? 'active' : '' ?>">2029</a>
            <a href="?year=2030&search=<?= htmlspecialchars($search) ?>" class="tablink <?= $tahun == '2030' ? 'active' : '' ?>">2030</a>

        </div>

        <!-- Konten Lulusan -->
        <table>
            <thead>
                <tr>
                    <th>Nama Peserta</th>
                    <th>Asal Sekolah</th>
                    <th>Lulus</th>
                    <th>Tahun</th>
                    <th>Foto Siswa</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($lulusan) > 0): ?>
                    <?php while($j = mysqli_fetch_array($lulusan)): ?>
                        <tr>
                            <td><?= htmlspecialchars($j['nama']) ?></td>
                            <td><?= htmlspecialchars($j['asal_sekolah']) ?></td>
                            <td><?= htmlspecialchars($j['lulus']) ?></td>
                            <td><?= htmlspecialchars($j['tahun']) ?></td>
                            <td><img src="uploads/jurusan/<?= htmlspecialchars($j['gambar']) ?>" alt="Foto Siswa"></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

<?php include 'footer.php' ?>