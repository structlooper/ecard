<!-- partial:./partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item sidebar-category">
            <p>Navigation</p>
            <span></span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
{{--        <li class="nav-item sidebar-category">--}}
{{--            <p>Components</p>--}}
{{--            <span></span>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">--}}
{{--                <i class="mdi mdi-palette menu-icon"></i>--}}
{{--                <span class="menu-title">UI Elements</span>--}}
{{--                <i class="menu-arrow"></i>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="ui-basic">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>--}}
{{--                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('update_password_page') }}">
                <i class="mdi mdi-account-settings menu-icon"></i>
                <span class="menu-title">Change password</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user_list') }}">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">User list</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('card_categories') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Card categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('card_list') }}">
                <i class="mdi mdi-credit-card-multiple  menu-icon"></i>
                <span class="menu-title">Card Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('order_management') }}">
                <i class="mdi mdi-library-books menu-icon"></i>
                <span class="menu-title">Orders</span>
            </a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="pages/icons/mdi.html">--}}
{{--                <i class="mdi mdi-emoticon menu-icon"></i>--}}
{{--                <span class="menu-title">Icons</span>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</nav>
<!-- partial -->
