@extends('layouts.app')

@section('content')
        <div class="text-center font-semibold text-xl" style="color: red;">
            <h3>Book Not Found</h3><br>
        </div>
        <div class="text-center">
            <p>Sorry, the book you are looking for could not be found.</p><br>
        <div class="text-center">
            <br><a href="{{ route('books.index', ['sort' => request()->sort, 'page' => request()->page]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to list</a>
        </div>
@endsection
