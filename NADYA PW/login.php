<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email === "" || trim($password) === "") {
        $error = "Email dan password wajib diisi!";
    } else {
        session_regenerate_id(true);
        $_SESSION["nama"] = $email;

        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Automate</title>

```
<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        color: #172033;
        background: white;
        border-top: 5px solid #66c9c9;
    }

    .login-box {
        width: 90%;
        max-width: 520px;
        margin: 35px auto;
    }

    h1 {
        margin: 0 0 14px;
        font-size: 36px;
    }

    .subtitle {
        margin-bottom: 30px;
        color: #64748b;
        line-height: 1.7;
    }

    .form-group {
        margin-bottom: 22px;
    }

    label {
        display: block;
        margin-bottom: 9px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 16px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 16px;
    }

    .options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .remember label {
        margin: 0;
    }

    a {
        color: #2864ed;
        text-decoration: none;
    }

    .login-button {
        width: 100%;
        padding: 16px;
        border: none;
        border-radius: 10px;
        background: #2864ed;
        color: white;
        font-size: 17px;
        font-weight: bold;
        cursor: pointer;
    }

    .login-button:hover {
        background: #1d4ed8;
    }

    .error {
        padding: 12px;
        margin-bottom: 20px;
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 8px;
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 25px 0;
        color: #64748b;
    }

    .divider::before,
    .divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #d1d5db;
    }

    .google-button {
        width: 100%;
        padding: 14px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        background: white;
        font-size: 15px;
        cursor: pointer;
    }

    .register {
        margin-top: 25px;
        text-align: center;
        color: #64748b;
    }

    @media (max-width: 480px) {
        h1 {
            font-size: 30px;
        }
    }
</style>
</head>

</head>

<body>

<main class="login-box">


<main class="login-box">

    <h1>Login to Automate</h1>

    <p class="subtitle">
        Selamat datang kembali! 👋<br>
        Masuk untuk melanjutkan layanan.
    </p>

    <?php if ($error !== ""): ?>
        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- FORM LOGIN HANYA SATU -->
    <form action="login.php" method="POST">

        <div class="form-group">
            <label for="email">Email atau Nomor Telepon</label>
            <input
                type="text"
                id="email"
                name="email"
                placeholder="Masukkan email atau nomor telepon"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >
        </div>

        <div class="options">
            <div class="remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <a href="#"
               onclick="alert('Silakan hubungi admin untuk bantuan password.'); return false;">
                Lupa password?
            </a>
        </div>

        <button type="submit" name="login" class="login-button">
            Login →
        </button>

    </form>

    <div class="divider">atau</div>

    <button
        type="button"
        class="google-button"
        onclick="alert('Fitur login Google belum diaktifkan.');"
    >
        🌐 Login dengan Google
    </button>

    <p class="register">
        Belum punya akun?
        <a href="register.php">Register</a>
    </p>

</main>
```

</body>
</html>
