@extends('layouts.app')
@section('content')
<div class="container">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>カテゴリー名</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contactCategories as $contactCategory)
      <tr>
        <td>{{ $contactCategory->contact_category }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection