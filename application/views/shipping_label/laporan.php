<?php $this->load->view('templates/header', ['title' => 'Label Pengiriman']); ?>
<div class="container mt-5">
    <h2 class="mb-4">Laporan Shipping Label</h2>

    <!-- Tombol Tambah 
    <a href="<?= site_url('shippinglabel') ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Buat Shipping Label
    </a>
    -->

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Penerima</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Nama Pengirim</th>
                    <th>Nomor Telepon Pengirim</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($labels as $label): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $label->created_at ?></td>
                        <td><?= $label->id_transaksi_master ?></td>
                        <td><?= $label->nama_penerima ?></td>
                        <td><?= $label->alamat_penerima ?></td>
                        <td><?= $label->telepon_penerima ?></td>
                        <td><?= $label->nama_pengirim ?></td>
                        <td><?= $label->telepon_pengirim ?></td>
                        <td><a href="<?= site_url('shippinglabel/print_label/' . $label->id) ?>" class="btn btn-primary"
                                target="blank">Print</a>
                        </td>
                        <td>
                            <a href="<?= site_url('shippinglabel/edit/' . $label->id) ?>"
                                class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td>
                        <a href="<?= site_url('shippinglabel/delete/' . $label->id) ?>"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus shipping label ini?')"
                                class="btn btn-danger btn-sm">Hapus</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>
<?php $this->load->view('templates/footer'); ?>