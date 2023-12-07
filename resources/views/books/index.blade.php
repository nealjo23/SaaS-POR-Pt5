@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Books') }}
    </h2>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table w-full p-4">
                        <thead class="border border-stone-300">
                        <tr class="bg-stone-300">
                            <th colspan="6" class="p-2 text-left">
                                <a href="{{ route('books.create') }}"
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Create New Book</a>
                            </th>
                        </tr>
                        <tr class="bg-stone-300">
                            <th class="p-2 text-left">Title</th>
                            <th class="p-2 text-left">Genre</th>
                            <th class="p-2 text-left">Author</th>
                            <th colspan="3" class="p-2 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="border border-stone-300">
                        @foreach($books as $book)
                            <tr class="border-b border-stone-300 hover:bg-stone-200">
                                <td class="p-2 text-left">{{ $book->title }}</td>
                                <td class="p-2 text-left">{{ $book->genre_name ?? 'N/A' }}</td>
                                <td class="p-2 text-left">{{ optional($book->author)->full_name }}</td>
                                <td class="p-2 text-center">
                                    <a href="{{ route('books.show', $book) }}" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="p-2 text-center">
                                    <a href="{{ route('books.edit', $book) }}" class="text-green-500 hover:text-green-700">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td class="p-2 text-center">
                                    <form action="{{ route('books.destroy', $book) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this book?');" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="border border-stone-300">
                        <tr>
                            <td colspan="4">
                                {{ $books->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
