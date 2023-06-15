@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 mt-6  ms-auto me-auto">
        <div class="card-body">
          <form method="post" action="{{ route('contact-tag.store') }}">
            @csrf
              <div class="form-group mt-3">
                  <label for="contact_tag">タグ</label>
                  <input type="text" name="contact_tag" class="form-control" id="contact_tag" cols="30" rows="10" placeholder="タグ名">
              </div>
              <button type="submit" class="btn btn-warning mt-3">追加する</button>
          </form>
        </div>
    </div>
 </div>
 @endsection