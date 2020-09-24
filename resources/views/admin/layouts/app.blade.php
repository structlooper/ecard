@include('admin.layouts.header')
<div class="container-scroller d-flex">
    @include('admin.layouts.side_bar')
    <div class="container-fluid page-body-wrapper">
       @include('admin.layouts.nav_bar')
        <div class="main-panel">
            @yield('content')
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('admin.layouts.main_footer')
@include('admin.layouts.footer')

