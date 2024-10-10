


    <h1 class="text-3xl">Movies</h1>
    <ul>
        @foreach ($movies as $movie)
        <a href="{{ route('movies.show', $movie->id) }}">
            <div class="flex flex-col items-center p-4">
                <img src="{{ asset('images/' . $movie->movieImage) }}" alt="{{ $movie->movieImage }}" style="width: 200px; height: 300px;">
                <p class="text-center">{{ $movie->movieName }}</p>
            </div>  
        </a>
        @endforeach
    </ul>

