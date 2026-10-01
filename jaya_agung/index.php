<?php
require_once "config/database.php";

// Ambil data produk terbaru untuk halaman depan
$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC LIMIT 6");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV. Jaya Agung Motor - Katalog & Showroom</title>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Global -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <!-- NAVBAR PUBLIK -->
    <div class="navbar">
        <div class="container" style="margin: 0; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
            <a href="index.php" style="font-weight: 700; font-size: 16px;">CV. Jaya Agung Motor</a>
            <div style="display: flex; gap: 20px;">
                <a href="index.php">Beranda</a>
                <a href="produk.php">Katalog Motor</a>
                <a href="tentang.php">Tentang Kami</a>
            </div>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="container">
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 28px; color: #1b3a4b; margin-bottom: 10px;">CV. Jaya Agung Motor</h1>
            <p style="color: #64748b; margin-bottom: 20px;">Pilihan motor berkualitas dan terpercaya untuk mobilitas Anda.</p>
            <a href="produk.php" class="btn">Lihat Katalog Motor</a>
        </div>

        <h2 style="font-size: 20px; color: #1b3a4b; margin-bottom: 15px;">Motor Terbaru</h2>

        <!-- GRID PRODUK (MENGATUR 3 KE SAMPING) -->
        <div class="produk-grid">
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
            <div class="card">
                <?php if (!empty($row['gambar'])): ?>
                    <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama']); ?>">
                <?php else: ?>
                    <div style="width: 100%; height: 180px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; border-radius: 6px; margin-bottom: 12px; color: #94a3b8; font-style: italic;">
                        Tidak ada gambar
                    </div>
                <?php endif; ?>

                <div>
                    <h3 style="font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 6px;"><?= htmlspecialchars($row['nama']); ?></h3>
                    <p style="color: #64748b; font-size: 13px; margin-bottom: 8px;"><?= htmlspecialchars($row['kategori']); ?></p>
                    <p style="color: #2563eb; font-weight: 600; font-size: 15px; margin-bottom: 15px;">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                </div>

                <a href="detail.php?id=<?= $row['id']; ?>" class="btn" style="width: 100%;">Lihat Detail</a>
            </div>
            <?php endwhile; ?>
        </div>

    </div>

</body>
</html>