<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;

class BookController extends Controller
{
    private function getGenreName($genre)
    {
        return $genre->name ?? 'Unknown Genre';
    }

    private function getSubGenreName($subGenre)
    {
        return $subGenre->name ?? 'Unknown Sub-Genre';
    }

    private function getPublisherName($publisher)
    {
        return $publisher->name ?? 'Unknown Publisher';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['author', 'genre', 'subGenre', 'publisher'])->paginate(10);

        $books->getCollection()->transform(function ($book) {
//            $book->author_name = $this->getAuthorFullName($book->author);
            $book->genre_name = $this->getGenreName($book->genre);
            $book->sub_genre_name = $this->getSubGenreName($book->subGenre);
            $book->publisher_name = $this->getPublisherName($book->publisher);
            // unset($book->author, $book->genre, $book->subGenre, $book->publisher);
            return $book;
        });

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        $publishers = Publisher::all();

        return view('books.create', compact('genres', 'authors', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:255',
            'year_published' => 'nullable|integer',
            'edition' => 'nullable|integer',
            'isbn_10' => 'nullable|size:10|unique:books',
            'isbn_13' => 'nullable|size:13|unique:books',
            'height' => 'nullable|integer',
            'genre_id' => 'nullable|exists:genres,id',
            'sub_genre_id' => 'nullable|exists:genres,id', // Assuming sub-genres are also stored in 'genres' table
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
        ]);

        // Create a new book instance
        $book = new Book($validatedData);

        // Save the book to the database
        $book->save();

        // Redirect the user with a success message
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }


    // Show a single book
    public function show(Book $book)
    {
        $book->load(['author', 'genre', 'subGenre', 'publisher']);
        $book->genre_name = $this->getGenreName($book->genre);
        $book->sub_genre_name = $this->getSubGenreName($book->subGenre);
        $book->publisher_name = $this->getPublisherName($book->publisher);
        return view('books.show', compact('book'));
    }

    // Show form to edit a book
    public function edit(Book $book)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $publishers = Publisher::all();

        return view('books.edit', compact('book', 'genres', 'authors', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:255',
            'year_published' => 'nullable|integer',
            'edition' => 'nullable|integer',
            'isbn_10' => 'nullable|size:10|unique:books,isbn_10,' . $book->id,
            'isbn_13' => 'nullable|size:13|unique:books,isbn_13,' . $book->id,
            'height' => 'nullable|integer',
            'genre_id' => 'nullable|exists:genres,id',
            'sub_genre_id' => 'nullable|exists:genres,id', // Assuming sub-genres are also stored in 'genres' table
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
        ]);

        // Update the book with validated data
        $book->update($validatedData);

        // Redirect the user with a success message
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete a book
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
