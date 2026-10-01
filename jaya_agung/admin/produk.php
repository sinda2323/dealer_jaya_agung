<?php

session_start();

require_once "../includes/auth.php";

require_once "../config/database.php";

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

$where_sql = "";

if (count($where) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

/*
|--------------------------------------------------------------------------
| PAGINATION
|--------------------------------------------------------------------------
*/

$per_page = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

$count_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM produk
     $where_sql"
);

$count_data = mysqli_fetch_assoc($count_query);

$total_data = $count_data['total'];

$total_page = ceil($total_data / $per_page);

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     $where_sql
     ORDER BY id DESC
     LIMIT $per_page OFFSET $offset"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Katalog Motor - CV. Jaya Agung Motor</title>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Global Utama -->
    <link rel="stylesheet" href="../assets/style.css">

    <!-- CSS Khusus Admin (Terisolasi agar halaman publik tidak berubah) -->
    <style>
        .admin-page {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            min-height: 100vh;
            padding-bottom: 40px;
        }

        .admin-page * {
            font-family: 'Poppins', sans-serif;
        }

        .admin-page .admin-navbar {
            background-color: #1b3a4b;
            padding: 15px 0;
            margin-bottom: 30px;
        }

        .admin-page .admin-navbar .nav-container {
            display: flex;
            gap: 20px;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .admin-page .admin-navbar a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
        }

        .admin-page .admin-navbar a:hover {
            text-decoration: underline;
        }

        .admin-page .admin-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .admin-page h1 {
            color: #1b3a4b;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .admin-page .card {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .admin-page .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #2563eb;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s;
        }

        .admin-page .btn:hover {
            background-color: #1d4ed8;
        }

        .admin-page .btn-warning {
            background-color: #f59e0b;
            padding: 6px 12px;
            font-size: 13px;
        }

        .admin-page .btn-warning:hover {
            background-color: #d97706;
        }

        .admin-page .btn-danger {
            background-color: #ef4444;
            padding: 6px 12px;
            font-size: 13px;
        }

        .admin-page .btn-danger:hover {
            background-color: #dc2626;
        }

        .admin-page form label {
            display: block;
            font-weight: 500;
            color: #1b3a4b;
            margin-bottom: 6px;
            margin-top: 12px;
        }

        .admin-page form label:first-child {
            margin-top: 0;
        }

        .admin-page form input[type="text"],
        .admin-page form select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            background-color: #fff;
            margin-bottom: 10px;
        }

        .admin-page form input[type="text"]:focus,
        .admin-page form select:focus {
            border-color: #2563eb;
        }

        .admin-page table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-page th {
            background-color: #1e293b;
            color: #ffffff;
            padding: 12px 15px;
            font-weight: 500;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-page th:first-child {
            border-top-left-radius: 6px;
        }

        .admin-page th:last-child {
            border-top-right-radius: 6px;
        }

        .admin-page td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .admin-page tr:hover {
            background-color: #f8fafc;
        }

        .admin-page td img {
            border-radius: 4px;
            object-fit: cover;
        }

        .admin-page .pagination {
            display: flex;
            gap: 6px;
            margin-top: 20px;
        }

        .admin-page .pagination a {
            padding: 6px 12px;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            color: #2563eb;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
        }

        .admin-page .pagination a:hover {
            background-color: #f1f5f9;
        }
    </style>
</head>

<body class="admin-page">

<div class="admin-navbar">
    <div class="nav-container">
        <a href="index.php">Dashboard</a>
        <a href="produk.php">Kelola Motor</a>
        <a href="../index.php">Website</a>
    </div>
</div>

<div class="admin-container">

    <h1>Kelola Katalog Motor</h1>

    <?php include "../includes/flash.php"; ?>

    <a href="tambah.php" class="btn" style="margin-bottom: 20px;">
        + Tambah Motor Baru
    </a>

    <!-- SEARCH & FILTER -->
    <div class="card">
        <form method="GET">
            <label>Cari Motor</label>
            <input
                type="text"
                name="keyword"
                placeholder="Masukkan nama/tipe motor"
                value="<?= htmlspecialchars($keyword); ?>"
            >

            <label>Kategori</label>
            <select name="kategori">
                <option value="">Semua Kategori</option>
                <option value="Matic" <?= $kategori == 'Matic' ? 'selected' : ''; ?>>Matic</option>
                <option value="Sport" <?= $kategori == 'Sport' ? 'selected' : ''; ?>>Sport</option>
                <option value="Bebek" <?= $kategori == 'Bebek' ? 'selected' : ''; ?>>Bebek</option>
            </select>

            <div style="margin-top: 15px; display: flex; gap: 10px;">
                <button type="submit" class="btn">Cari</button>
                <a href="produk.php" class="btn" style="background-color: #64748b;">Reset</a>
            </div>
        </form>
    </div>

    <!-- TABEL PRODUK -->
    <div class="card" style="padding: 0; overflow: hidden;">
        <table>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama / Tipe Motor</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok Unit</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = $offset + 1;
            while ($row = mysqli_fetch_assoc($query)):
            ?>

            <tr>
                <td><?= $no++; ?></td>
                <td>
                    <?php if (!empty($row['gambar'])): ?>
                        <img
                            src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>"
                            width="70"
                            height="50"
                        >
                    <?php else: ?>
                        <span style="color: #94a3b8; font-style: italic;">Tidak ada</span>
                    <?php endif; ?>
                </td>
                <td style="font-weight: 500; color: #1e293b;">
                    <?= htmlspecialchars($row['nama']); ?>
                </td>
                <td>
                    <?= htmlspecialchars($row['kategori']); ?>
                </td>
                <td style="font-weight: 500;">
                    Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                </td>
                <td>
                    <?= $row['stok']; ?>
                </td>
                <td>
                    <div style="display: flex; gap: 6px;">
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data motor ini?')">Hapus</a>
                    </div>
                </td>
            </tr>

            <?php endwhile; ?>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <a href="?page=<?= $i; ?>&keyword=<?= urlencode($keyword); ?>&kategori=<?= urlencode($kategori); ?>">
                <?= $i; ?>
            </a>
        <?php endfor; ?>
    </div>

</div>

</body>
</html>