<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画館トップページ') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="mb-12">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">最近のレビュー</h2>
                        <a href="{{ route('reviews.create') }}" class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out mb-8 shadow-md">
                            新しいレビューを投稿する
                        </a>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($theater_reviews->take(6) as $theater_review)
                                <div class="border rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300 bg-white">
                                    <div class="relative">
                                        <img src="{{ $theater_review->image_url ?? 'https://via.placeholder.com/300x200' }}" alt="Theater Image" class="w-full h-48 object-cover">
                                        <div class="absolute top-0 right-0 bg-yellow-400 text-navy-600 px-3 py-1 m-2 rounded-full text-sm font-semibold">
                                            {{ $theater_review->theater->theater_name }}
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <p class="text-sm text-gray-600 mb-2">{{ $theater_review->theater->adress }}</p>
                                        <p class="text-sm text-gray-700 mb-3">
                                            投稿者: {{ $theater_review->user->name }}
                                        </p>
                                        <p class="mb-4 text-gray-700">{{ Str::limit($theater_review->review, 100) }}</p>
                                        <div class="flex justify-end">
                                            <a href="{{ route('reviews.show', $theater_review->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-lg hover:bg-yellow-400 transition duration-300 ease-in-out shadow">
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
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">映画館を探す</h2>
                        <button class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300 ease-in-out shadow-md">
                            映画館を探す
                        </button>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>