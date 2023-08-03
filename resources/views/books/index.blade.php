<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table w-full">
                        <thead class="border border-stone-300">
                        <tr class="bg-stone-300">
                            <th class="p-2 text-right">#</th>
                            <th class="p-2 text-left">Title</th>
                            <th class="p-2 text-left">ISBN</th>
                            <th class="p-2 text-left">Author</th>
                            <th class="p-2 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="border border-stone-300">
                        @foreach($books as $book)
                        <tr class="border-b border-stone-300 hover:bg-stone-200">
                            <td class="p-2 text-right">{{ $loop->iteration }}</td>
                            <td class="p-2 text-left">{{ $book->title }}</td>
                            <td class="p-2 text-left">{{ $book->ISBN }}</td>
                            <td class="p-2 text-left">{{ $book->author_name }}</td>
                            <td class="p-2">
                                View
                                Edit
                                Delete
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="border border-stone-300">
                        <tr>
                            <td colspan="5">
                                {{ $books->links() }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
