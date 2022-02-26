@extends('layouts.auth')

@section('body')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                <form class="theme-form login-form" method="post">
                    @csrf
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br/>
                            @endforeach
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}} <br/>
                        </div>
                    @endif
                    <h4>Masuk</h4>
                    <h6>Selamat Datang! Silakan masuk untuk melihat akun Anda.</h6>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-email"></i></span>
                            <input class="form-control" type="email" required placeholder="Contoh : email@mail.com"  name="email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                            <input class="form-control" type="password" name="password" required placeholder="*********" />
                            <div class="show-hide"><span class="show"> </span></div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="checkbox">
                            <input id="checkbox1" type="checkbox" />
                            <label for="checkbox1">Ingat Kata Sandi</label>
                        </div>
                        <a class="link" href="forget-password.html">Lupa Kata Sandi?</a>
                    </div> --}}
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Masuk</button>
                    </div>
                    {{-- <p>Tidak Punya Akun?<a class="ms-2" href="{{url('/register')}}">Buat Akun</a></p> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection