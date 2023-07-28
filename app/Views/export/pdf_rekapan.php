<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 16pt;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .h1>th {
            padding: 15px !important;
        }

        .h2>th {
            padding: 10px !important;
        }

        .h3>th {
            padding: 5px !important;
        }

        th {
            font-size: 14px;
            background-color: #D9D9D9;
        }

        td {
            font-size: 12px;
            padding: 5px;
        }

        .number {
            text-align: center;
            width: 20px;
        }

        .data>td:nth-child(2) {
            width: 200px;
        }
    </style>
</head>

<body lang=EN-US>
    <h1 align="center">Daftar Rekapan Pengajuan Kajian</h1>
    <table width="100%" align="center">
        <thead>
            <tr class="h2">
                <th>NO</th>
                <th>TGL PENGAJUAN</th>
                <th>NAMA PENGGUNA</th>
                <th>NAMA KAJIAN</th>
                <th>PRIHAL PENGAJUAN</th>
                <th>INSTANSI</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data as $usulan) : ?>
                <tr class="data">
                    <td class="number"><?= $i++; ?></td>
                    <td><?= $usulan['created_at']; ?></td>
                    <td><?= $usulan['name']; ?></td>
                    <td><?= $usulan['nama_kajian']; ?></td>
                    <td><?= $usulan['prihal_usulan']; ?></td>
                    <td><?= $usulan['instansi']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>