<?php
// Mencegah error jika variabel $page belum didefinisikan di halaman lain
if (!isset($page)) { $page = ''; }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website Resmi NCC Politeknik Negeri Jember - Layanan Konsultasi Gizi dan Kesehatan.">
    
    <title>NCC Politeknik Negeri Jember</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Font Global */
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Top Bar (Baris Gelap di Atas) */
        .top-bar {
            background-color: var(--secondary, #0f172a); /* Navy Blue */
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
            padding: 10px 0;
            font-weight: 500;
        }
        .top-bar a { color: rgba(255,255,255,0.85); text-decoration: none; transition: 0.3s; }
        .top-bar a:hover { color: #fff; }

        /* Navbar Utama */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            padding: 16px 0;
        }

        /* Logo Brand */
        .brand-icon {
            width: 42px; height: 42px;
            background: var(--primary, #0088cc);
            color: white;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            margin-right: 12px;
            box-shadow: 0 4px 10px rgba(0, 136, 204, 0.2);
        }

        /* Menu Links */
        .nav-link-custom {
            color: #475569 !important; /* Slate Grey */
            font-weight: 600;
            margin: 0 5px;
            padding: 8px 12px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        /* Efek Hover & Active */
        .nav-link-custom:hover, .nav-link-custom.active {
            color: var(--primary, #0088cc) !important;
            background-color: rgba(0, 136, 204, 0.05); /* Biru sangat muda */
        }
        
        /* Garis bawah animasi saat aktif */
        .nav-link-custom.active::after {
            content: '';
            position: absolute;
            bottom: 5px; left: 12px; right: 12px;
            height: 2px;
            background-color: var(--primary, #0088cc);
            border-radius: 2px;
        }

        /* Tombol Login Spesial */
        .btn-login-nav {
            background-color: var(--primary, #0088cc);
            color: white;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0, 136, 204, 0.25);
            transition: transform 0.3s;
            border: none;
        }
        .btn-login-nav:hover {
            background-color: #0077b3; /* Biru lebih gelap */
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="top-bar d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 d-flex gap-4">
                <span><i class="bi bi-clock me-2 text-info"></i>Senin - Jumat, 08:00 - 16:00</span>
                <span><i class="bi bi-telephone me-2 text-info"></i>(0331) 333532</span>
                <span><i class="bi bi-geo-alt me-2 text-info"></i>Politeknik Negeri Jember</span>
            </div>
            <div class="col-md-4 text-end">
                <span class="me-3 opacity-75">Ikuti Kami:</span>
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
        <div>
            <div style="line-height: 1; font-weight: 800; font-size: 1.25rem; color: var(--primary, #0088cc); letter-spacing: -0.5px;">NCC</div>
            <div style="line-height: 1; font-size: 0.8rem; font-weight: 600; color: #64748b;">Polije Jember</div>
        </div>
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        
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
        
        <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
          <a class="btn btn-login-nav btn-sm" href="admin/login.php">
            <i class="bi bi-person-lock me-2"></i>Staff Area
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>