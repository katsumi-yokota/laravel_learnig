@extends('layouts.app')
@section('content')
<div class="container">
  <div class="">
    <div class="card-body">
      <form method="post" action="{{ route('article.store') }}">
        @csrf
          <div class="form-group mt-3">
            <label for="title">タイトル</label>
            <input type="text" name="title" class="form-control" id="title" cols="30" rows="10" placeholder="タイトル名">
          </div>
          <div class="form-group mt-3">
            <label for="body">内容</label>
            <textarea name="body" class="form-control" cols=”100″ rows="25"
            id="body" placeholder="内容"></textarea>
          </div>
          <button name="title" type="submit" class="btn btn-light mt-3" onClick="return confirm('本当に投稿しますか？');">投稿</button>
      </form>
    </div>
  </div>
 </div>
 @endsection
