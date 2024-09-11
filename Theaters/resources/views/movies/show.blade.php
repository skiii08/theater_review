<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画レビュー詳細') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($movie_review->movie)
                        <div class="flex flex-col md:flex-row md:space-x-6">
                            <!-- 左側：情報 -->
                            <div class="md:w-1/2">
                                <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                                    <h3 class="text-2xl font-bold mb-4 text-indigo-700">{{ $movie_review->movie->title }}</h3>
                                    <div class="space-y-2">
                                        <p><span class="font-semibold text-gray-600">評価:</span> 
                                            <span class="text-lg text-yellow-500">{{ $movie_review->movie_rating }}</span>
                                        </p>
                                        <p><span class="font-semibold text-gray-600">投稿者:</span> 
                                            {{ $movie_review->user->name ?? 'Unknown' }}
                                        </p>
                                        <p><span class="font-semibold text-gray-600">投稿日時:</span> 
                                            {{ $movie_review->created_at->format('Y年m月d日 H:i') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- レビュー内容 -->
                                <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                                    <h4 class="text-xl font-semibold mb-4 text-indigo-600">レビュー内容:</h4>
                                    <p class="text-gray-700">{{ $movie_review->movie_review }}</p>
                                </div>

                                <!-- ボタン群 -->
                                <div class="flex flex-wrap gap-4">
                                    <a href="{{ route('movies.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300 ease-in-out">
                                        映画トップページに戻る
                                    </a>
                                    
                                    @if(auth()->check() && $movie_review->user_id && auth()->id() == $movie_review->user_id)
                                        <a href="{{ route('movie_reviews.edit', $movie_review) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">
                                            編集
                                        </a>
                                        <form action="{{ route('movie_reviews.destroy', $movie_review) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 ease-in-out" onclick="return confirm('本当に削除しますか？');">
                                                削除
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- 右側：ポスター -->
                            <div class="md:w-1/2">
                                <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                                    <img src="{{ $movie_review->movie->poster_uri }}" alt="{{ $movie_review->movie->title }}" class="w-full h-auto rounded-lg mb-4">
                                    <div class="text-center">
                                        <a href="{{ route('movies.show', $movie_review->movie->id) }}" class="inline-block px-6 py-3 bg-yellow-500 text-gray-900 font-semibold rounded-lg hover:bg-yellow-400 transition duration-300 ease-in-out">
                                            映画詳細を見る
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-red-500">エラー: 関連する映画情報が見つかりません。</p>
                    @endif

                    @if(!auth()->check())
                        <p class="mt-4 text-sm text-gray-600">編集・削除機能を使用するにはログインが必要です。</p>
                    @endif

                    @if(config('app.debug'))
                        <div class="mt-8 p-4 bg-gray-100 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2 text-gray-700">デバッグ情報:</h3>
                            <p>ユーザーログイン状態: {{ auth()->check() ? 'ログイン中' : '未ログイン' }}</p>
                            <p>現在のユーザーID: {{ auth()->id() ?? 'なし' }}</p>
                            <p>レビューのuser_id: {{ $movie_review->user_id ?? 'なし' }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>