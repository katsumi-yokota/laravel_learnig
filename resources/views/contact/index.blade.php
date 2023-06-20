<?php $user = App\Models\Contact::find(1); // アクセサ ?>
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="container">

  <form action="" method="get">
  <input type="text" name="keyword" id="keyword" class="form-control" placeholder="タイトルまたは名前を入力してください。" value="@if(isset($keyword)){{ $keyword }}@endif">
  <select name="contact_category_id" id="contact_category_id" class="form-control" value="">
    <option value="0">全カテゴリー</option>
    @foreach ($contactCategories as $contactCategory)
      <option @if ($contactCategory->id === $selectedContactCategoryId) selected @endif value="{{ $contactCategory->id }}">{{ $contactCategory->name }}</option>
    @endforeach
  </select>
  <select name="contact_tag_id" id="contact_tag_id" class="form-control" value="">
    <option value="">全タグ</option>
    @foreach ($contactTags as $contactTag)
      <option @if ($contactTag->id === $selectedContactTagId) selected @endif value="{{ $contactTag->id }}">{{ $contactTag->name }}</option>
    @endforeach
  </select>
  <button type="submit" class="form-control btn btn-success">検索</button>
  </form>

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>状態</th>
        <th>@sortablelink('contactCategory.name', 'カテゴリー名')</th>
        <th>タグ名</th>
        <th>@sortablelink('title', 'タイトル')</th>
        <th>@sortablelink('name', '名前')</th>
        <th>@sortablelink('body', '内容')</th>
        <th>@sortablelink('created_at', '受付日時')</th>
        <th>@sortablelink('file_name', 'ファイルダウンロード')</th>
        <th>ファイルプレビュー</th>
        <th>詳細</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contacts as $contact)
        <tr>
          <td>
          @if ($contact->is_closed)
            クローズド
          @else
            オープン
          @endif
          </td>
          <td>
          @if (isset($contact->contactCategory))
            <a href="{{ route('contact.index', ['contact_category_id' => $contact->contactCategory->id]) }}">{{ $contact->contactCategory->name }}</a>
          @endif
          </td>  
          <td>
            @php
              $contactTagCount = $contact->contactTags->count();
            @endphp
            @foreach ($contact->contactTags as $i => $contactTag)
              <a href="{{ route('contact.index', ['contact_tag_id' => $contactTag->id]) }}">{{ $contactTag->name }}</a>{{ $i < $contactTagCount - 1 ? ',' : '' }} 
            @endforeach
          </td>
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
            <td><img src="{{ route('contact.preview', $contact->id) }}" alt=""></td>
          @else
            <td>この形式のファイルはプレビューできません。</td>
          @endif
        @else
          <td></td>
          <td>ファイルが削除された可能性があります。</td>
        @endif
          <td><a href="{{ route('contact.show', $contact->id) }}">詳細</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
{{ $contacts->appends(request()->query())->links() }}
