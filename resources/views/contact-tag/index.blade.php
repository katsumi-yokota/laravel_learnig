@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>タグ名</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contactTags as $contactTag)
      <tr>
        <td>{{ $contactTag->name }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
