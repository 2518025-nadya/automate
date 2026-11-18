<?php
include 'koneksi.php';

$error = "";

if (isset($_POST['daftar'])) {

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $no_hp = trim($_POST['no_hp']);
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // Validasi data kosong
    if (empty($nama) || empty($email) || empty($no_hp) || empty($password) || empty($konfirmasi)) {

        $error = "Semua data wajib diisi!";

    } elseif ($password != $konfirmasi) {

        $error = "Konfirmasi password tidak cocok!";

    } elseif (strlen($password) < 8) {

        $error = "Password minimal 8 karakter!";

    } else {

        // Periksa email sudah terdaftar atau belum
        $cek = mysqli_prepare($koneksi, 
            "SELECT id_pengguna FROM tb_pengguna WHERE email = ?"
        );

        mysqli_stmt_bind_param($cek, "s", $email);
        mysqli_stmt_execute($cek);

        $hasil = mysqli_stmt_get_result($cek);

        if (mysqli_num_rows($hasil) > 0) {

            $error = "Email sudah terdaftar!";

        } else {

            // Enkripsi password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data ke database
            $role = "pelanggan";

            $query = mysqli_prepare($koneksi,
                "INSERT INTO tb_pengguna 
                (nama, email, password, no_hp, role, created_at)
                VALUES (?, ?, ?, ?, ?, NOW())"
            );

            mysqli_stmt_bind_param(
                $query,
                "sssss",
                $nama,
                $email,
                $password_hash,
                $no_hp,
                $role
            );

            if (mysqli_stmt_execute($query)) {

                echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location='login.php';
                </script>";
                exit;

            } else {

                $error = "Registrasi gagal! Silakan coba lagi.";

            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Automate</title>

    <link rel="stylesheet" href="css/register.css">
</head>

<body>

    <div class="register-container">

        <div class="left">

            <div class="overlay">

                <h4>WELCOME TO AUTOMATE</h4>

                <h1>Mulai Perjalanan<br>Bersama Kami</h1>

                <p>
                    Daftar sekarang untuk menikmati kemudahan
                    layanan kendaraan terbaik.
                </p>

            </div>

        </div>

        <div class="right">

            <div class="register-box">

                <h2>Create Your Account</h2>

                <p class="subtitle">
                    Isi data diri kamu untuk membuat akun Automate.
                </p>

                <?php if (!empty($error)) { ?>
                    <p style="color:red;">
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php } ?>

                <form method="POST" action="">

                    <label>Nama Lengkap</label>

                    <input
                        type="text"
                        name="nama"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan email kamu"
                        required
                    >

                    <label>Nomor Telepon</label>

                    <input
                        type="text"
                        name="no_hp"
                        placeholder="Masukkan nomor telepon"
                        required
                    >

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        minlength="8"
                        required
                    >

                    <label>Konfirmasi Password</label>

                    <input
                        type="password"
                        name="konfirmasi"
                        placeholder="Masukkan kembali password"
                        required
                    >

                    <button type="submit" name="daftar">
                        Daftar &nbsp; →
                    </button>

                </form>

                <p class="login">
                    Sudah punya akun?
                    <a href="login.php">Login</a>
                </p>

            </div>

        </div>

    </div>

</body>
</html>