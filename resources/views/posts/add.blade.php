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
                            <h3 class="panel-title">Add New Posts</h3>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                <form action="{{ route('posts.create') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                <label for="title" class="control-label sr-only">Title</label>
                                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">
                                                @if ($errors->has('title'))
                                                    <span class="help-block">{{ $errors->first('title')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="content">Content</label>
                                                <textarea class="form-control" id="content" rows="3" name="content">{{ old('content') }}</textarea>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Pilih Gambar Posting
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="thumbnail">
                                        </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">
                                            <div class="input-group">
                                            <input type="submit" class="btn btn-info" value="Kirim">
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('footer')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
        $(document).ready(function(){
            $('#lfm').filemanager('image');
        });

</script>
@stop


