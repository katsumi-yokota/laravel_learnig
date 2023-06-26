<!-- Navigation Links -->
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
        {{ __('ユーザー管理') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('contact-category.index')" :active="request()->routeIs('contact-category.index')">
        {{ __('コンタクトカテゴリー管理') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('contact-tag.index')" :active="request()->routeIs('contact-tag.index')">
        {{ __('コンタクトタグ管理') }}
    </x-nav-link>
</div>
