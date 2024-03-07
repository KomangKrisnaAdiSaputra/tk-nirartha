<body>
    <div style="margin-bottom: 10mm; margin-top: 50px;">
        <p>
            Kepada Orang Tua {{ getDataSiswa($data['id_siswa'])['nama_siswa'] }}
        </p>
        <p>
            @if ($data['status_biaya'] == '0')
                Pembayaran Anda Bulan {{ carbon(true, $data['bulan_biaya'], 'm', 'MMMM') }} Belum Dibayar, Mohon
                Segera Di Bayar
            @elseif($data['status_biaya'] == '1')
                Pembayaran Anda Bulan {{ carbon(true, $data['bulan_biaya'], 'm', 'MMMM') }} Telah Selesai, Terima Kasih
            @elseif($data['status_biaya'] == '2')
                Pembayaran Anda Bulan {{ carbon(true, $data['bulan_biaya'], 'm', 'MMMM') }} Gagal Di Validasi, Mohon
                Untuk
                Menginput Ulang Bukti Pembayaran Terima Kasih
            @endif
        </p>
    </div>
    <table style="width: 100%;">
        <tr>
            <th style="text-align: start; font-size: 18px; font-weight: bold">Detail Pembayaran</th>
            <th style="text-align: right;">
                <h2>Tk Nirartha 2</h2>
            </th>
        </tr>
    </table>

    <table style="width: 100%; margin-bottom: 12px; border: solid 1px #d8d8d8">
        <tr style="background-color: #d8d8d8">
            <th colspan="2">{{ $data['nama_biaya'] }}</th>
        </tr>
        <tr>
            <td style="width: 90px">Tanggal</td>
            <td>: <span>{{ carbon(true, $data['bulan_biaya'], 'm', 'MMMM') . ' ' . $data['tahun_biaya'] }}</span></td>
        </tr>
        <tr>
            <td style="width: 90px">Status</td>
            <td>: <span>{{ getStatusDaftarAwal((string) $data['status_biaya']) }}</span></td>
        </tr>
    </table>
</body>
