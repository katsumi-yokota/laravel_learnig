@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-10 mt-6  ms-auto me-auto">
      <div class="card-body">
        <form method="post" action="{{ route('contact-response.update', ['contact' => $contactResponse->contact_id, 'contact_response' => $contactResponse->id]) }}">
          @csrf
          @method('put')
            <div class="form-group mt-3">
                <input type="text" name="response_content" class="form-control" id="response_content" cols="30" rows="10" placeholder="" value="{{ $contactResponse->response_content }}">
            </div>
            <button type="submit" class="btn btn-warning mt-3">編集する</button>
        </form>
      </div>
  </div>
</div>
@endsection
