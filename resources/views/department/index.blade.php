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
        <th>変更</th>
        <th>削除</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($departments as $department)
      <tr>
        <td>{{ $department->name }}</td>
        <td>
          <a href="{{ route('department.edit', ['department' => $department->id]) }}" class="btn btn-success">変更</a>
        </td>
        <td>
          <form method="post" action="{{ route('department.destroy', ['department' => $department->id]) }}">
            @csrf
            @method('delete')
              <button type="submit" onClick="return confirm('本当に削除しますか？')">
                削除
              </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
