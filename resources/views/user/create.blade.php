@extends('layouts.app')
@section('content')
@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif
<div class="row">
    <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
        <div class="card-body">
            <h1 class="mt4  mb-3">ユーザーを追加する</h1>
            <form method="post" action="{{ route('user.store') }}">
            @csrf
                <div class="form-group mt-3">
                    <label for="department_id">部署名</label>
                    <select name="department_id" id="department_id" class="form-control">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="name">ユーザー名</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }} " placeholder="">
                </div>
                <div class="form-group mt-3">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="">
                </div>
                <div class="form-group mt-3">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" class="form-control" id="password" value="" placeholder="">
                </div>
                <button type="submit" class="btn btn-success mt-3">送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection