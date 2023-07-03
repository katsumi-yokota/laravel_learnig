{{-- @php
  $userId = Auth::user()->id;
  // dd($userId);
@endphp
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
  <x-nav-link :href="route('user-profile.show')" :active="request()->routeIs('user-profile.show')">
      {{ __('ユーザー名、メールアドレス、パスワードの管理') }}
  </x-nav-link>
</div> --}}
