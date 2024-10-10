
            <div style="display: flex; justify-content: center;">
                <div style="border: 1px solid lightgray; border-radius: 10px; width: 1000px;">
                    <iframe src="{{ $movie->movieUrl }}" id="videoIframe" width="1000px" height="600px" style="border:none;" title="Video Player">Nothing</iframe>
                    <div style="display: flex; padding: 10px;">
                        <img src="{{ asset('images/' . $movie->movieImage) }}" alt="{{ $movie->movieImage }}" style="width: 100px; height: 150px;">
                        <div style="padding-left: 10px;">
                            <h2>{{ $movie->movieName }}</h2>
                            <p>{{ $movie->movieDescription }}</p>
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
                    <button type="submit" style="background-color: #4CAF50; color: white; padding: 14px 20px; margin-left: 10px; border: none; cursor: pointer;">Comment</button>
                </div>
            </form>
            <h2 style="text-align: center;">Comments</h2>
            @foreach ($comments as $comment)
            <div style="display: flex; justify-content: center; padding: 10px; border-bottom: 1px solid lightgray;">
                <div style="display: flex; align-items: center;">
                @if (auth()->user()->id == $comment->user_id)
                    <p style="margin-right: 10px;">{{ auth()->user()->name }} : </p>
                @endif
                </div>
                <p style="margin-left: 10px;">{{ $comment->comment }}</p>
            </div>
            @endforeach

