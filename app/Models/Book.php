<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';

    protected $fillable = [
        'code',
        'title',
        'stock',
        'year',
        'writer',
    ];

    public function bookLoan()
    {
        return $this->hasMany(BookLoan::class, 'book_id');
    }
}
