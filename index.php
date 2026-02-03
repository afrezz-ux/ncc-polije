<?php 
$page = 'home'; // Menu header 'Beranda' aktif
include 'layout/header.php'; 
?>

<section class="hero-section d-flex align-items-center position-relative overflow-hidden py-5">
    <div style="position: absolute; top: -100px; right: -100px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, rgba(255,255,255,0) 70%); border-radius: 50%; z-index: -1;"></div>

    <div class="container">
        <div class="row align-items-center flex-column-reverse flex-lg-row">
            
            <div class="col-lg-6 mt-4 mt-lg-0 pe-lg-5">
                <span class="badge bg-light text-primary border px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">
                    <i class="bi bi-hospital-fill me-2"></i>Pusat Layanan Gizi Terpadu
                </span>
                <h1 class="display-4 fw-bold text-dark mb-3" style="line-height: 1.2;">
                    Solusi Kesehatan Anda Dimulai dari <span style="color: var(--primary, #0088cc);">Nutrisi Tepat.</span>
                </h1>
                <p class="lead text-muted mb-4" style="font-size: 1.1rem;">
                    NCC Politeknik Negeri Jember menyediakan layanan konsultasi gizi profesional berbasis ilmiah untuk mendukung gaya hidup sehat mahasiswa dan masyarakat umum.
                </p>
                <div class="d-flex gap-3">
                    <a href="reservasi.php" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow transition-hover">
                        Buat Janji Temu <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="tanya_ahli.php" class="btn btn-outline-secondary rounded-pill px-4 py-3 fw-bold">
                        Tanya Dokter
                    </a>
                </div>
                
                <div class="row mt-5 pt-4 border-top">
                    <div class="col-auto me-4">
                        <h3 class="fw-bold mb-0 text-dark">500+</h3>
                        <small class="text-muted">Pasien Terbantu</small>
                    </div>
                    <div class="col-auto">
                        <h3 class="fw-bold mb-0 text-dark">100%</h3>
                        <small class="text-muted">Ahli Gizi Tersertifikasi</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 position-relative mb-4 mb-lg-0">
                
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 110%; height: 110%; background: radial-gradient(circle, rgba(14, 165, 233, 0.15) 0%, rgba(255,255,255,0) 70%); z-index: 0;"></div>

                <div class="hero-img-wrapper position-relative z-1 p-lg-4">
                    <img src="assets/img/uploads/Gemini_Generated_Image_5ib52x5ib52x5ib5.png" alt="Ahli Gizi NCC" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover; max-height: 550px;"> 
                    </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="card border-0 rounded-5 shadow overflow-hidden bg-white">
            <div class="row g-0 align-items-center">
                <div class="col-lg-5 bg-soft-blue text-center py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%); min-height: 400px; display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; width: 300px; height: 300px; border: 40px solid rgba(255,255,255,0.4); border-radius: 50%; top: -50px; left: -50px;"></div>
                    
                    <div class="position-relative z-1 p-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/3076/3076753.png" width="180" class="mb-4 drop-shadow" alt="Scale Icon">
                        <h3 class="fw-bold text-dark mb-0">BMI Calculator</h3>
                        <p class="text-muted small">Cek Ideal Tubuhmu Sekarang</p>
                    </div>
                </div>

                <div class="col-lg-7 p-4 p-lg-5">
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-2 rounded-pill mb-3">
                        <i class="bi bi-stars me-2"></i>Fitur Baru NCC
                    </span>
                    <h2 class="fw-bold mb-3">Sudahkah Berat Badan Anda Ideal?</h2>
                    <p class="text-muted lead mb-4">
                        Jangan menebak-nebak kondisi kesehatan Anda. Cek status gizi Anda menggunakan standar WHO secara akurat, cepat, dan gratis. Dapatkan rekomendasi ahli langsung setelah pengecekan.
                    </p>
                    
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="cek_gizi.php" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-sm transition-hover">
                            <i class="bi bi-calculator-fill me-2"></i> Cek Status Gizi Saya
                        </a>
                        <div class="d-flex align-items-center text-muted ms-md-2 mt-2 mt-md-0">
                            <i class="bi bi-clock-history me-2"></i> Hanya butuh 30 detik
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container py-lg-4">
        <div class="text-center mb-5 mx-auto" style="max-width: 700px;">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Layanan Unggulan</h6>
            <h2 class="fw-bold mb-3">Solusi Kesehatan Menyeluruh</h2>
            <p class="text-muted">Kami mengintegrasikan teknologi dan keahlian medis untuk memberikan pelayanan terbaik bagi civitas akademika Polije.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card h-100 p-4 border rounded-4 bg-white shadow-sm hover-up">
                    <div class="icon-box mb-4 bg-primary bg-opacity-10 text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Reservasi Instan</h4>
                    <p class="text-muted mb-4">Pilih jadwal konsultasi luring maupun daring dengan sistem booking realtime tanpa perlu antri di lokasi.</p>
                    <a href="reservasi.php" class="text-decoration-none fw-bold link-primary">Booking Sekarang <i class="bi bi-arrow-right small ms-1"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card h-100 p-4 border rounded-4 bg-white shadow-sm hover-up">
                    <div class="icon-box mb-4 bg-warning bg-opacity-10 text-warning rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="bi bi-envelope-heart"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Konsultasi Daring</h4>
                    <p class="text-muted mb-4">Tidak sempat datang ke klinik? Kirim pertanyaan Anda lewat fitur Tanya Ahli dan dapatkan jawaban via email.</p>
                    <a href="tanya_ahli.php" class="text-decoration-none fw-bold text-warning">Mulai Bertanya <i class="bi bi-arrow-right small ms-1"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card h-100 p-4 border rounded-4 bg-white shadow-sm hover-up">
                    <div class="icon-box mb-4 bg-success bg-opacity-10 text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="bi bi-journal-medical"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Edukasi & Artikel</h4>
                    <p class="text-muted mb-4">Akses ratusan artikel kesehatan tervalidasi untuk menunjang gaya hidup sehat dan pola makan seimbang.</p>
                    <a href="artikel.php" class="text-decoration-none fw-bold text-success">Baca Artikel <i class="bi bi-arrow-right small ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary, #0088cc) 0%, #005f8f 100%);">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('assets/img/pattern.png'); opacity: 0.1;"></div>
    
    <div class="container position-relative z-1 text-center text-white py-4">
        <h2 class="fw-bold mb-3">Siap Memulai Perubahan?</h2>
        <p class="lead mb-4 opacity-75 mx-auto" style="max-width: 600px;">
            Jangan tunda kesehatan Anda. Bergabunglah dengan ratusan pasien lain yang telah berhasil memperbaiki kualitas hidup bersama NCC Polije.
        </p>
        <a href="reservasi.php" class="btn btn-light btn-lg rounded-pill fw-bold text-primary px-5 shadow transition-hover">
            Hubungi Kami Sekarang
        </a>
    </div>
</section>

<style>
    .transition-hover { transition: transform 0.3s ease; }
    .transition-hover:hover { transform: translateY(-3px); }
    
    .hover-up { transition: all 0.3s ease; }
    .hover-up:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important; }
    
    /* Bayangan lembut pada icon */
    .drop-shadow { filter: drop-shadow(0 10px 10px rgba(0,0,0,0.1)); }
</style>

<?php include 'layout/footer.php'; ?>