@extends('layouts.app')
@section('content')
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
          <img src="{{ route('contact.preview', $contact->id) }}" alt="">
        @else
        この形式のファイルはプレビューできません。
        @endif
      @else
        ファイルが削除された可能性があります。
      @endif
      </td></tr>
      <tr>
        <th>レスポンス</th>
        <td>
          <form method="post" action="{{ route('contact-response.store', $contact->id) }}">
            @csrf
            <div class="form-group">
              <label for="response_content">レスポンス</label>
              <textarea name="response_content" class="form-control" id="response_content" value="" placeholder="レスポンスしてください。">{{ old('response_content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">送信する</button>
          </form>
        </td>
      </tr>
    </table>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>レスポンス内容</th>
          <th>対応者</th>
          <th>対応日時</th>
          <th>編集</th>
          <th>削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($contact->contactResponses->sortByDesc('created_at') as $contactResponse)
          <?php $isSameUser = $contactResponse->user && Auth::id() === $contactResponse->user->id ?>
          <tr>
            <td>{{ $contactResponse->response_content }}</td>
            <td>@if ($contactResponse->user) {{ $contactResponse->user->name }} @endif</td>
            <td>{{ $contactResponse->created_at }}</td>
            <td>
            @if ($isSameUser)
              <a href="{{ route('contact-response.edit', ['contact' => $contactResponse->contact_id, 'contact_response' => $contactResponse->id]) }}" class="btn btn-primary">編集</a>
            @endif
            </td>
            <td>
            @if ($isSameUser) 
              <form method="post" action="{{ route('contact-response.destroy', ['contact' => $contactResponse->contact_id, 'contact_response' => $contactResponse->id]) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-warning" onClick="return confirm('本当に削除しますか？');">削除</button>
              </form>
            @endif 
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
@endsection
