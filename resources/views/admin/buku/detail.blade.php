@extends('layouts.main') 
@section('css') 


@endsection 
@section('body')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Detail Buku</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                @if($buku != null)
                <tbody>
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td>{{$buku->title}}</td>
                    </tr>
                    <tr>
                        <td>Kode</td>
                        <td>:</td>
                        <td>{{$buku->code}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Seluruhnya</td>
                        <td>:</td>
                        <td>{{$buku->stock}}</td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>:</td>
                        <td>{{$buku->stock - count($buku->bookloan)}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Peminjaman</td>
                        <td>:</td>
                        <td>{{count($buku->bookloan)}}</td>
                    </tr>
                    <tr>
                        <td>Penulis</td>
                        <td>:</td>
                        <td>{{$buku->writer}}</td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td>{{$buku->year}}</td>
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