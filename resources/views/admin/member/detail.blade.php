@extends('layouts.main') 
@section('css') 


@endsection 
@section('body')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Detail Member</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                @if($member != null)
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$member->name}}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td>{{$member->username}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$member->email}}</td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection 
@section('script') 
    <!-- Plugins JS start-->

@endsection