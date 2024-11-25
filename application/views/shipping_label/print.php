<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Shipping Label</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .label-container {
            border: 1px solid #000;
            padding: 20px;
            width: 400px;
            margin: auto;
            text-align: left;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        p {
            margin: 5px 0;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="label-container">
        <h1 class="text-center">Shipping Label</h1>
        <p><strong>Nama Penerima:</strong> <?= $label->nama_penerima; ?></p>
        <p><strong>Alamat Penerima:</strong> <?= $label->alamat_penerima; ?></p>
        <p><strong>No Telepon Penerima:</strong> <?= $label->telepon_penerima; ?></p>
        <hr>
        <p><strong>Nama Pengirim:</strong> <?= $label->nama_pengirim; ?></p>
        <p><strong>No Telepon Pengirim:</strong> <?= $label->telepon_pengirim; ?></p>
    </div>
</body>

</html>
