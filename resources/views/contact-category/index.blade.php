@extends('layouts.app')
@section('content')

<div class="container mt-4">

  {{ $contactCategories->appends(request()->query())->links() }}

  <div class="btn btn-link btn-lg">
    <x-nav-link :href="route('contact-category.create')">
      {{ __('新規コンタクトカテゴリー追加') }}
    </x-nav-link>
  </div>

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>カテゴリー名</th>
        <th>お問い合わせ数</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contactCategories as $contactCategory)
      <tr>
        <td>{{ $contactCategory->name }}</td>
        <td>{{ $contactCategory->contacts_count }}</td>
        <td><a href="{{ route('contact-category.show', $contactCategory->id) }}">詳細</a></td>
        <td><a href="{{ route('contact-category.edit', $contactCategory->id) }}">編集</a></td>
        <td>
          <form method="post" action="{{ route('contact-category.destroy', $contactCategory->id) }}">
            @csrf
            @method('delete')
          <button type="submit" onClick="return confirm('本当に削除しますか？');">
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