<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Klorofil - Free Bootstrap Dashboard Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/linearicons/style.css') }}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admin/assets/img/favicon.png') }}">
</head>

<body>
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Register Siswa</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-auth-small" action="/site/siswa/register" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('nama_depan') ? 'has-error' : '' }}">
                                        <label for="nama_depan" class="control-label sr-only">Nama Depan</label>
                                        <input type="text" class="form-control" id="nama_depan" placeholder="Nama Depan" name="nama_depan" value="{{ old('nama_depan') }}">
                                        @if ($errors->has('nama_depan'))
                                            <span class="help-block">{{ $errors->first('nama_depan')}}</span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="nama_belakang" class="control-label sr-only">Nama Belakang</label>
                                        <input type="text" class="form-control" id="nama_belakang" placeholder="Nama Belakang" name="nama_belakang" value="{{ old('nama_belakang') }}">
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="email" class="control-label sr-only">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password" class="control-label sr-only">Password</label>
                                        <input type="password" class="form-control" id="password"
                                        placeholder="Password" name="password">
                                        @if ($errors->has('password'))
                                        <span class="help-block">{{ $errors->first('password')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                                        <label for="jenis_kelamin"></label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="L"{{(old('jenis_kelamin') == 'L') ? 'selected' : '' }}>Laki Laki</option>
                                        <option value="P"{{(old('jenis_kelamin') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @if ($errors->has('jenis_kelamin'))
                                        <span class="help-block">{{ $errors->first('jenis_kelamin')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                        <label for="agama"></label>
                                        <input type="text" class="form-control" id="agama" aria-describedby="emailHelp" placeholder="Agama" name="agama" value="{{ old('agama') }}">
                                        <small id="emailHelp" class="form-text text-muted"></small>
                                        @if ($errors->has('agama'))
                                        <span class="help-block">{{ $errors->first('agama')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" rows="2" name="alamat">{{ old('alamat') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">REGISTER</button>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

</body>

</html>
