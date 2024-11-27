
<?php $this->load->view('templates/header', ['title' => 'Tambah Transaksi']); ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Transaksi Stok</h4>
        </div>
        <div class="card-body">
        <form action="<?= site_url('transaksi/simpan') ?>" method="post">
    <div class="mb-3">
        <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
        <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
            <option value="">Pilih Jenis Transaksi</option>
            <option value="masuk">Stok Masuk</option>
            <option value="keluar">Stok Keluar</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="waktu" class="form-label">Waktu Transaksi</label>
        <input type="datetime-local" name="waktu" id="waktu" class="form-control" value="<?= date('Y-m-d\TH:i') ?>" required>
    </div>

    <div id="barang-container">
        <div class="barang-item mb-3">
            <label for="id_barang" class="form-label">Barang</label>
            <select name="id_barang[]" class="form-select mb-2" required>
                <option value="">Pilih Barang</option>
                <?php foreach ($barang as $b): ?>
                    <option value="<?= $b->id_barang ?>"><?= $b->nama_barang ?> (<?= $b->kode_barang ?>)</option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="jumlah[]" class="form-control mb-2" placeholder="Jumlah" required>
            <button type="button" class="btn btn-danger remove-barang">Hapus Barang</button>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="add-barang">Tambah Barang</button>
    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>

<script>
    document.getElementById('add-barang').addEventListener('click', function () {
        const container = document.getElementById('barang-container');
        const newItem = document.querySelector('.barang-item').cloneNode(true);
        newItem.querySelector('select').value = '';
        newItem.querySelector('input').value = '';
        container.appendChild(newItem);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-barang')) {
            e.target.closest('.barang-item').remove();
        }
    });
</script>

        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
