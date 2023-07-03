@extends('layouts.app')
@section('content')
<div class="container">
  <h1 class="my-3">詳細</h1>
  <table class="table table-striped table-bordered">
    <tr>
        <th>部署</th>
        <td>{{ $department->name ?? '無所属' }}</td>
    </tr>
    <tr>
        <th>ユーザー名</th>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <th>パスワード</th>
        <td></td>
    </tr>
  </table>
  <a href="{{ route('user-profile.edit') }}" class="btn btn-primary">編集する</a>
</div>
@endsection
