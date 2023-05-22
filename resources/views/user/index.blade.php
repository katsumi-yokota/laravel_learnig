@extends('layouts.app')
@section('content')
<div class="container">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>@sortablelink('name', '名前')</th>
        <th>@sortablelink('email', 'Eメール')</th>
        <th>@sortablelink('password', 'パスワード')</th>
        <th>詳細</th>
        <th>編集</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->password }}</td>
        <td><a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary">詳細</a></td>
        <td><a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">編集</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
{{ $users->appends(request()->query())->links() }}