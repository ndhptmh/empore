@extends('layouts.main') 
@section('css') 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection 
@section('body')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Data Peminjaman Buku</h5><span>Berikut ini adalah data peminjaman buku.</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped" id="data_pinjam">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal Mulai Pinjam</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
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
        $(function () {
          
          var table = $('#data_pinjam').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/api/bookloan",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'book.title', name: 'book.title'},
                  {data: 'start_date', name: 'start_date'},
                  {data: 'end_date', name: 'end_date'},
                  {
                      data: 'action', 
                      name: 'action', 
                      orderable: true, 
                      searchable: true
                  },
              ]
          });
          
        });
    </script>

    <script>
        function terimaPeminjaman(id){
            event.preventDefault();
            swal({
                title: 'Anda akan mengkonfirmasi peminjaman buku?',
                text: 'Stok buku akan berkurang ketika Anda mengkonfirmasi!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    $.ajax({
                        url: '/peminjaman/accept/'+id,
                        type: 'get',
                        dataType: 'json',
                        success: function(result){
                            if(result){
                                swal({ 
                                    title: "Berhasil!", 
                                    text: "Konfirmasi peminjaman berhasil diterima!", 
                                    icon: "success" 
                                }).then(function() {
                                    window.location = "/peminjaman";
                                });
                            }
                            else{
                                swal({ title: "Gagal!", text: result.message, icon: "error" })
                            }
                        },
                        error: function(err){
                            swal({ title: "Gagal!", text: "Terjadi kesalahan saat menerima desa !", icon: "error" })
                        }
                    })
                }
            });
        } 
        function tolakPeminjaman(id){
            event.preventDefault();
            swal({
                title: 'Anda akan menolak peminjaman buku?',
                text: 'Stok buku tiddak akan berkurang ketika Anda menolak!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    $.ajax({
                        url: '/peminjaman/decline/'+id,
                        type: 'get',
                        dataType: 'json',
                        success: function(result){
                            if(result){
                                swal({ 
                                    title: "Berhasil!", 
                                    text: "Konfirmasi peminjaman berhasil ditolak!", 
                                    icon: "success" 
                                }).then(function() {
                                    window.location = "/peminjaman";
                                });
                            }
                            else{
                                swal({ title: "Gagal!", text: result.message, icon: "error" })
                            }
                        },
                        error: function(err){
                            swal({ title: "Gagal!", text: "Terjadi kesalahan saat menerima desa !", icon: "error" })
                        }
                    })
                }
            });
        } 
        function returnPeminjaman(id){
            event.preventDefault();
            swal({
                title: 'Anda akan mengkonfirmasi pengembalian buku?',
                text: 'Stok buku akan bertambah ketika Anda mengkonfirmasi!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    $.ajax({
                        url: '/peminjaman/return/'+id,
                        type: 'get',
                        dataType: 'json',
                        success: function(result){
                            if(result){
                                swal({ 
                                    title: "Berhasil!", 
                                    text: "Konfirmasi pengembalian berhasil diterima!", 
                                    icon: "success" 
                                }).then(function() {
                                    window.location = "/peminjaman";
                                });
                            }
                            else{
                                swal({ title: "Gagal!", text: result.message, icon: "error" })
                            }
                        },
                        error: function(err){
                            swal({ title: "Gagal!", text: "Terjadi kesalahan saat menerima desa !", icon: "error" })
                        }
                    })
                }
            });
        } 
    </script>
@endsection