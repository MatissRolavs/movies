<x-app-layout>
<style>
.rating:not(:checked) > input {
  position: absolute;
  appearance: none;
}

.rating:not(:checked) > label {
  float: right;
  cursor: pointer;
  font-size: 30px;
  color: #666;
}

.rating:not(:checked) > label:before {
  content: '★';
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
  color: #e58e09;
}

.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
  color: #ff9e0b;
}

.rating > input:checked ~ label {
  color: #ffa723;
}
</style>


            <div style="display: flex; justify-content: center;">
                <div style="border: 1px solid lightgray; border-radius: 10px; width: 1000px;">
                    <iframe src="{{ $movie->movieUrl }}" id="videoIframe" width="1000px" height="600px" style="border:none;" title="Video Player">Nothing</iframe>
                    <div style="display: flex; padding: 10px;">
                        <img src="{{ asset('images/' . $movie->movieImage) }}" alt="{{ $movie->movieImage }}" style="width: 100px; height: 150px;">
                        <div style="padding-left: 10px;">
                            <h2 style="color: white;">{{ $movie->movieName }}</h2>
                            <p style="color: white;">{{ $movie->movieDescription }}</p>
                            <p style="color: white;">Average Rating: {{ $movie->movieRating }}/5.00</p>
                            @php
                                $uniqueCategories = $categories->where('movie_id', $movie->id)->unique('name');
                            @endphp
                            @foreach ($uniqueCategories as $category)
                                <p style="color: white;">{{ $category->name }}</p>
                            @endforeach
                            <form method="POST" action="{{ route('categories.store') }}">
                                @csrf
                                <select name="category" id="category" onchange="this.form.submit()">
                                    <option value="" disabled selected>Add a category</option>
                                    <option value="Comedy">Comedy</option>
                                    <option value="Thriller">Thriller</option>
                                    <option value="Horror">Horror</option>
                                    <option value="Action">Action</option>
                                    <option value="Romance">Romance</option>
                                    <option value="Drama">Drama</option>
                                </select>
                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            </form>
                            <form method="POST" action="{{ route('ratings.store') }}">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div style="display: flex; justify-content: center; padding: 10px;">
                                    <label for="rating" style="color: white;">Rate this movie: </label>
                                    <div class="rating">
                                        <input value="5" name="rating" id="star5" type="radio">
                                        <label title="text" for="star5"></label>
                                        <input value="4" name="rating" id="star4" type="radio">
                                        <label title="text" for="star4"></label>
                                        <input value="3" name="rating" id="star3" type="radio" >
                                        <label title="text" for="star3"></label>
                                        <input value="2" name="rating" id="star2" type="radio">
                                        <label title="text" for="star2"></label>
                                        <input value="1" name="rating" id="star1" type="radio">
                                        <label title="text" for="star1"></label>
                                    </div>
                                    <button type="submit" style="margin-left: 10px; background-color: rgb(126 34 206); color: black; padding: 5px 10px; border: none; border-radius: 5px;">Submit</button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('movies.update', $movie->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                <button type="submit" style="margin-left: 10px; background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 5px;">Update Movie</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div style="display: flex; justify-content: center; padding: 10px;">
                    <textarea name="comment" id="comment" cols="30" rows="10" style="width: 1000px; border-radius: 10px; border: 1px solid lightgray; padding: 10px;" placeholder="Leave a comment..."></textarea>
                    <button type="submit" style="background-color: rgb(126 34 206); color: white; padding: 14px 20px; margin-left: 10px; border: none; cursor: pointer;">Comment</button>
                </div>
            </form>
            <h2 style="text-align: center;">Comments</h2>
            @foreach ($comments as $comment)
            <div style="display: flex; justify-content: center; padding: 10px; border-bottom: 1px solid lightgray;">
                <div style="display: flex; align-items: center;">
                @if (auth()->user()->id == $comment->user_id)
                    <p style="margin-right: 10px; color: white;">{{ auth()->user()->name }} : </p>
                @endif
                </div>
                <p style="margin-left: 10px; color: white;">{{ $comment->comment }}</p>
            </div>
            @endforeach

            </x-app-layout>