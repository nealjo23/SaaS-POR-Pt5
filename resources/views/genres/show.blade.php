@extends('layouts.app')

@section('content')
    @empty($genre)
        <div class="max-w-2xl mx-auto bg-white border border-black p-6 mt-5 text-center text-xl font-bold">
            Genre not found
        </div>
    @else
        <div class="max-w-2xl mx-auto bg-white border border-black p-6 mt-5">
            <table class="w-full">
                <thead>
                <tr>
                    <th colspan="2" class="text-xl font-bold text-left p-4">{{ $genre->name }}</th>
                </tr>
                </thead>
                <tbody class="border-t border-black">
                <tr>
                    <td class="border-r border-black p-2">Description</td>
                    <td class="p-2">{{ $genre->description ?? '' }}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2" class="text-right p-2">
                        @auth
                        <a href="{{ route('genres.edit', ['genre' => $genre->id, 'page' => request()->page]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                        @endauth
                        <a href="{{ route('genres.index', ['sort' => request()->sort, 'page' => request()->page]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to list</a>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    @endempty
@endsection
