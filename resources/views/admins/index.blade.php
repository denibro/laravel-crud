@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            @if (session('tambahadmin'))
            <div class="alert alert-success" role="alert">
                {{ session('tambahadmin') }}
            </div>
            @elseif (session('deleteadmin'))
            <div class="alert alert-danger" role="alert">
                {{ session('deleteadmin') }}
            </div>
            @elseif (session('updateadmin'))
            <div class="alert alert-success" role="alert">
                {{ session('updateadmin') }}
            </div>
            @elseif (session('updatepassadmin'))
            <div class="alert alert-success" role="alert">
                {{ session('updatepassadmin') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="container">
                            <h3 class="panel-title">Data admin</h3>
                            </div>
                            <div class="right">
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">&nbsp&nbsp&nbspTambah Data Admin &nbsp&nbsp<i class="lnr lnr-pencil"></i></button>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $nomor = 1;
                                    @endphp

                                    @foreach ($admin as $ad)
                                    <tr>
                                        <td>{{ $nomor }}</td>
                                        <td>{{ $ad->nama }}</td>
                                        <td>{{ $ad->user->email }}</td>
                                        <td>
                                            <a href="/admins/{{$ad->id}}/profile" class="btn btn-primary btn-sm">Profil</a>
                                            <a href="/admins/{{$ad->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                            {{--  <a href="/admins/{{$ad->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Hapus..?')">Hapus</a>  --}}
                                            <a href="#" class="btn btn-danger btn-sm deleteadmin" admin-id="{{ $ad->id }}" admin-nama="{{ $ad->nama }}">Hapus</a>
                                            <a href="/admins/{{$ad->user->id}}/rubahpassword" class="btn btn-success btn-sm">Ganti Password</a>
                                        </td>
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
</div>

<!-- Modal admin -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">

            <form action="/admins/create" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="namadepan">Nama</label>
                    <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Nama" name="nama">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                    <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Password" name="password">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cencel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal admin-->

@endsection

@section('footer')
    <script>
        $('.deleteadmin').click(function(){
            var admin_id = $(this).attr('admin-id');
            var admin_nama = $(this).attr('admin-nama');
            swal({
                    title: "Yakin?",
                    text: ""+admin_nama+" Mau Di Hapus !!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/admins/"+admin_id+"/delete";
                    }
                });
        });
    </script>

@stop

