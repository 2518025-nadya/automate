
<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email == "" || $password == "") {

        $error = "Email dan password wajib diisi!";

    } else {

        $query = mysqli_prepare($koneksi,
            "SELECT * FROM tb_pengguna WHERE email = ?"
        );

        mysqli_stmt_bind_param($query, "s", $email);
        mysqli_stmt_execute($query);

        $hasil = mysqli_stmt_get_result($query);

        if (mysqli_num_rows($hasil) == 1) {

            $data = mysqli_fetch_assoc($hasil);

            if (password_verify($password, $data['password'])) {

                session_regenerate_id(true);

                $_SESSION['id_pengguna'] = $data['id_pengguna'];
                $_SESSION['username'] = $data['nama'];
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['role'] = $data['role'];

                header("Location: dashboard.php");
                exit;

            } else {

                $error = "Password yang kamu masukkan salah!";

            }

        } else {

            $error = "Email belum terdaftar!";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Automate</title>

    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="login-container">

        <div class="left">

            <div class="overlay">

                <h4>WELCOME TO AUTOMATE</h4>

                <h1>Your Vehicle<br>In Good Hands</h1>

                <p>
                    Masuk untuk melanjutkan layanan
                    kendaraan terbaik untukmu.
                </p>

                <div class="features">
                    <span>♡ Aman &amp; Terpercaya</span>
                    <span>⚙ Layanan Profesional</span>
                    <span>◷ Tersedia 24/7</span>
                </div>

            </div>

        </div>

        <div class="right">

            <div class="login-box">

                <h2>Login to Automate</h2>

                <p class="welcome">
                    Selamat datang kembali! 👋<br>
                    Masuk untuk melanjutkan layanan.
                </p>

                <?php if (!empty($error)) { ?>
                    <p class="error">
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php } ?>

                <form action="" method="POST">

                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Masukkan email kamu"
                        required
                    >

                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                    <div class="remember">

                        <label class="remember-label">
                            <input type="checkbox" name="remember">
                            Ingat saya
                        </label>

                        <a href="forgot-password.php">
                            Lupa password?
                        </a>

                    </div>

                    <button type="submit" name="login" value="1">
                        Login →
                    </button>

                </form>

                <div class="or">
                    <span>atau</span>
                </div>

                <button type="button" class="google">
                    G &nbsp; Login dengan Google
                </button>

                <p class="register">
                    Belum punya akun?
                    <a href="register.php">Register</a>
                </p>

            </div>

        </div>

    </div>

</body>
</html>
