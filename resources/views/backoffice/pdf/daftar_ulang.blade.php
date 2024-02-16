<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <style>
        @page {
            size: A4;
            /* atau ganti dengan ukuran yang diinginkan, seperti A5 atau Letter */
            margin: 30px 30px 50px;
        }

        * {
            color: #424242;
            font-size: 12px;
            line-height: 14px;
            font-family: "Gill Sans", sans-serif;
        }

        .flight-info * {
            font-size: 14px;
        }

        table {
            border-spacing: 0;
            width: 100%;
        }

        table.nospan,
        table.nospan tr,
        table.nospan th,
        table.nospan td {
            padding: 0;
            margin: 0;
        }

        th {
            background-color: #e9edf3;
        }

        table.normal th,
        table.normal td {
            padding: 1.2mm 2mm;
            margin: 0;
        }

        table.normal,
        table.normal th,
        table.normal td {
            border: 0.2mm solid #d4dae2;
            border-collapse: collapse;
        }

        table.normal th.normal {
            font-weight: normal;
        }

        table.td-padding-l td {
            padding-top: 2mm;
            padding-bottom: 2mm;
        }

        table.right td {
            text-align: right;
        }

        ol li {
            padding: 1mm;
            text-align: justify;
        }

        .h2 {
            font-size: 14px;
            font-weight: bold;
            line-height: 18px;
        }

        .h3 {
            font-size: 13px;
            font-weight: bold;
            line-height: 15px;
        }

        .h4 {
            font-size: 12px;
            font-weight: bold;
            line-height: 14px;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        a {
            text-decoration: none;
        }

        p,
        h1,
        h2,
        h3,
        h4 {
            margin: 0;
            padding: 0;
        }

        .header,
        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }

        .header {
            top: 0px;
        }

        .footer {
            bottom: -30px;
        }

        .page-break {
            page-break-after: always;
        }

        .pagenum:before {
            content: counter(page);
        }
    </style>
</head>

<body id="page">
    <div class="footer">Page <span class="pagenum"></span></div>
    <div style="margin-top: 10mm">
        <div style="display: inline-block; width: 39%; padding-bottom: 8px">
            <div style="border-bottom: 1px solid #303030"></div>
        </div>
        <div
            style="
                    display: inline-block;
                    width: 21%;
                    font-size: 18px;
                    text-align: center;
                ">
            Pendaftaran Ulang
        </div>
        <div style="display: inline-block; width: 39%; padding-bottom: 8px">
            <div style="border-bottom: 1px solid #303030"></div>
        </div>
    </div>
    <div style="margin-top: 6mm">
        <table class="normal td-padding-l" style="border: none">
            <thead>
                <tr>
                    <th class="normal" style="width: 2mm">#</th>
                    <th class="normal" style="width: 20mm">
                        No Pendaftaran
                    </th>
                    <th class="normal" style="width: 30mm; text-align: center">
                        Tanggal Daftar Ulang
                    </th>
                    <th class="normal" style="width: 20mm; text-align: center">
                        Nama
                    </th>
                    <th class="normal" style="width: 20mm; text-align: center">
                        Jenis Kelamin
                    </th>
                    <th class="normal" style="width: 20mm; text-align: center">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            {{ $value['id_pendaftaran_ulang'] }}
                        </td>
                        <td>{{ $value['tgl_pendaftaran_ulang'] }}</td>
                        <td>
                            {{ getDataSiswa($value['id_siswa'])['nama_siswa'] }}
                        </td>
                        <td>
                            {{ getJkPegawai(getDataSiswa($value['id_siswa'])['jk_siswa']) }}
                        </td>
                        <td>
                            {{ getStatusDaftarAwal($value['status_pendaftaran_ulang']) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
