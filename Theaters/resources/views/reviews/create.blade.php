<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レビュー投稿') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="theater_id" class="block text-sm font-medium text-gray-700">映画館名:</label>
                            <select name="theater_id" id="theater_id" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">選択してください</option>
                                @foreach($theaters as $theater)
                                    <option value="{{ $theater->id }}">{{ $theater->theater_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="screen_number" class="block text-sm font-medium text-gray-700">スクリーン番号:</label>
                            <select name="screen_number" id="screen_number" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">映画館を選択してください</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="seat_number" class="block text-sm font-medium text-gray-700">座席番号:</label>
                            <input type="text" name="seat_number" id="seat_number" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="viewing_date" class="block text-sm font-medium text-gray-700">鑑賞日:</label>
                            <input type="date" name="viewing_date" id="viewing_date" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="theater_review" class="block text-sm font-medium text-gray-700">映画館レビュー:</label>
                            <textarea name="theater_review" id="theater_review" maxlength="500" placeholder="500字以内で入力してください" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="movie_title" class="block text-sm font-medium text-gray-700">映画タイトル:</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" id="selected_movie_title" name="movie_title" readonly class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300">
                                <button type="button" id="select_movie" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-r-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    映画を選ぶ
                                </button>
                            </div>
                            <input type="hidden" id="selected_movie_id" name="movie_id">
                        </div>
                        
                        <div class="mb-4">
                            <label for="movie_rating" class="block text-sm font-medium text-gray-700">映画評価:</label>
                            <select name="movie_rating" id="movie_rating" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">選択してください</option>
                                @for ($i = 0; $i <= 50; $i++)
                                    <option value="{{ $i / 10 }}">{{ number_format($i / 10, 1) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="movie_review" class="block text-sm font-medium text-gray-700">映画レビュー:</label>
                            <textarea name="movie_review" id="movie_review" maxlength="500" placeholder="500字以内で入力してください" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('movie_review') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                投稿する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    $(document).ready(function() {
        console.log('Document ready');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getScreenNumbers(theaterId) {
            console.log('getScreenNumbers called with:', theaterId);
            if(theaterId) {
                $.ajax({
                    url: "{{ route('get.screen.numbers', '') }}/" + theaterId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log('Received screen numbers:', data);
                        $('#screen_number').empty();
                        if(data.length > 0) {
                            $.each(data, function(key, value) {
                                $('#screen_number').append('<option value="'+ value +'">'+ value +'</option>');
                            });
                        } else {
                            $('#screen_number').append('<option value="">スクリーンが見つかりません</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("エラーが発生しました: " + error);
                        $('#screen_number').empty().append('<option value="">エラーが発生しました</option>');
                    }
                });
            } else {
                $('#screen_number').empty().append('<option value="">映画館を選択してください</option>');
            }
        }

        $('#theater_id').change(function() {
            console.log('Theater selected:', $(this).val());
            getScreenNumbers($(this).val());
        });

        $('#select_movie').on('click', function(e) {
            e.preventDefault();
            console.log('Select movie button clicked');
            
            localStorage.setItem('review_form', JSON.stringify({
                theater_id: $('#theater_id').val(),
                screen_number: $('#screen_number').val(),
                seat_number: $('#seat_number').val(),
                viewing_date: $('#viewing_date').val(),
                theater_review: $('#theater_review').val(),
                movie_rating: $('#movie_rating').val(),
                movie_review: $('#movie_review').val()
            }));

            window.location.href = "{{ route('movies.search') }}";
        });

        var savedForm = localStorage.getItem('review_form');
        if (savedForm) {
            console.log('Saved form data found');
            savedForm = JSON.parse(savedForm);
            $('#theater_id').val(savedForm.theater_id);
            $('#seat_number').val(savedForm.seat_number);
            $('#viewing_date').val(savedForm.viewing_date);
            $('#theater_review').val(savedForm.theater_review);
            $('#movie_rating').val(savedForm.movie_rating);
            $('#movie_review').val(savedForm.movie_review);

            if (savedForm.theater_id) {
                getScreenNumbers(savedForm.theater_id);
                setTimeout(function() {
                    $('#screen_number').val(savedForm.screen_number);
                }, 500);
            }

            localStorage.removeItem('review_form');
        }

        @if(isset($selectedMovie))
            console.log('Selected movie:', @json($selectedMovie));
            $('#selected_movie_title').val("{{ $selectedMovie['title'] }}");
            $('#selected_movie_id').val("{{ $selectedMovie['id'] }}");
        @endif
    });
    </script>
    @endpush
</x-app-layout>