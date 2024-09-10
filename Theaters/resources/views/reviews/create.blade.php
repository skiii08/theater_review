<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レビュー投稿</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>レビュー投稿</h1>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <div>
            <label for="theater_id">映画館名:</label>
            <select name="theater_id" id="theater_id" required>
                <option value="">選択してください</option>
                @foreach($theaters as $theater)
                    <option value="{{ $theater->id }}">{{ $theater->theater_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="screen_number">スクリーン番号:</label>
            <select name="screen_number" id="screen_number" required>
                <option value="">映画館を選択してください</option>
            </select>
        </div>
        <div>
            <label for="seat_number">座席番号:</label>
            <input type="text" name="seat_number" id="seat_number" required>
        </div>
        <div>
            <label for="viewing_date">鑑賞日:</label>
            <input type="date" name="viewing_date" id="viewing_date" required>
        </div>
        <div>
            <label for="theater_review">映画館レビュー:</label>
            <textarea name="theater_review" id="theater_review" maxlength="500" placeholder="500字以内で入力してください" required></textarea>
        </div>
        
        <div>
            <label for="movie_title">映画タイトル:</label>
            <button type="button" id="select_movie">映画を選ぶ</button>
            <input type="text" id="selected_movie_title" name="movie_title" readonly>
            <input type="hidden" id="selected_movie_id" name="movie_id">
        </div>
        
        <div>
            <label for="movie_rating">映画評価:</label>
            <select name="movie_rating" id="movie_rating" required>
                <option value="">選択してください</option>
                @for ($i = 0; $i <= 50; $i++)
                    <option value="{{ $i / 10 }}">{{ number_format($i / 10, 1) }}</option>
                @endfor
            </select>
        </div>

        <div>
            <label for="movie_review">映画レビュー:</label>
            <textarea name="movie_review" id="movie_review" maxlength="500" placeholder="500字以内で入力してください" required>{{ old('movie_review') }}</textarea>
        </div>

        <button type="submit">投稿する</button>
    </form>

    <script>
    $(document).ready(function() {
        // スクリーンナンバーの取得関数
        function getScreenNumbers(theaterId) {
            if(theaterId) {
                $.ajax({
                    url: '/get-screen-numbers/' + theaterId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#screen_number').empty();
                        $.each(data, function(key, value) {
                            $('#screen_number').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('#screen_number').empty();
                $('#screen_number').append('<option value="">映画館を選択してください</option>');
            }
        }

        // 映画館選択時のイベント
        $('#theater_id').change(function() {
            getScreenNumbers($(this).val());
        });

        // 映画選択ボタンのクリックイベント
        $('#select_movie').on('click', function(e) {
            e.preventDefault();
            
            // フォームの現在の状態を保存
            localStorage.setItem('review_form', JSON.stringify({
                theater_id: $('#theater_id').val(),
                screen_number: $('#screen_number').val(),
                seat_number: $('#seat_number').val(),
                viewing_date: $('#viewing_date').val(),
                theater_review: $('#theater_review').val(),
                movie_rating: $('#movie_rating').val(),
                movie_review: $('#movie_review').val()
            }));

            // 映画検索ページへ遷移
            window.location.href = "{{ route('movies.search') }}";
        });

        // ページロード時の処理
        var savedForm = localStorage.getItem('review_form');
        if (savedForm) {
            savedForm = JSON.parse(savedForm);
            $('#theater_id').val(savedForm.theater_id);
            $('#seat_number').val(savedForm.seat_number);
            $('#viewing_date').val(savedForm.viewing_date);
            $('#theater_review').val(savedForm.theater_review);
            $('#movie_rating').val(savedForm.movie_rating);
            $('#movie_review').val(savedForm.movie_review);

            // 映画館が選択されている場合、スクリーンナンバーを取得
            if (savedForm.theater_id) {
                getScreenNumbers(savedForm.theater_id);
                // スクリーンナンバーの選択を遅延させる
                setTimeout(function() {
                    $('#screen_number').val(savedForm.screen_number);
                }, 500);
            }

            localStorage.removeItem('review_form');
        }

        // 選択された映画情報の表示
        @if(isset($selectedMovie))
            $('#selected_movie_title').val("{{ $selectedMovie['title'] }}");
            $('#selected_movie_id').val("{{ $selectedMovie['id'] }}");
        @endif
    });
    </script>
</body>
</html>