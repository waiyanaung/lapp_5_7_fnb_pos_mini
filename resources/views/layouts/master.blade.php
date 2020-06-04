@inject('Status', 'App\Core\Status')

@include('layouts.partial.backend.header')
@include('layouts.partial.backend.nav')
@yield('script')
@yield('page_script')
<div id="content" class="content">
@yield('content')
</div>
@include('layouts.partial.backend.footer')
