<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.dashboard.meta')
    <title>Dashboard</title>
    @include('components.dashboard.styles')
    @yield('styles')
</head>
<body>

<div class="loader-wrapper">
    <div class="theme-loader">
        <div class="loader-p"></div>
    </div>
</div>

<div class="page-wrapper compact-wrapper" id="pageWrapper">

    @include('components.dashboard.header')

    <div class="page-body-wrapper sidebar-icon">

        @include('components.dashboard.sidebar')

        <div class="page-body">
            <!-- Container-fluid starts-->
            <div class="container-fluid dashboard-default-sec">
               @yield('content')
            </div>
            <!-- Container-fluid Ends-->
        </div>

        @include('components.dashboard.footer')
    </div>
</div>
@include('components.dashboard.scripts')
@yield('scripts')
</body>
</html>