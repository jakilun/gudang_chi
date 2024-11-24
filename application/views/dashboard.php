<?php $this->load->view('templates/header', ['title' => 'Dashboard']); ?>
<!-- Container utama -->
<div class="container mt-4">

    <!-- Peringatan Stok Menipis -->
    <?php if(!empty($stok_menipis)): ?>
        <div class="alert alert-warning">
            <strong>Peringatan!</strong> Beberapa barang memiliki stok yang kurang dari batas minimum:
            <ul>
                <?php foreach ($stok_menipis as $barang): ?>
                    <li><?php echo $barang->nama_barang; ?> (Stok Tersisa: <?php echo $barang->stok_tersisa; ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Tabel Stok Barang -->
    <h3>Stok Barang</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stok Tersisa</th>
                <th>Stok Minimum</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($stok_menipis as $barang): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $barang->nama_barang; ?></td>
                    <td><?php echo $barang->stok_tersisa; ?></td>
                    <td><?php echo $barang->stok_minimum; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $this->load->view('templates/footer'); ?>
