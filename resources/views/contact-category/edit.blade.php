@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-10 mt-6  ms-auto me-auto">
      <div class="card-body">
        <form method="post" action="{{ route('contact-category.update', $contactCategory->id) }}">
          @csrf
          @method('put')
            <div class="form-group mt-3">
                <label for="category">カテゴリーを編集、削除</label>
                <input type="text" name="category" class="form-control" id="category" cols="30" rows="10" placeholder="" value="{{ $contactCategory->contact_category }}">
            </div>
            <button type="submit" class="btn btn-warning mt-3">編集する</button>
        </form>
        <form method="post" action="{{ route('contact-category.destroy', $contactCategory->id) }}">
          @csrf
          @method('delete')
            <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('本当に削除しますか？');">削除する</button>
        </form>
      </div>
  </div>
</div>
@endsection