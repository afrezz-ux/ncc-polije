<?php
session_start();
require_once '../config/database.php';

// 1. CEK KEAMANAN
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit;
}

// 2. LOGIC: TANDAI SUDAH DIJAWAB
if (isset($_GET['aksi']) && $_GET['aksi'] == 'selesai' && isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "UPDATE tanya_ahli SET status_jawab='Dijawab' WHERE id='$id'");
    echo "<script>window.location='pesan_masuk.php';</script>";
}

// 3. LOGIC: HAPUS PESAN
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM tanya_ahli WHERE id='$id'");
    echo "<script>window.location='pesan_masuk.php';</script>";
}

// 4. AMBIL DATA PESAN (Urutkan dari yang terbaru)
$query = "SELECT * FROM tanya_ahli ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Masuk Konsultasi - NCC Admin</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root { --primary-color: #0088cc; --bg-light: #f3f6f9; --sidebar-width: 260px; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-light); color: #1e293b; }

        /* Sidebar Style */
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
        
        /* Email Card Style */
        .email-card {
            background: white; border-radius: 12px; padding: 25px; margin-bottom: 20px;
            border: 1px solid #e1e4e8; transition: 0.2s; position: relative;
        }
        .email-card:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-color: var(--primary-color); }
        .status-badge { position: absolute; top: 25px; right: 25px; }
    </style>
</head>
<body>

<nav class="sidebar">
    <a href="index.php" class="brand-logo"> <i class="bi bi-hospital-fill"></i> NCC ADMIN </a>
    <div class="nav flex-column">
        <a href="index.php" class="nav-link"> <i class="bi bi-grid-1x2-fill"></i> Dashboard </a>
        <a href="kelola_artikel.php" class="nav-link"> <i class="bi bi-journal-richtext"></i> Artikel & Edukasi </a>
        <a href="pesan_masuk.php" class="nav-link active"> <i class="bi bi-envelope-paper-heart"></i> Konsultasi Online </a>
        
        <a href="../index.php" target="_blank" class="nav-link mt-3 pt-3 border-top"> <i class="bi bi-globe"></i> Lihat Website </a>
    </div>
    <a href="logout.php" class="nav-link logout-btn"> <i class="bi bi-box-arrow-right"></i> Keluar Sistem </a>
</nav>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Konsultasi Masuk</h3>
            <p class="text-muted">Kelola pertanyaan pasien yang masuk via website.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            
            <?php while($row = mysqli_fetch_assoc($result)) : ?>
                <div class="email-card">
                    <div class="status-badge">
                        <?php if($row['status_jawab'] == 'Belum'): ?>
                            <span class="badge bg-warning text-dark border border-warning rounded-pill px-3 py-2"><i class="bi bi-exclamation-circle me-1"></i>Belum Dijawab</span>
                        <?php else: ?>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-2"><i class="bi bi-check-circle-fill me-1"></i>Selesai</span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <?= substr($row['nama_penanya'], 0, 1); ?>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark"><?= $row['nama_penanya']; ?></h5>
                            <div class="text-muted small">
                                <i class="bi bi-envelope me-1"></i> <?= $row['email']; ?> &nbsp;&bull;&nbsp; 
                                <i class="bi bi-clock me-1"></i> <?= $row['tanggal_tanya']; ?>
                            </div>
                        </div>
                    </div>

                    <div class="bg-light p-4 rounded-3 mb-4 border" style="color: #475569; font-size: 1rem; line-height: 1.6;">
                        <i class="bi bi-chat-quote-fill text-primary opacity-25 fs-1 d-block mb-2"></i>
                        <?= nl2br($row['pertanyaan']); ?>
                    </div>

                    <div class="d-flex flex-wrap gap-2 pt-2 border-top">
                        <a href="mailto:<?= $row['email']; ?>?subject=Jawaban Konsultasi NCC Polije&body=Yth. Sdr/i <?= $row['nama_penanya']; ?>,%0D%0A%0D%0AMenjawab pertanyaan Anda mengenai...%0D%0A%0D%0A---%0D%0ATerima Kasih,%0D%0ATim Ahli Gizi NCC Politeknik Negeri Jember" 
                           class="btn btn-primary btn-sm rounded-pill px-4 fw-bold shadow-sm" target="_blank">
                            <i class="bi bi-reply-fill me-2"></i> Balas via Email
                        </a>

                        <?php if($row['status_jawab'] == 'Belum'): ?>
                            <a href="pesan_masuk.php?aksi=selesai&id=<?= $row['id']; ?>" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-bold" onclick="return confirm('Sudah membalas email pasien? Tandai selesai?')">
                                <i class="bi bi-check2-all me-2"></i> Tandai Sudah Dijawab
                            </a>
                        <?php endif; ?>

                        <a href="pesan_masuk.php?aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-light text-danger btn-sm rounded-circle ms-auto border" onclick="return confirm('Hapus pesan ini permanen?')" title="Hapus Pesan">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>

            <?php if(mysqli_num_rows($result) == 0): ?>
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" width="100" class="mb-3 opacity-25">
                    <h5 class="text-muted">Kotak masuk kosong.</h5>
                    <p class="text-muted small">Belum ada pertanyaan baru dari pasien.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>

</body>
</html>