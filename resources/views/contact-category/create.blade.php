@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 mt-6  ms-auto me-auto">
        <div class="card-body">
          <form method="post" action="{{ route('contact-category.store') }}">
            @csrf
              <div class="form-group mt-3">
                  <label for="category">カテゴリー</label>
                  <input type="text" name="category" class="form-control" id="category" cols="30" rows="10" placeholder="カテゴリー名">
              </div>
              <button type="submit" class="btn btn-warning mt-3">追加する</button>
          </form>
        </div>
    </div>
 </div>
 @endsection