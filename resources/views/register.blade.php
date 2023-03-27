@extends('components.komponen')
@section('judul_halaman','Registrasi')
<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
        <div class="card-header">
            <h4 class="card-title">Registrasi</h4>
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
            <form action="register/process" method="POST">
                @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                type="email"
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
            <div class="mb-3">
                <label for="confpassword" class="form-label"
                >Confirm Password</label
                >
                <input
                type="password"
                class="form-control"
                id="confpassword"
                name="confpassword"
                />
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>