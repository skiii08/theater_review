<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ステータスメッセージ') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("ステータスメッセージを変更できます") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="status_message" :value="__('ステータスメッセージ')" />
            <x-text-input id="status_message" name="status_message" type="text" class="mt-1 block w-full" :value="old('status_message', $user->status_message)" autocomplete="status_message" />
            <x-input-error class="mt-2" :messages="$errors->get('status_message')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('更新') }}</x-primary-button>

            @if (session('status') === 'status-message-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>