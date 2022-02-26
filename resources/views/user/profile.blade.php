@extends('layouts.main')

@section('body')
<div class="col-12">
    <div class="card card-body">
        <div class="row">
            <div class="col-12 col-md-4">
                <label class="form-label">Photo</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" required>
                    <label class="custom-file-label" for="file">Pilih file...</label>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="mb-3">
                    <label class="form-label" for="name">Nama</label>
                    <input class="form-control" id="name" type="name" name="name" value="{{auth()->user()->name}}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" value="{{auth()->user()->email}}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" id="password" type="password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input class="form-control" id="password_confirmation" type="password" placeholder="Konfirmasi Password">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection