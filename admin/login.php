<?php
session_start();
include '../config/database.php'; // Mundur satu folder untuk ambil config

// LOGIC LOGIN
$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    // Ubah password jadi MD5 (Sesuai database di Step 1)
    $password_md5 = md5($password);

    // Cek ke tabel admin
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password_md5'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // Simpan sesi login
        $_SESSION['status'] = "login";
        $_SESSION['admin_id'] = $data['id'];
        $_SESSION['nama_admin'] = $data['nama_lengkap'];
        
        // Lempar ke dashboard
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staff - NCC Polije</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #0088cc 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: white;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }
        .brand-logo {
            width: 60px;
            height: 60px;
            background: #0088cc;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 20px;
        }
        .form-control {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 12px;
            border-radius: 10px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0088cc;
        }
        .btn-login {
            background: #0088cc;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
        }
        .btn-login:hover {
            background: #005f8f;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-logo shadow">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>
        <h4 class="text-center fw-bold mb-1">NCC Admin Portal</h4>
        <p class="text-center text-muted mb-4 small">Silakan login untuk mengelola data</p>

        <?php if($error): ?>
            <div class="alert alert-danger text-center p-2 small mb-3">
                <i class="bi bi-exclamation-circle me-1"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">USERNAME</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control border-start-0" placeholder="Masukkan username" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">PASSWORD</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control border-start-0" placeholder="Masukkan password" required>
                </div>
            </div>
            
            <button type="submit" name="login" class="btn btn-primary btn-login shadow">
                MASUK DASHBOARD <i class="bi bi-box-arrow-in-right ms-1"></i>
            </button>
        </form>
        
        <div class="text-center mt-4">
            <a href="../index.php" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Website Utama
            </a>
        </div>
    </div>

</body>
</html>