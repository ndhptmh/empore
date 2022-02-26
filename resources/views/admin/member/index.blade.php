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
            <h5>Data Anggota</h5><span>Berikut ini adalah data Anggota yang terdaftar.</span>
            <br>
            <a href="{{url('member/create')}}" class="btn btn-sm btn-success">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="data_member">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
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
          
          var table = $('#data_member').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/api/member",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'username', name: 'username'},
                  {data: 'email', name: 'email'},
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
        function hapusMember(id){
            event.preventDefault();
            swal({
                title: 'Anda akan menghapus data?',
                text: 'Data akan dihapus secara permanen!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    $.ajax({
                        url: '/member/'+id,
                        data : {
                            "_token" : "{{csrf_token()}}"
                        },
                        type: 'delete',
                        dataType: 'json',
                        success: function(result){
                            if(result){
                                swal({ 
                                    title: "Berhasil!", 
                                    text: "Penghapusan berhasil dilakukan !.", 
                                    icon: "success" 
                                }).then(function() {
                                    window.location = "/member";
                                });
    
                            }else{
                                swal({ title: "Gagal!", text: result.message, icon: "error" })
                            }
                        },
                        error: function(err){
                            swal({ title: "Gagal!", text: "Terjadi kesalahan saat menghapus data !", icon: "error" })
                        }
                    })
                }
            });
        } 
    </script>
@endsection