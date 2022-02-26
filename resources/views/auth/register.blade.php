@extends('layouts.auth')
@section('body')     
    <div class="container-fluid p-0"> 
        <div class="row m-0">
            <div class="col-12 p-0">    
                <div class="login-card">
                    <form action="{{url('register')}}" method="POST" class="theme-form login-form" style="width:50%">
                        @csrf
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br/>
                                @endforeach
                            </div>
                        @endif
                        <h4>Tidak Punya Akun?</h4>
                        <h6>Silakan isi form di bawah ini!</h6>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <div class="small-group">
                                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                        <input class="form-control" type="text" required name="name" value="{{old('name')}}" placeholder="Nama Lengkap">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                        <input class="form-control" type="email" required name="email" value="{{old('email')}}" placeholder="Contoh : Test@gmail.com">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                        <input class="form-control" type="password" name="password" required name="name" placeholder="*********">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Konfirmasi Kata Sandi</label>
                                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                        <input class="form-control" type="password" name="password_confirmation" required name="name" placeholder="*********">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Buat Akun</button>
                        </div>

                        <p>Sudah Punya Akun ?<a class="ms-2" href="{{url('/login')}}">Masuk </a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
