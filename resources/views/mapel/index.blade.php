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
                            <h3 class="panel-title">Mata Pelajaran</h3>
                            </div>
                            <div class="right">
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">&nbsp&nbsp&nbsp;Tambah Mata Pelajaran &nbsp&nbsp<i class="lnr lnr-pencil"></i></button>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>NAMA LENGKAP</th>
                                        <th>TELEPON</th>
                                        <th>JENIS_KELAMIN</th>
                                        <th>AGAMA</th>
                                        <th>ALAMAT</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>

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
                <h3 class="modal-title" id="exampleModalLabel">Tambah Guru</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">

            <form action="/guru/create" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="namadepan">Nama</label>
                    <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Nama" name="nama">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                    <option value="guru">Guru</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" id="telepon" aria-describedby="emailHelp" placeholder="Telepon" name="telepon">
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


@endsection


@section('footer')
    <script>
        $(document).ready(function(){

            $('#datatable').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.get.data.guru') }}",
                columns:[
                    {data:'nama',name:'nama'},
                    {data:'telepon',name:'telepon'},
                    {data:'jenis_kelamin',name:'jenis_kelamin'},
                    {data:'agama',name:'agama'},
                    {data:'alamat',name:'alamat'},
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





