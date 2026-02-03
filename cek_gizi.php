<?php
require_once 'config/database.php';
$page = 'cek_gizi'; // Nanti kita update header agar menu ini aktif

// --- LOGIC PERHITUNGAN BMI ---
$hasil_bmi = null;
$kategori  = "";
$warna     = ""; // Untuk warna alert (success, warning, danger)
$saran     = "";
$icon_hasil = "";

if (isset($_POST['hitung'])) {
    $gender = $_POST['gender']; // Laki-laki / Perempuan
    $usia   = $_POST['usia'];
    $tb     = $_POST['tb'];
    $bb     = $_POST['bb'];

    // Rumus BMI = Berat (kg) / (Tinggi (m) * Tinggi (m))
    $tb_meter = $tb / 100;
    $bmi      = $bb / ($tb_meter * $tb_meter);
    $hasil_bmi = number_format($bmi, 1);

    // Penentuan Kategori (Standar WHO untuk Asia)
    if ($bmi < 18.5) {
        $kategori = "Kekurangan Berat Badan";
        $warna    = "info"; // Biru
        $saran    = "Anda perlu meningkatkan asupan kalori dan protein. Konsumsi makanan padat energi dan konsultasikan jadwal makan dengan ahli gizi kami.";
        $icon_hasil = "bi-person-dash";
    } elseif ($bmi >= 18.5 && $bmi <= 22.9) {
        $kategori = "Berat Badan Normal";
        $warna    = "success"; // Hijau
        $saran    = "Selamat! Pertahankan pola makan sehat dan rutin berolahraga minimal 30 menit sehari.";
        $icon_hasil = "bi-person-check";
    } elseif ($bmi >= 23 && $bmi <= 24.9) {
        $kategori = "Kelebihan Berat Badan (Overweight)";
        $warna    = "warning"; // Kuning
        $saran    = "Waspada! Mulai kurangi gula dan lemak jenuh. Perbanyak aktivitas fisik untuk membakar kalori ekstra.";
        $icon_hasil = "bi-person-plus";
    } else {
        $kategori = "Obesitas";
        $warna    = "danger"; // Merah
        $saran    = "Risiko kesehatan tinggi. Sangat disarankan untuk segera melakukan reservasi konsultasi dengan ahli gizi NCC untuk program penurunan berat badan.";
        $icon_hasil = "bi-exclamation-octagon";
    }
}

include 'layout/header.php'; 
?>

