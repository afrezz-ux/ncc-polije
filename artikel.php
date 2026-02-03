<?php
require_once 'config/database.php';
$page = 'artikel'; // Agar menu header aktif

// Logic Pencarian (Opsional: Jika nanti mau tambah fitur search)
$query = "SELECT * FROM artikel ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);

include 'layout/header.php'; 
?>

<section class="py-5 bg-light border-bottom">
    <div class="container text-center">
        <span class="badge bg-white text-primary fw-bold px-3 py-2 rounded-pill mb-3 shadow-sm border">
            <i class="bi bi-journal-medical me-2"></i>Edukasi Kesehatan
        </span>
        <h1 class="fw-bold text-dark display-5">Artikel & Tips Gizi</h1>
        <p class="text-muted lead">Temukan informasi kesehatan terpercaya dari ahli gizi NCC Polije.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        
        <div class="row g-4">
            <?php 
            // Loop Data dari Database
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    // Potong isi artikel biar tidak kepanjangan di depan (Limit 100 huruf)
                    $kutipan = substr(strip_tags($row['isi']), 0, 100) . '...';
                    $tanggal = date('d M Y', strtotime($row['tanggal']));
            ?>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover-effect">
                    <div style="height: 200px; overflow: hidden;">
                        <img src="assets/img/uploads/<?= $row['gambar']; ?>" class="w-100 h-100 object-fit-cover" alt="<?= $row['judul']; ?>">
                    </div>
                    
                    <div class="card-body p-4 d-flex flex-column">
                        <small class="text-primary fw-bold mb-2 text-uppercase" style="font-size: 0.75rem;">
                            <i class="bi bi-calendar-event me-1"></i> <?= $tanggal; ?>
                        </small>
                        <h5 class="card-title fw-bold mb-3">
                            <a href="detail_artikel.php?id=<?= $row['id']; ?>" class="text-decoration-none text-dark stretched-link">
                                <?= $row['judul']; ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted small flex-grow-1">
                            <?= $kutipan; ?>
                        </p>
                        <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                            <span class="small text-muted">Oleh: Admin NCC</span>
                            <span class="text-primary fw-bold small">Baca Selengkapnya &rarr;</span>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                } // End While
            } else { 
            ?>
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="100" class="mb-3 opacity-50">
                    <h5 class="text-muted">Belum ada artikel yang diterbitkan.</h5>
                </div>
            <?php } ?>
        </div>

    </div>
</section>

<style>
    .object-fit-cover { object-fit: cover; }
    .card-hover-effect { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .card-hover-effect:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>

<?php include 'layout/footer.php'; ?>