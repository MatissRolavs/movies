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
</style>
    <div style="display: flex; justify-content: center; align-items: center; gap: 20px; background-color: black; border-radius: 10px; padding: 20px;">
        <form method="GET" action="{{ route('movies.index') }}">
            <div style="display: flex; align-items: center;">
                <button type="submit" class="bg-transparent border-none hover:bg-purple-700 hover:rounded-full">
                    <img src="{{ asset('images/search_24dp_5F6368_FILL0_wght400_GRAD0_opsz24.svg') }}" width="24" height="24" alt="search icon">
                </button>
                <input type="text" name="search" id="search" value="{{ request('search') }}" style="width: 270px; height: 20px; border-radius: 10px; padding: 10px; font-size: 20px;" class="bg-white border border-purple-700 rounded-md p-2">
                <select name="sort_by" id="sort_by"  style="width: 270px; height: 45px; border-radius: 10px; padding: 10px; font-size: 20px;" class="bg-white border border-purple-700 rounded-md p-2">
                    <option value="" disabled selected>Sort by</option>
                    <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title</option>
                    <option value="rating_asc" {{ request('sort_by') == 'rating_asc' ? 'selected' : '' }}>Rating ascending</option>
                    <option value="rating_desc" {{ request('sort_by') == 'rating_desc' ? 'selected' : '' }}>Rating descending</option>
                </select>
            </div>
        </form>
    </div>
    
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px; margin-top: 20px;">
        @foreach ($movies as $movie)
        <div class="card">
            <a style="text-decoration: none;" href="{{ route('movies.show', $movie->id) }}">
                <img src="{{ asset('images/' . $movie->movieImage) }}" alt="{{ $movie->movieImage }}">
                <div class="px-6 py-4 text-center">
                    <div class="text-white font-bold text-xl mb-2 break-words">{{ $movie->movieName }}</div>
                </div>
            </a>
            <p class="text-white text-base">
                Average Rating: {{$movie->movieRating}}/5.00
            </p>
        </div>
        @endforeach
    </div>


</x-app-layout>