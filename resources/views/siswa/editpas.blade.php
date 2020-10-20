@extends('layouts.master')


@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ganti Password <b>Siswa</b></h3>
                            <br>
                            Nama  : {{ $siswa->nama_lengkap() }}
                            <br>
                            Email : {{ $siswa->user->email }}
                        </div>
                        <div class="panel-body">
                            <form action="/siswa/{{$siswa->user->id}}/updatepassword" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Password" name="password" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
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

