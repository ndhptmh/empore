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
                    <h5>Data Buku</h5><span>Berikut ini adalah data buku.</span>
                </div>
            </div>
            <div class="col-sm-2">
                <a href="{{url('buku/create')}}" class="btn btn-sm btn-success mt-4">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="buku_data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="editBuku" tabindex="-1" role="dialog" aria-labelledby="modalEditBuku" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditBuku">Edit Buku</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    @csrf
                                    @if(count($errors) > 0)
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }} <br/>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="row">
                                        <input type="hidden" id="id_data">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Judul Buku</label>
                                                <div class="small-group">
                                                    <input class="form-control" type="text" required id="title" name="title" value="{{old('title')}}" placeholder="Contoh: Buku Mewarnai">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Kode Buku</label>
                                                <div class="small-group">
                                                    <input class="form-control" type="text" required id="code" name="code" value="{{old('code')}}" placeholder="Contoh: BT201287">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Penulis</label>
                                                <div class="small-group">
                                                    <input class="form-control" type="text" required id="writer" name="writer" value="{{old('writer')}}" placeholder="Contoh: Jung Jaehyun">
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Tahun Terbit</label>
                                                <div class="small-group">
                                                    <input class="form-control" min="1" minlength="4" id="year" type="number" name="year" required placeholder="Contoh: 2014">
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group">
                                                <label>Stok</label>
                                                <div class="small-group">
                                                    <input class="form-control" type="number" min="1" id="stock" name="stock" required  placeholder="Contoh: 1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" onclick="editData()">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        $(function () {
          
          var table = $('#buku_data').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/api/book",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'code', name: 'code'},
                  {data: 'title', name: 'title'},
                  {data: 'writer', name: 'writer'},
                  {data: 'year', name: 'year'},
                  {data: 'stock', name: 'stock'},
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
        $('#editBuku').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({ 
                type: "GET",
                url: "/api/book/" + id,       
                success: function (data) {
                    if(data.status==1){
                        console.log(data.data.id)
                        $(e.currentTarget).find('#id_data').val(data.data.id);
                        $(e.currentTarget).find('#stock').val(data.data.stock);
                        $(e.currentTarget).find('#title').val(data.data.title);
                        $(e.currentTarget).find('#code').val(data.data.code);
                        $(e.currentTarget).find('#year').val(data.data.year);
                        $(e.currentTarget).find('#writer').val(data.data.writer);
                    }
                }
            })
        });

        function editData(){
            var id = $("#id_data").val();
            event.preventDefault();
            swal({
                title: 'Anda akan mengedit data?',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    $.ajax({
                        url: '/api/book/'+ id,
                        data : {
                            // "_token" : "{{csrf_token()}}",
                            title: $("#title").val(), 
                            code:$("#code").val(),
                            year:$("#year").val(),
                            writer:$("#writer").val(),
                            stock:$("#stock").val(),
                        },
                        type: 'put',
                        dataType: 'json',
                        success: function(result){
                            if(result){
                                swal({ 
                                    title: "Berhasil!", 
                                    text: "Berhasil mengedit data!", 
                                    icon: "success" 
                                })
                                .then(function() {
                                    window.location = "/buku";
                                });

                            }else{
                                swal({ title: "Gagal!", text: result.message, icon: "error" })
                            }
                        },
                        error: function(err){
                            swal({ title: "Gagal!", text: "Terjadi kesalahan saat menambah data !", icon: "error" })
                        }
                    })
                }
            });
        }
 
        function hapusBuku(id){
            event.preventDefault();
            swal({
                title: 'Anda akan menghapus data?',
                text: 'Data akan dihapus secara permanen!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    $.ajax({
                        url: '/api/book/'+id,
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
                                    window.location = "/buku";
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