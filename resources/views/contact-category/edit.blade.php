@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-10 mt-6  ms-auto me-auto">
      <div class="card-body">
        <form method="post" action="{{ route('contact-category.update', $contactCategory->id) }}">
          @csrf
          @method('put')
            <div class="form-group mt-3">
                <label for="category">カテゴリーを編集</label>
                <input type="text" name="category" class="form-control" id="category" cols="30" rows="10" placeholder="" value="{{ $contactCategory->contact_category }}">
            </div>
            <button type="submit" class="btn btn-warning mt-3">編集する</button>
        </form>
      </div>
  </div>
</div>
@endsection