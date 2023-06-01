@extends('layouts.app')
@section('content')

{{ $contactCategories->appends(request()->query())->links() }}

<div class="container">
  <div class="btn btn-link btn-lg">
    <x-nav-link :href="route('contact-category.create')">
      {{ __('新規コンタクトカテゴリー追加') }}
    </x-nav-link>
  </div>

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>カテゴリー名</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contactCategories as $contactCategory)
      <tr>
        <td>{{ $contactCategory->contact_category }}</td>
        <td><a href="{{ route('contact-category.show', $contactCategory->id) }}">詳細</a></td>
        <td><a href="{{ route('contact-category.edit', $contactCategory->id) }}">編集</a></td>
        <td><a href="{{ route('contact-category.destroy', $contactCategory->id) }}">削除</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection