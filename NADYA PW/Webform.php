
<?php
session_start();

$produk = '';
$jumlah = '';
$harga = '';

$error = '';
$hasil = null;

// FUNCTION UNTUK MENGHITUNG HARGA
function hitungTotal($jumlah, $harga)
{
    $subtotal = $jumlah * $harga;

    if ($subtotal > 100000) {
        $diskon = $subtotal * 0.10;
    } else {
        $diskon = 0;
    }

    $total = $subtotal - $diskon;

    return [
        'subtotal' => $subtotal,
        'diskon' => $diskon,
        'total' => $total
    ];
}

// PROSES FORM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $produk = trim($_POST['produk'] ?? '');
    $jumlahInput = trim($_POST['jumlah'] ?? '');
    $hargaInput = trim($_POST['harga'] ?? '');

    // VALIDASI FIELD WAJIB
    if ($produk === '' || $jumlahInput === '' || $hargaInput === '') {

        $error = 'Semua field wajib diisi.';

    } elseif (
        !is_numeric($jumlahInput) ||
        !is_numeric($hargaInput)
    ) {

        $error = 'Jumlah dan harga harus berupa angka.';

    } elseif ($jumlahInput <= 0 || $hargaInput <= 0) {

        $error = 'Jumlah dan harga tidak boleh nol atau negatif.';

    } elseif (filter_var($jumlahInput, FILTER_VALIDATE_INT) === false) {

        $error = 'Jumlah produk harus berupa bilangan bulat positif.';

    } else {

        $jumlah = (int) $jumlahInput;
        $harga = (float) $hargaInput;

        // Memanggil function hitungTotal().
        $hasil = hitungTotal($jumlah, $harga);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form Pemesanan Produk - Automate</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px 15px;
            font-family: Arial, sans-serif;
            background: #f3f6fc;
            color: #1f2937;
        }

        .container {
            width: 100%;
            max-width: 700px;
            margin: 25px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #0755f5;
            text-align: center;
        }

        .description {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #0755f5;
        }

        button,
        .back-button {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .primary {
            color: white;
            background: #0755f5;
        }

        .secondary {
            color: #1f2937;
            background: #e2e8f0;
        }

        .error {
            margin-top: 20px;
            padding: 13px;
            border-radius: 8px;
            background: #fef2f2;
            color: #b91c1c;
        }

        .result {
            margin-top: 30px;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #cbd5e1;
            text-align: left;
            overflow-wrap: anywhere;
        }

        th {
            background: #0755f5;
            color: white;
        }

        .total {
            color: #0755f5;
            font-weight: bold;
        }

        .back-button {
            margin-top: 25px;
            background: #e2e8f0;
            color: #1f2937;
        }

        @media (max-width: 480px) {
            .container {
                padding: 18px;
            }

            th,
            td {
                padding: 8px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Form Pemesanan Produk</h1>

    <p class="description">
        Automate — Formulir Pemesanan
    </p>

    <form action="WebForm.php" method="POST">

        <div class="form-group">
            <label for="produk">Nama Produk</label>

            <input
                type="text"
                id="produk"
                name="produk"
                placeholder="Masukkan nama produk"
                value="<?= htmlspecialchars($produk, ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah Produk</label>

            <input
                type="number"
                id="jumlah"
                name="jumlah"
                placeholder="Masukkan jumlah produk"
                min="1"
                step="1"
                value="<?= htmlspecialchars((string) $jumlah, ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="harga">Harga Satuan (Rp)</label>

            <input
                type="number"
                id="harga"
                name="harga"
                placeholder="Masukkan harga produk"
                min="0.01"
                step="any"
                value="<?= htmlspecialchars((string) $harga, ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <button type="submit" class="primary">
            Hitung Total
        </button>

        <button type="reset" class="secondary">
            Hapus
        </button>

    </form>

    <?php if ($error !== ''): ?>

        <div class="error">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>

    <?php endif; ?>

    <?php if ($hasil !== null): ?>

        <div class="result">

            <h2>Hasil Pemesanan</h2>

            <table>
                <tr>
                    <th>Keterangan</th>
                    <th>Hasil</th>
                </tr>

                <tr>
                    <td>Nama Produk</td>
                    <td>
                        <?= htmlspecialchars($produk, ENT_QUOTES, 'UTF-8') ?>
                    </td>
                </tr>

                <tr>
                    <td>Jumlah Produk</td>
                    <td><?= number_format($jumlah, 0, ',', '.') ?></td>
                </tr>

                <tr>
                    <td>Harga Satuan</td>
                    <td>
                        Rp <?= number_format($harga, 0, ',', '.') ?>
                    </td>
                </tr>

                <tr>
                    <td>Subtotal</td>
                    <td>
                        Rp <?= number_format($hasil['subtotal'], 0, ',', '.') ?>
                    </td>
                </tr>

                <tr>
                    <td>Diskon 10%</td>
                    <td>
                        Rp <?= number_format($hasil['diskon'], 0, ',', '.') ?>
                    </td>
                </tr>

                <tr>
                    <td>Total Pembayaran</td>
                    <td class="total">
                        Rp <?= number_format($hasil['total'], 0, ',', '.') ?>
                    </td>
                </tr>
            </table>

        </div>

    <?php endif; ?>

    <a href="dashboard.php" class="back-button">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>
