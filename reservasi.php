<?php
// ==========================================
// 1. LOGIC PHP & DATABASE
// ==========================================
require_once 'config/database.php';

// Safety check koneksi
if (!isset($koneksi)) {
    die("Error Fatal: Variabel koneksi tidak ditemukan di config/database.php");
}

$page = 'reservasi'; // Agar menu header aktif
$pesan_sukses = "";
$pesan_gagal  = "";

// Proses Penyimpanan Data
if (isset($_POST['kirim_reservasi'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $hp       = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $tanggal  = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $keluhan  = mysqli_real_escape_string($koneksi, $_POST['keluhan']);

    $query = "INSERT INTO reservasi (nama_pasien, no_hp, tanggal_konsul, keluhan, status) 
              VALUES ('$nama', '$hp', '$tanggal', '$keluhan', 'Pending')";

    if (mysqli_query($koneksi, $query)) {
        $pesan_sukses = "Jadwal berhasil diajukan! Admin kami akan segera menghubungi Anda via WhatsApp.";
    } else {
        $pesan_gagal = "Gagal mengirim data: " . mysqli_error($koneksi);
    }
}

// ==========================================
// 2. TAMPILAN VISUAL BARU (Modern Overlay)
// ==========================================
include 'layout/header.php'; 
?>

<section class="page-header-premium text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <span class="badge bg-white text-primary fw-bold px-3 py-2 rounded-pill mb-3 shadow-sm">
                    <i class="bi bi-calendar-check me-2"></i>Booking Online
                </span>
                <h1 class="display-5 fw-bold mb-3">Jadwalkan Konsultasi Anda</h1>
                <p class="lead opacity-75">
                    Isi formulir di bawah ini untuk mendapatkan jadwal konsultasi gizi eksklusif bersama ahli kami. Tanpa antri, langsung terkonfirmasi.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="pb-5" style="background-color: #f8fafc;"> <div class="container">
        <div class="row">
            
            <div class="col-lg-8">
                <div class="form-card-floating p-4 p-md-5">
                    
                    <h4 class="fw-bold text-secondary mb-4">
                        <i class="bi bi-file-earmark-medical me-2 text-primary"></i>Data Diri Pasien
                    </h4>

                    <?php if ($pesan_sukses): ?>
                        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div><strong>Berhasil!</strong> <?= $pesan_sukses; ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if ($pesan_gagal): ?>
                        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-x-circle-fill fs-4 me-3"></i>
                            <div><strong>Gagal!</strong> <?= $pesan_gagal; ?></div>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label-premium">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 border text-muted" style="border-radius: 10px 0 0 10px; border-color: #e2e8f0;">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="nama" class="form-control form-control-premium border-start-0 ps-0" style="border-radius: 0 10px 10px 0;" placeholder="Sesuai KTP/KTM" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label-premium">No. WhatsApp Aktif</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 border text-muted" style="border-radius: 10px 0 0 10px; border-color: #e2e8f0;">
                                        <i class="bi bi-whatsapp"></i>
                                    </span>
                                    <input type="number" name="hp" class="form-control form-control-premium border-start-0 ps-0" style="border-radius: 0 10px 10px 0;" placeholder="08xx..." required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label-premium">Rencana Tanggal Konsultasi</label>
                                <input type="date" name="tanggal" class="form-control form-control-premium" required>
                                <div class="form-text ms-1 text-muted"><i class="bi bi-info-circle me-1"></i>Jam operasional: Senin - Jumat (08:00 - 15:00)</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label-premium">Keluhan / Topik Konsultasi</label>
                                <textarea name="keluhan" rows="4" class="form-control form-control-premium" placeholder="Ceritakan tujuan Anda (Contoh: Ingin program diet penurunan berat badan, atau konsultasi gizi olahraga...)" required></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" name="kirim_reservasi" class="btn btn-primary-custom w-100 py-3 fw-bold shadow">
                                    KIRIM PERMINTAAN BOOKING <i class="bi bi-arrow-right-circle ms-2"></i>
                                </button>
                                <p class="text-center text-muted small mt-3">
                                    <i class="bi bi-shield-lock-fill me-1"></i> Data Anda aman dan terenkripsi.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-card shadow-sm" style="margin-top: -80px; z-index: 10; position: relative;">
                    <h5 class="fw-bold mb-3">Butuh Bantuan?</h5>
                    <p class="text-muted small mb-4">Jika Anda bingung memilih jadwal atau jenis layanan, silakan hubungi admin kami.</p>
                    <a href="#" class="btn btn-outline-custom w-100 mb-2"><i class="bi bi-chat-dots me-2"></i> Chat Admin WA</a>
                    <a href="#" class="btn btn-outline-custom w-100"><i class="bi bi-telephone me-2"></i> (0331) 333532</a>
                </div>

                <div class="sidebar-card border-0 bg-soft-blue shadow-sm mt-4" style="background: #e0f2fe;">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-clock-history fs-3 text-primary me-3"></i>
                        <h6 class="fw-bold mb-0 text-primary">Jam Operasional</h6>
                    </div>
                    <ul class="list-unstyled mb-0 text-secondary small">
                        <li class="d-flex justify-content-between mb-2">
                            <span>Senin - Kamis</span>
                            <span class="fw-bold">08:00 - 16:00</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span>Jumat</span>
                            <span class="fw-bold">08:00 - 15:00</span>
                        </li>
                        <li class="d-flex justify-content-between text-danger">
                            <span>Sabtu - Minggu</span>
                            <span class="fw-bold">Tutup</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'layout/footer.php'; ?>