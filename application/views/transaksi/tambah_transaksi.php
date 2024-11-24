<?php $this->load->view('templates/header', ['title' => 'Tambah Transaksi']); ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Transaksi Stok</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('transaksi/simpan') ?>" method="post">
                <div class="mb-3">
                    <label for="id_barang" class="form-label">Pilih Barang</label>
                    <select class="form-select" id="id_barang" name="id_barang" required>
                        <option value="">Pilih Barang</option>
                        <?php foreach ($barang as $b) { ?>
                            <option value="<?= $b->id_barang ?>"><?= $b->nama_barang ?> (<?= $b->kode_barang ?>)
                            </option>
                        <?php } ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                    <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required>
                        <option value="masuk">Stok Masuk</option>
                        <option value="keluar">Stok Keluar</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
                <div class="form-group">
                    <label for="waktu">Tanggal & Jam</label>
                    <input type="datetime-local" name="waktu" class="form-control" value="<?= date('Y-m-d\TH:i') ?>"
                        required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>