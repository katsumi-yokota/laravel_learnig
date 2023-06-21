@extends('layouts.app')
@section('content')

<div class="container mt-4">
  
  {{-- カスタマイズしたページャー --}}
  {{-- {{ $users->appends(request()->query())->links('pagination.default') }} --}}

  <div class="btn btn-link btn-lg">
    <x-nav-link :href="route('user.create')">
      {{ __('新規ユーザー追加') }}
    </x-nav-link>
  </div>

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>@sortablelink('name', '名前')</th>
        <th>@sortablelink('email', 'Eメール')</th>
        <th>@sortablelink('created_at', '作成日')</th>
        <th>@sortablelink('updated_at', '更新日')</th>
        <th>@sortablelink('deleted_at', '削除日')</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
        <th>復元</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <!-- 論理削除済み -->
        @if ($user->trashed())
        <td>{{ '削除済み ' . $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->updated_at }}</td>
        <td>{{ $user->deleted_at }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <form method="post" action="{{ route('user.restore', $user->id) }}">
            @csrf
            @method('patch') <!-- 論理削除復元 -->
            <button type=”submit” class="btn btn-success btn-block">
              復元
            </button>
          </form>
        </td>
        <!-- 論理削除済みでない -->
        @else
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->updated_at }}</td>
        <td></td>
        <td><a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary">詳細</a></td>
        <td><a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">編集</a></td>
        <td>
          <form method="post" action="{{ route('user.destroy', $user->id) }}" class="ms-1">
            @csrf
            @method('delete') <!-- 削除 -->
            <button type="submit" class="btn btn-warning" onClick="return confirm('本当に削除しますか？');"> <!-- jsで確認 -->
              削除
            </button>
          </form>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
