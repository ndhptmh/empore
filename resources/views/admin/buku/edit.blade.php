@extends('layouts.main') 
@section('css') 

@endsection 
@section('body')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Buku</h5>
            <br>
        </div>
        <div class="card-body">
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
@endsection 
@section('script') 
<script type="text/javascript">

    $(document).ready(function() {
       
    });

    function editData(){
        event.preventDefault();
        swal({
            title: 'Anda akan menambahkan data?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                $.ajax({
                    url: '/api/book',
                    data : {
                        "_token" : "{{csrf_token()}}",
                        title: $("#title").val(), 
                        code:$("#code").val(),
                        year:$("#year").val(),
                        writer:$("#writer").val(),
                        stock:$("#stock").val(),
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result){
                        if(result){
                            swal({ 
                                title: "Berhasil!", 
                                text: "Berhasil menambahkan data !", 
                                icon: "success" 
                            }).then(function() {
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

</script>
@endsection