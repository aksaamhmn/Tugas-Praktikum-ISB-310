<?php
session_start();

// 1. PROTEKSI HALAMAN
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

$error = false;

// 2. LOGIKA REMEMBER ME
$saved_username = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : '';

// 3. LOGIKA PROSES LOGIN
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === "admin" && $password === "dapur123") {

        // A. Set Session untuk menandakan user berhasil login
        $_SESSION["login"] = true;
        $_SESSION["username"] = $username;

        // B. Set Cookies jika checkbox "Remember Me" dicentang
        if (isset($_POST["remember"])) {
            // Buat cookie bernama 'remember_username' yang berlaku selama 30 hari
            setcookie('remember_username', $username, time() + (86400 * 30), "/");
        } else {
            // Jika tidak dicentang, pastikan cookie dihapus (set waktu ke masa lalu)
            setcookie('remember_username', '', time() - 3600, "/");
        }

        // C. Redirect ke halaman utama setelah sukses
        header("Location: index.php");
        exit;
    } else {
        $error = true;
    }
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dapur Takjil</title>
    <link rel="icon" type="image/jpeg" href="assets/favicon.jpeg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body class="d-flex align-items-center min-vh-100 hero-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow border-success border-opacity-25 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <i class="bi bi-shop display-4 text-success"></i>
                            <h2 class="fw-bold mt-2 text-success">Dapur Takjil</h2>
                            <p class="text-muted small">Silakan masuk untuk mengelola sistem</p>
                        </div>

                        <?php if ($error) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Username atau password salah!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label fw-bold text-secondary">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" value="<?= htmlspecialchars($saved_username) ?>" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold text-secondary">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                </div>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input border-success" id="remember" name="remember" <?= $saved_username ? 'checked' : '' ?>>
                                <label class="form-check-label text-muted" for="remember">Remember Me</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-success btn-lg rounded-pill shadow-sm">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>