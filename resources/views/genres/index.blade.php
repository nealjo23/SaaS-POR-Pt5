@extends('layouts.app')


@section('content')
    @if ($errors->any())
        <h2 class="text-center font-semibold text-xl text-red-400 leading-tight" style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </h2>
    @endif
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
        {{ __('Genres') }}
    </h2>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table w-full p-4">
                        <thead class="border border-stone-300">
                        <tr class="bg-stone-300">
                            <th colspan="5" class="p-2 text-left">
                                <a href="{{ route('genres.create', ['page' => request()->page]) }}"
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Create New Genre</a>
                            </th>
                        </tr>
                        <tr class="bg-stone-300">
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Description</th>
                            <th colspan="3" class="p-2 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="border border-stone-300">
                        @forelse($genres as $genre)
                            <tr class="border-b border-stone-300 hover:bg-stone-200">
                                <td class="p-2 text-left">{{ $genre->name }}</td>
                                <td class="p-2 text-left">{{ $genre->description ?? '' }}</td>
                                <td class="p-2 text-center">
                                    <a href="{{ route('genres.show', ['genre' => $genre->id, 'page' => request()->page]) }}" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="p-2 text-center">
                                    <a href="{{ route('genres.edit', ['genre' => $genre->id, 'page' => request()->page]) }}" class="text-green-500 hover:text-green-700">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td class="p-2 text-center">
                                    <form action="{{ route('genres.destroy', 777) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="page" value="{{ request()->page }}">
                                        <button type="submit" onclick="return confirm('\n{{ $genre->name }}\n\nAre you sure you want to delete this genre?');" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-2 text-center text-black font-bold">
                                    No genres to show
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot class="border border-stone-300">
                        <tr>
                            <td colspan="4">
                                {{ $genres->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
