@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Rangking Lima Besar</h3>
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
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ totalsiswa() }}</span>
                            <span class="title">Total Siswa</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ totalguru() }}</span>
                            <span class="title">Total Guru</span>
                        </p>
                    </div>
                </div>
                @if (auth()->user()->role == 'master')
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ totaladmin() }}</span>
                            <span class="title">Total Admin</span>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop
