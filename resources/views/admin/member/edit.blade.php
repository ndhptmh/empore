@extends('layouts.main') 
@section('css') 

@endsection 
@section('body')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Anggota</h5>
            <br>
        </div>
        <div class="card-body">
            <form action="{{url('member/'.$member->id)}}" method="POST">
                @csrf
                @method('patch')
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br/>
                        @endforeach
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <div class="small-group">
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                <input class="form-control" type="text" required name="name" value="{{$member->name}}" placeholder="Nama Lengkap">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Username</label>
                            <div class="small-group">
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                <input class="form-control" type="text" required name="username" value="{{$member->username}}" placeholder="username">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" required name="email" value="{{$member->email}}" placeholder="Contoh : Test@gmail.com">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Kata Sandi</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password"  name="name" placeholder="*********">
                            </div>
                            <small> Kosongkan kata sandi jika tidak ingin diubah </small>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password_confirmation" name="name" placeholder="*********">
                            </div>
                            <small> Kosongkan Konfirmasi kata sandi jika tidak ingin diubah </small>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 
@section('script') 
    
@endsection