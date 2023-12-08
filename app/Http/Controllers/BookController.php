<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;

class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allowedSorts = [
            'title_asc', 'title_desc',
            'genre_asc', 'genre_desc',
            'author_asc', 'author_desc',
            'authorFamilyName_asc', 'authorFamilyName_desc',
            'updatedAt_asc', 'updatedAt_desc',
        ];

        $request->validate([
            'sort' => ['nullable', 'in:' . implode(',', $allowedSorts)]
            // the implode function creates a comma separated string of all allowed sort options
            // so the requested sort is valid if null or in the list of allowed sorts
        ]);

        $sortOption = $request->input('sort', '');
        $booksQuery = Book::excludeUnknown()->with(['author', 'genre', 'subGenre', 'publisher']);

        // $booksIncludingUnknown = Book::withoutGlobalScope('excludeUnknown')->get();

        if ($sortOption) {
            [$sortColumn, $sortDirection] = explode('_', $sortOption);

            switch ($sortColumn) {
                case 'title':
                    $booksQuery->orderBy('title', $sortDirection);
                    break;

                case 'updatedAt':
                    $booksQuery->orderBy('updated_at', $sortDirection);
                    break;

                case 'genre':
                    $booksQuery->join('genres', 'books.genre_id', '=', 'genres.id')
                        ->orderBy('genres.name', $sortDirection)
                        ->select('books.*');
                    break;

                case 'author':
                    $booksQuery->join('authors', 'books.author_id', '=', 'authors.id')
                        ->orderByRaw("CONCAT(authors.given_name, ' ', authors.family_name) $sortDirection")
                        ->select('books.*');
                    break;

                case 'authorFamilyName':
                    $booksQuery->join('authors', 'books.author_id', '=', 'authors.id')
                        ->orderBy('authors.family_name', $sortDirection)
                        ->select('books.*');
                    break;
            }
        }

        $books = $booksQuery->paginate(10);

        // Add extra fields
        $books->getCollection()->transform(function ($book) {
            $book->genre_name = $book->genre?->name;
            $book->sub_genre_name = $book->subGenre?->name;
            $book->publisher_name = $book->publisher?->name;
            $book->author_name = $book->author?->full_name;
            return $book;
        });

        $books->appends(['sort' => $sortOption]);

        $currentSort = $request->input('sort', ''); // Default to empty string if not set

        session([
            'last_sort' => $request->input('sort', ''),
            'last_page' => $request->input('page', 1)
        ]);

        return view('books.index', compact('books', 'currentSort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::orderBy('name')->get();
        $authors = Author::orderBy('family_name')->get();
        $publishers = Publisher::orderBy('name')->get();

        return view('books.create', compact('genres', 'authors', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:255',
            'year_published' => 'nullable|integer',
            'edition' => 'nullable|integer',
            'isbn_10' => 'nullable|size:10|unique:books',
            'isbn_13' => 'nullable|size:13|unique:books',
            'height' => 'nullable|integer',
            'genre_id' => 'nullable|exists:genres,id',
            'sub_genre_id' => 'nullable|exists:genres,id',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
        ]);

        $book = new Book($validatedData);

        $book->save();

        return redirect()->route('books.index', [
            'sort' => session('last_sort', ''),
            'page' => session('last_page', 1)
        ])->with('success', 'Book created successfully.');
    }


    public function show($id)
    {
        $book = Book::with(['author', 'genre', 'subGenre', 'publisher'])->find($id);

        if (!$book) {
            return response()->view('errors.book-not-found', [], 404);
        }

        return view('books.show', compact('book'));
    }


    public function edit($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->view('errors.book-not-found', [], 404);
        }

        $genres = Genre::orderBy('name')->get();
        $authors = Author::orderBy('family_name')->get();
        $publishers = Publisher::orderBy('name')->get();

        return view('books.edit', compact('book', 'genres', 'authors', 'publishers'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
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

        $book->update($validatedData);

        return redirect()->route('books.index', [
            'sort' => session('last_sort', ''),
            'page' => session('last_page', 1)
        ])->with('success', 'Book updated successfully.');    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->view('errors.book-not-found', [], 404);
        }

        $book->delete();
        return redirect()->route('books.index', [
            'sort' => session('last_sort', ''),
            'page' => session('last_page', 1)
        ])->with('success', 'Book deleted successfully.');
    }
}
