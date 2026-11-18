
<?php
session_start();
include 'koneksi.php';

// Cek apakah sudah login
if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Automate</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            max-width: 900px;
            margin: auto;
        }

        h1 {
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #222;
            color: white;
        }

        .logout {
            display: inline-block;
            background: #e53935;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Admin Dashboard</h1>

    <p>Selamat datang di halaman Admin Automate!</p>

    <h2>Informasi Admin</h2>

    <p>Nama: <?php echo htmlspecialchars($_SESSION['nama']); ?></p>

    <a href="logout.php" class="logout">Logout</a>

</div>

</body>
</html>
