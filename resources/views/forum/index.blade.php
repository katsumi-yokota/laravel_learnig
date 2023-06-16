@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<div class="container">
  <body>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>名前</th>
          <th>タイトル</th>
          <th>メール</th>
          <th>内容</th>
        </tr>
      </thead>
    @foreach ($contents as $content)
    <tbody>
      <tr>
        <td>{{ $content->name }}</td>
        <td>{{ $content->title }}</td>
        <td>{{ $content->email }}</td>
        <td>{!! nl2br($content->body) !!}</td>
      </tr>
    </tbody>
    @endforeach
    </table>
  
    <form method="post" action="{{ route('forum.store') }}">
      @csrf
      <div class="form-group">
        <label for="title">タイトル</label>
        <input class="form-control" type="text" name="title" id="title">
      </div>
      <div class="form-group">
        <label for="name">名前</label>
        <input class="form-control" type="text" name="name" id="name">
      </div>
  
      <div class="form-group">
        <label for="email">Eメール</label>
        <input class="form-control" type="text" name="email" id="email">
      </div>
  
      <div class="form-group">
        <label for="body">内容</label>
        <textarea class="form-control" name="body" id="body" cols="30" rows="5"></textarea>
      </div>
  
      <button type="submit" class="btn btn-danger my-3">投稿</button>
    </form>
</div>
</body>
</html>
@endsection
