@extends('layouts.profile')



@section('title')
Account
@endsection



@section('content')
<div class="main-content position-relative max-height-vh-100 h-100">

    <!-- Navbar -->
    @include('includes.navbar-profile')
    <!-- End Navbar -->


    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../../../assets/img/team-1.jpg" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Sayo Kravits
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Public Relations
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    href="{{ URL::route('accounts.index') }}" role="tab" aria-selected="false">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">一覧</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center border"
                                    href="/accounts/{{ $account->id }}/richmenu" role="tab" aria-selected="true">
                                    <i class="ni ni-image"></i>
                                    <span class="ms-2">リッチメニュー</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    href="/accounts/{{ $account->id }}/edit" role="tab" aria-selected="false">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span class="ms-2">設定</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">Projects</h6>
                        <p class="text-sm">Architects design houses</p>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ asset('images/rich-img-01.jpeg') }}" alt="img-blur-shadow"
                                                class="img-fluid shadow border-radius-xl">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
                                        <a href="javascript:;">
                                            <h5>
                                                Bubbles
                                            </h5>
                                        </a>
                                        {{-- <p class="mb-4 text-sm">
                                            As Bubble works through a huge amount of internal management turmoil.
                                        </p> --}}
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                                Project</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ asset('images/rich-img-02.jpeg') }}" alt="img-blur-shadow"
                                                class="img-fluid shadow border-radius-lg">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                                        <a href="javascript:;">
                                            <h5>
                                                Scandinavian
                                            </h5>
                                        </a>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                                Project</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ asset('images/rich-img-03.jpeg') }}" alt="img-blur-shadow"
                                                class="img-fluid shadow border-radius-xl">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                                        <a href="javascript:;">
                                            <h5>
                                                Minimalist
                                            </h5>
                                        </a>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                                Project</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="javascript:;">
                                            <i class="fa fa-plus text-secondary mb-3"></i>
                                            <h5 class=" text-secondary"> New project </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('includes.footer')
        <!-- End Footer -->
    </div>

</div>
@endsection



@section('scripts')
<script src="../../../assets/js/core/popper.min.js"></script>
<script src="../../../assets/js/core/bootstrap.min.js"></script>
<script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
<!-- Kanban scripts -->
<script src="../../../assets/js/plugins/dragula/dragula.min.js"></script>
<script src="../../../assets/js/plugins/jkanban/jkanban.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
@endsection