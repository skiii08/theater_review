<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('お気に入りの映画館') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("　") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="theater_id" :value="__('映画館')" />
            <select id="theater_id" name="theater_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">選択してください</option>
                @foreach (\App\Models\Theater::all() as $theater)
                    <option value="{{ $theater->id }}" {{ old('theater_id', $user->theater_id) == $theater->id ? 'selected' : '' }}>
                        {{ $theater->theater_name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('theater_id')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('更新') }}</x-primary-button>

            @if (session('status') === 'favorite-theater-updated')
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