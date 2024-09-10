<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レビュー編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="theater_id" class="block text-sm font-medium text-gray-700">映画館名:</label>
                            <select name="theater_id" id="theater_id" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">選択してください</option>
                                @foreach($theaters as $theater)
                                    <option value="{{ $theater->id }}" {{ $review->theater_id == $theater->id ? 'selected' : '' }}>
                                        {{ $theater->theater_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="screen_number" class="block text-sm font-medium text-gray-700">スクリーン番号:</label>
                            <select name="screen_number" id="screen_number" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="{{ $review->screen_number }}">{{ $review->screen_number }}</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="seat_number" class="block text-sm font-medium text-gray-700">座席番号:</label>
                            <input type="text" name="seat_number" id="seat_number" value="{{ $review->seat_number }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="viewing_date" class="block text-sm font-medium text-gray-700">鑑賞日:</label>
                            <input type="date" name="viewing_date" id="viewing_date" value="{{ $review->viewing_date instanceof \Carbon\Carbon ? $review->viewing_date->format('Y-m-d') : $review->viewing_date }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="review" class="block text-sm font-medium text-gray-700">レビュー:</label>
                            <textarea name="review" id="review" maxlength="500" placeholder="500字以内で入力してください" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $review->review }}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                更新する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // スクリーン番号を動的に更新するJavaScriptコードをここに追加
    </script>
    @endpush
</x-app-layout>