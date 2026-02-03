<?php
session_start();
require_once '../config/database.php';

// CEK LOGIN
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit;
}

// LOGIC TOMBOL AKSI
$msg_type = ""; $msg_content = "";
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $aksi = $_GET['aksi'];

    if ($aksi == 'terima') {
        mysqli_query($koneksi, "UPDATE reservasi SET status='Disetujui' WHERE id='$id'");
        $msg_type = "success"; $msg_content = "Status pasien berhasil disetujui.";
    } elseif ($aksi == 'tolak') {
        mysqli_query($koneksi, "UPDATE reservasi SET status='Ditolak' WHERE id='$id'");
        $msg_type = "danger"; $msg_content = "Permintaan pasien ditolak.";
    } elseif ($aksi == 'hapus') {
        mysqli_query($koneksi, "DELETE FROM reservasi WHERE id='$id'");
        $msg_type = "warning"; $msg_content = "Data reservasi dihapus permanen.";
    }
}

// STATISTIK
$total_pasien = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM reservasi"));
$pending      = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM reservasi WHERE status='Pending'"));
$approved     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM reservasi WHERE status='Disetujui'"));

// DATA TABEL
$query = "SELECT * FROM reservasi ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dokter - NCC Polije</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
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
        .stat-card { background: white; border-radius: 16px; padding: 25px; border: 1px solid #e1e4e8; transition: 0.2s; }
        .stat-card:hover { transform: translateY(-3px); border-color: var(--primary-color); }
        .table-container { background: white; border-radius: 16px; padding: 25px; border: 1px solid #e1e4e8; margin-top: 30px; }
        
        /* Modal Styling */
        .cursor-pointer { cursor: pointer; }
        .cursor-pointer:hover { text-decoration: underline; color: var(--primary-color); }
    </style>
</head>
<body>

<nav class="sidebar">
    <a href="index.php" class="brand-logo"> <i class="bi bi-hospital-fill"></i> NCC ADMIN </a>
    <div class="nav flex-column">
        <a href="index.php" class="nav-link active"> <i class="bi bi-grid-1x2-fill"></i> Dashboard </a>
        <a href="kelola_artikel.php" class="nav-link"> <i class="bi bi-journal-richtext"></i> Artikel & Edukasi </a>
        <a href="pesan_masuk.php" class="nav-link"> <i class="bi bi-envelope-paper-heart"></i> Konsultasi Online </a>
        
        <a href="../index.php" target="_blank" class="nav-link mt-3 pt-3 border-top"> <i class="bi bi-globe"></i> Lihat Website </a>
    </div>
    <a href="logout.php" class="nav-link logout-btn"> <i class="bi bi-box-arrow-right"></i> Keluar Sistem </a>
</nav>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Selamat Datang, Dokter! 👋</h3>
            <p class="text-muted">Ringkasan pasien konsultasi gizi hari ini.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="text-muted small fw-bold text-uppercase mb-2">Total Pasien</div>
                <h2 class="fw-bold mb-0"><?= $total_pasien; ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card border-warning">
                <div class="text-muted small fw-bold text-uppercase mb-2">Perlu Konfirmasi</div>
                <h2 class="fw-bold mb-0 text-warning"><?= $pending; ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card border-success">
                <div class="text-muted small fw-bold text-uppercase mb-2">Disetujui</div>
                <h2 class="fw-bold mb-0 text-success"><?= $approved; ?></h2>
            </div>
        </div>
    </div>

    <div class="table-container">
        <?php if($msg_content != ""): ?>
            <div class="alert alert-<?= $msg_type ?> border-0 shadow-sm d-flex align-items-center mb-4">
                <i class="bi bi-info-circle-fill me-2"></i> <?= $msg_content ?>
            </div>
        <?php endif; ?>

        <h5 class="fw-bold mb-4">Daftar Permintaan Konsultasi</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th><th>Pasien</th><th>Kontak</th><th>Tgl Konsul</th><th>Keluhan (Klik Baca)</th><th>Status</th><th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td>#<?= $row['id']; ?></td>
                        <td class="fw-bold"><?= $row['nama_pasien']; ?></td>
                        <td>
                            <a href="https://wa.me/62<?= substr($row['no_hp'], 1); ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill">
                                <i class="bi bi-whatsapp"></i> Chat
                            </a>
                        </td>
                        <td><?= date('d M Y', strtotime($row['tanggal_konsul'])); ?></td>
                        
                        <td class="text-truncate" style="max-width: 200px;">
                            <span class="cursor-pointer text-primary fw-medium" 
                                  onclick="bukaModal('<?= $row['nama_pasien']; ?>', '<?= addslashes(nl2br($row['keluhan'])); ?>')">
                                <i class="bi bi-eye me-1"></i> Baca Keluhan
                            </span>
                        </td>

                        <td>
                            <?php 
                                if($row['status'] == 'Pending') echo '<span class="badge bg-warning text-dark rounded-pill">Pending</span>';
                                elseif($row['status'] == 'Disetujui') echo '<span class="badge bg-success rounded-pill">Disetujui</span>';
                                else echo '<span class="badge bg-danger rounded-pill">Ditolak</span>';
                            ?>
                        </td>
                        <td class="text-end">
                            <?php if($row['status'] == 'Pending'): ?>
                                <a href="index.php?aksi=terima&id=<?= $row['id']; ?>" class="btn btn-sm btn-primary rounded-3" title="Terima"><i class="bi bi-check-lg"></i></a>
                                <a href="index.php?aksi=tolak&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger rounded-3" title="Tolak"><i class="bi bi-x-lg"></i></a>
                            <?php else: ?>
                                <a href="index.php?aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-light text-muted" onclick="return confirm('Hapus permanen?')"><i class="bi bi-trash"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<div class="modal fade" id="modalKeluhan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold" id="modalTitle">Detail Keluhan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-2 pb-4">
        <div class="p-3 bg-light rounded-3 mt-3">
            <i class="bi bi-chat-quote-fill text-primary opacity-25 fs-1 d-block mb-2"></i>
            <p id="modalBody" class="mb-0 text-secondary" style="line-height: 1.6;"></p>
        </div>
      </div>
      <div class="modal-footer border-top-0 pt-0">
        <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function bukaModal(nama, keluhan) {
        // Isi data ke dalam modal
        document.getElementById('modalTitle').innerText = "Keluhan: " + nama;
        document.getElementById('modalBody').innerHTML = keluhan;
        
        // Tampilkan Modal
        var myModal = new bootstrap.Modal(document.getElementById('modalKeluhan'));
        myModal.show();
    }
</script>

</body>
</html>