<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use DataTables;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/buku/'.$row->id.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a> 
                    <a data-toggle="modal" data-target="#editBuku" data-id='.$row->id.' class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" type="button" onclick="hapusBuku('.$row->id.')">
                        <i class="fa fa-trash"></i>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        else{
            $book = Book::get();
            if(count($book) > 0){
                return response()->json([
                    'status' => 1,
                    'message' => 'berhasil mendapatkan data buku',
                    'data' => $book
                ]);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message' => 'belum ada data buku',
                    'data' => NULL,
                ]);
            }
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:books,code',
            'title' => 'required',
            'stock' => 'required',
            'year' => 'required',
            'writer' => 'required',
        ],
        [
            'code.required' => 'Kode Buku wajib di isi!',
            'title.required' => 'Judul Buku wajib di isi!',
            'stock.required' => 'Stok Buku wajib di isi!',
            'year.required' => 'Tahun Buku wajib di isi!',
            'writer.required' => 'Penulis Buku wajib di isi!',
        ]);

        Book::updateOrCreate([
            'code' => $request->code,
            'title' => $request->title,
        ],[
            'code' => $request->code,
            'title' => $request->title,
            'stock' => $request->stock,
            'year' => $request->year,
            'writer' => $request->writer,
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'berhasil menambah data buku',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($book)
    {
        $book = Book::whereId($book)->first();
        if($book){
            return response()->json([
                'status' => 1,
                'message' => 'berhasil mendapatkan detail data buku',
                'data' => $book
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'tidak ada buku dengan id tersebut',
                'data' => NULL
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($book)
    {
        $book = Book::whereId($book)->first();
        if($book){
            return response()->json([
                'status' => 1,
                'message' => 'berhasil mendapatkan detail data buku',
                'data' => $book
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'tidak ada buku dengan id tersebut',
                'data' => NULL
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        $book = Book::whereId($book)->first();
        if($book){
            $request->validate([
                'code' => 'required|unique:books,code,'.$book->id,
                'title' => 'required',
                'stock' => 'required',
                'year' => 'required',
                'writer' => 'required',
            ],
            [
                'code.required' => 'Kode Buku wajib di isi!',
                'title.required' => 'Judul Buku wajib di isi!',
                'stock.required' => 'Stok Buku wajib di isi!',
                'year.required' => 'Tahun Buku wajib di isi!',
                'writer.required' => 'Penulis Buku wajib di isi!',
            ]);
    
            Book::whereId($book->id)->update([
                'code' => $request->code,
                'title' => $request->title,
                'stock' => $request->stock,
                'year' => $request->year,
                'writer' => $request->writer,
            ]);  
    
            return response()->json([
                'status' => 1,
                'message' => 'berhasil mengedit data buku',
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'tidak ada buku dengan id tersebut',
                'data' => NULL
            ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($book)
    {
        $book = Book::whereId($book)->first();
        if($book){
            Book::destroy($book->id);
            return response()->json([
                'status' => 1,
                'message' => 'berhasil menghapus data buku',
                'data' => $book
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'tidak ada buku dengan id tersebut',
                'data' => NULL
            ]);
        }
    }

    public function showByCode($book)
    {
        $book = Book::whereCode($book)->first();
        if($book){
            return response()->json([
                'status' => 1,
                'message' => 'berhasil mendapatkan detail data buku',
                'data' => $book
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'tidak ada buku dengan code tersebut',
                'data' => NULL
            ]);
        }
    }

    public function updateByCode(Request $request, $book)
    {
        $book = Book::whereCode($book)->first();
        if($book){
            $request->validate([
                'code' => 'required|unique:books,code,'.$book->id,
                'title' => 'required',
                'stock' => 'required',
                'year' => 'required',
                'writer' => 'required',
            ],
            [
                'code.required' => 'Kode Buku wajib di isi!',
                'title.required' => 'Judul Buku wajib di isi!',
                'stock.required' => 'Stok Buku wajib di isi!',
                'year.required' => 'Tahun Buku wajib di isi!',
                'writer.required' => 'Penulis Buku wajib di isi!',
            ]);
    
            Book::whereId($book->id)->update([
                'code' => $request->code,
                'title' => $request->title,
                'stock' => $request->stock,
                'year' => $request->year,
                'writer' => $request->writer,
            ]);  
    
            return response()->json([
                'status' => 1,
                'message' => 'berhasil mengedit data buku',
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'tidak ada buku dengan code tersebut',
                'data' => NULL
            ]);
        } 
    }

    public function destroyByCode($book)
    {
        $book = Book::whereCode($book)->first();
        if($book){
            Book::destroy($book->id);
            return response()->json([
                'status' => 1,
                'message' => 'berhasil menghapus data buku',
                'data' => $book
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'tidak ada buku dengan code tersebut',
                'data' => NULL
            ]);
        }
    }
}
