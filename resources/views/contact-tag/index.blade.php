@extends('layouts.app')
@section('content')

<div class="container mt-4">

  <div class="btn btn-link btn-lg">
    <x-nav-link :href="route('contact-tag.create')">
      {{ __('新規コンタクトタグ追加') }}
    </x-nav-link>
  </div>

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>タグ名</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contactTags as $contactTag)
      <tr>
        <td>{{ $contactTag->name }}</td>
        <td><a href="{{ route('contact-tag.show', $contactTag->id) }}">詳細</a></td>
        <td><a href="{{ route('contact-tag.edit', $contactTag->id) }}">編集</a></td>
        <td>
          <form method="post" action="{{ route('contact-tag.destroy', $contactTag->id) }}">
            @csrf
            @method('delete')
          <button type="submit" onClick="return confirm('削除しますか？');">
            削除
          </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
