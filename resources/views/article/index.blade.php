@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ブログ</title>
</head>
<body>
    <header>
        <h1 class="site-title">ブログ</h1>
    </header>
    <main class="container">
        @foreach ($articles as $article)
          <article class="article-item">
            <h2 class="article-title">{{ $article->title }}</h2>
            <p class="article-body">{{ $article->body }}</p>
          </article>
        @endforeach
    </main>
    <footer>
        &copy; Laravelの学習
    </footer>
</body>
</html>
@endsection
