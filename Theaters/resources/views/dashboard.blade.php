<x-app-layout>
    <x-slot name="header">
        <nav class="flex">
            <a href="{{ route('dashboard') }}" class="font-semibold text-xl {{ request()->routeIs('dashboard') ? 'text-blue-800' : 'text-gray-800' }} leading-tight mr-6">
                {{ __('ホーム') }}
            </a>
            <a href="{{ route('theater.top') }}" class="font-semibold text-xl {{ request()->routeIs('theater.top') ? 'text-blue-800' : 'text-gray-800' }} leading-tight">
                {{ __('映画館') }}
            </a>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">{{ __('プロフィール') }}</h2>
                    <div class="mb-4">
                        <p><strong>{{ __('名前') }}:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>{{ __('メールアドレス') }}:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>{{ __('ステータスメッセージ') }}:</strong> {{ Auth::user()->status_message ?? '未設定' }}</p>
                        <p><strong>{{ __('お気に入りの映画館') }}:</strong> {{ Auth::user()->theater->theater_name ?? '未設定' }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                        {{ __('プロフィールを編集') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>