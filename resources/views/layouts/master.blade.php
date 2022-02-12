<!DOCTYPE html>
<html lang="ja">

<head>
    @include('includes.head')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>


    <!-- Sidebar -->
    @include('includes.sidebar')
    <!-- End Sidebar -->



    
            <!-- Content -->
            @yield('content')
            <!-- End Content -->


    <!-- Left Sidebar -->
    @include('includes.sidebar-left')
    <!-- End Left Sidebar -->


    <!-- Scripts -->
    @yield('scripts')
    <!-- End Scripts -->


</body>

</html>