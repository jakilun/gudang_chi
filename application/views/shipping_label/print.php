<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Pengaturan untuk tampilan normal */
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .label-box {
            border: 2px solid;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .label-box h1 {
            text-align: center;;
        }

        .label-box .details p {
            font-size: 16px;
        }

        .label-box table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .label-box th, .label-box td {
            padding: 10px;
            text-align: left;
        }

        .label-box th {
            background-color: #f2f2f2;
        }

        .label-box .total-weight {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .label-box .footer {
            text-align: right;
            margin-top: 30px;
        }

        .label-box .footer p {
            font-size: 14px;
        }

        .logo {
            display: block;
            margin: 0 auto;
            width: 150px;
        }

        /* CSS untuk orientasi print landscape */
        @media print {
            @page {
                size: landscape;
            }

            body {
                width: 100%;
                height: 100%;
            }

            .container {
                width: 100%;
                margin: 0;
            }

            .label-box {
                width: 100%;
                margin: 0;
                padding: 20px;
            }

            .logo {
                width: 200px;
                margin-bottom: 20px;
            }

            .label-box .details p {
                font-size: 14px;
            }

            .label-box table {
                font-size: 12px;
            }

            .label-box th, .label-box td {
                padding: 8px;
            }

            .footer p {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="label-box">
            <!-- Logo at the top -->
            <h1><B>GEN INDONESIA</B></h1>
            <hr>
            <!-- Shipping details -->
            <div class="details">
                <p><strong>Nama Penerima:</strong> <?= $label->nama_penerima ?></p>
                <p><strong>Alamat Penerima:</strong> <?= $label->alamat_penerima ?></p>
                <p><strong>Telepon Penerima:</strong> <?= $label->telepon_penerima ?></p>
                <hr>
                <h4>Daftar Barang yang Dikirim</h4>
                <table border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Berat (kg)</th>
                            <th>Total Berat (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_berat = 0; ?>
                        <?php foreach ($barang as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $item->nama_barang ?></td>
                                <td><?= $item->jumlah ?></td>
                                <td><?= number_format($item->berat, 2) ?> kg</td>
                                <td><?= number_format($item->berat * $item->jumlah, 2) ?> kg</td>
                            </tr>
                            <?php $total_berat += $item->berat * $item->jumlah; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="total-weight">
                    <p>Total Berat: <?= number_format($total_berat, 2) ?> kg</p>
                </div>

                <p><strong>Nama Pengirim:</strong> <?= $label->nama_pengirim ?></p>
                <p><strong>Telepon Pengirim:</strong> <?= $label->telepon_pengirim ?></p>
            </div>

            <!-- Footer (optional) -->
            <div class="footer">
                <p><em>Terima Kasih</em></p>
            </div>
        </div>
    </div>

    <script>
        window.print(); // Auto print when the page loads
    </script>

</body>
</html>
