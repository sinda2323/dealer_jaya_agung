<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CV. Jaya Agung Motor</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Inline langsung di dalam file agar dijamin 100% langsung berubah -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            color: #333333;
        }

        .dashboard-container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .admin-header-banner {
            background: #1e293b;
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .admin-header-banner h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .admin-header-banner p {
            font-size: 13px;
            color: #94a3b8;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            border-left: 6px solid #ccc;
        }

        .stat-card.border-blue { border-left-color: #3b82f6; }
        .stat-card.border-green { border-left-color: #10b981; }
        .stat-card.border-orange { border-left-color: #f59e0b; }

        .stat-label {
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: #1e293b;
            margin-top: 5px;
        }

        .status-active {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #10b981;
            font-size: 22px;
        }

        .dot {
            width: 10px;
            height: 10px;
            background-color: #10b981;
            border-radius: 50%;
            display: inline-block;
        }

        /* Content Cards */
        .content-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            margin-bottom: 20px;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .content-card h3 {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .content-card p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .bg-light-blue {
            background-color: #f8fafc;
        }

        /* Buttons */
        .btn-primary {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-logout {
            display: inline-block;
            background: #ef4444;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: #dc2626;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        
        <!-- Header Banner -->
        <div class="admin-header-banner">
            <h1>Dashboard Admin CV. Jaya Agung Motor</h1>
            <p>Selamat datang kembali, Administrator. Kelola katalog motor dengan mudah dan cepat.</p>
        </div>

        <!-- Statistik Cards -->
        <div class="stats-grid">
            <div class="stat-card border-blue">
                <span class="stat-label">TOTAL UNIT MOTOR</span>
                <h2 class="stat-value">10</h2>
            </div>
            <div class="stat-card border-green">
                <span class="stat-label">TOTAL KATEGORI</span>
                <h2 class="stat-value">2</h2>
            </div>
            <div class="stat-card border-orange">
                <span class="stat-label">STATUS SISTEM</span>
                <h2 class="stat-value status-active"><span class="dot"></span> Aktif</h2>
            </div>
        </div>

        <!-- Manajemen Katalog Motor -->
        <div class="content-card">
            <h3>🏍️ Manajemen Katalog Motor</h3>
            <p>Kelola daftar motor, perbarui harga, foto, spesifikasi, dan stok produk secara real-time.</p>
            <a href="produk.php" class="btn-primary">Kelola Katalog Motor Sekarang</a>
        </div>

        <div class="logout-section" style="margin-top: 30px; text-align: right;">
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>

    </div>

</body>
</html>