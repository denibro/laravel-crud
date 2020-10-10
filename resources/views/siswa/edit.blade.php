@extends('layouts.master')


@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Update Data Siswa</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/siswa/{{ $siswa->id }}/{{ $siswa->user->id }}/update" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="namadepan">Nama Depan</label>
                                    <input type="text" class="form-control" id="namadepan" aria-describedby="emailHelp" placeholder="Nama Depan" name="nama_depan" value="{{ $siswa->nama_depan }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="namabelakang">Nama Belakang</label>
                                    <input type="text" class="form-control" id="namabelakang" aria-describedby="emailHelp" placeholder="Nama Belakang" name="nama_belakang" value="{{ $siswa->nama_belakang }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email" name="email" value="{{ $siswa->user->email }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
                                    <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki Laki</option>
                                    <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input type="text" class="form-control" id="agama" aria-describedby="emailHelp" placeholder="Agama" name="agama" value="{{ $siswa->agama }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" rows="2" name="alamat">{{ $siswa->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <input type="file" class="form-control" aria-describedby="emailHelp" name="avatar">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    <a href="/siswa/{{ $siswa->id }}/profile" class="btn btn-info btn-md">Cencel</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop


{{--  @section('content1')

    <h1>Edit Data Siswa</h1>
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
    @endif

    <div class="row">
        <div class="col">
            <form action="/siswa/{{ $siswa->id }}/update" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="namadepan">Nama Depan</label>
                    <input type="text" class="form-control" id="namadepan" aria-describedby="emailHelp" placeholder="Nama Depan" name="nama_depan" value="{{ $siswa->nama_depan }}">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="namabelakang">Nama Belakang</label>
                    <input type="text" class="form-control" id="namabelakang" aria-describedby="emailHelp" placeholder="Nama Belakang" name="nama_belakang" value="{{ $siswa->nama_belakang }}">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
                    <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki Laki</option>
                    <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <input type="text" class="form-control" id="agama" aria-describedby="emailHelp" placeholder="Agama" name="agama" value="{{ $siswa->agama }}">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="2" name="alamat">{{ $siswa->alamat }}</textarea>
                </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/siswa" class="btn btn-secondary btn-md">Cencel</a>
            </form>
        </div>
    </div>

@endsection  --}}



