<?php
// Mencegah error jika variabel $page belum didefinisikan
if (!isset($page)) { $page = ''; }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NCC Politeknik Negeri Jember - Konsultasi Gizi">
    
    <title>NCC Politeknik Negeri Jember</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* 1. Top Bar Styling */
        .top-bar {
            background-color: var(--secondary, #0f172a);
            color: rgba(255,255,255,0.9);
            font-size: 0.85rem;
            padding: 9px 0;
        }
        .top-bar a { color: rgba(255,255,255,0.9); text-decoration: none; transition: 0.3s; }
        .top-bar a:hover { color: #fff; text-shadow: 0 0 5px rgba(255,255,255,0.5); }

        /* 2. Navbar Styling */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            padding: 15px 0;
        }

        .brand-icon {
            width: 40px; height: 40px;
            background: var(--primary, #0088cc);
            color: white;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            margin-right: 12px;
        }

        /* 3. ANIMASI MENU (YANG DIBENARKAN) */
        .nav-link-custom {
            color: #475569 !important;
            font-weight: 600;
            margin: 0 8px;
            padding: 8px 0 !important; /* Padding kiri-kanan 0, kita atur margin saja */
            position: relative; /* Wajib untuk acuan garis absolute */
            display: inline-block;
        }

        /* Garis Bawah (Hidden by default) */
        .nav-link-custom::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary, #0088cc);
            
            /* Teknik Scale: Lebih mulus daripada width */
            transform: scaleX(0); 
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }

        /* Efek Saat Hover / Aktif */
        .nav-link-custom:hover, .nav-link-custom.active {
            color: var(--primary, #0088cc) !important;
        }

        /* Munculkan Garis */
        .nav-link-custom:hover::after, .nav-link-custom.active::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        /* 4. Tombol Login */
        .btn-login-nav {
            background-color: var(--primary, #0088cc);
            color: white;
            font-weight: 700;
            padding: 10px 25px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 136, 204, 0.2);
        }
        .btn-login-nav:hover {
            background-color: #006699;
            color: white;
            transform: translateY(-2px); /* Efek naik sedikit */
            box-shadow: 0 6px 15px rgba(0, 136, 204, 0.3);
        }

        /* Fix untuk Tampilan HP (Mobile) */
        @media (max-width: 991px) {
            .nav-link-custom {
                margin: 5px 0;
                display: block;
                width: fit-content; /* Agar garis bawah sesuai panjang teks saja */
            }
            .navbar-collapse {
                padding-top: 15px;
                border-top: 1px solid #eee;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

<div class="top-bar d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 d-flex gap-4">
                <span><i class="bi bi-clock me-2"></i>Senin - Jumat, 08:00 - 16:00</span>
                <span><i class="bi bi-telephone me-2"></i>(0331) 333532</span>
            </div>
            <div class="col-md-4 text-end">
                <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="me-3"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
  <div class="container">
    
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <div class="brand-icon">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>
        <div class="d-flex flex-column justify-content-center">
            <span style="line-height: 1; font-weight: 800; font-size: 1.25rem; color: var(--primary, #0088cc); letter-spacing: -0.5px;">NCC</span>
            <span style="line-height: 1; font-size: 0.8rem; font-weight: 600; color: #64748b;">Polije Jember</span>
        </div>
    </a>
    
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        
        <li class="nav-item">
            <a class="nav-link nav-link-custom <?= ($page == 'home') ? 'active' : ''; ?>" href="index.php">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-custom <?= ($page == 'reservasi') ? 'active' : ''; ?>" href="reservasi.php">Reservasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-custom <?= ($page == 'cek_gizi') ? 'active' : ''; ?>" href="cek_gizi.php">Cek Gizi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-custom <?= ($page == 'artikel') ? 'active' : ''; ?>" href="artikel.php">Artikel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-custom <?= ($page == 'tanya') ? 'active' : ''; ?>" href="tanya_ahli.php">Tanya Ahli</a>
        </li>
        
        <li class="nav-item ms-lg-4 mt-3 mt-lg-0">
          <a class="btn btn-login-nav btn-sm d-block d-lg-inline-block text-center" href="admin/login.php">
            Staff Area <i class="bi bi-arrow-right-short"></i>
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>