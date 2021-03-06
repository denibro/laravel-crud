@extends('layouts.master')


@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Update Data Admin</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/admins/{{ $admin->id }}/{{ $admin->user->id }}/update" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="namadepan">Nama</label>
                                    <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Nama" name="nama" value="{{ $admin->nama }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email" value="{{ $admin->user->email }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role">
                                    <option value="admin">Admin</option>
                                    </select>
                                </div>
                                {{--  <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Password" name="password">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>  --}}
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    <a href="#" class="btn btn-info btn-md">Cencel</a>
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



