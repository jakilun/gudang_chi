<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            background-color: #343a40;
            color: white;
            width: 250px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="p-3">
            <h3 class="text-center">Gudang CHI</h3>
            <!-- Menampilkan nama user di sidebar -->
            <div class="mt-3 mb-4">
                <span class="d-block text-white">Selamat datang, <strong><?= $this->session->userdata('nama_pegawai'); ?></strong></span>
            </div>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('stok/daftar_barang') ?>" class="nav-link">
                        <i class="fas fa-box"></i> Data Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('stok/stok_real') ?>" class="nav-link">
                        <i class="fas fa-box"></i> Stok Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('transaksi/daftar') ?>" class="nav-link">
                        <i class="fas fa-exchange-alt"></i> Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('surat_jalan') ?>" class="nav-link">
                        <i class="fas fa-file-alt"></i> Surat Jalan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('shippinglabel/laporan') ?>" class="nav-link">
                        <i class="fas fa-file-alt"></i> Label Pengiriman
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('login/logout') ?>" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
