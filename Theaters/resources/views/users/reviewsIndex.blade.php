<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Reviews') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Theater Reviews</h3>
                    @forelse (Auth::user()->theaterReviews as $review)
                        <div class="mb-4 p-4 border rounded">
                            <p><strong>Theater:</strong> {{ $review->theater->theater_name }}</p>
                            <p><strong>Date:</strong> {{ $review->viewing_date->format('Y-m-d') }}</p>
                            <p><strong>Review:</strong> {{ Str::limit($review->review, 100) }}</p>
                            <a href="{{ route('reviews.show', $review) }}" class="text-blue-500 hover:underline">Read more</a>
                        </div>
                    @empty
                        <p>No theater reviews yet.</p>
                    @endforelse

                    <h3 class="text-lg font-semibold mb-4 mt-8">Movie Reviews</h3>
                    @forelse (Auth::user()->movieReviews as $review)
                        <div class="mb-4 p-4 border rounded">
                            <p><strong>Movie:</strong> {{ $review->movie->title }}</p>
                            <p><strong>Rating:</strong> {{ $review->movie_rating }}/5</p>
                            <p><strong>Review:</strong> {{ Str::limit($review->movie_review, 100) }}</p>
                            <a href="{{ route('reviews.show', $review->theaterReview) }}" class="text-blue-500 hover:underline">Read more</a>
                        </div>
                    @empty
                        <p>No movie reviews yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>