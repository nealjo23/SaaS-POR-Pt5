<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('author')->paginate(10);

        $books->getCollection()->transform(function ($book) {
            // Retrieve the author's given name
            $givenName = $book->author->given_name ?? '';

            // Retrieve the author's family name and handle null/empty values
            $familyName = $book->author->family_name ?? '';

            // Concatenate the given name and family name with a space in between
            $authorName = trim($givenName . ' ' . $familyName);

            // Append the "author_name" field to the book object
            $book->author_name = $authorName;

            // Remove the "author" relation to prevent duplicate data in the response
            unset($book->author);

            return $book;
        });

        return view('books.index', compact(['books']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
