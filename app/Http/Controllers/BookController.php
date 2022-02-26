<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use Illuminate\Http\Request;
use DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function buku()
    {
        $data = Book::latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/user/buku/'.$row->id.'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        
    }

    public function index()
    {
        return view('user/book/index');
    }

    public function show($buku)
    {
        $buku = Book::where('id', $buku)->with(['bookloan' => function($qry){
                $qry->where('status', 'accepted');
            }])->first();
        $cek = BookLoan::where('member_id', auth()->guard('member')->user()->id)
            ->where('book_id', $buku->id)->where('status', '!=', 'returned')->count();
        //dd($cek);
        return view('user/book/detail', compact('buku', 'cek'));
    }

    public function loan()
    {
        return view('user/book/peminjaman');
    }

    public function bookloan(){
        $data = BookLoan::with('book')->where('member_id', auth()->guard('member')->user()->id)->latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
    }

    public function storeBook(Request $request, $id){
        $request->validate([
            'start_date' => 'required',
            'end_date'=> 'required',
        ],[
            'start_date.required' => 'Tanggal mulai tiddak boleh kosong !',
            'end_date.required' => 'Tanggal pengembalian tidak boleh kosong !',
        ]);

        $BookLoan = BookLoan::updateOrCreate([
            'book_id' => $id,
            'member_id' => auth()->guard('member')->user()->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ],[
            'book_id' => $id,
            'member_id' => auth()->guard('member')->user()->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
            'message' => 'menunggu konfirmasi admin'
        ]);

        return redirect('/user/peminjaman')->with('success', 'Berhasil meminjam buku baru!');
    }

    
}
