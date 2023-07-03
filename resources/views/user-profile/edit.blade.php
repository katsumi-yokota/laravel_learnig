@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="my-3">ユーザーを編集</h1>
    <form method="post" action="{{ route('user-profile.update', $user->id) }}">
        @csrf
        @method('put')
    <table class="table table-striped table-bordered">
        <tr>
            <th>部署</th>
            <td>{{ $department->name ?? '無所属' }}</td>
        </tr>
        <tr>
            <th>ユーザー名</th>
            <td>
                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" placeholder="">
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>
                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="">
            </td>
        </tr>
        <tr>
            <th>パスワード</th>
            <td>
                <input type="password" name="password" class="form-control" id="password" value="" placeholder="">
            </td>
        </tr>
        <tr>
            <th>パスワード（確認）</th>
            <td>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" value="" placeholder="">
            </td>
        </tr>
    </table>
    <button type="submit" class="btn btn-success mt-3">編集する</button>
    </form>
</div>
@endsection
