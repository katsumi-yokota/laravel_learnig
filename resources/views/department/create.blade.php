@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
        <div class="card-body">
            <h1 class="mt4  mb-3">部署を追加する</h1>
            <form method="post" action="{{ route('department.store') }}">
            @csrf
                <div class="form-group mt-3">
                    <label for="name">部署名</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }} " placeholder="">
                </div>
                <button type="submit" class="btn btn-success mt-3">送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection
