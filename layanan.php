<?php
require_once 'config/database.php';

// 1. LOGIC DINAMIS: Cek URL (jenis apa yang diminta?)
if (isset($_GET['jenis'])) {
    $jenis = $_GET['jenis'];
} else {
    header("Location: index.php"); // Jika tidak ada jenis, tendang ke home
    exit;
}

// 2. DATABASE KONTEN (Array PHP)
// Kita simpan datanya di sini agar mudah diedit tanpa database ribet
$data_layanan = [
    'diet' => [
        'judul' => 'Konsultasi Diet Personal',
        'subjudul' => 'Program penurunan atau penambahan berat badan yang dirancang khusus untuk metabolisme Anda.',
        'icon' => 'bi-clipboard-pulse',
        'gambar' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&q=80&w=800', // Foto Makanan Sehat
        'deskripsi' => 'Bingung mengatur menu makan? Layanan Konsultasi Diet kami membantu Anda menyusun rencana makan (meal plan) yang sesuai dengan kebutuhan kalori, aktivitas harian, dan preferensi rasa Anda. Tidak ada diet menyiksa, yang ada hanyalah pola makan seimbang.',
        'poin' => [
            'Analisa kebiasaan makan harian',
            'Perhitungan kebutuhan kalori (BMR/TDEE)',
            'Penyusunan menu mingguan',
            'Monitoring via WhatsApp'
        ],
        'cta_text' => 'Buat Janji Konsultasi',
        'cta_link' => 'reservasi.php'
    ],
    'katering' => [
        'judul' => 'Katering Sehat NCC',
        'subjudul' => 'Makanan lezat, rendah kalori, dan bergizi tinggi diantar langsung ke kos/rumah Anda.',
        'icon' => 'bi-box-seam', // Ikon Box
        'gambar' => 'https://images.unsplash.com/photo-1543339308-43e59d6b73a6?auto=format&fit=crop&q=80&w=800', // Foto Katering
        'deskripsi' => 'Sibuk kuliah atau kerja sampai lupa makan sehat? NCC Healthy Catering hadir sebagai solusi. Dimasak oleh chef berpengalaman di bawah pengawasan ahli gizi, kami menjamin setiap suapan bernutrisi, higienis, dan tentu saja enak.',
        'poin' => [
            'Bebas MSG & Pengawet',
            'Takar saji sesuai kebutuhan kalori',
            'Menu variatif (Nusantara & Western)',
            'Gratis ongkir area Kampus Polije'
        ],
        'cta_text' => 'Pesan via WhatsApp',
        'cta_link' => 'https://wa.me/62812345678?text=Halo%20Admin%20NCC,%20saya%20tertarik%20info%20Katering%20Sehat'
    ],
    'diabetes' => [
        'judul' => 'Edukasi & Diet Diabetes',
        'subjudul' => 'Kendalikan gula darah Anda dengan manajemen nutrisi yang tepat dan terpantau.',
        'icon' => 'bi-heart-pulse',
        'gambar' => 'https://images.unsplash.com/photo-1579684385180-1ea55f9f6725?auto=format&fit=crop&q=80&w=800', // Foto Medis
        'deskripsi' => 'Diabetes bukan akhir segalanya. Dengan pengaturan pola makan yang tepat, Anda bisa hidup sehat dan aktif. Program ini fokus pada edukasi indeks glikemik, pemilihan karbohidrat kompleks, dan jadwal makan untuk menjaga kestabilan gula darah.',
        'poin' => [
            'Edukasi Indeks Glikemik Pangan',
            'Perencanaan makan 3J (Jadwal, Jumlah, Jenis)',
            'Pencegahan komplikasi diabetes',
            'Pendampingan perubahan gaya hidup'
        ],
        'cta_text' => 'Konsultasi Program Diabetes',
        'cta_link' => 'reservasi.php'
    ]
];

// Cek apakah jenis yang diminta ada di data kita?
if (!array_key_exists($jenis, $data_layanan)) {
    header("Location: index.php"); // Jika user ngetik ngawur, tendang ke home
    exit;
}

// Ambil data sesuai jenis
$konten = $data_layanan[$jenis];
$page = 'layanan'; // Untuk header active state
include 'layout/header.php'; 
?>

<style>
    .service-hero {
        background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), url('<?= $konten['gambar'] ?>');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        color: white;
    }
    .check-list li {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
    }
    .check-list i {
        color: var(--primary-color, #0088cc);
        font-size: 1.2rem;
        margin-right: 10px;
        background: #e0f2fe;
        border-radius: 50%;
        padding: 5px;
    }
</style>

<section class="service-hero text-center">
    <div class="container">
        <div class="d-inline-block p-3 rounded-circle bg-white text-primary mb-3 shadow">
            <i class="bi <?= $konten['icon'] ?> fs-2"></i>
        </div>
        <h1 class="display-4 fw-bold mb-3 animate-up"><?= $konten['judul'] ?></h1>
        <p class="lead opacity-75 mx-auto animate-up" style="max-width: 700px;">
            <?= $konten['subjudul'] ?>
        </p>
    </div>
</section>

<section class="py-5">
    <div class="container py-lg-4">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6">
                <h6 class="text-primary fw-bold text-uppercase ls-2 mb-3">Detail Layanan</h6>
                <h2 class="fw-bold mb-4 text-dark">Apa yang akan Anda dapatkan?</h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    <?= $konten['deskripsi'] ?>
                </p>

                <ul class="list-unstyled check-list mb-5">
                    <?php foreach($konten['poin'] as $poin): ?>
                        <li><i class="bi bi-check-lg"></i> <?= $poin ?></li>
                    <?php endforeach; ?>
                </ul>

                <a href="<?= $konten['cta_link'] ?>" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm">
                    <?= $konten['cta_text'] ?> <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="rounded-4 overflow-hidden shadow-lg">
                        <img src="<?= $konten['gambar'] ?>" alt="<?= $konten['judul'] ?>" class="w-100 object-fit-cover" style="height: 400px;">
                    </div>
                    
                    <div class="position-absolute bg-white p-4 rounded-4 shadow-lg" style="bottom: -30px; left: -30px; max-width: 250px; border-left: 5px solid var(--primary, #0088cc);">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-star-fill text-warning me-2"></i>
                            <span class="fw-bold text-dark">Layanan Unggulan</span>
                        </div>
                        <p class="small text-muted mb-0">
                            Direkomendasikan oleh ahli gizi Polije untuk hasil maksimal.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 bg-light mt-5">
    <div class="container text-center">
        <h3 class="fw-bold mb-3">Masih Ragu Memilih?</h3>
        <p class="text-muted mb-4">Tim kami siap membantu Anda menentukan layanan yang paling tepat.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="tanya_ahli.php" class="btn btn-outline-dark rounded-pill px-4">Tanya Dulu</a>
            <a href="https://wa.me/62812345678" class="btn btn-success rounded-pill px-4"><i class="bi bi-whatsapp me-2"></i> Chat Admin</a>
        </div>
    </div>
</section>

<?php include 'layout/footer.php'; ?>