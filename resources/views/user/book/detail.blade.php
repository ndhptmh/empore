@extends('layouts.main') 
@section('css') 

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection 
@section('body')
<div class="col-sm-12">
    <div class="card">
        <div class="row">
            <div class="col-sm-10">
                <div class="card-header">
                    <h5>Detail Buku</h5>
                    <span>{{$cek != 0 ? 'Anda sedang meminjam/menunggu konfirmasi admin untuk buku ini' : ''}}</span>
                   

                </div>
            </div>
            <div class="col-sm-2">
                <button data-toggle="modal" data-target="#pinjamModal" data-id="{{$buku}}" class="btn btn-sm btn-success text-white mt-4" {{$buku->stock == 0 || $cek != 0 ? 'disabled' : '' }}>Pinjam</button>
            </div>
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

        <!-- Modal -->
        <div class="modal fade" id="pinjamModal" tabindex="-1" role="dialog" aria-labelledby="modalPinjam" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPinjam">Pinjam Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/user/bookloan/{{$buku->id}}">
                            @csrf
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
                                        <label>Tanggal Mulai Pinjam</label>
                                        <div class="small-group">
                                            <input class="form-control" type="date" min="{{date('Y-m-d')}}" required id="start_date" name="start_date" value="{{old('start_date')}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Tanggal Pengembalian</label>
                                        <div class="small-group">
                                            <input class="form-control" type="date" required id="end_date" name="end_date" value="{{old('end_date')}}">
                                        </div>
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
        </div>
    </div>
</div>
@endsection 
@section('script') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $("#start_date").on("change",function(){
        var selected = $(this).val();
        //console.log(selected)
        $('#end_date').attr('min' , selected);
    });
</script>

@endsection