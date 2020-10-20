@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            @if (session('sukses'))
            <div class="alert alert-success" role="alert">
                {{ session('sukses') }}
            </div>
            @elseif (session('delete'))
            <div class="alert alert-danger" role="alert">
                {{ session('delete') }}
            </div>
            @elseif (session('updatepasssiswa'))
            <div class="alert alert-success" role="alert">
                {{ session('updatepasssiswa') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="container">
                            <h3 class="panel-title">Posts</h3>
                            </div>
                            <div class="right">
                                <a href="{{ route('posts.add') }}" class="btn btn-primary btn-sm">Add New Post</a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TITLE</th>
                                        <th>USER</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post )
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td class="text-center">
                                            <a target="_blank" href="{{ route('site.single.post',$post->slug) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
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


@endsection


@section('footer')
    <script>
        $('.delete').click(function(){
            var siswa_id = $(this).attr('siswa-id');
            var siswa_nama = $(this).attr('siswa-nama');
            swal({
                    title: "Yakin?",
                    text: ""+siswa_nama+" Mau Di Hapus !!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/siswa/"+siswa_id+"/delete";
                    }
                });
        });
    </script>
@stop





{{--  @section('content1')

    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
    @elseif (session('delete'))
    <div class="alert alert-danger" role="alert">
        {{ session('delete') }}
    </div>
    @endif

    <div class="row">
        <div class="col-6">
            <h1>Data Siswa</h1>
        </div>
        <div class="col-6">
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#exampleModal">
                Tambah Data Siswa
                </button>
            <!-- akhir Button trigger modal -->
        </div>
        <table class="table table-hover">
        <tr>
            <th>NAMA DEPAN</th>
            <th>NAMA BELAKANG</th>
            <th>JENIS KELAMIN</th>
            <th>AGAMA</th>
            <th>ALAMAT</th>
            <th>AKSI</th>
        </tr>
        @foreach ($data_siswa as $siswa )
        <tr>
            <td>{{ $siswa->nama_depan }}</td>
            <td>{{ $siswa->nama_belakang }}</td>
            <td>{{ $siswa->jenis_kelamin }}</td>
            <td>{{ $siswa->agama }}</td>
            <td>{{ $siswa->alamat }}</td>
            <td>
                <a href="/siswa/{{ $siswa->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                <a href="/siswa/{{ $siswa->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Hapus..?')">Hapus</a></td>
        </tr>
        @endforeach

        </table>
    </div>

    <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">

                        <form action="/siswa/create" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="namadepan">Nama Depan</label>
                                <input type="text" class="form-control" id="namadepan" aria-describedby="emailHelp" placeholder="Nama Depan" name="nama_depan">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="namabelakang">Nama Belakang</label>
                                <input type="text" class="form-control" id="namabelakang" aria-describedby="emailHelp" placeholder="Nama Belakang" name="nama_belakang">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
                                <option value="L">Laki Laki</option>
                                <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <input type="text" class="form-control" id="agama" aria-describedby="emailHelp" placeholder="Agama" name="agama">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="2" name="alamat"></textarea>
                            </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <!-- akhir Modal -->

@endsection  --}}






