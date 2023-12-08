@if ($errors->any())
    <div class="alert alert-danger text-xl font-bold" style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($genre) ? route('genres.update', $genre) : route('genres.store') }}" method="POST">
    @csrf
    @if(isset($genre))
        @method('PUT')
    @endif

    <table class="w-full bg-white">
        <!-- Name -->
        <tr>
            <td class="text-right pr-2">
                <label for="name">Name:</label>
            </td>
            <td>
                <input type="text" id="name" name="name" value="{{ old('name', $genre->name ?? '') }}" required style="width: 400px;">
            </td>
        </tr>

        <!-- Description -->
        <tr>
            <td class="text-right pr-2">
                <label for="description">Description:</label>
            </td>
            <td>
                <input type="text" id="description" name="description" value="{{ old('description', $genre->description ?? '') }}" style="width: 400px;">
            </td>
        </tr>

        <!-- Buttons -->
        <tr>
            <td colspan="2" class="text-right">
                <input type="hidden" name="page" value="{{ request()->page }}">
                <a href="{{ route('genres.index', ['page' => request()->page]) }}" class="inline-block px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700">Cancel</a>
                <button type="submit" class="ml-2 inline-flex justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700">{{ isset($genre) ? 'Update' : 'Create' }}</button>
            </td>
        </tr>
    </table>
</form>
