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
            <label for="review">レビュー:</label>
            <textarea name="review" id="review" maxlength="500" placeholder="500字以内で入力してください" required></textarea>
        </div>
        
       
        
        

        <button type="submit">投稿する</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#theater_id').change(function() {
                var theaterId = $(this).val();
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
            });
        });
    </script>
</body>
</html>