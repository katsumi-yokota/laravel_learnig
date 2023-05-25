@extends('layouts.app')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif
<div class="row">
    <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
        <div class="card-body">
            <h1 class="mt4  mb-3">編集</h1>
            <form method="post" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('put') <!-- update用 -->
                <div class="form-group">
                    <label for="name">ユーザー名</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" placeholder="">
                </div>
                <div class="form-group mt-3">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="">
                </div>
                <div class="form-group mt-3">
                    <label for="password">パスワード</label>
                    <input type="text" name="password" class="form-control" id="password" value="{{ old('password') }}" placeholder="">
                </div>
                <button type="submit" class="btn btn-success mt-3">編集する</button>
            </form>
        </div>
    </div>
</div>
@endsection
