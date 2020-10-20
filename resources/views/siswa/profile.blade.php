
@extends('layouts.master')



@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@stop


@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            @if (session('sukses'))
            <div class="alert alert-success" role="alert">
                {{ session('sukses') }}
            </div>
            @elseif (session('deletenilaimapel'))
            <div class="alert alert-danger" role="alert">
                {{ session('deletenilaimapel') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img width="200" height="200" src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar">
                                <h3 class="name">{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        <span>Mata Pelajaran</span>{{ $siswa->mapel->count() }}
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        <span>Rata Rata Nilai</span>{{ $siswa->rataRataNilai()}}
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        {{ $siswa->jumlahNilai() }}<span>Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Data Detail</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>Nama Lengkap <span>{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</span></li>
                                    <li>Email <span>{{ $siswa->user->email }}</span></li>
                                    <li>Jenis Kelamin <span>{{ $siswa->jenis_kelamin }}</span></li>
                                    <li>Agama<span>{{ $siswa->agama }}</span></li>
                                    <li>Alamat<span>{{ $siswa->alamat }}</span></li>
                                </ul>
                            </div>
                            <div class="text-center"><a href="/siswa/{{ $siswa->id }}/edit" class="btn btn-primary">Edit Profile</a></div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">

                        @if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah Nilai
                        </button>
                        @endif
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Mata Pelajaran {{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>SEMESTER</th>
                                            <th>NILAI</th>
                                            <th>Guru</th>
                                            @if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
                                            <th>AKSI</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($siswa->mapel as $mapel)
                                        <tr>
                                            <td>{{ $mapel->kode }}</td>
                                            <td>{{ $mapel->nama }}</td>
                                            <td>{{ $mapel->semester }}</td>
                                            <td>
                                                <a href="#" class="nilai" data-type="text" data-pk="{{ $mapel->id }}" data-url="/api/siswa/{{ $siswa->id }}/editnilai" data-title="Masukan Nilai">{{ $mapel->pivot->nilai }}</a>
                                            </td>
                                            <td>
                                                <a href="/guru/{{ $mapel->guru_id }}/profile">{{ $mapel->guru->nama }}</a></td>
                                            {{-- <td>
                                                <a href="/siswa/{{ $siswa->id }}/{{ $mapel->id }}/deletenilai" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Hapus..?')">Hapus</a
                                            </td> --}}
                                            @if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm deletemapel" mapel-id="{{ $mapel->id }}" mapel-nama="{{ $mapel->nama }}" siswa-id="{{ $siswa->id }}">Hapus</a
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="chartNilai">

                            </div>

                        </div>
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

{{--  rangking di halaman profile  --}}
{{--  <div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Rangking Lima Besar</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>RANGKING</th>
                                        <th>NAMA</th>
                                        <th>NILAI</th>
                                        @if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
                                        <th>AKSI</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nomor = 1;
                                    @endphp

                                    @foreach (rangking5Besar() as $s)
                                    <tr>
                                        <td>{{ $nomor }}</td>
                                        <td>{{ $s->nama_lengkap()}}</td>
                                        <td>{{ $s->rataRataNilai }}</td>

                                        @if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
                                        <td>
                                        <a href="/siswa/{{ $s->id }}/profile" class="btn btn-info btn-sm">Profil</a>
                                        </td>
                                        @endif
                                    </tr>
                                    @php
                                    $nomor++;
                                    @endphp

                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  --}}
{{--  akhir rangking di halaman profile  --}}



// modal mata pelajaran

@if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/siswa/{{ $siswa->id }}/addnilai" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="mapel">Mata Pelajaran</label>
                        <select class="form-control" id="mapel" name="mapel">

                            @foreach ($matapelajaran as $mp)
                            <option value="{{ $mp->id }}">{{ $mp->nama }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="text" class="form-control" id="nilai" aria-describedby="emailHelp" placeholder="Nilai" name="nilai"value="{{ old('nilai') }}">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endif


// akhir modal mata pelajaran

@stop


@section('footer')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

@if (auth()->user()->role == 'master' || auth()->user()->role == 'admin')
<script>
    Highcharts.chart('chartNilai', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Laporan Nilai Siswa'
        },
        subtitle: {
            text: 'Dew-Kzh'
        },
        xAxis: {
            categories:{!! json_encode($categories) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nilai'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Nilai',
            data: {!! json_encode($data) !!}

        }]
    });

    $(document).ready(function() {
        $('.nilai').editable();
    });
</script>
@endif

    <script>
        $('.deletemapel').click(function(){
            var mapel_id = $(this).attr('mapel-id');
            var mapel_nama = $(this).attr('mapel-nama');
            var siswa_id = $(this).attr('siswa-id');
            swal({
                    title: "Yakin?",
                    text: ""+mapel_nama+" Mau Di Hapus !!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/siswa/"+siswa_id+"/"+mapel_id+"/deletenilai";
                    }
                });
        });
    </script>
@stop



