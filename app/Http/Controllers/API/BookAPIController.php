<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationAPIRequest;
use App\Http\Requests\StoreBookAPIRequest;
use App\Http\Requests\UpdateBookAPIRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookAPIController extends ApiBaseController
{
    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $book = Book::with('author', 'publisher.country', 'genre', 'subGenre')->find($id);
        if (!is_null($book)) {
            return $this->sendResponse(
                $book,
                "Retrieved successfully.",
            );
        }
        return $this->sendError("Book Not Found");
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PaginationAPIRequest $request): JsonResponse
    {
        $books = Book::with('author', 'publisher.country', 'genre', 'subGenre')->paginate($request['per_page']);
        if (!is_null($books) && ($books->count() > 0)) {
            return $this->sendResponse(
                $books,
                "Retrieved successfully.",
            );
        }
        return $this->sendError("No Books Found");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookAPIRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // get genre if supplied
        $genre = ($request->filled('genre')) ? $this->getGenre($request['genre']) : null;

        // get sub_genre if supplied
        $sub_genre = ($request->filled('sub_genre')) ? $this->getGenre($request['sub_genre']) : null;

        // get author if supplied
        $author = ($request->filled('author')) ? $this->getAuthor($request['author']) : null;

        // get publisher if supplied
        $publisher = ($request->filled('publisher')) ? $this->getPublisher($request['publisher']) : null;

        # Create book record
        $newBook = [
            'title' => $validated['title'],
            'height' => $validated['height'] ?? null,
            'genre_id' => $genre->id ?? null,
            'sub_genre_id' => $sub_genre->id ?? null,
            'author_id' => $author->id ?? null,
            'publisher_id' => $publisher->id ?? null,
        ];
        $book = Book::create($newBook);

        // Eager load the foreign key fields
        $book->load('author', 'publisher', 'genre', 'subGenre');

        $responseData = [
            'title' => $book['title'],
            'subtitle' => $book['subtitle'] ?? null,
            'year_published' => $book['year_published'] ?? null,
            'edition' => $book['edition'] ?? null,
            'isbn_10' => $book['isbn_10'] ?? null,
            'isbn_13' => $book['isbn_13'] ?? null,
            'height' => $book['height'] ?? null,
            'genre' => $book->genre->name ?? null,
            'sub_genre' => $book->subGenre->name ?? null,
            'author' => $author['author_name'] ?? null,
            'publisher' => $book->publisher->name ?? null,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
        ];

        return response()->json(
            [
                'success' => true,
                'message' => "Created successfully.",
                'data' => [
                    'book' => $responseData,
                ],
            ],
            200
        );

    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(UpdateBookAPIRequest $request, string $id): JsonResponse
    {
        $book = Book::query()->where('id', $id)->first();
        $destroyedBook = $book;

        if (!is_null($book) && $book->count() > 0) {
            $book->delete();
            return response()->json(
                [
                    'status' => true,
                    'message' => "Book Deleted.",
                    'book' => $destroyedBook
                ],
                200  # Ok
            );
        }
        return response()->json(
            [
                'status' => false,
                'message' => "Unable to delete: Book Not Found",
                'book' => null
            ],
            404  # Not Found
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookAPIRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $book = Book::query()->where('id', $id)->first();

        if (!is_null($book) && $book->count() > 0) {
            // get genre if supplied
            $genre = ($request->filled('genre')) ? $this->getGenre($request['genre']) : null;

            // get sub_genre if supplied
            $sub_genre = ($request->filled('sub_genre')) ? $this->getGenre($request['sub_genre']) : null;

            // get author if supplied
            $author = ($request->filled('author')) ? $this->getAuthor($request['author']) : null;

            // get publisher if supplied
            $publisher = ($request->filled('publisher')) ? $this->getPublisher($request['publisher']) : null;

            // should really only update the fields that exist in the request, but that is for another day
            $book['title'] = $validated['title'];
            $book['height'] = $validated['height'] ?? null;
            $book['genre_id'] = $genre->id ?? null;
            $book['sub_genre_id'] = $sub_genre->id ?? null;
            $book['author_id'] = $author->id ?? null;
            $book['publisher_id'] = $publisher->id ?? null;
            $book['updated_at'] = Carbon::now();
            $book->save();

            // load the foreign key fields
            $book->load('author', 'publisher', 'genre', 'subGenre');

            $responseData = [
                'title' => $book['title'],
                'subtitle' => $book['subtitle'] ?? null,
                'year_published' => $book['year_published'] ?? null,
                'edition' => $book['edition'] ?? null,
                'isbn_10' => $book['isbn_10'] ?? null,
                'isbn_13' => $book['isbn_13'] ?? null,
                'height' => $book['height'] ?? null,
                'genre' => $book->genre->name ?? null,
                'sub_genre' => $book->subGenre->name ?? null,
                'author' => $author['author_name'] ?? null,
                'publisher' => $book->publisher->name ?? null,
                'created_at' => $book->created_at,
                'updated_at' => $book->updated_at,
            ];

            return response()->json(
                [
                    'success' => true,
                    'message' => "Updated successfully.",
                    'data' => [
                        'book' => $responseData,
                    ],
                ],
                200
            );
        }
        return response()->json(
            [
                'status' => false,
                'message' => "Unable to update: Book Not Found",
                'book' => null
            ],
            404  # Not Found
        );
    }

    public function getGenre(string $genreString)
    {
        if (!(empty($genreString))) {
            $genre = Genre::where('name', $genreString)->first();
            if (is_null($genre)) {
                // Add new genre if not found
                $newGenre = ["name" => $genreString];
                $genre = Genre::create($newGenre);
            }
        } else {
            $genre = null;
        }
        return $genre;
    }

    public function getAuthor(string $authorString)
    {
        if (!(empty($authorString))) {
            $authorNames = Book::extractAuthorNames($authorString);
            $authorGiven = $authorNames['author_given'];
            $authorFamily = $authorNames['author_family'];

            # check if author exists, if not, add new author
            $author = Author::whereGivenName($authorGiven)->whereFamilyName($authorFamily)->first();
            if (is_null($author)) {
                $newAuthor = ["given_name" => $authorGiven, "family_name" => $authorFamily];
                $author = Author::create($newAuthor);
            }
            $authorName = $authorFamily . ", " . $authorGiven;
        } else {
            $author = null;
            $authorName = null;
        }
        $author['author_name'] = $authorName;
        return $author;
    }

    public function getPublisher(string $publisherString)
    {
        if (!(empty($publisherString))) {
            $publisher = Publisher::whereName($publisherString)->first();
            if (is_null($publisher)) {
                $newPublisher = ["name" => $publisherString];
                $publisher = Publisher::create($newPublisher);
            }
        } else {
            $publisher = null;
        }
        return $publisher;
    }
}
