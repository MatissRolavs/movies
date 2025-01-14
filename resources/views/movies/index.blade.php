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
</style>

<div class="search-sort-container">
    <div class="shrink-0 flex items-center text-white">
        <a href="{{ route('movies.index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo" width="100" height="50">
        </a>
    </div>
  <form method="GET" action="{{ route('movies.index') }}">
    <div style="margin-top: 10px;">
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
  
</div>

<div class="filter-container">
  
    <div style="margin-top: 10px;">
      <span class="text-white font-medium">Filter by Category:</span>
      <div class="category-grid">
        <label class="text-white"><input type="checkbox" name="category[]" value="Comedy" {{ is_array(request('category')) && in_array('Comedy', request('category')) ? 'checked' : '' }}> Comedy</label>
        <label class="text-white"><input type="checkbox" name="category[]" value="Thriller" {{ is_array(request('category')) && in_array('Thriller', request('category')) ? 'checked' : '' }}> Thriller</label>
        <label class="text-white"><input type="checkbox" name="category[]" value="Horror" {{ is_array(request('category')) && in_array('Horror', request('category')) ? 'checked' : '' }}> Horror</label>
        <label class="text-white"><input type="checkbox" name="category[]" value="Action" {{ is_array(request('category')) && in_array('Action', request('category')) ? 'checked' : '' }}> Action</label>
        <label class="text-white"><input type="checkbox" name="category[]" value="Romance" {{ is_array(request('category')) && in_array('Romance', request('category')) ? 'checked' : '' }}> Romance</label>
        <label class="text-white"><input type="checkbox" name="category[]" value="Drama" {{ is_array(request('category')) && in_array('Drama', request('category')) ? 'checked' : '' }}> Drama</label>
      </div>
    </div>
  </form>
</div>

<div style="display: grid; grid-template-columns: repeat(5, 190px); gap: 10px; justify-content: center; margin-top: 20px;">
  @foreach ($movies as $movie)
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
  @endforeach
</div>



</x-app-layout>

