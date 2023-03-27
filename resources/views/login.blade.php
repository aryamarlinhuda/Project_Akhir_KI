@extends('components.komponen')
@section('judul_halaman','Login')
<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
        <div class="card-header">
            <h4 class="card-title">Login</h4>
        </div>
        <div class="card-body">
            <!-- Validasi -->
            @if (count($errors) > 0)
                <div class="container alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Message Berhasil Registrasi -->
            @if(session('register'))
            <div class="alert alert-success alert-block dismissible show fade mt-1">
                <div class="alert-body">
                    {{session('register')}}
                </div>
            </div>
            @endif
            @if(session('logout'))
            <div class="alert alert-success alert-block dismissible show fade mt-1">
                <div class="alert-body">
                    {{session('logout')}}
                </div>
            </div>
            @endif
            <form action="login/process" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                />
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <br>
            <p class="text-secondary mt-3 mb-0">Jika belum memiliki akun, silahkan registrasi terlebih dahulu!</p>
            <a href="register" class="btn btn-success">Registrasi</a>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>