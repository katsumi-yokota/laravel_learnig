@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 mt-6  ms-auto me-auto">
        <div class="card-body">
            <h1 >部署名の変更</h1>
            <form method="post" action="{{ route('department.update', $department) }}">
                @csrf
                @method('put')
                <div class="form-group mt-3">
                        <label for="name">部署名の変更</label>
                        <input name="name" class="form-control" id="name" placeholder="ここにつぶやきの内容を書く" value="{{ $department->name }}">
                </div>
                <button type="submit" class="btn btn-success mt-3">編集</button>
            </form>
        </div>
    </div>
 </div>
 @endsection
