@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white border border-black p-6 mt-5">
        <table class="w-full">
            <thead>
            <tr>
                <th colspan="2" class="text-2xl font-bold text-left p-4">{{ $book->title }}</th>
            </tr>
            </thead>
            <tbody class="border-t border-black">
            <tr>
                <td class="border-r border-black p-2">Subtitle</td>
                <td class="p-2">{{ $book->subtitle ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border-r border-black p-2">Year Published</td>
                <td class="p-2">{{ $book->year_published ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border-r border-black p-2">Edition</td>
                <td class="p-2">{{ $book->edition ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border-r border-black p-2">ISBN</td>
                <td class="p-2">{{ $book->isbn }}</td>
            </tr>
            <tr>
                <td class="border-r border-black p-2">Height</td>
                <td class="p-2">{{ $book->height ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border-r border-black p-2">Author</td>
                <td class="p-2">{{ optional($book->author)->full_name }}</td>
            </tr>
            <tr>
                <td class="border-r border-black p-2">Genre</td>
                <td class="p-2">{{ $book->genre_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border-r border-black p-2">Sub Genre</td>
                <td class="p-2">{{ $book->sub_genre_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="border-r border-black p-2">Publisher</td>
                <td class="p-2">{{ $book->publisher_name ?? 'N/A' }}</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2" class="text-right p-2">
                    <a href="{{ route('books.edit', $book) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to list</a>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
