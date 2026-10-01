<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    $_SESSION['flash_message'] = "Data motor tidak ditemukan!";
    header("Location: produk.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $gambar_lama = $row['gambar'];

    $gambar = $gambar_lama;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];
        $ekstensi = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($ekstensi, $allowed)) {
            $gambar = uniqid() . '.' . $ekstensi;
            if (move_uploaded_file($tmp_file, '../uploads/produk/' . $gambar)) {
                if (!empty($gambar_lama) && file_exists('../uploads/produk/' . $gambar_lama)) {
                    unlink('../uploads/produk/' . $gambar_lama);
                }
            }
        }
    }

    if (!empty($nama) && !empty($kategori) && !empty($harga)) {
        $update = "UPDATE produk SET nama = '$nama', kategori = '$kategori', deskripsi = '$deskripsi', harga = '$harga', stok = '$stok', gambar = '$gambar' WHERE id = $id";
        if (mysqli_query($conn, $update)) {
            $_SESSION['flash_message'] = "Data motor berhasil diperbarui!";
            header("Location: produk.php");
            exit;
        } else {
            $error = "Gagal memperbarui database.";
        }
    } else {
        $error = "Semua field wajib diisi dengan benar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Motor - CV. Jaya Agung Motor</title>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Global -->
    <link rel="stylesheet" href="../assets/style.css">

    <!-- CSS Khusus Halaman Admin -->
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
        .admin-navbar {
            background-color: #1b3a4b;
            padding: 15px 0;
            margin-bottom: 30px;
        }
        .admin-navbar .nav-container {
            display: flex;
            gap: 20px;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .admin-navbar a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
        }
        .admin-navbar a:hover {
            text-decoration: underline;
        }
        .admin-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        h1 {
            color: #1b3a4b;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 500;
            color: #1b3a4b;
            margin-bottom: 8px;
            font-size: 14px;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            background-color: #fff;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #2563eb;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #2563eb;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn:hover {
            background-color: #1d4ed8;
        }
        .btn-secondary {
            background-color: #64748b;
        }
        .btn-secondary:hover {
            background-color: #475569;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
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
    <div class="card">
        <h1>Edit Data Motor</h1>

        <?php if (!empty($error)): ?>
            <div class="alert-error"><?= $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Nama Motor / Tipe</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']); ?>" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="Matic" <?= $row['kategori'] == 'Matic' ? 'selected' : ''; ?>>Matic</option>
                    <option value="Sport" <?= $row['kategori'] == 'Sport' ? 'selected' : ''; ?>>Sport</option>
                    <option value="Bebek" <?= $row['kategori'] == 'Bebek' ? 'selected' : ''; ?>>Bebek</option>
                </select>
            </div>

            <div class="form-group">
                <label>Spesifikasi / Deskripsi</label>
                <textarea name="deskripsi"><?= htmlspecialchars($row['deskripsi']); ?></textarea>
            </div>

            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" value="<?= htmlspecialchars($row['harga']); ?>" required>
            </div>

            <div class="form-group">
                <label>Stok Unit</label>
                <input type="number" name="stok" value="<?= htmlspecialchars($row['stok']); ?>" required>
            </div>

            <div class="form-group">
                <label>Gambar Saat Ini</label>
                <?php if (!empty($row['gambar'])): ?>
                    <div style="margin-bottom: 10px;">
                        <img src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" width="150" style="border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover;">
                    </div>
                <?php else: ?>
                    <p style="color: #94a3b8; font-style: italic; margin-bottom: 10px;">Tidak ada gambar</p>
                <?php endif; ?>

                <label>Ganti Gambar Motor (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" style="padding: 6px 0;">
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn">Update Motor</button>
                <a href="produk.php" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>