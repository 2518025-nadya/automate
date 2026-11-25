<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/koneksi.php';

// Mengambil data layanan
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_layanan ORDER BY id_layanan DESC"
);

if (!$query) {
    die("Gagal mengambil data: " . mysqli_error($koneksi));
}

// Pengaturan Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

// Tampilan laporan PDF
$html = '
<style>
    body {
        font-family: Arial, sans-serif;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    p {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th {
        background-color: #f28c28;
        color: white;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }
</style>

<h2>LAPORAN DATA LAYANAN</h2>
<p>AUTOMATE - Layanan Kendaraan</p>

<table>
<tr>
    <th>ID</th>
    <th>Nama Layanan</th>
    <th>Deskripsi</th>
    <th>Harga</th>
</tr>';

// Memasukkan data ke tabel
while ($data = mysqli_fetch_assoc($query)) {

    $html .= '
    <tr>
        <td>' . htmlspecialchars($data['id_layanan']) . '</td>
        <td>' . htmlspecialchars($data['nama_layanan']) . '</td>
        <td>' . htmlspecialchars($data['deskripsi']) . '</td>
        <td>Rp ' . number_format($data['harga'], 0, ',', '.') . '</td>
    </tr>';
}

$html .= '
</table>';

// Membuat PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Menampilkan PDF di browser
$dompdf->stream('laporan_services.pdf', [
    'Attachment' => false
]);

?>