<?php $user = App\Models\Contact::find(1); // アクセサ ?>
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="container">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>@sortablelink('title', 'タイトル')</th>
        <th>@sortablelink('name', '名前')</th>
        <th>@sortablelink('body', '内容')</th>
        <th>@sortablelink('created_at', '受付日時')</th>
        <th>@sortablelink('file_name', 'ファイルダウンロード')</th>
        <th>ファイルプレビュー</th>
        <th>コンタクトカテゴリーID</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contacts as $contact)
      <tr>
        <td>{{ $contact->title }}</td>
        <td>{{ $contact->name }}</td>
        <td>{!! nl2br(e($contact->body)) !!}</td>
        <td>{{ $contact->created_at }}</td>
          @if (!$contact->file_path)
          <td></td>
          <td>ファイルが添付されていません。</td>
          @elseif (File::exists($contact->file_path)) <!-- public配下を確認 -->
          <td><a href="{{ route('contact.download', $contact->id) }}">{{ $contact->file_name }}</a></td>
            @if (preg_match('/.+\.(png|jpe?g|gif|bmp)$/', $contact->file_name))
            <td><img src="{{ asset("storage/contact/$contact->file_name") }}" alt=""></td>
            @else
            <td>この形式のファイルはプレビューできません。</td>
            @endif
          @else
          <td></td>
          <td>ファイルが削除された可能性があります。</td>
          @endif
          @if (isset($contact->contactCategory->name))
          <td>{{ $contact->contactCategory->name }}</td>
          @else
          <td>カテゴリーが指定されていません。</td>
          @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
{{ $contacts->appends(request()->query())->links() }}