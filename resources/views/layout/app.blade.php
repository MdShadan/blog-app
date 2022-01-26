<!DOCTYPE html>
<html lang="en">
    <!--Head Links-->
    @include('layout.head_links')

    <body class="app sidebar-mini">
        <!--Header-->
        @include('layout.header')

        <!-- Sidebar menu-->
        @include('layout.side_nav')

        
        <main class="app-content">
            @yield('content')
</main>
<!--Foot Links-->
@include('layout.foot_link')
        </body>
</html>