<style>
    /* Radio Button Gender yang Keren */
    .gender-selector input[type="radio"] { display: none; }
    .gender-selector label {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        transition: 0.3s;
        width: 100%;
        text-align: center;
    }
    .gender-selector label:hover { border-color: var(--primary-color); background: #f0f9ff; }
    
    /* Saat dipilih */
    .gender-selector input[type="radio"]:checked + label {
        border-color: var(--primary-color);
        background-color: #e0f2fe;
        color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(0, 136, 204, 0.2);
    }

    /* BMI Meter Bar */
    .bmi-bar {
        height: 15px;
        border-radius: 50px;
        background: linear-gradient(90deg, #0dcaf0 0%, #198754 35%, #ffc107 70%, #dc3545 100%);
        position: relative;
        margin: 30px 0;
    }
    .bmi-marker {
        position: absolute;
        top: -10px;
        width: 4px;
        height: 35px;
        background: #0f172a;
        border: 2px solid white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }
</style>

<section class="py-5 bg-white border-bottom">
    <div class="container text-center">
        <span class="badge bg-light text-primary border fw-bold px-3 py-2 rounded-pill mb-3">
            <i class="bi bi-calculator me-2"></i>Kalkulator Kesehatan
        </span>
        <h1 class="display-5 fw-bold text-dark">Cek Status Gizi (BMI)</h1>
        <p class="text-muted lead">Ketahui kondisi tubuh ideal Anda dalam hitungan detik.</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center g-5">
            
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white p-4 border-bottom-0">
                        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-sliders me-2 text-primary"></i>Masukkan Data Diri</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <form method="POST" action="#hasil"> <div class="mb-4">
                                <label class="fw-bold mb-2 small text-uppercase text-muted">Jenis Kelamin</label>
                                <div class="row g-3 gender-selector">
                                    <div class="col-6">
                                        <input type="radio" name="gender" id="male" value="L" checked>
                                        <label for="male">
                                            <i class="bi bi-gender-male fs-1 d-block mb-2"></i>
                                            <span class="fw-bold">Pria</span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="gender" id="female" value="P" <?= (isset($_POST['gender']) && $_POST['gender']=='P') ? 'checked' : '' ?>>
                                        <label for="female">
                                            <i class="bi bi-gender-female fs-1 d-block mb-2"></i>
                                            <span class="fw-bold">Wanita</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold mb-2 small text-uppercase text-muted">Usia (Tahun)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-cake2"></i></span>
                                    <input type="number" name="usia" class="form-control form-control-lg bg-light" placeholder="Contoh: 21" value="<?= $_POST['usia'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <label class="fw-bold mb-2 small text-uppercase text-muted">Tinggi (cm)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-rulers"></i></span>
                                        <input type="number" name="tb" class="form-control form-control-lg bg-light" placeholder="170" value="<?= $_POST['tb'] ?? '' ?>" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="fw-bold mb-2 small text-uppercase text-muted">Berat (kg)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="bi bi-speedometer2"></i></span>
                                        <input type="number" name="bb" class="form-control form-control-lg bg-light" placeholder="65" value="<?= $_POST['bb'] ?? '' ?>" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="hitung" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm">
                                HITUNG SEKARANG <i class="bi bi-arrow-right ms-2"></i>
                            </button>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" id="hasil">
                <?php if ($hasil_bmi != null): ?>
                    
                    <div class="card border-0 shadow-lg rounded-4 bg-white h-100">
                        <div class="card-body p-5 text-center d-flex flex-column justify-content-center">
                            
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-<?= $warna ?> bg-opacity-10 p-4 text-<?= $warna ?>">
                                    <i class="bi <?= $icon_hasil ?> display-3"></i>
                                </div>
                            </div>

                            <h5 class="text-muted text-uppercase fw-bold ls-2">Hasil Analisa</h5>
                            <h2 class="display-4 fw-bold text-dark mb-1"><?= $hasil_bmi ?></h2>
                            <span class="badge bg-<?= $warna ?> rounded-pill px-4 py-2 fs-6 mb-4">
                                <?= $kategori ?>
                            </span>

                            <div class="position-relative px-3">
                                <div class="d-flex justify-content-between text-muted small mb-1">
                                    <span>Kurus</span>
                                    <span>Normal</span>
                                    <span>Gemuk</span>
                                    <span>Obesitas</span>
                                </div>
                                <div class="bmi-bar">
                                    <?php 
                                        $posisi = ($bmi / 40) * 100;
                                        if($posisi > 100) $posisi = 100;
                                        if($posisi < 0) $posisi = 0;
                                    ?>
                                    <div class="bmi-marker" style="left: <?= $posisi ?>%;"></div>
                                </div>
                            </div>

                            <div class="bg-light p-4 rounded-3 text-start border-start border-4 border-<?= $warna ?>">
                                <h6 class="fw-bold text-dark mb-2"><i class="bi bi-lightbulb-fill text-warning me-2"></i>Rekomendasi Ahli:</h6>
                                <p class="mb-0 text-secondary"><?= $saran ?></p>
                            </div>

                            <div class="mt-4">
                                <a href="reservasi.php" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
                                    Konsultasi Lanjut <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>

                        </div>
                    </div>

                <?php else: ?>

                    <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white;">
                        <div class="card-body p-5 d-flex flex-column justify-content-center text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/2815/2815428.png" width="120" class="mx-auto mb-4 opacity-75">
                            <h3 class="fw-bold">Mengapa Cek Gizi?</h3>
                            <p class="text-white-50 mb-4">Mengetahui status gizi adalah langkah awal mencegah penyakit degeneratif seperti diabetes dan hipertensi.</p>
                            
                            <ul class="text-start list-unstyled mx-auto text-white-50" style="max-width: 300px;">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Standar WHO Asia Pasifik</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Akurat & Cepat</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Rekomendasi Personal</li>
                            </ul>
                        </div>
                    </div>

                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php include 'layout/footer.php'; ?>