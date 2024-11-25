<?php $this->load->view('templates/header', ['title' => 'Buat Label Pengiriman']); ?>
<div class="container mt-5">
    <div class="container mt-5">
        <h3>Tambah Label Pengiriman</h3>
        <form action="<?= site_url('shippinglabel/simpan') ?>" method="post">
            <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
            <div class="mb-3">
                <label for="nama_penerima" class="form-label">Nama Penerima</label>
                <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" required>
            </div>
            <div class="mb-3">
                <label for="alamat_penerima" class="form-label">Alamat Penerima</label>
                <textarea class="form-control" id="alamat_penerima" name="alamat_penerima" required></textarea>
            </div>
            <div class="mb-3">
                <label for="telepon_penerima" class="form-label">Nomor Telepon Penerima</label>
                <input type="text" class="form-control" id="telepon_penerima" name="telepon_penerima" required>
            </div>
            <div class="mb-3">
                <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
                <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" required>
            </div>
            <div class="mb-3">
                <label for="telepon_pengirim" class="form-label">Nomor Telepon Pengirim</label>
                <input type="text" class="form-control" id="telepon_pengirim" name="telepon_pengirim" required>
            </div>
            <button type="submit" class="btn btn-primary">Buat Label Pengiriman</button>
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
