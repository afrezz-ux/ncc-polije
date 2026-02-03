<?php
session_start();
require_once '../config/database.php';

// 1. CEK LOGIN
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit;
}

// 2. LOGIC SIMPAN ARTIKEL
$error = "";
if (isset($_POST['upload'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi   = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $tgl   = date('Y-m-d');
    
    // Proses Upload Gambar
    $foto_nama = $_FILES['gambar']['name'];
    $foto_tmp  = $_FILES['gambar']['tmp_name'];
    $foto_size = $_FILES['gambar']['size'];
    
    // Cek apakah ada file?
    if($foto_nama != "") {
        // Cek Ukuran (Max 2MB)
        if($foto_size > 2097152) {
            $error = "Ukuran gambar terlalu besar! Maksimal 2MB.";
        } else {
            // Rename agar unik
            $foto_baru = rand() . '_' . str_replace(' ', '-', $foto_nama); 
            $folder    = "../assets/img/uploads/";

            // Upload Fisik
            if(move_uploaded_file($foto_tmp, $folder . $foto_baru)) {
                // Simpan ke Database
                $query = "INSERT INTO artikel (judul, isi, gambar, tanggal) VALUES ('$judul', '$isi', '$foto_baru', '$tgl')";
                
                if(mysqli_query($koneksi, $query)) {
                    echo "<script>alert('Artikel berhasil diterbitkan!'); window.location='kelola_artikel.php';</script>";
                } else {
                    $error = "Gagal Database: " . mysqli_error($koneksi);
                }
            } else {
                $error = "Gagal upload gambar. Pastikan folder assets/img/uploads/ ada.";
            }
        }
    } else {
        $error = "Harap pilih gambar sampul artikel.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tulis Artikel Baru - NCC Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* STYLE YANG SAMA DENGAN HALAMAN LAIN (KONSISTEN) */
        :root { --primary-color: #0088cc; --bg-light: #f3f6f9; --sidebar-width: 260px; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-light); color: #1e293b; }
        
        .sidebar {
            width: var(--sidebar-width); height: 100vh; background: #fff; position: fixed; top: 0; left: 0;
            border-right: 1px solid #e1e4e8; padding: 25px; display: flex; flex-direction: column; z-index: 999;
        }
        .brand-logo {
            font-size: 1.25rem; font-weight: 800; color: var(--primary-color);
            display: flex; align-items: center; gap: 10px; margin-bottom: 40px; text-decoration: none;
        }
        .nav-link {
            color: #64748b; font-weight: 600; padding: 12px 15px; margin-bottom: 8px; border-radius: 10px;
            transition: 0.3s; display: flex; align-items: center; gap: 12px;
        }
        .nav-link:hover, .nav-link.active { background-color: #e0f2fe; color: var(--primary-color); }
        .logout-btn { margin-top: auto; color: #ef4444; background: #fef2f2; }
        
        .main-content { margin-left: var(--sidebar-width); padding: 30px 40px; }
        
        /* Form Style Specific */
        .form-card { background: white; border-radius: 16px; padding: 40px; border: 1px solid #e1e4e8; }
        .form-control { padding: 12px; border-radius: 10px; border: 1px solid #cbd5e1; }
        .form-control:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(0,136,204,0.1); }
        
        /* Custom Upload Button Visual */
        input[type="file"]::file-selector-button {
            background-color: #f1f5f9; border: none; padding: 8px 15px; border-radius: 6px;
            color: #475569; font-weight: 600; margin-right: 15px; cursor: pointer;
        }
    </style>
</head>
<body>

<nav class="sidebar">
    <a href="index.php" class="brand-logo"> <i class="bi bi-hospital-fill"></i> NCC ADMIN </a>
    <div class="nav flex-column">
        <a href="index.php" class="nav-link"> <i class="bi bi-grid-1x2-fill"></i> Dashboard </a>
        <a href="kelola_artikel.php" class="nav-link active"> <i class="bi bi-journal-richtext"></i> Artikel & Edukasi </a>
        <a href="pesan_masuk.php" class="nav-link"> <i class="bi bi-envelope-paper-heart"></i> Konsultasi Online </a>
        
        <a href="../index.php" target="_blank" class="nav-link mt-3 pt-3 border-top"> <i class="bi bi-globe"></i> Lihat Website </a>
    </div>
    <a href="logout.php" class="nav-link logout-btn"> <i class="bi bi-box-arrow-right"></i> Keluar Sistem </a>
</nav>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Editor Artikel</h3>
        <a href="kelola_artikel.php" class="btn btn-light text-muted fw-bold rounded-pill border shadow-sm">
            <i class="bi bi-arrow-left me-2"></i> Batal
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-card shadow-sm">
                
                <?php if($error): ?>
                    <div class="alert alert-danger d-flex align-items-center mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div><?= $error ?></div>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-secondary">Judul Artikel</label>
                        <input type="text" name="judul" class="form-control fs-5 fw-bold text-dark" placeholder="Contoh: Tips Menjaga Pola Makan Saat Puasa..." required>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-secondary">Upload Gambar Sampul</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                        <div class="form-text ms-1"><i class="bi bi-info-circle me-1"></i> Format: JPG/PNG. Maksimal 2 MB.</div>
                    </div>

                    <div class="mb-5">
                        <label class="fw-bold mb-2 text-secondary">Isi Konten</label>
                        <textarea name="isi" rows="12" class="form-control" placeholder="Tulis artikel edukasi di sini..." style="line-height: 1.6;" required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="upload" class="btn btn-primary py-3 fw-bold rounded-3 shadow hover-effect">
                            <i class="bi bi-send-fill me-2"></i> Terbitkan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

</body>
</html>