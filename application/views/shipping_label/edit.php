<div class="container">
    <h2>Edit Shipping Label</h2>
    <form method="post" action="<?= site_url('shippinglabel/update') ?>">
        <input type="hidden" name="id" value="<?= $label->id ?>">
        <div class="form-group">
            <label for="nama_penerima">Nama Penerima</label>
            <input type="text" id="nama_penerima" name="nama_penerima" class="form-control" value="<?= $label->nama_penerima ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat_penerima">Alamat Penerima</label>
            <textarea id="alamat_penerima" name="alamat_penerima" class="form-control" required><?= $label->alamat_penerima ?></textarea>
        </div>
        <div class="form-group">
            <label for="telepon_penerima">Telepon Penerima</label>
            <input type="text" id="telepon_penerima" name="telepon_penerima" class="form-control" value="<?= $label->telepon_penerima ?>" required>
        </div>
        <div class="form-group">
            <label for="nama_pengirim">Nama Pengirim</label>
            <input type="text" id="nama_pengirim" name="nama_pengirim" class="form-control" value="<?= $label->nama_pengirim ?>" required>
        </div>
        <div class="form-group">
            <label for="telepon_pengirim">Telepon Pengirim</label>
            <input type="text" id="telepon_pengirim" name="telepon_pengirim" class="form-control" value="<?= $label->telepon_pengirim ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
