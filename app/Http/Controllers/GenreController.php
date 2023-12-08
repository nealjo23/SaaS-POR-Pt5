<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $genres = Genre::orderBy('name', 'asc')->paginate(10);

        session([
            'last_page' => $request->input('page', 1)
        ]);

        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:genres,name',
            'description' => 'nullable|max:255',
        ]);

        $genre = new Genre($validatedData);

        $genre->save();

        return redirect()->route('genres.index', [
            'page' => session('last_page', 1)
        ])->with('success', 'Genre created successfully.');
    }


    public function show($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->view('errors.genre-not-found', [], 404);
        }
        return view('genres.show', compact('genre'));
    }


    public function edit($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->view('errors.genre-not-found', [], 404);
        }
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->view('errors.genre-not-found', [], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:genres,name,' . $id,
            'description' => 'nullable|max:255',
        ]);

        $genre->update($validatedData);

        return redirect()->route('genres.index', [
            'page' => session('last_page', 1)
        ])->with('success', 'Genre updated successfully.');
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->view('errors.genre-not-found', [], 404);
        }

        try {
            $genre->delete();
            return redirect()->route('genres.index', [
                'page' => session('last_page', 1)
            ])->with('success', 'Genre deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Cannot delete this genre because it is in use by books.');
        }
    }
}
