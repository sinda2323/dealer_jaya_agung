<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - CV. Jaya Agung Motor</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc; /* Warna background selaras dengan dashboard */
            color: #333333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Kartu Login di Tengah */
        .login-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .login-card h2 {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-card .subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            background-color: #f8fafc;
            color: #1e293b;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #2563eb;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        /* Tombol Login Selaras dengan Dashboard */
        .btn-login {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            border: none;
            border-radius: 10px;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link a:hover {
            color: #2563eb;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Login Admin</h2>
        <p class="subtitle">Masukkan akun administrator untuk masuk ke panel kontrol.</p>

        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>

            <button type="submit" class="btn-login">Login ke Dashboard</button>
        </form>

        <div class="back-link">
            <a href="../index.php">&larr; Kembali ke Website Dealer</a>
        </div>
    </div>

</body>
</html>