
<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Automate</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f3f6fc;
            color: #1f2937;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 35px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #0755f5;
        }

        .welcome {
            color: #64748b;
            line-height: 1.7;
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 25px;
        }

        .button {
            display: inline-block;
            padding: 13px 20px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            background: #0755f5;
        }

        .logout {
            background: #dc2626;
        }
    </style>

</head>

<body>

<div class="container">

    <h1>Automate Dashboard</h1>

    <p class="welcome">
        Selamat datang kembali,
        <strong>
            <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>
        </strong>!

        <br>

        Selamat datang di layanan kendaraan Automate.
    </p>

    <div class="menu">

        <a class="button" href="WebForm.php">
            Form Pemesanan Produk
        </a>

        <a class="button" href="services.php">
            Kelola Services
        </a>

        <a class="button logout" href="logout.php">
            Logout
        </a>

    </div>

</div>

</body>
</html>
