<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $movie->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <img src="{{ $movie->poster_uri }}" alt="{{ $movie->title }}" class="mb-4 max-w-md mx-auto">
                        <p><strong>公開日:</strong> {{ $movie->date }}</p>
                        <p><strong>上映時間:</strong> {{ $movie->time }}分</p>
                        <p><strong>ジャンル:</strong> {{ $movie->genre }}</p>
                        <p><strong>監督:</strong> {{ $movie->director }}</p>
                        <p><strong>キャスト:</strong> {{ $movie->cast }}</p>
                        <p><strong>ストーリー:</strong> {{ $movie->story }}</p>
                    </div>

                    <h3 class="text-lg font-semibold mt-6 mb-4">レビュー</h3>
                    @if($movie->reviews->isNotEmpty())
                        @foreach($movie->reviews as $review)
                            <div class="mb-4 p-4 border rounded">
                                <p><strong>評価:</strong> {{ $review->movie_rating }}</p>
                                <p>{{ $review->movie_review }}</p>
                                <p class="text-sm text-gray-500 mt-2">投稿者: {{ $review->user->name }} | 投稿日: {{ $review->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        @endforeach
                    @else
                        <p>まだレビューがありません。</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('reviews.create', ['movie_id' => $movie->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            このムービーのレビューを書く
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>