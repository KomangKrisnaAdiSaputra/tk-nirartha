<body>
    <table style="width: 100%; margin-top: 50px;">
        <tr>
            <th style="text-align: start; font-size: 18px; font-weight: bold">Detail Pengumuman</th>
            <th style="text-align: right;">
                <h2>Tk Nirartha 2</h2>
            </th>
        </tr>
    </table>

    <table style="width: 100%; margin-bottom: 12px; border: solid 1px #d8d8d8">
        <tr style="background-color: #d8d8d8">
            <th colspan="2">{{ \Carbon\Carbon::parse($data['tgl_pengumuman'])->isoFormat('dddd, D MMMM Y') }}</th>
        </tr>
        <tr>
            <th colspan="2" style="text-align: start">
                {{ $data['isi_pengumuman'] }}
            </th>
        </tr>
    </table>
</body>
