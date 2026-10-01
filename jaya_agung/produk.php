<?php
require_once "config/database.php";

$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';

$where = [];
if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $where[] = "nama LIKE '%$keyword_safe%'";
}
if ($kategori != '') {
    $kategori_safe = mysqli_real_escape_string($conn, $kategori);
    $where[] = "kategori = '$kategori_safe'";
}

$where_sql = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

$query = mysqli_query($conn, "SELECT * FROM produk $where_sql ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Motor - CV. Jaya Agung Motor</title>
    
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
        <div class="container" style="margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; max-width: 1100px;">
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
        <h1 style="font-size: 24px; color: #1b3a4b; margin-bottom: 20px;">Katalog Motor</h1>

        <!-- FORM PENCARIAN & FILTER -->
        <div class="card" style="margin-bottom: 30px;">
            <form method="GET" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end;">
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 5px; font-size: 13px;">Cari Motor</label>
                    <input type="text" name="keyword" placeholder="Nama motor..." value="<?= htmlspecialchars($keyword); ?>" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                </div>
                <div style="width: 180px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 5px; font-size: 13px;">Kategori</label>
                    <select name="kategori" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; background: #fff;">
                        <option value="">Semua Kategori</option>
                        <option value="Matic" <?= $kategori == 'Matic' ? 'selected' : ''; ?>>Matic</option>
                        <option value="Sport" <?= $kategori == 'Sport' ? 'selected' : ''; ?>>Sport</option>
                        <option value="Bebek" <?= $kategori == 'Bebek' ? 'selected' : ''; ?>>Bebek</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn" style="margin-top: 0; height: 38px;">Cari</button>
                    <a href="produk.php" class="btn" style="background-color: #64748b; margin-top: 0; height: 38px; text-decoration: none; display: inline-flex; align-items: center; box-sizing: border-box;">Reset</a>
                </div>
            </form>
        </div>

        <!-- GRID PRODUK (Jajar Tiga ke Samping) -->
        <div class="produk-grid">
            <?php 
            if (mysqli_num_rows($query) > 0):
                while ($row = mysqli_fetch_assoc($query)): 
            ?>
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
            <?php 
                endwhile; 
            else:
            ?>
                <p style="grid-column: 1 / -1; text-align: center; color: #64748b; padding: 40px;">Data motor tidak ditemukan.</p>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>