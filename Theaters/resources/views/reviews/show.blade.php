<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レビュー詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">{{ $review->theater ? $review->theater->theater_name : 'N/A' }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <p><strong>スクリーン番号:</strong> {{ $review->screen_number }}</p>
                            <p><strong>座席番号:</strong> {{ $review->seat_number }}</p>
                            <p><strong>鑑賞日:</strong> {{ \Carbon\Carbon::parse($review->viewing_date)->format('Y年m月d日') }}</p>
                            <p><strong>投稿日時:</strong> {{ \Carbon\Carbon::parse($review->created_at)->format('Y年m月d日 H:i') }}</p>
                            @if($review->image_url)
    <div class="mb-4">
        <img src="{{ $review->image_url }}" alt="Review Image" class="max-w-full h-auto">
    </div>
@endif
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-md font-semibold mb-2">レビュー内容:</h4>
                        <p class="bg-gray-100 p-4 rounded">{{ $review->review }}</p>
                    </div>

                    <div class="flex space-x-4 mb-6">
                        <a href="{{ route('theater.top') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-150 ease-in-out">
                            トップページに戻る
                        </a>
                        @if(auth()->check() && $review->user_id && auth()->id() == $review->user_id)
                            <a href="{{ route('reviews.edit', $review) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150 ease-in-out">
                                編集
                            </a>
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-150 ease-in-out" onclick="return confirm('本当に削除しますか？');">
                                    削除
                                </button>
                            </form>
                        @endif
                    </div>

                    @if(!auth()->check())
                        <p class="text-sm text-gray-600">編集・削除機能を使用するにはログインが必要です。</p>
                    @endif

                    @if(config('app.debug'))
                        <div class="mt-8 p-4 bg-gray-100 rounded">
                            <h3 class="text-lg font-semibold mb-2">デバッグ情報:</h3>
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