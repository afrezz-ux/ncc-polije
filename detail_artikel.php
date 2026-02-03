<?php
require_once 'config/database.php';

// Cek ID di URL
if (!isset($_GET['id'])) {
    header("Location: artikel.php"); // Jika tidak ada ID, tendang ke depan
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = "SELECT * FROM artikel WHERE id='$id'";
$result = mysqli_query($koneksi, $query);

// Cek apakah data ketemu?
if (mysqli_num_rows($result) == 0) {
    echo "Artikel tidak ditemukan.";
    exit;
}

$data = mysqli_fetch_assoc($result);
$page = 'artikel'; // Menu header aktif
include 'layout/header.php'; 
?>

<div class="bg-light py-3 border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="artikel.php" class="text-decoration-none">Artikel</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width: 300px;"><?= $data['judul']; ?></li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold mb-3 display-6" style="line-height: 1.3;"><?= $data['judul']; ?></h1>
                <div class="d-flex align-items-center mb-4 text-muted small">
                    <div class="d-flex align-items-center me-4">
                        <i class="bi bi-person-circle fs-5 me-2 text-primary"></i>
                        <span>Admin NCC</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar-check fs-5 me-2 text-primary"></i>
                        <span><?= date('d F Y', strtotime($data['tanggal'])); ?></span>
                    </div>
                </div>

                <div class="rounded-4 overflow-hidden shadow-sm mb-5">
                    <img src="assets/img/uploads/<?= $data['gambar']; ?>" class="w-100" alt="<?= $data['judul']; ?>">
                </div>

                <div class="article-content fs-5" style="line-height: 1.8; color: #334155;">
                    <?= nl2br($data['isi']); ?>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <h6 class="fw-bold mb-3">Bagikan artikel ini:</h6>
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2"><i class="bi bi-whatsapp"></i> WhatsApp</button>
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2"><i class="bi bi-facebook"></i> Facebook</button>
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2"><i class="bi bi-twitter-x"></i> Twitter</button>
                    
                    <div class="mt-4">
                        <a href="artikel.php" class="text-decoration-none fw-bold">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Artikel
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php include 'layout/footer.php'; ?>