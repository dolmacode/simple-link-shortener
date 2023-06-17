<!doctype html>
<html>
    <head>
        <title>Сокращение ссылок</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script defer src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div id="root">
            <header>
                <h1>Сокращение ссылок онлайн</h1>
            </header>
            
            <main>
                <form method="post" id="store-link-form" enctype="multipart/form-data">
                    <input name="base_link" value="http://" type="url" id="store-link-base" class="form-input" placeholder="Введите ссылку">
                    <button type="button" id="store-link-submit" class="form-submit">Сократить</button>
                </form>
                
                <ul class="recent-links">
                    @foreach($recent as $link)
                    <li>
                        <a href="{{ $link->short_link ?? '/' }}" class="link">{{ env('APP_URL') . '/' . $link->short_link ?? "Ссылка недоступна" }}</a>
                    </li>
                    @endforeach
                </ul>
            </main>
            
            <footer>
                2023, dev by dolmacode
            </footer>
        </div>
    </body>
</html>