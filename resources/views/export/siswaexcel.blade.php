<table>
    <thead>
    <tr>
        <th>NO</th>
        <th>NAMA LENGKAP</th>
        <th>JENIS KELAMIN</th>
        <th>AGAMA</th>
        <th>ALAMAT</th>
        <th>RATA RATA NILAI</th>
    </tr>
    </thead>
    <tbody>
            @php
            $nomor = 1;
            @endphp
        @foreach($siswaexcel as $siscel)
            <tr>
                <td>{{ $nomor }}</td>
                <td>{{ $siscel->nama_lengkap() }}</td>
                <td>{{ $siscel->jenis_kelamin}}</td>
                <td>{{ $siscel->agama }}</td>
                <td>{{ $siscel->alamat }}</td>
                <td>{{ $siscel->rataRataNilai()}}</td>
            </tr>
                @php
                $nomor++;
                @endphp
        @endforeach
    </tbody>
</table>
