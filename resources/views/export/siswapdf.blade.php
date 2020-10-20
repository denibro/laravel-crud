<table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA LENGKAP</th>
                <th>JENIS KELAMIN</th>
                <th>AGAMA</th>
                <th>RATA RATA NILAI</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($siswa as $s)
            <tr>
                <td>{{$nomor}}</td>
                <td>{{ $s->nama_lengkap() }}</td>
                <td>{{ $s->jenis_kelamin}}</td>
                <td>{{ $s->agama }}</td>
                <td>{{ $s->rataRataNilai()}}</td>
            </tr>
            @php
            $nomor++;
            @endphp
            @endforeach


        </tbody>
</table>
