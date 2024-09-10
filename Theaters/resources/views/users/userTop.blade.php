<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                    
                    <div class="mb-4">
                        <p class="font-bold">Status Message:</p>
                        <p>{{ Auth::user()->status_message ?? 'No status message set.' }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="font-bold">Favorite Theater:</p>
                        <p>{{ Auth::user()->theater->theater_name ?? 'No favorite theater set.' }}</p>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit Profile
                        </a>
                        <a href="{{ route('users.reviews.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            View My Reviews
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>