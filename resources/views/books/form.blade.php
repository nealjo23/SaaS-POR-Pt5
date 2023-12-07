<form action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}" method="POST">
    @csrf
    @if(isset($book))
        @method('PUT')
    @endif

    <table class="w-full bg-white">
        <!-- Title -->
        <tr>
            <td class="text-right pr-2">
                <label for="title">Title:</label>
            </td>
            <td>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title ?? '') }}" required style="width: 400px;">
            </td>
        </tr>

        <!-- Subtitle -->
        <tr>
            <td class="text-right pr-2">
                <label for="subtitle">Subtitle:</label>
            </td>
            <td>
                <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle', $book->subtitle ?? '') }}" style="width: 400px;">
            </td>
        </tr>

        <!-- Year Published -->
        <tr>
            <td class="text-right pr-2">
                <label for="year_published">Year Published:</label>
            </td>
            <td>
                <input type="number" id="year_published" name="year_published" value="{{ old('year_published', $book->year_published ?? '') }}">
            </td>
        </tr>

        <!-- Edition -->
        <tr>
            <td class="text-right pr-2">
                <label for="edition">Edition:</label>
            </td>
            <td>
                <input type="number" id="edition" name="edition" value="{{ old('edition', $book->edition ?? '') }}">
            </td>
        </tr>

        <!-- ISBN -->
        <tr>
            <td class="text-right pr-2">
                <label for="isbn">ISBN:</label>
            </td>
            <td>
                <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn ?? '') }}">
            </td>
        </tr>

        <!-- Height -->
        <tr>
            <td class="text-right pr-2">
                <label for="height">Height:</label>
            </td>
            <td>
                <input type="number" id="height" name="height" value="{{ old('height', $book->height ?? '') }}">
            </td>
        </tr>

        <!-- Genre -->
        <tr>
            <td class="text-right pr-2">
                <label for="genre_id">Genre:</label>
            </td>
            <td>
                <select id="genre_id" name="genre_id">
                    <option value="">Select Genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ (isset($book) && $book->genre_id == $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>

        <!-- Sub Genre -->
        <tr>
            <td class="text-right pr-2">
                <label for="sub_genre_id">Sub Genre:</label>
            </td>
            <td>
                <select id="sub_genre_id" name="sub_genre_id">
                    <option value="">Select Sub Genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ (isset($book) && $book->sub_genre_id == $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>

        <!-- Author -->
        <tr>
            <td class="text-right pr-2">
                <label for="author_id">Author:</label>
            </td>
            <td>
                <select id="author_id" name="author_id">
                    <option value="">Select Author</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ (isset($book) && $book->author_id == $author->id) ? 'selected' : '' }}>{{ $author->getFullNameAttribute() }}</option>
                    @endforeach
                </select>
            </td>
        </tr>

        <!-- Publisher -->
        <tr>
            <td class="text-right pr-2">
                <label for="publisher_id">Publisher:</label>
            </td>
            <td>
                <select id="publisher_id" name="publisher_id" class="max-w-xs" style="max-width: 400px;">
                    <option value="">Select Publisher</option>
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}" {{ (isset($book) && $book->publisher_id == $publisher->id) ? 'selected' : '' }}>{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>



        <!-- Buttons -->
        <tr>
            <td colspan="2" class="text-right">
                <a href="{{ route('books.index') }}" class="inline-block px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700">Cancel</a>
                <button type="submit" class="ml-2 inline-flex justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700">{{ isset($book) ? 'Update' : 'Create' }}</button>
            </td>
        </tr>
    </table>
</form>
