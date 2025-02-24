<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ひらめきッチン</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                background:
                    linear-gradient(135deg, #e0f7fa, #ffccbc);
                /* 落ち着いたグラデーション背景 */
                font-family: 'Arial', sans-serif;
                /* フォントを変更 */
            }

            main {
                flex: 1;
                padding: 20px;
                /* パディングを追加 */
                border-radius: 10px;
                /* 角を丸くする */
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                /* シャドウを追加 */
                background-color: rgba(255, 255, 255, 0.9);
                /* メインの背景色を少し透過させる */
            }

            header {
                text-align: center;
                /* ヘッダーを中央揃え */
            }

            h1 {
                color: #ff5722;
                /* タイトルの色を変更 */
                font-size: 24px;
                /* フォントサイズを変更 */
            }

            label {
                font-weight: bold;
                /* ラベルを太字に */
                color: #333;
                /* ラベルの色を変更 */
            }

            button {
                background-color: #ff5722;
                /* ボタンの背景色 */
                color: white;
                /* ボタンの文字色 */
                border: none;
                /* ボーダーを削除 */
                border-radius: 5px;
                /* ボタンの角を丸くする */
                padding: 10px 15px;
                /* ボタンのパディング */
                cursor: pointer;
                /* カーソルをポインターに */
                transition: background-color 0.3s;
                /* ホバー時のトランジション */
            }

            button:hover {
                background-color: #e64a19;
                /* ホバー時の色 */
            }
        </style>
    @endif
</head>

<body>
    <div class="container mx-auto">
        <header>
            <div style="display: flex; align-items: center;"><img src="{{ asset('images/ひらめきッチン.png') }}" alt="ひらめきッチン"
                    style="width: 100px; height: auto;" />
                <h1 style="margin-left: 10px;">余った食材からレシピを考えます！</h1>
            </div>
        </header>
        <main>
            <form action="/kitchen" method="POST">
                @csrf
                <div>
                    <label>料理のスタイル:</label><br>
                    <input type="radio" id="japanese" name="style" value="和風"
                        {{ old('style') == '和風' ? 'checked' : '' }}>
                    <label for="japanese">和風</label><br>
                    <input type="radio" id="western" name="style" value="洋風"
                        {{ old('style') == '洋風' ? 'checked' : '' }}>
                    <label for="western">洋風</label><br>
                    <input type="radio" id="chinese" name="style" value="中華風"
                        {{ old('style') == '中華風' ? 'checked' : '' }}>
                    <label for="chinese">中華風</label>
                </div>
                <label for="inputField">食材:</label>
                <input type="text" id="inputField" name="ingredients" required placeholder="複数入力OK"
                    value="{{ old('ingredients') }}">
                <button type="submit">送信</button>
            </form>
            @if (isset($value))
                <div>{!! $value !!}</div>
            @endif
        </main>
        <footer>
            <p>&copy; 2025 Keigo Okabe</p>
        </footer>
    </div>
</body>

</html>
