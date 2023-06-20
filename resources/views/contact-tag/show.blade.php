@extends('layouts.app')
@section('content')
<table class="table table-striped table-bordered">
    <tr>
      <th>タグID</th>
      <td>{{ $contactTag->id }}</td>
    </tr>
    <tr>
      <th>タグ名</th>
      <td>{{ $contactTag->name }}</td>
    </tr>
    <tr>
      <th>作成日時</th>
      <td>{{ $contactTag->created_at }}</td>
    </tr>
    <tr>
      <th>更新日時</th>
      <td>{{ $contactTag->updated_at }}</td>
    </tr>
</table>
@endsection
