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
                            <h3 class="panel-title">Data Siswa</h3>
                            </div>
                            <div class="right">
                                <a href="" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importSiswa">&nbsp&nbsp&nbsp;Import Exel &nbsp&nbsp</a>
                                <a href="/siswa/exportExcel" class="btn btn-primary btn-sm">Export Excel</a>
                                <a href="/siswa/exportpdf" class="btn btn-primary btn-sm">Export PDF</a>
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">&nbsp&nbsp&nbsp;Tambah Data Siswa &nbsp&nbsp<i class="lnr lnr-pencil"></i></button>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        {{--  <th>NO</th>  --}}
                                        <th>NAMA LENGKAP</th>
                                        {{--  <th>NAMA DEP</th>
                                        <th>NAMA BELAK</th>  --}}
                                        <th>KELAMIN</th>
                                        <th>AGAMAnya ada adalah</th>
                                        <th>ALAMAT</th>
                                        <th>Rata Rata</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{--  @php
                                        $nomor = 1;
                                    @endphp
                                    @foreach ($data_siswa as $siswa )
                                    <tr>
                                        <td>{{ $nomor }}</td>
                                        <td>{{ $siswa->nama_depan }}</td>
                                        <td>{{ $siswa->nama_belakang }}</td>
                                        <td>{{ $siswa->jenis_kelamin }}</td>
                                        <td>{{ $siswa->agama }}</td>
                                        <td>{{ $siswa->alamat }}</td>
                                        <td>{{ $siswa->rataRataNilai() }}</td>
                                        <td class="text-center">
                                            <a href="/siswa/{{ $siswa->id }}/profile" class="btn btn-primary btn-sm">Prof</a>
                                            <a href="/siswa/{{ $siswa->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete" siswa-id="{{ $siswa->id }}" siswa-nama="{{ $siswa->nama_lengkap() }}">Hapus</a>
                                            <a href="/siswa/{{ $siswa->id }}/rubahpassword" class="btn btn-success btn-sm">Pass</a>
                                        </td>
                                    </tr>
                                    @php
                                    $nomor++;
                                    @endphp
                                    @endforeach  --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal siswa -->
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
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                    <option value="siswa">Siswa</option>
                    </select>
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
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cencel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal siswa -->

<!-- Modal import siswa -->
<div class="modal fade" id="importSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Import Data Siswa</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">

            <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Import</label>
                    <input type="file" class="form-control" aria-describedby="emailHelp" name="data_siswa">
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Import" class="btn btn-primary btn-sm">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir Modal import siswa -->

@endsection


@section('footer')
    <script>
        $(document).ready(function(){

            $('#datatable').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.get.data.siswa') }}",
                columns:[
                    {data:'nama_lengkap',name:'nama_lengkap'},
                    {data:'jenis_kelamin',name:'jenis_kelamin'},
                    {data:'agama',name:'agama'},
                    {data:'alamat',name:'alamat'},
                    {data:'rata2_nilai',name:'rata2_nilai'},
                    {data:'aksi',name:'aksi'},
                ]
            });

            $('body').on('click','.delete',function(){
                var siswa_id = $(this).attr('siswa-id');
                var siswa_nama_lengkap = $(this).attr('siswa-nama');
                swal({
                        title: "Yakin?",
                        text: ""+siswa_nama_lengkap+" Mau Di Hapus !!",
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






