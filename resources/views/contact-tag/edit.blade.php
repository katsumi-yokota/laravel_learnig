@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>編集</title>
</head>
<body>
  <form method="post" action="{{ route('contact-tag.update',['contact_tag_id' => $contactTag->id, 'contact_tag' => $contactTag]) }}">
    @csrf
    @method('put')
      <input type="text" name="name" value="{{ $contactTag->name }}">
      <button type="submit">編集</button>
  </form>
</body>
</html>
@endsection
