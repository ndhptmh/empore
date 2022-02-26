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
            return response([
                'status' => 1,
                'message' => 'berhasil mendapatkan data',
                'data' => $book,
            ]);
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
    public function show(Book $book)
    {
        return response()->json([
            'status' => 1,
            'message' => 'berhasil mendapatkan detail data buku',
            'data' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return response()->json([
            'status' => 1,
            'message' => 'berhasil mendapatkan detail data buku',
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
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
            'message' => 'berhasil mengedit data Provider',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return response()->json([
            'status' => 1,
            'message' => 'berhasil menghapus data buku',
        ]);
    }
}
