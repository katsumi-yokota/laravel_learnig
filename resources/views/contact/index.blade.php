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
          @elseif (File::exists("$contact->file_path"))
          <td><a href="{{ route('contact.download', $contact->id) }}">{{ $contact->file_name }}</a></td>
          <td><img src="{{ asset("storage/contact/$contact->file_name") }}" alt=""></td>
          @else
          <td></td>
          <td>ファイルが削除された可能性があります。</td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
{{ $contacts->appends(request()->query())->links() }}