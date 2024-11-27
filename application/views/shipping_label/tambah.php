<?php $this->load->view('templates/header', ['title' => 'Buat Label Pengiriman']); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>Form Shipping Label</h4>
                </div>
                <div class="card-body">
                <form action="<?= site_url('shippinglabel/create_by_transaksi_master/' . $id_transaksi_master) ?>" method="post">
                <input type="hidden" name="id_transaksi" value="<?= $id_transaksi_master; ?>">
                    <!-- Data Pengirim dan Penerima -->
                        <div class="mb-3">
                            <label for="nama_penerima" class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" name="nama_penerima" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_penerima" class="form-label">Alamat Penerima</label>
                            <input type="text" class="form-control" name="alamat_penerima" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon_penerima" class="form-label">Telepon Penerima</label>
                            <input type="text" class="form-control" name="telepon_penerima" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
                            <input type="text" class="form-control" name="nama_pengirim" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon_pengirim" class="form-label">Telepon Pengirim</label>
                            <input type="text" class="form-control" name="telepon_pengirim" required>
                        </div>

                        <!-- Daftar Barang yang Dikirim -->
                        <h5 class="mt-4">Barang yang Dikirim</h5>
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Berat (kg)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total_berat = 0;
                                foreach ($barang_transaksi as $barang): 
                                    $total_berat += $barang->berat * $barang->jumlah;
                                ?>
                                <tr>
                                    <td><?= $barang->nama_barang ?></td>
                                    <td><?= $barang->jumlah ?></td>
                                    <td><?= number_format($barang->berat, 2) ?> kg</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between mt-3">
                            <h6>Total Berat: <?= number_format($total_berat, 2) ?> kg</h6>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Buat Shipping Label</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script>
        $(document).ready(function () {
            $("#nama_penerima").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "<?= site_url('shippinglabel/get_suggestions') ?>",
                        data: { term: request.term },
                        dataType: "json",
                        success: function (data) {
                            response($.map(data, function (item) {
                                return {
                                    label: item.nama_penerima + " (" + item.telepon_penerima + ")",
                                    value: item.nama_penerima,
                                    telepon: item.telepon_penerima,
                                    alamat: item.alamat_penerima
                                };
                            }));
                        }
                    });
                },
                select: function (event, ui) {
                    $("#telepon_penerima").val(ui.item.telepon);
                    $("#alamat_penerima").val(ui.item.alamat);
                },
                minLength: 3
            });
        });
    </script>
    <?php $this->load->view('templates/footer'); ?>