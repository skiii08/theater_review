<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $theater->theater_name }}の詳細
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row md:space-x-6">
                        <!-- 左側：映画館情報 -->
                        <div class="md:w-1/2">
                            <h3 class="text-2xl font-bold mb-4 text-indigo-700">映画館情報</h3>
                            <p class="mb-2"><span class="font-semibold">名称:</span> {{ $theater->theater_name }}</p>
                            <p class="mb-2"><span class="font-semibold">住所:</span> {{ $theater->adress }}</p>
                            <p class="mb-4"><span class="font-semibold">スクリーン数:</span> {{ $screens->count() }}</p>

                           

                        <!-- 右側：スクリーン情報 -->
                        <div class="md:w-1/2">
                            <h3 class="text-2xl font-bold mb-4 text-indigo-700">スクリーン情報</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-300">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="py-2 px-4 border-b">スクリーン番号</th>
                                            <th class="py-2 px-4 border-b">座席数</th>
                                            <th class="py-2 px-4 border-b">スクリーンサイズ</th>
                                            <th class="py-2 px-4 border-b">音響システム</th>
                                            <th class="py-2 px-4 border-b">投影方式</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($screens as $screen)
                                            <tr>
                                                <td class="py-2 px-4 border-b">{{ $screen->screen_number }}</td>
                                                <td class="py-2 px-4 border-b">{{ $screen->seeting_capacity }}</td>
                                                <td class="py-2 px-4 border-b">{{ $screen->screen_size }}</td>
                                                <td class="py-2 px-4 border-b">{{ $screen->sound_system }}</td>
                                                <td class="py-2 px-4 border-b">{{ $screen->projection_type }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- ... 既存のコード ... -->

                    <h3 class="text-3xl font-bold mt-12 mb-8 text-indigo-700">最近のレビュー</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($reviews as $review)
                            <div class="border rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300 bg-white">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $review->image_url ?? 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                                         alt="Review Image" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="p-6">
                                    <p class="text-sm text-indigo-600 mb-2 font-semibold">{{ $review->created_at->format('Y年m月d日') }}</p>
                                    <p class="text-lg font-bold text-gray-800 mb-3">
                                        投稿者: {{ $review->user->name }}
                                    </p>
                                    <p class="mb-4 text-gray-700 leading-relaxed">{{ Str::limit($review->review, 100) }}</p>
                                    <div class="flex justify-end">
                                        <a href="{{ route('reviews.show', $review->id) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-lg hover:bg-yellow-400 transition duration-300 ease-in-out shadow">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>