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
      <tr>
        <th>タグ名</th>
        <td>
        @php
          $contactTagCount = $contact->contactTags->count();
        @endphp
        @if ($contactTagCount === 0)
          タグをつけていません。
        @else
          @foreach ($contact->contactTags as $i => $contactTag)
            {{ $contactTag->name }}{{ $i < $contactTagCount - 1 ? ',' : '' }}
          @endforeach
        @endif
        </td>
      </tr>
      <tr><th>タイトル  </th><td>{{ $contact->title }}</td></tr>
      <tr><th>お名前  </th><td>{{ $contact->name }}</td></tr>
      <tr><th>本文  </th><td>{{ $contact->body }}</td></tr>
      <tr><th>メールアドレス  </th><td>{{ $contact->email }}</td></tr>
      <tr><th>お問い合わせ日時  </th><td>{{ $contact->created_at }}</td></tr>
      <tr><th>ファイル名  </th><td>{{ $contact->file_name }}</td></tr>
      <tr>
        <th>ゲストユーザー様用のURL</th>
        <td>
        @if ($contact->status === App\Models\Contact::CLOSED)
          問い合わせはクローズしているので問い合わせ者はURLにアクセスできません。
        @else
          @if ($contact->share_status === App\Models\Contact::SHARED)
            {{ request()->url() . "/contact-interaction/$contact->share_code" }}
          @else 
            URLは発行されていません。
          @endif
        @endif
        </td>
      </tr>
      <tr>
        <th>返信</th>
        <td>
        @if ($contact->is_closed)
          クローズしているので返信できません。
        @else
          <form method="post" action="{{ route('contact-interaction.store', $contact->id) }}">
            @csrf
            <div class="form-group">
              <textarea name="response_content" class="form-control" id="response_content" value="" placeholder="ここに返信を書いてください。">{{ old('response_content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">送信する</button>
          </form>
        @endif
        </td>
      </tr>
    </table>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>返信内容</th>
          <th>返信者</th>
          <th>返信日時</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($contact->contactResponses->sortByDesc('created_at') as $contactResponse)
          <?php $isSameUser = $contactResponse->user && Auth::id() === $contactResponse->user->id ?>
          <tr>
            <td>{{ $contactResponse->response_content }}</td>
            <td>
              @if ($contactResponse->user) 
                {{ $contactResponse->user->name }} 
              @else
                {{ $contact->name . '様 ※ゲストユーザー様の返信です' }}
              @endif</td>
            <td>{{ $contactResponse->created_at }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
@endsection
