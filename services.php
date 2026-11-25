<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: login.php");
    exit;
}

$error = "";
$success = "";

// PROSES TAMBAH DATA
if (isset($_POST['tambah'])) {

    $nama = trim($_POST['nama_layanan']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga = $_POST['harga'];

    if ($nama == "" || $deskripsi == "" || $harga == "") {
        $error = "Semua data wajib diisi!";
    } elseif (!is_numeric($harga) || $harga <= 0) {
        $error = "Harga harus lebih dari 0!";
    } else {

        $query = mysqli_prepare($koneksi,
            "INSERT INTO tb_layanan
            (nama_layanan, deskripsi, harga, created_at)
            VALUES (?, ?, ?, NOW())"
        );

        mysqli_stmt_bind_param(
            $query, "ssd",
            $nama, $deskripsi, $harga
        );

        if (mysqli_stmt_execute($query)) {
            $success = "Layanan berhasil ditambahkan!";
        } else {
            $error = "Gagal menambahkan layanan!";
        }
    }
}

// PROSES EDIT DATA
if (isset($_POST['edit'])) {

    $id = $_POST['id_layanan'];
    $nama = trim($_POST['nama_layanan']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga = $_POST['harga'];

    if ($nama == "" || $deskripsi == "" || $harga == "") {
        $error = "Semua data wajib diisi!";
    } elseif (!is_numeric($harga) || $harga <= 0) {
        $error = "Harga harus lebih dari 0!";
    } else {

        $query = mysqli_prepare($koneksi,
            "UPDATE tb_layanan
            SET nama_layanan = ?, deskripsi = ?, harga = ?
            WHERE id_layanan = ?"
        );

        mysqli_stmt_bind_param(
            $query, "ssdi",
            $nama, $deskripsi, $harga, $id
        );

        if (mysqli_stmt_execute($query)) {
            header("Location: services.php?pesan=edit");
            exit;
        } else {
            $error = "Gagal mengubah layanan!";
        }
    }
}

// PROSES HAPUS DATA
if (isset($_POST['hapus'])) {

    $id = $_POST['id_layanan'];

    $query = mysqli_prepare($koneksi,
        "DELETE FROM tb_layanan WHERE id_layanan = ?"
    );

    mysqli_stmt_bind_param($query, "i", $id);

    if (mysqli_stmt_execute($query)) {
        header("Location: services.php?pesan=hapus");
        exit;
    } else {
        $error = "Gagal menghapus layanan!";
    }
}

// PESAN BERHASIL
if (isset($_GET['pesan'])) {

    if ($_GET['pesan'] == 'edit') {
        $success = "Layanan berhasil diubah!";
    }

    if ($_GET['pesan'] == 'hapus') {
        $success = "Layanan berhasil dihapus!";
    }
}

// AMBIL DATA UNTUK EDIT
$dataEdit = null;

if (isset($_GET['edit'])) {

    $id = $_GET['edit'];

    $queryEdit = mysqli_prepare($koneksi,
        "SELECT * FROM tb_layanan WHERE id_layanan = ?"
    );

    mysqli_stmt_bind_param($queryEdit, "i", $id);
    mysqli_stmt_execute($queryEdit);

    $hasilEdit = mysqli_stmt_get_result($queryEdit);
    $dataEdit = mysqli_fetch_assoc($hasilEdit);
}

// AMBIL SEMUA DATA
$data = mysqli_query($koneksi,
    "SELECT * FROM tb_layanan ORDER BY id_layanan DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Services - Automate</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f6fc;
            margin: 0;
            padding: 30px;
            color: #1f2937;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        h1 {
            color: #0755f5;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px;
            border: 1px solid #ddd;
            border-radius: 7px;
        }

        button, .back, .cetak {
            padding: 11px 17px;
            border: none;
            border-radius: 7px;
            color: white;
            background: #0755f5;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .edit {
            background: #e99b17;
        }

        .delete {
            background: #dc2626;
        }

        .cetak {
            background: #f28c28;
            margin-left: 10px;
        }

        .cetak:hover {
            background: #d97706;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #0755f5;
            color: white;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .form-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 7px;
            }
        }
    </style>

</head>

<body>

<div class="container">

    <h1>Kelola Services Automate</h1>

    <p>Kelola layanan kendaraan Automate di sini.</p>

    <a href="dashboard.php" class="back">
        ← Kembali ke Dashboard
    </a>

    <!-- TOMBOL CETAK PDF -->
    <a href="cetak_services.php"
       target="_blank"
       class="cetak">
        Cetak Laporan PDF
    </a>

    <?php if ($success != "") { ?>
        <p class="success">
            <?= htmlspecialchars($success) ?>
        </p>
    <?php } ?>

    <?php if ($error != "") { ?>
        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php } ?>

    <!-- FORM TAMBAH / EDIT -->

    <div class="form-box">

        <h2>
            <?= $dataEdit ? "Edit Layanan" : "Tambah Layanan Baru" ?>
        </h2>

        <form method="POST">

            <?php if ($dataEdit) { ?>

                <input type="hidden"
                    name="id_layanan"
                    value="<?= $dataEdit['id_layanan'] ?>">

            <?php } ?>

            <label>Nama Layanan</label>

            <input
                type="text"
                name="nama_layanan"
                placeholder="Contoh: Ganti Oli"
                value="<?= htmlspecialchars($dataEdit['nama_layanan'] ?? '') ?>"
                required
            >

            <label>Deskripsi</label>

            <textarea
                name="deskripsi"
                placeholder="Masukkan deskripsi layanan"
                required
            ><?= htmlspecialchars($dataEdit['deskripsi'] ?? '') ?></textarea>

            <label>Harga</label>

            <input
                type="number"
                name="harga"
                placeholder="Masukkan harga"
                min="0.01"
                step="0.01"
                value="<?= htmlspecialchars($dataEdit['harga'] ?? '') ?>"
                required
            >

            <?php if ($dataEdit) { ?>

                <button type="submit" name="edit">
                    Simpan Perubahan
                </button>

                <a href="services.php" class="back">
                    Batal
                </a>

            <?php } else { ?>

                <button type="submit" name="tambah">
                    Tambah Layanan
                </button>

            <?php } ?>

        </form>

    </div>

    <!-- TABEL DATA LAYANAN -->

    <h2>Daftar Layanan</h2>

    <table>

        <tr>
            <th>No</th>
            <th>Nama Layanan</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;

        if (mysqli_num_rows($data) > 0) {

            while ($row = mysqli_fetch_assoc($data)) {
        ?>

        <tr>

            <td><?= $no++ ?></td>

            <td>
                <?= htmlspecialchars($row['nama_layanan']) ?>
            </td>

            <td>
                <?= htmlspecialchars($row['deskripsi']) ?>
            </td>

            <td>
                Rp <?= number_format($row['harga'], 0, ',', '.') ?>
            </td>

            <td>

                <a class="back edit"
                    href="services.php?edit=<?= $row['id_layanan'] ?>">
                    Edit
                </a>

                <form method="POST" style="display:inline;"
                    onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">

                    <input type="hidden"
                        name="id_layanan"
                        value="<?= $row['id_layanan'] ?>">

                    <button type="submit"
                        name="hapus"
                        class="delete">
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

        <?php
            }

        } else {
        ?>

        <tr>
            <td colspan="5" style="text-align:center;">
                Belum ada data layanan.
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>