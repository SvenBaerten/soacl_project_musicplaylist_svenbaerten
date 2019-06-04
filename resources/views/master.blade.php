<!doctype html>
<html lang="en">
    <head>
        <title>Music Playlist</title>
        <meta charset="utf_8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Music playlist website for the course 'SOA & Cloud computing'.">
        <meta name="author" content="Sven Baerten">
        <meta type="hidden" name="csrf-token" content="{{ csrf_token() }}"> <!-- FROM https://stackoverflow.com/questions/46466167/laravel-5-5-ajax-call-419-unknown-status-->
        <base href="{{URL::asset('/')}}" target="_top">
        
        <!-- Bootstrap CSS -->
        <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="{{{URL::asset('css/music_playlist.css')}}}">    
    </head>
    <body>
        <header>
            @include('header')
        </header>
        

        <div class='container-fluid' id='container'>
            @yield('content')
        </div>

        <div id="video-placeholder"></div> <!-- For YouTube video. -->

        <footer>
            @include('footer')
        </footer>        

        <!-- JavaScript -->
        <script type="application/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script type="application/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="application/javascript" src="{{{URL::asset('js/music_playlist.js')}}}"></script>
        <script type="application/javascript" src="https://www.youtube.com/iframe_api"></script>
    </body>
</html>
