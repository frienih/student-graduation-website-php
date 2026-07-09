<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['status_login'])) {
    echo "<script>window.location = '../login.php?msg=Harap Login Terlebih Dahulu!'</script>";
}
date_default_timezone_set("Asia/Jakarta");

$identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$d = mysqli_fetch_object($identitas);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - <?= htmlspecialchars($d->nama) ?></title>
    <link rel="icon" href="../uploads/identitas/<?= htmlspecialchars($d->favicon) ?>">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- Bagian Navbar -->
    <div class="navbar">
        <div class="container">
            <div class="nav-logo">
                <h2><a href="index.php"><?= htmlspecialchars($d->nama) ?></a></h2>
            </div>

            <!-- navbar Menu -->
            <ul class="nav-menu" id="nav-menu">
                <li><a href="index.php">Dashboard</a></li>

                <?php if ($_SESSION['ulevel'] == 'Super Admin') { ?>
                    <li><a href="pengguna.php">Pengguna</a></li>
                <?php } elseif ($_SESSION['ulevel'] == 'Admin') { ?>
                    <li><a href="lulusan.php">Lulusan</a></li>
                    <li><a href="identitas-bimbel.php">Identitas Bimbel</a></li>
                <?php } ?>

                <li class="dropdown-parent">
                    <a href="javascript:void(0);" id="user-menu"><?= htmlspecialchars($_SESSION['uname']) ?>
                        (<?= htmlspecialchars($_SESSION['ulevel']) ?>) <i class="fa fa-caret-down"></i></a>
                    <!-- Sub Menu -->
                    <ul class="dropdown" id="user-dropdown">
                        <li><a href="ubah-password.php">Ubah Password</a></li>
                        <li><a href="logout.php">Keluar</a></li>
                    </ul>
                </li>
            </ul>

            <div class="mobile-menu-btn text-center">
                <a href="#" onclick="showMobileMenu()">Menu</a>
            </div>
        </div>
    </div>

    <!-- Box Menu Mobile -->
    <div class="mobile-only" id="mobileMenu" style="display:none;">
        <div class="box-menu-mobile">
            <span onclick="hideMobileMenu()" class="close-btn">Close</span>
            <ul class="text-center">
                <li><a href="index.php">Dashboard</a></li>

                <?php if ($_SESSION['ulevel'] == 'Super Admin') { ?>
                    <li><a href="pengguna.php">Pengguna</a></li>
                <?php } elseif ($_SESSION['ulevel'] == 'Admin') { ?>
                    <li><a href="lulusan.php">Lulusan</a></li>
                    <li><a href="identitas-bimbel.php">Identitas Bimbel</a></li>
                <?php } ?>
                <li>
                    <a href="javascript:void(0);" id="mobile-user-menu"><?= htmlspecialchars($_SESSION['uname']) ?>
                        (<?= htmlspecialchars($_SESSION['ulevel']) ?>) <i class="fa fa-caret-down"></i></a>
                    <!-- Sub Menu -->
                    <ul class="dropdown" id="mobile-user-dropdown">
                        <li><a href="ubah-password.php">Ubah Password</a></li>
                        <li><a href="logout.php">Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <script>
    // Function to show mobile menu
    function showMobileMenu() {
        document.getElementById('mobileMenu').style.display = 'block';
    }

    // Function to hide mobile menu
    function hideMobileMenu() {
        document.getElementById('mobileMenu').style.display = 'none';
    }

    // Add click event for the desktop user menu
    document.getElementById('user-menu').addEventListener('click', function () {
        var dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('show');
    });

    // Add click event for the mobile user menu
    document.getElementById('mobile-user-menu').addEventListener('click', function () {
        var mobileDropdown = document.getElementById('mobile-user-dropdown');
        mobileDropdown.classList.toggle('show');
    });
    </script>

    </script>

</body>

</html>
