<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    public function generateCSV() {
        $book = Book::orderBy('title')->get();

        $filename = '../storage/book.csv';

        $file = fopen($filename, 'w+');

        foreach ($book as $b) {
            fputcsv($file, [
                $b->title,
                $b->author,
                $b->genre,
                $b->rental_amount
            ]);
        }

        fclose($file);

        return response()->download($filename);
    }
}
