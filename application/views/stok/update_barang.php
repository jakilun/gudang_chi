<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Barang</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Update Barang</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('stok/simpan_update_barang') ?>" method="post">
                <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $barang['nama_barang'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kode_barang" class="form-label">Kode Barang</label>
                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $barang['kode_barang'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stok_minimum" class="form-label">Stok Minimum</label>
                    <input type="number" class="form-control" id="stok_minimum" name="stok_minimum" value="<?= $barang['stok_minimum'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="berat" class="form-label">Berat Barang (Kg)</label>
                    <input type="number" step="0.01" class="form-control" id="berat" name="berat" value="<?= $barang['berat'] ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?= site_url('stok/daftar_barang') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Link Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
