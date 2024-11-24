<?php $this->load->view('templates/header', ['title' => 'Stok Barang']); ?>
<div class="container mt-5">
    <h2>Stok Real Barang</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Stok Tersisa</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($stok as $s): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $s['nama_barang'] ?></td>
                    <td><?= $s['stok_masuk'] ?></td>
                    <td><?= $s['stok_keluar'] ?></td>
                    <td><?= $s['stok_tersisa'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $this->load->view('templates/footer'); ?>
