<?php $this->load->view('templates/header', ['title' => 'Daftar Transaksi']); ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Daftar Transaksi Stok</h4>
        </div>

        <div class="card-body">
            <a href="<?= site_url('transaksi/tambah') ?>" class="btn btn-primary mb-3">Tambah Transaksi</a>
            <!-- Form Filter -->
            <form action="<?= site_url('transaksi/daftar') ?>" method="get" class="mb-3">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <label for="id_barang" class="form-label">Produk</label>
                        <select name="id_barang" id="id_barang" class="form-control form-select">
                            <option value="">Semua Produk</option>
                            <?php foreach ($barang as $b): ?>
                                <option value="<?= $b->id_barang ?>" <?= $id_barang == $b->id_barang ? 'selected' : '' ?>>
                                    <?= $b->nama_barang ?> (<?= $b->kode_barang ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                        <select name="jenis_transaksi" class="form-control form-select mr-2">
                            <option value="">Semua Jenis Transaksi</option>
                            <option value="masuk" <?= (isset($_GET['jenis_transaksi']) && $_GET['jenis_transaksi'] == 'masuk') ? 'selected' : '' ?>>Masuk</option>
                            <option value="keluar" <?= (isset($_GET['jenis_transaksi']) && $_GET['jenis_transaksi'] == 'keluar') ? 'selected' : '' ?>>Keluar</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                            value="<?= $tanggal_awal ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                            value="<?= $tanggal_akhir ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-4 w-100">Filter</button>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Nama Barang</th>
                        <th>Jenis Transaksi</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($transaksi as $transaksi) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($transaksi->waktu)) ?></td> <!-- Mengakses properti objek -->
                            <td><?= $transaksi->nama_barang ?></td> <!-- Mengakses properti objek -->
                            <td><?= ucfirst($transaksi->jenis_transaksi) ?></td> <!-- Mengakses properti objek -->
                            <td><?= $transaksi->jumlah ?></td> <!-- Mengakses properti objek -->
                            <td><?= $transaksi->keterangan ?></td> <!-- Mengakses properti objek -->
                            <td>
                                <?php if ($transaksi->jenis_transaksi === 'keluar'): ?>
                                    <?php if ($transaksi->label_created): ?>
                                        <a href="<?= site_url('shippinglabel/print_label/' . $transaksi->id_transaksi) ?>"
                                            class="btn btn-success btn-sm" target="blank">
                                            <i class="fas fa-check"></i> Lihat Shipping Label
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= site_url('shippinglabel/create?transaksi_id=' . $transaksi->id_transaksi) ?>"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-truck"></i> Buat Shipping Label
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('transaksi/edit/' . $transaksi->id_transaksi) ?>"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= site_url('transaksi/hapus/' . $transaksi->id_transaksi) ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>