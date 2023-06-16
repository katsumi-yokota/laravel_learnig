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
    <h1 class="site-title text-lg p-3">ブログ</h1>
  </header>
  <div class="container">
    <main>
      @foreach ($articles as $article)
        <article class="article-item">
          <h2 class="article-title text-lg p-1">{{ $article->title }}</h2>
          <p class="article-body p-1">{!! nl2br($article->body) !!}</p>
        </article>
      @endforeach
    </main>
  </div>
</body>
</html>
@endsection
