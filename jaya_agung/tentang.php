<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - CV. Jaya Agung Motor</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            color: #333333;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background: #0f172a; /* Warna latar gelap sesuai referensi */
            padding: 15px 0;
            margin-bottom: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .navbar .container {
            display: flex;
            align-items: center;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
            gap: 40px; /* Jarak antara logo dan menu */
        }

        .brand-logo {
            text-decoration: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
        }

        .nav-menu {
            display: flex;
            gap: 25px; /* Jarak antar menu di sebelah logo */
            align-items: center;
        }

        .navbar a {
            text-decoration: none;
            color: #cbd5e1;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.2s;
        }

        .navbar a:hover {
            color: #ffffff;
        }

        /* Container Utama */
        .main-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px 40px 20px;
        }

        /* Grid Layout */
        .info-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            align-items: start;
        }

        /* Card dengan Warna Biru Pastel */
        .content-card {
            background: #e0f2fe; /* Biru pastel lembut */
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid #bae6fd;
            margin-bottom: 20px;
        }

        .content-card h1, .content-card h2 {
            font-size: 18px;
            font-weight: 700;
            color: #0369a1;
            margin-bottom: 15px;
        }

        .content-card p {
            font-size: 13px;
            color: #334155;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .content-card p strong {
            color: #0f172a;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .navbar .container {
                gap: 20px;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="container">
        <a href="index.php" class="brand-logo">
            CV. Jaya Agung Motor
        </a>
        <div class="nav-menu">
            <a href="index.php">Beranda</a>
            <a href="produk.php">Katalog Motor</a>
            <a href="tentang.php" style="color: #ffffff; font-weight: 600;">Tentang Kami</a>
        </div>
    </div>
</div>

<div class="main-container">
    <div class="info-grid">
        <!-- Kolom Kiri: Tentang CV -->
        <div class="content-card">
            <h1>Tentang CV. Jaya Agung Motor</h1>
            <p>
                CV. Jaya Agung Motor adalah dealer dan showroom kendaraan roda dua terpercaya yang menyediakan pilihan motor dari kategori Matic dan Sport dengan kondisi prima.
            </p>
            <p>
                Kami berkomitmen memberikan pelayanan terbaik, kemudahan proses transaksi, serta penawaran harga kompetitif untuk kebutuhan kendaraan Anda dan keluarga.
            </p>
        </div>

        <!-- Kolom Kanan: Kontak & Layanan -->
        <div class="content-card">
            <h2>📞 Kontak & Layanan</h2>
            <p>
                <strong>WhatsApp:</strong><br>
                085136760635
            </p>
            <p>
                <strong>Instagram:</strong><br>
                @jayaagungmotor
            </p>
        </div>
    </div>
</div>

</body>
</html>