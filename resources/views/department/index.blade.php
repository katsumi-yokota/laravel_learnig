@extends('layouts.app')
@section('content')

<div class="container mt-4">

  <div class="btn btn-link btn-lg">
    <x-nav-link :href="route('department.create')">
      {{ __('新規部署追加') }}
    </x-nav-link>
  </div>

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>部署名</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($departments as $department)
      <tr>
        <td>{{ $department->name }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
