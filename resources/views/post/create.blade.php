<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 mt-6  ms-auto me-auto">
        <div class="card-body">
            <h1 class="mt4">つぶやきの作成</h1>
            <form method="post" action="{{route('post.store')}}">
                @csrf
                <div class="form-group mt-3">
                        <label for="body">つぶやきの内容</label>
                        <textarea name="body" class="form-control" id="body" cols="30" rows="10" placeholder="ここにつぶやきの内容を書く"></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3">つぶやく</button>
            </form>
        </div>
    </div>
 </div>
 @endsection