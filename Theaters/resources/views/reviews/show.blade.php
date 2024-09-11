<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レビュー詳細') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row">
                        <!-- 左側：レビュー情報 -->
                        
                                                
                        
                        <div class="md:w-2/3 pr-4">
                            <h3 class="text-2xl font-bold mb-4 text-indigo-700">{{ $review->theater ? $review->theater->theater_name : 'N/A' }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <p><span class="font-semibold text-gray-600">スクリーン番号:</span> {{ $review->screen_number }}</p>
                                <p><span class="font-semibold text-gray-600">座席番号:</span> {{ $review->seat_number }}</p>
                                <p><span class="font-semibold text-gray-600">鑑賞日:</span> {{ \Carbon\Carbon::parse($review->viewing_date)->format('Y年m月d日') }}</p>
                                <p><span class="font-semibold text-gray-600">投稿日時:</span> {{ \Carbon\Carbon::parse($review->created_at)->format('Y年m月d日 H:i') }}</p>
                            </div>
                            
                            <a href="{{ route('theaters.show', $review->theater_id) }}" class="text-blue-600 hover:underline">
    映画館の詳細を見る
</a>
                            
                            <div class="md:w-1/3">
                            @if($review->image_url)
                                <div class="sticky top-6">
                                    <img src="{{ $review->image_url }}" alt="Review Image" class="w-full rounded-lg shadow-lg">
                                </div>
                            @endif
                        </div>
                        

                            <div class="mb-6">
                                <h4 class="text-xl font-semibold mb-2 text-indigo-600">レビュー内容:</h4>
                                <p class="bg-gray-50 p-4 rounded-lg border border-gray-200">{{ $review->review }}</p>
                            </div>

                            <div class="flex flex-wrap gap-4 mb-6">
                                <a href="{{ route('theater.top') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300 ease-in-out">
                                    トップページに戻る
                                </a>
                                
                                
                                @if(auth()->check() && $review->user_id && auth()->id() == $review->user_id)
                                    <a href="{{ route('reviews.edit', $review) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">
                                        編集
                                    </a>
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 ease-in-out" onclick="return confirm('本当に削除しますか？');">
                                            削除
                                        </button>
                                    </form>
                                @endif
                            </div>

                            @if(!auth()->check())
                                <p class="text-sm text-gray-600">編集・削除機能を使用するにはログインが必要です。</p>
                            @endif
                        </div>

                        <!-- 右側：画像 -->

                    </div>

                    @if(config('app.debug'))
                        <div class="mt-8 p-4 bg-gray-100 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2 text-gray-700">デバッグ情報:</h3>
                            <p>ユーザーログイン状態: {{ auth()->check() ? 'ログイン中' : '未ログイン' }}</p>
                            <p>現在のユーザーID: {{ auth()->id() ?? 'なし' }}</p>
                            <p>レビューのuser_id: {{ $review->user_id ?? 'なし' }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>