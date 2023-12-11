@extends('layouts.app')


@section('content')
    @if(session('success'))
        <h2 class="text-center font-semibold text-xl text-red-400 leading-tight" style="color: red;">
            {{ session('success') }}
        </h2>
    @endif
    {{-- If my styles were working ....--}}
    {{--@if(session('success'))--}}
    {{--    <div class="alert alert-success">--}}
    {{--        {{ session('success') }}--}}
    {{--    </div>--}}
    {{--@endif--}}
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
                            <th class="p-2 text-left">
                                @auth
                                <a href="{{ route('books.create', ['sort' => request()->sort, 'page' => request()->page]) }}"
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Create New Book</a>
                                @endauth
                            </th>
                            <th class="p-2 text-right">
                                Sort by:
                            </th>
                            <th colspan="4" class="p-2 text-left">
                                <!-- Sorting Dropdown -->
                                <form action="{{ route('books.index') }}" method="GET" class="flex items-center" id="sortForm">
                                    <select name="sort" class="rounded border-gray-300" id="sortDropdown">
                                        <option value="" {{ $currentSort == '' ? 'selected' : '' }}>No Sort</option>
                                        <option value="title_asc" {{ $currentSort == 'title_asc' ? 'selected' : '' }}>Title (Asc)</option>
                                        <option value="title_desc" {{ $currentSort == 'title_desc' ? 'selected' : '' }}>Title (Desc)</option>
                                        <option value="author_asc" {{ $currentSort == 'author_asc' ? 'selected' : '' }}>Author (Asc)</option>
                                        <option value="author_desc" {{ $currentSort == 'author_desc' ? 'selected' : '' }}>Author (Desc)</option>
                                        <option value="authorFamilyName_asc" {{ $currentSort == 'authorFamilyName_asc' ? 'selected' : '' }}>Author Family Name (Asc)</option>
                                        <option value="authorFamilyName_desc" {{ $currentSort == 'authorFamilyName_desc' ? 'selected' : '' }}>Author Family Name (Desc)</option>
                                        <option value="genre_asc" {{ $currentSort == 'genre_asc' ? 'selected' : '' }}>Genre (Asc)</option>
                                        <option value="genre_desc" {{ $currentSort == 'genre_desc' ? 'selected' : '' }}>Genre (Desc)</option>
                                        <option value="updatedAt_asc" {{ $currentSort == 'updatedAt_asc' ? 'selected' : '' }}>Last Modified (Asc)</option>
                                        <option value="updatedAt_desc" {{ $currentSort == 'updatedAt_desc' ? 'selected' : '' }}>Last Modified (Desc)</option>
                                    </select>

{{--                                    <button type="submit" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                                        Sort--}}
{{--                                    </button>--}}
                                </form>
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
                        @forelse($books as $book)
                            <tr class="border-b border-stone-300 hover:bg-stone-200">
                                <td class="p-2 text-left">{{ $book->title }}</td>
                                <td class="p-2 text-left">{{ $book->genre_name ?? 'N/A' }}</td>
                                <td class="p-2 text-left">{{ optional($book->author)->full_name }}</td>
                                <td class="p-2 text-center">
                                    <a href="{{ route('books.show', ['book' => $book->id, 'sort' => request()->sort, 'page' => request()->page]) }}" class="text-blue-500 hover:text-blue-700" title="View book details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="p-2 text-center">
                                    @auth
                                    <a href="{{ route('books.edit', ['book' => $book->id, 'sort' => request()->sort, 'page' => request()->page]) }}" class="text-green-500 hover:text-green-700" title="Edit book details">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @endauth
                                </td>
                                <td class="p-2 text-center">
                                    @auth
                                    <form action="{{ route('books.destroy', $book) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="sort" value="{{ request()->sort }}">
                                        <input type="hidden" name="page" value="{{ request()->page }}">
                                        <button type="submit" onclick="return confirm('\n{{ $book->title }}\n\nAre you sure you want to delete this book?');" class="text-red-500 hover:text-red-700" title="Delete book">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endauth
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-2 text-center text-black font-bold">
                                    No books to show
                                </td>
                            </tr>
                        @endforelse
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
    <script>
        document.getElementById('sortDropdown').addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });
    </script>
@endsection
