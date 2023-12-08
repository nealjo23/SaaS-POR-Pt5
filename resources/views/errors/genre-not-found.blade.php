@extends('layouts.app')

@section('content')
        <div class="text-center font-semibold text-xl" style="color: red;">
            <h3>Genre Not Found</h3><br>
        </div>
        <div class="text-center">
            <p>Sorry, the genre you are looking for could not be found.</p><br>
        <div class="text-center">
            <br><a href="{{ route('genres.index', ['page' => request()->page]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to list</a>
        </div>
@endsection
