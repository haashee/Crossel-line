<!DOCTYPE html>
<html lang="ja">

<head>
    @include('includes.head')
</head>

<body class="g-sidenav-show bg-gray-100">
    
    <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>

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