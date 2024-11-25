<?php $this->load->view('templates/header', ['title' => 'Daftar Barang']); ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Daftar Barang</h4>
        </div>
        <div class="card-body">
            <a href="<?= site_url('stok/tambah_barang') ?>" class="btn btn-success mb-3">Tambah Barang</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>Stok Minimum</th>
                    <th>Berat</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($barang)) : ?>
                    <?php foreach ($barang as $index => $item) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $item['nama_barang'] ?></td>
                            <td><?= $item['kode_barang'] ?></td>
                            <td><?= $item['stok_minimum'] ?></td>
                            <td><?= $item['berat'] ?> Kg</td>
                            <td>
                                <a href="<?= site_url('stok/update_barang/' . $item['id_barang']) ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="<?= site_url('stok/hapus_barang/' . $item['id_barang']) ?>" 
       class="btn btn-danger btn-sm"
       onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data barang.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
