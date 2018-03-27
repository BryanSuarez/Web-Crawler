<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Posts</title>
</head>
<body class="bg-grey-lighter">
<div class="row">
    <div class="col-sm-12"><h3 class="text-center">Fetched posts</h3></div>
</div>
<div class="container">
    @foreach($articles as $article)
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-7 col-lg-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Title:</b> {{ $article->title }}</div>
                    <div class="panel-body">
                        <p>
                            <b>Ranking:</b> <span class="label label-default">{{ $article->rank }}</span> |
                            <b>Comments:</b> <span class="label label-default">{{ $article->comments }}</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
</div>
<ul>
</ul>
</body>
</html>




