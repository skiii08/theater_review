<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画トップページ') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="mb-8">
                        <h2 class="text-3xl font-bold mb-4 text-indigo-700">最近の映画レビュー</h2>
                        <a href="{{ route('reviews.create') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 ease-in-out mb-6 shadow-md">
                            新しいレビューを投稿する
                        </a>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($movie_reviews->take(6) as $movie_review)
                                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                                    <div class="h-64 overflow-hidden">
                                        <img src="{{ $movie_review->movie->poster_uri }}" alt="{{ $movie_review->movie->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-6 flex-grow flex flex-col justify-between">
                                        <div>
                                            <h3 class="font-bold text-xl mb-2 text-indigo-800">{{ $movie_review->movie->title }}</h3>
                                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                                <svg class="w-4 h-4 mr-1 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                                </svg>
                                                <span>{{ $movie_review->user->name }}</span>
                                            </div>
                                            <div class="text-sm text-gray-500 mb-2">
                                                {{ $movie_review->created_at->format('Y年m月d日 H:i') }}
                                            </div>
                                            <p class="text-gray-700 mb-4">{{ Str::limit($movie_review->movie_review, 100) }}</p>
                                        </div>
                                        <div class="flex justify-end mt-4">
                                            <a href="{{ route('movie_reviews.show', $movie_review->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-indigo-900 font-semibold rounded-lg hover:bg-yellow-400 transition duration-300 ease-in-out shadow-md">
                                                <span>詳細を見る</span>
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section>
                        <h2 class="text-3xl font-bold mb-4 text-indigo-700">映画を探す</h2>
                        <button class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300 ease-in-out shadow-md">
                            映画を探す
                        </button>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>