<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画トップページ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">最近の映画レビュー</h2>
                        <a href="{{ route('reviews.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150 ease-in-out mb-4">
                            新しいレビューを投稿する
                        </a>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($movie_reviews as $movie_review)
                                <div class="border rounded-lg p-6 shadow-sm hover:shadow-md transition duration-300">
                                    <h3 class="font-bold text-xl mb-2">{{ $movie_review->movie->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">評価: {{ $movie_review->movie_rating }}</p>
                                    <p class="text-sm text-gray-500 mb-2">
                                        投稿者: {{ $movie_review->user->name }}
                                    </p>
                                    <p class="mb-4">{{ Str::limit($movie_review->movie_review, 100) }}</p>
                                    <div class="flex justify-end">
                                       <a href="{{ route('movie_reviews.show', $movie_review->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded hover:bg-yellow-400 transition duration-150 ease-in-out">
                                             <span>詳細を見る</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                             </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section>
                        <h2 class="text-2xl font-bold mb-4">映画を探す</h2>
                        <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-150 ease-in-out">
                            映画を探す
                        </button>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>