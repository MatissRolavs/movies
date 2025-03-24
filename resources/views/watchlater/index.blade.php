<x-app-layout>
    <style>
    .card {
    width: 190px;
    height: 254px;
    border-radius: 30px;
    background: #e0e0e0;
    }
    .card img {
    width: 100%;
    height: 100%;
    border-radius: 15px;
    object-fit: cover;
    }
    .filter-container {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    background-color: black;
    border-radius: 10px;
    padding: 20px;
    position: absolute;
    right: 5px;
    top: 120px;
    border-style: solid;
    border-color:rgb(126 34 206);
    }
    .search-sort-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    background-color: black;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    }
    .category-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    }
    .link-box {
    padding: 20px;
    border-style: solid;
    border-color: rgb(126, 34, 206);
    border-radius: 10px;
    width: 100px;
    transition: box-shadow 0.3s ease, background-color 0.3s ease;
    }

    .link-box:hover {
    box-shadow: 0 0 10px rgb(126, 34, 206);
    background-color: rgb(126 34 206); /* light grey tone */
    }
    .link-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    position: absolute;
    background-color: black;
    top: 120px;
    
    
    }
    </style>
    <div class="link-container">
    <div class = "link-box">
        <a style="text-decoration: none; color: white;" href= "{{ route('movies.index') }}">Home</a>
    </div>
    <div class="link-box">
        <a style="text-decoration: none; color: white;" href= "{{ route('watchlaters.index') }}">Watch Later</a>
    </div>
    </div>
    <div class="search-sort-container">
        <div class="shrink-0 flex items-center text-white">
            <a href="{{ route('movies.index') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" width="100" height="50">
            </a>
            <h1 style="color: white;">Watch Later</h1>
        </div>
    </div>

   
    
    <div style="display: grid; grid-template-columns: repeat(5, 190px); gap: 10px; justify-content: center; margin-top: 20px;">
    @foreach ($laters as $later)
        @if (auth()->user()->id == $later->user_id)
            @foreach ($movies as $movie)
                @if ($movie->id == $later->movie_id)
                    <div style="width: 190px; overflow: hidden; box-sizing: border-box;">
                        <div class="card relative" style="width: 190px;">
                            <a style="text-decoration: none;" href="{{ route('movies.show', $movie->id) }}">
                            <img src="{{ file_exists(public_path('images/' . $movie->movieImage)) ? asset('images/' . $movie->movieImage) : $movie->movieImage }}" alt="{{ $movie->movieImage }}" class="w-full" style="width: 100%;">
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-1">
                            <div style="display: flex; flex-direction: column;  align-items: center;">
                                <div class="text-white font-bold text-sm mb-2 break-words" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 150px;" title="{{ $movie->movieName }}">
                                {{ $movie->movieName }}
                                </div>
                                <p class="text-white text-base">
                                {{$movie->movieRating}}/5.00
                                </p>
                            </div>
                            </div>
                            </a>
                        </div>
                    </div> 
                @endif
            @endforeach
        @endif
    @endforeach
    </div>
</x-app-layout>
