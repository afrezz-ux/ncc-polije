<?php
// ==========================================
// 1. LOGIC PHP & DATABASE
// ==========================================
require_once 'config/database.php';

// Set halaman aktif untuk Header
$page = 'tanya'; 

$pesan_sukses = "";
$pesan_gagal  = "";

// Proses Penyimpanan Pertanyaan
if (isset($_POST['kirim_pertanyaan'])) {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email  = mysqli_real_escape_string($koneksi, $_POST['email']);
    $tanya  = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
    
    // Insert ke tabel 'tanya_ahli' (Sesuai database Step 1)
    $query = "INSERT INTO tanya_ahli (nama_penanya, email, pertanyaan, status_jawab) 
              VALUES ('$nama', '$email', '$tanya', 'Belum')";

    if (mysqli_query($koneksi, $query)) {
        $pesan_sukses = "Pertanyaan Anda berhasil terkirim! Ahli gizi kami akan menjawab melalui email yang Anda daftarkan.";
    } else {
        $pesan_gagal = "Terjadi kesalahan sistem: " . mysqli_error($koneksi);
    }
}

include 'layout/header.php'; 
?>

<section class="py-5 bg-light border-bottom position-relative overflow-hidden">
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(14, 165, 233, 0.1); border-radius: 50%; filter: blur(60px);"></div>
    
    <div class="container text-center position-relative z-1">
        <span class="badge bg-white text-primary fw-bold px-3 py-2 rounded-pill mb-3 shadow-sm border">
            <i class="bi bi-chat-left-heart-fill me-2"></i>Layanan Q&A
        </span>
        <h1 class="fw-bold text-dark display-5 mb-3">Tanya Ahli Gizi</h1>
        <p class="text-muted lead mx-auto" style="max-width: 700px;">
            Punya pertanyaan singkat seputar diet, nutrisi, atau pola makan? 
            Kirimkan pertanyaan Anda, tim NCC Polije siap membantu menjawabnya secara gratis.
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-start">
            
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white p-4 border-bottom-0">
                        <h4 class="fw-bold mb-0 text-primary">
                            <i class="bi bi-envelope-paper-heart me-2"></i>Formulir Pertanyaan
                        </h4>
                    </div>
                    <div class="card-body p-4 pt-0">
                        
                        <?php if ($pesan_sukses): ?>
                            <div class="alert alert-success d-flex align-items-center rounded-3 shadow-sm" role="alert">
                                <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                                <div><?= $pesan_sukses; ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if ($pesan_gagal): ?>
                            <div class="alert alert-danger d-flex align-items-center rounded-3 shadow-sm" role="alert">
                                <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                                <div><?= $pesan_gagal; ?></div>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary small text-uppercase">Nama Anda</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                                        <input type="text" name="nama" class="form-control bg-light border-start-0 py-2" placeholder="Nama Lengkap" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-secondary small text-uppercase">Email Aktif</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control bg-light border-start-0 py-2" placeholder="nama@email.com" required>
                                    </div>
                                    <div class="form-text ms-1" style="font-size: 11px;">*Jawaban akan dikirim ke email ini.</div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold text-secondary small text-uppercase">Pertanyaan Anda</label>
                                    <textarea name="pertanyaan" rows="5" class="form-control bg-light py-3" placeholder="Tuliskan keluhan atau pertanyaan Anda secara detail di sini..." required></textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" name="kirim_pertanyaan" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm transition-hover">
                                        KIRIM PERTANYAAN <i class="bi bi-send-fill ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                
                <div class="card bg-primary text-white border-0 rounded-4 shadow-sm mb-4 p-4 position-relative overflow-hidden">
                    <div style="position: absolute; right: -20px; top: -20px; font-size: 10rem; opacity: 0.1; transform: rotate(-15deg);">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div class="position-relative z-1">
                        <h4 class="fw-bold mb-3">Butuh Respon Cepat?</h4>
                        <p class="opacity-75 mb-4">Jika kondisi darurat atau butuh jawaban instan, silakan hubungi admin kami via WhatsApp.</p>
                        <a href="https://wa.me/62812345678" target="_blank" class="btn btn-white text-primary fw-bold rounded-pill px-4 shadow-sm">
                            <i class="bi bi-whatsapp me-2"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3 ps-2 border-start border-4 border-primary">Sering Ditanyakan</h5>
                <div class="accordion shadow-sm rounded-3 overflow-hidden" id="accordionFAQ">
                    
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apakah konsultasi ini berbayar?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted small bg-light">
                                Untuk mahasiswa Politeknik Negeri Jember, layanan konsultasi dasar <strong>Gratis</strong>. Untuk umum, dikenakan biaya administrasi sesuai kebijakan klinik.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Berapa lama balasan email diterima?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted small bg-light">
                                Tim ahli gizi kami berusaha membalas pertanyaan masuk dalam waktu <strong>1x24 jam</strong> pada hari kerja (Senin - Jumat).
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apakah privasi data saya aman?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted small bg-light">
                                Tentu saja. Semua data kesehatan dan identitas Anda dijaga kerahasiaannya sesuai standar kode etik medis.
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<style>
    /* Agar Tombol Accordion terlihat bersih saat diklik */
    .accordion-button:not(.collapsed) {
        background-color: #e0f2fe;
        color: var(--primary);
        box-shadow: none;
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
    }
    
    /* Hover Effect Button */
    .transition-hover:hover {
        transform: translateY(-3px);
    }
</style>

<?php include 'layout/footer.php'; ?>