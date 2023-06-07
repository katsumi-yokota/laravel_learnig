@extends('layouts.app')
@section('content')
<?php $hashedName = basename($contact->file_path); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>詳細</title>
</head>
<body>
  <div class="container">
    <table class="table table-striped table-bordered">
      <tr><th>お問い合わせID  </th><td>{{ $contact->id }}</td></tr>
      <tr><th>カテゴリー名  </th><td>{{ $contact->contactCategory->name }}</td></tr>
      <tr><th>タイトル  </th><td>{{ $contact->title }}</td></tr>
      <tr><th>お名前  </th><td>{{ $contact->name }}</td></tr>
      <tr><th>本文  </th><td>{{ $contact->body }}</td></tr>
      <tr><th>メールアドレス  </th><td>{{ $contact->email }}</td></tr>
      <tr><th>お問い合わせ日時  </th><td>{{ $contact->created_at }}</td></tr>
      <tr><th>更新日時  </th><td>{{ $contact->updated_at }}</td></tr>
      <tr><th>ファイル名  </th><td>{{ $contact->file_name }}</td></tr>
      <tr><th>プレビュー  </th><td>
      @if (!$contact->file_path)
        ファイルが添付されていません。
      @elseif (File::exists($contact->file_path))
        @if (preg_match('/.+\.(png|jpe?g|gif|bmp)$/', $contact->file_name))
          <img src="{{ asset("storage/contact/$hashedName") }}" alt="">
        @else
        この形式のファイルはプレビューできません。
        @endif
      @else
        ファイルが削除された可能性があります。
      @endif
      </td></tr>
      <tr><th>対応履歴  </th><td>ここに対応履歴を表示</td></tr>
    </table>
  </div>
</body>
</html>
@endsection
