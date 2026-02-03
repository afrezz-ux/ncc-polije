<?php
session_start();
require_once '../config/database.php';

// CEK LOGIN
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit;
}

// LOGIC HAPUS ARTIKEL
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    
    // Ambil nama file gambar dulu
    $q = mysqli_query($koneksi, "SELECT gambar FROM artikel WHERE id='$id'");
    $data = mysqli_fetch_assoc($q);
    $path = "../assets/img/uploads/" . $data['gambar'];

    // Hapus file fisik di folder
    if (file_exists($path)) { unlink($path); }

    // Hapus data di database
    mysqli_query($koneksi, "DELETE FROM artikel WHERE id='$id'");
    
    echo "<script>alert('Artikel berhasil dihapus!'); window.location='kelola_artikel.php';</script>";
}

// AMBIL DATA
$query = "SELECT * FROM artikel ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Artikel - NCC Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root { --primary-color: #0088cc; --bg-light: #f3f6f9; --sidebar-width: 260px; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-light); color: #1e293b; }

        /* Sidebar Styling */
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
        
        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); padding: 30px 40px; }
        .card-table { background: white; border-radius: 16px; padding: 25px; border: 1px solid #e1e4e8; }
        .thumb-img { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; }
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
        <div>
            <h3 class="fw-bold mb-1">Pustaka Artikel</h3>
            <p class="text-muted">Kelola konten berita dan tips kesehatan.</p>
        </div>
        <a href="tambah_artikel.php" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Tulis Artikel Baru
        </a>
    </div>

    <div class="card-table">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">Cover</th>
                        <th>Judul Artikel</th>
                        <th>Tanggal Terbit</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td class="ps-3">
                            <img src="../assets/img/uploads/<?= $row['gambar']; ?>" class="thumb-img border" alt="img">
                        </td>
                        <td>
                            <div class="fw-bold text-dark"><?= $row['judul']; ?></div>
                            <small class="text-muted"><?= substr(strip_tags($row['isi']), 0, 50); ?>...</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border">
                                <i class="bi bi-calendar-event me-1"></i> <?= $row['tanggal']; ?>
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <a href="kelola_artikel.php?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Hapus artikel ini?')">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    
                    <?php if(mysqli_num_rows($result) == 0): ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada artikel. Silakan buat baru.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>