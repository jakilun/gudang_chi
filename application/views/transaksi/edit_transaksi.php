<?php $this->load->view('templates/header', ['title' => 'Edit Transaksi']); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white text-center">
                    <h4>Edit Transaksi</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('transaksi/update/' . $transaksi->id_transaksi); ?>" method="post">
                        <div class="form-group mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <select name="id_barang" id="nama_barang" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option value="<?= $b->id_barang; ?>" <?= $b->id_barang == $transaksi->id_barang ? 'selected' : ''; ?>>
                                        <?= $b->nama_barang; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                            <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
                                <option value="masuk" <?= $transaksi->jenis_transaksi == 'masuk' ? 'selected' : ''; ?>>Masuk</option>
                                <option value="keluar" <?= $transaksi->jenis_transaksi == 'keluar' ? 'selected' : ''; ?>>Keluar</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $transaksi->jumlah; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control"><?= $transaksi->keterangan; ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="datetime-local" name="waktu" id="waktu" class="form-control" 
                                   value="<?= date('Y-m-d\TH:i', strtotime($transaksi->waktu)); ?>" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a href="<?= base_url('transaksi'); ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
