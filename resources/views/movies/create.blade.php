@include('layouts.navigation')
    <h1 class="text-3xl">Create a new movie</h1>
    <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mt-6">
            <label for="movieUrl" class="block text-sm font-medium text-gray-700">Movie URL</label>
            <div class="mt-1">
                <input type="text" name="movieUrl" id="movieUrl" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('movieUrl') }}">
            </div>
        </div>
        <div class="mt-6">
            <label for="movieName" class="block text-sm font-medium text-gray-700">Movie Name</label>
            <div class="mt-1">
                <input type="text" name="movieName" id="movieName" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('movieName') }}">
            </div>
        </div>
        <div class="mt-6">
            <label for="movieDescription" class="block text-sm font-medium text-gray-700">Movie Description</label>
            <div class="mt-1">
                <textarea name="movieDescription" id="movieDescription" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('movieDescription') }}</textarea>
            </div>
        </div>
        <div class="mt-6">
            <label for="movieImage" class="block text-sm font-medium text-gray-700">Movie Image</label>
            <div class="mt-1">
                <input type="file" name="movieImage" id="movieImage" class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create
            </button>
        </div>
    </form>

