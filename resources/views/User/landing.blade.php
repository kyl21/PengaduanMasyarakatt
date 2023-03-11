@extends('layouts.user')
@section('css')
@endsection
@section('title', 'Pengaduan Masyarakat')
@section('content')
<section class="header bg-white align-items-center justify-content-center">
    <br>
    <br>
    <br>
    <nav class="navbar navbar-expand-lg  fixed-top">
        <div class="container ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">

                    <h4 class="semi-bold mb-0 text-dark">Pengaduan Masyarakat Desa Citeko</h4>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::guard('masyarakat')->check())
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-dark" href="{{ route('pekat.laporan') }}">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-dark" href="{{ route('pekat.logout') }}"
                                style="text-decoration: underline">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center cursor-pointer">
                        <li class="nav-item">
                            <button class="btn teks-dark" type="button" class="btn btn" data-toggle="modal"
                                data-target="#loginModal">Masuk</button>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.formRegister') }}" class="btn btn text-dark">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.laporan') }}" class="btn btn text-dark">Laporan</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</section>

<div class="row mx-1  pb-5">
    <div class="col-lg-6 col-10 col">
        <div class="content">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
            @if (Session::has('pengaduan'))
            <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
            @endif
            <div class=" mb-3 text-center "><h1>---Tulis Laporan Disini---</h1></div>
            <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data" class="border-rounded">
                @csrf
                <div class="form-group ">
                    <input type="text" value="{{ old('judul_laporan') }}" name="judul_laporan"
                        placeholder="Masukkan Judul Laporan" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                        rows="4">{{ old('isi_laporan') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian"
                        placeholder="Pilih Tanggal Kejadian" class="form-control" onfocusin="(this.type='date')"
                        onfocusout="(this.type='text')">
                </div>
                <div class="form-group">
                    <textarea name="lokasi_kejadian" id="latlang" rows="3" class="form-control mb-3"
                        placeholder="Lokasi Kejadian">{{ old('lokasi_kejadian') }}</textarea>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <select name="kategori_kejadian" class="custom-select" id="inputGroupSelect01" required>
                            <option value="" selected>Pilih Kategori Kejadian</option>
                            <option value="agama">Agama</option>
                            <option value="hukum">Hukum</option>
                            <option value="lingkungan">Lingkungan</option>
                            <option value="sosial">Sosial</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-custom mt-2 bg-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="mt-3">Masuk terlebih dahulu</h3>
                <p>Silahkan masuk menggunakan akun yang sudah didaftarkan.</p>
                <form action="{{ route('pekat.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username atau Email</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-danger text-white mt-3" style="width: 100%">MASUK</button>
                </form>
                @if (Session::has('pesan'))
                <div class="alert alert-danger mt-2">
                    {{ Session::get('pesan') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');

</script>
@endif
@endsection
