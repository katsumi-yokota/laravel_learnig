@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="my-3">部署名を編集</h1>
    <form method="post" action="{{ route('department.update', $department) }}">
        @csrf
        @method('put')
    <table class="table table-striped table-bordered">
        <tr>
            <th>部署名</th>
            <td>
                <input name="name" class="form-control" id="name" placeholder="" value="{{ $department->name }}">
            </td>
        </tr>
    </table>
    <button type="submit" class="btn btn-success mt-3">編集</button>
    </form>
</div>
 @endsection
