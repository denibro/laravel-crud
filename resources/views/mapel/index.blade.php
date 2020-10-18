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
                <div class="col-md-10">
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
                                        <th>KODE MAPEL</th>
                                        <th>MAPEL</th>
                                        <th>SEMESTER</th>
                                        <th>GURU</th>
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

            <form action="/mapel/create" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="kodemapel">Kode Mapel</label>
                    <input type="text" class="form-control" id="kodemapel" aria-describedby="emailHelp" placeholder="Kode Mapel" name="kode">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Pelajaran</label>
                    <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Nama Pelajaran" name="nama">
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" class="form-control" id="semester" aria-describedby="emailHelp" placeholder="Semester" name="semester">
                </div>
                <div class="form-group">
                    <label for="namaguru">Pilih Guru</label>
                    <select class="form-control" id="namaguru" name="guru_id">
                            <option value="">-Pilih-</option>
                            @foreach ($guru as $g)
                            <option value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                    </select>
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
                ajax:"{{ route('ajax.get.data.mapel') }}",
                columns:[
                    {data:'kode',name:'kode'},
                    {data:'nama',name:'nama'},
                    {data:'semester',name:'semester'},
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





