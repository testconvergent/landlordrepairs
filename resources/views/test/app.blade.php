<html>
    <head>
        <title>{{ $title or 'Laravel News' }}</title>
    </head>

    <body>
        <div class="container">
            {{ $slot }}
        </div>
    </body>
</html>