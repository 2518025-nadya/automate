<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["nama"])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION["nama"];
?>

<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MATE Dashboard</title>

```
<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f7f8fc;
        color: #111827;
    }

    /* SIDEBAR */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        padding: 30px 20px;
        background: #050b16;
        color: white;
    }

    .logo {
        margin-bottom: 65px;
        color: #1680ff;
        font-size: 28px;
        font-weight: bold;
    }

    .menu {
        display: block;
        margin-bottom: 12px;
        padding: 15px 20px;
        border-radius: 12px;
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    .menu:hover,
    .menu.active {
        background: #1677ff;
    }

    /* KONTEN UTAMA */
    .main {
        margin-left: 250px;
        padding: 30px 40px;
    }

    /* BAGIAN ATAS */
    .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 65px;
    }

    .search {
        width: 55%;
        max-width: 500px;
        padding: 16px 20px;
        border: 1px solid #eee;
        border-radius: 30px;
        background: white;
        box-shadow: 0 3px 8px #00000008;
    }

    .profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #e0eaff;
        font-size: 20px;
    }

    .logout-button {
        padding: 11px 17px;
        border: none;
        border-radius: 8px;
        background: #e53935;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    .logout-button:hover {
        background: #c62828;
    }

    /* SAPAAN */
    .welcome {
        margin-bottom: 35px;
    }

    .welcome h1 {
        margin-bottom: 12px;
        font-size: 32px;
    }

    .welcome p {
        color: #718096;
    }

    /* KARTU INFORMASI */
    .cards {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .card {
        padding: 28px;
        border: 1px solid #eee;
        border-radius: 16px;
        background: white;
        box-shadow: 0 4px 12px #00000006;
    }

    .card-title {
        color: #718096;
        font-size: 14px;
    }

    .card-number {
        margin-top: 15px;
        font-size: 28px;
        font-weight: bold;
    }

    /* KONTEN BAWAH */
    .bottom-section {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 25px;
    }

    .panel {
        padding: 28px;
        border: 1px solid #eee;
        border-radius: 16px;
        background: white;
    }

    .panel h3 {
        margin-top: 0;
        margin-bottom: 25px;
    }

    .vehicle {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 10px;
        background: #f8fafc;
    }

    .vehicle-icon {
        font-size: 32px;
    }

    .vehicle p {
        margin: 6px 0 0;
        color: #718096;
        font-size: 14px;
    }

    .service {
        margin-bottom: 22px;
    }

    .service:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 900px) {
        .sidebar {
            width: 200px;
        }

        .main {
            margin-left: 200px;
            padding: 25px;
        }

        .cards {
            grid-template-columns: 1fr;
        }

        .bottom-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .sidebar {
            position: static;
            width: 100%;
            height: auto;
        }

        .logo {
            margin-bottom: 25px;
        }

        .main {
            margin-left: 0;
            padding: 20px;
        }

        .topbar {
            align-items: flex-start;
            flex-direction: column;
            margin-bottom: 35px;
        }

        .search {
            width: 100%;
        }

        .profile {
            flex-wrap: wrap;
        }

        .welcome h1 {
            font-size: 26px;
        }
    }
</style>
```

</head>

<body>

```
<!-- SIDEBAR -->
<aside class="sidebar">

    <div class="logo">〽 MATE</div>

    <a href="dashboard.php" class="menu active">Dashboard</a>
    <a href="#" class="menu">My Vehicle</a>
    <a href="#" class="menu">Service</a>
    <a href="#" class="menu">Booking</a>
    <a href="#" class="menu">History</a>
    <a href="#" class="menu">Profile</a>
    <a href="#" class="menu">Setting</a>

</aside>

<!-- KONTEN DASHBOARD -->
<main class="main">

    <div class="topbar">

        <div class="search">
            🔎 Cari layanan, kendaraan, atau informasi
        </div>

        <div class="profile">

            <div class="avatar">👤</div>

            <strong>
                <?php echo htmlspecialchars($nama); ?>
            </strong>

            <!-- TOMBOL LOGOUT -->
            <form action="logout.php" method="POST"
                  onsubmit="return confirm('Apakah kamu yakin ingin logout?');">

                <button type="submit" class="logout-button">
                    Logout
                </button>

            </form>

        </div>

    </div>

    <section class="welcome">

        <h1>
            Good Morning,
            <?php echo htmlspecialchars($nama); ?>! 👋
        </h1>

        <p>
            Semoga hari kamu menyenangkan!
            Yuk, cek layanan kendaraanmu.
        </p>

    </section>

    <section class="cards">

        <div class="card">
            <div class="card-title">Booking Aktif</div>
            <div class="card-number">1</div>
        </div>

        <div class="card">
            <div class="card-title">Service Berikutnya</div>
            <div class="card-number">1</div>
        </div>

        <div class="card">
            <div class="card-title">Riwayat</div>
            <div class="card-number">9</div>
        </div>

    </section>

    <section class="bottom-section">

        <div class="panel">

            <h3>Kendaraan Saya</h3>

            <div class="vehicle">
                <div class="vehicle-icon">🚙</div>

                <div>
                    <strong>Robicon</strong>
                    <p>N 1234 NXX</p>
                </div>
            </div>

            <p><strong>Service Berikutnya:</strong> 12 September 2025</p>
            <p><strong>Status:</strong> Tidak Ada</p>

        </div>

        <div class="panel">

            <h3>Layanan Terdekat</h3>

            <div class="service">🚘 Service kendaraan</div>
            <div class="service">🛢️ Ganti Oli</div>
            <div class="service">🚗 Car Wash</div>
            <div class="service">⚙️ Spare Parts</div>

        </div>

    </section>

</main>
```

</body>
</html>
