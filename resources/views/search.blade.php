@extends('body.main')

@section('title', 'Article Search')

@section('container')
<div class="flex justify-center items-center h-screen4">
    <div class="w-full max-w-2xl">
        <div class="backdrop-blur-md p-5 rounded-3xl shadow-lg w-full max-w-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">Article</h2>
            <form method="POST" action="{{ route('searchArticles') }}">
                @csrf
                <div class="mb-2">
                    <div class="relative">
                        <label for="query" class="block mb-1">Search for article</label>
                        <input type="text" name="query" id="query" class="w-full px-2 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Title" style="width: 100%; height: 35px;" required autofocus>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="w-64 bg-orange text-black font-semibold py-2 mt-3 rounded-full hover:bg-orange-700/75 focus:outline-none focus:ring-2 focus:ring-orange-500">Search</button>
                </div>
            </form>
        </div>
    </div>    
</div>

@if(isset($articles))
<div class="flex justify-center items-center mt-8">
    <div class="w-full max-w-6xl">
        <h2 class="text-2xl font-bold text-center mb-6">Result</h2>
        @foreach($articles as $article)
        <a href="{{ $article['link'] }}" target="_blank" class="block backdrop-blur-md p-5 rounded-3xl shadow-xl max-w-6xl mb-4 no-underline hover:bg-gray-200">
            <div class="text">
                <div class="article-flex">
                    <h2>{{ $article['title'] }}</h2>
                </div>
                <div class="article-flex">
                    <p>{{ $article['snippet'] }}</p>
                </div>   
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif
@endsection
