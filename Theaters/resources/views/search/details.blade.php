<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $movie['title'] }} - 映画詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(isset($movie['poster_url']))
                        <img src="{{ $movie['poster_url'] }}" alt="{{ $movie['title'] }} ポスター" class="max-w-xs mb-4">
                    @endif

                    <p class="mb-2"><strong>ID:</strong> {{ $movie['id'] }}</p>
                    <p class="mb-2"><strong>公開日:</strong> {{ $movie['release_date'] }}</p>
                    <p class="mb-2"><strong>上映時間:</strong> {{ $movie['runtime'] ?? 'N/A' }}分</p>
                    <p class="mb-2"><strong>ジャンル:</strong> {{ $movie['genres_string'] ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>監督:</strong> {{ $movie['director'] ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>主要出演者:</strong> {{ $movie['cast'] ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>概要:</strong> {{ $movie['overview'] }}</p>
                    
                    @if(isset($movie['vote_average']))
                        <p class="mb-2"><strong>評価:</strong> {{ $movie['vote_average'] }} / 10</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            戻る
                        </a>
                        
                        <form action="{{ route('movies.save') }}" method="POST" class="inline-block">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                決定する
                            </button>
                        </form>
                        
                        <a href="{{ route('movies.search') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            新しい検索を行う
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>