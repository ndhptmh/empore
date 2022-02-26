<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookLoan;
use App\Models\Book;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman = BookLoan::get();
        return view('admin/peminjaman/index', compact('peminjaman'));
    }

    public function decline($id){
        //dd($request);
        $form_data = [
            'status' => 'declined',
            'message' => 'Peminjaman buku ditolak'
        ];
        BookLoan::whereId($id)->update($form_data);
        
        return response()->json([
            'status' => 0,
            'message' => 'Peminjaman buku berhasil ditolak',
            'data' => NULL
        ]);
    }

    public function accept($id){
        $form_data = [
            'status' => 'accepted',
            'message' => 'Peminjaman buku diterima'
        ];
        BookLoan::whereId($id)->update($form_data);

        $loan = BookLoan::findOrFail($id);
        $book = Book::findorFail($loan->book_id);
        Book::whereId($book->id)->update([
            'stock' => $book->stock - 1,
        ]);

        return $loan;
    }

    public function returned($id){
        $form_data = [
            'status' => 'returned',
            'message' => 'Berhasil mengembalikan buku'
        ];
        BookLoan::whereId($id)->update($form_data);

        $loan = BookLoan::findOrFail($id);
        $book = Book::findorFail($loan->book_id);
        Book::whereId($book->id)->update([
            'stock' => $book->stock + 1,
        ]);

        return $loan;
    }
}
