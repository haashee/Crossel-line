@extends('layouts.profile')



@section('title')
    Accounts
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
                    <img src="../../../assets/img/team-1.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
                        <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                            <i class="ni ni-app"></i>
                            <span class="ms-2">App</span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                            <i class="ni ni-email-83"></i>
                            <span class="ms-2">Messages</span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                            <i class="ni ni-settings-gear-65"></i>
                            <span class="ms-2">Settings</span>
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <section class="py-3">
                <div class="row">
                <div class="col-md-8 me-auto text-left">
                    <h5>Some of Our Awesome Projects</h5>
                    <p>This is the paragraph where you can write more details about your projects. Keep you user engaged by providing meaningful information.</p>
                </div>
                </div>
                <div class="row mt-lg-4 mt-2">

                    @forelse ($accounts as $account)
                        
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex">
                                    <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                        <img src="../../../assets/img/small-logos/logo-slack.svg" alt="slack_logo">
                                    </div>
                                    <div class="ms-3 my-auto">
                                        <h6>{{ $account->name }}</h6>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="dropdown">
                                        <button class="btn btn-link text-secondary ps-0 pe-2" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-lg"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="javascript:;">Action</a>
                                            <a class="dropdown-item" href="javascript:;">Another action</a>
                                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    {{-- <p class="text-sm mt-3"> If everything I did failed - which it doesn&#39;t, I think that it actually succeeds. </p> --}}
                                    <hr class="horizontal dark">
                                    <div class="row">
                                    <div class="col-4">
                                        <h6 class="text-sm mb-0">5</h6>
                                        <p class="text-secondary text-sm font-weight-bold mb-0">友だち数</p>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="text-sm mb-0">{{ $account->user->name }}</h6>
                                        <p class="text-secondary text-sm font-weight-bold mb-0">ユーザー名</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <h6 class="text-sm mb-0">{{ date('Y/m/d', strtotime($account->updated_at)) }}</h6>
                                        <p class="text-secondary text-sm font-weight-bold mb-0">登録日</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <a href="javascript:;">
                                    <i class="fa fa-plus text-secondary mb-3"></i>
                                    <h5 class=" text-secondary"> アカウントを登録してください。 </h5>
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endforelse

                    {{-- <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex">
                            <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                <img src="../../../assets/img/small-logos/logo-spotify.svg" alt="spotify_logo">
                            </div>
                            <div class="ms-3 my-auto">
                                <h6>Premium support</h6>
                                <div class="avatar-group">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                    <img alt="Image placeholder" src="../../../assets/img/team-4.jpg" class="rounded-circle">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Jessica Rowland">
                                    <img alt="Image placeholder" src="../../../assets/img/team-3.jpg" class="">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Michael Lewis">
                                    <img alt="Image placeholder" src="../../../assets/img/team-2.jpg" class="rounded-circle">
                                </a>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <div class="dropdown">
                                <button class="btn btn-link text-secondary ps-0 pe-2" id="navbarDropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-lg"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="navbarDropdownMenuLink1">
                                    <a class="dropdown-item" href="javascript:;">Action</a>
                                    <a class="dropdown-item" href="javascript:;">Another action</a>
                                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                                </div>
                                </div>
                            </div>
                            </div>
                            <p class="text-sm mt-3"> Pink is obviously a better color. Everyone’s born confident, and everything’s taken away from you. </p>
                            <hr class="horizontal dark">
                            <div class="row">
                            <div class="col-6">
                                <h6 class="text-sm mb-0">3</h6>
                                <p class="text-secondary text-sm font-weight-bold mb-0">Participants</p>
                            </div>
                            <div class="col-6 text-end">
                                <h6 class="text-sm mb-0">22.11.21</h6>
                                <p class="text-secondary text-sm font-weight-bold mb-0">Due date</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex">
                            <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                <img src="../../../assets/img/small-logos/logo-xd.svg" alt="xd_logo">
                            </div>
                            <div class="ms-3 my-auto">
                                <h6>Design tools</h6>
                                <div class="avatar-group">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                    <img alt="Image placeholder" src="../../../assets/img/team-4.jpg" class="rounded-circle">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Michael Lewis">
                                    <img alt="Image placeholder" src="../../../assets/img/team-2.jpg" class="rounded-circle">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Jessica Rowland">
                                    <img alt="Image placeholder" src="../../../assets/img/team-3.jpg" class="">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Jessica Rowland">
                                    <img alt="Image placeholder" src="../../../assets/img/team-4.jpg" class="">
                                </a>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <div class="dropdown">
                                <button class="btn btn-link text-secondary ps-0 pe-2" id="navbarDropdownMenuLink2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-lg"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="navbarDropdownMenuLink2">
                                    <a class="dropdown-item" href="javascript:;">Action</a>
                                    <a class="dropdown-item" href="javascript:;">Another action</a>
                                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                                </div>
                                </div>
                            </div>
                            </div>
                            <p class="text-sm mt-3"> Constantly growing. We’re constantly making mistakes from which we learn and improve. </p>
                            <hr class="horizontal dark">
                            <div class="row">
                            <div class="col-6">
                                <h6 class="text-sm mb-0">4</h6>
                                <p class="text-secondary text-sm font-weight-bold mb-0">Participants</p>
                            </div>
                            <div class="col-6 text-end">
                                <h6 class="text-sm mb-0">06.03.20</h6>
                                <p class="text-secondary text-sm font-weight-bold mb-0">Due date</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex">
                            <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                <img src="../../../assets/img/small-logos/logo-asana.svg" alt="asana_logo">
                            </div>
                            <div class="ms-3 my-auto">
                                <h6>Looking great</h6>
                                <div class="avatar-group">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Jessica Rowland">
                                    <img alt="Image placeholder" src="../../../assets/img/team-3.jpg" class="">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                    <img alt="Image placeholder" src="../../../assets/img/team-4.jpg" class="rounded-circle">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Michael Lewis">
                                    <img alt="Image placeholder" src="../../../assets/img/team-2.jpg" class="rounded-circle">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Jessica Rowland">
                                    <img alt="Image placeholder" src="../../../assets/img/team-3.jpg" class="">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                    <img alt="Image placeholder" src="../../../assets/img/team-4.jpg" class="rounded-circle">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Michael Lewis">
                                    <img alt="Image placeholder" src="../../../assets/img/team-2.jpg" class="rounded-circle">
                                </a>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <div class="dropdown">
                                <button class="btn btn-link text-secondary ps-0 pe-2" id="navbarDropdownMenuLink3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-lg"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="navbarDropdownMenuLink3">
                                    <a class="dropdown-item" href="javascript:;">Action</a>
                                    <a class="dropdown-item" href="javascript:;">Another action</a>
                                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                                </div>
                                </div>
                            </div>
                            </div>
                            <p class="text-sm mt-3"> You have the opportunity to play this game of life you need to appreciate every moment. </p>
                            <hr class="horizontal dark">
                            <div class="row">
                            <div class="col-6">
                                <h6 class="text-sm mb-0">6</h6>
                                <p class="text-secondary text-sm font-weight-bold mb-0">Participants</p>
                            </div>
                            <div class="col-6 text-end">
                                <h6 class="text-sm mb-0">14.03.24</h6>
                                <p class="text-secondary text-sm font-weight-bold mb-0">Due date</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex">
                            <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                <img src="../../../assets/img/small-logos/logo-invision.svg" alt="invision_logo">
                            </div>
                            <div class="ms-3 my-auto">
                                <h6>Developer First</h6>
                                <div class="avatar-group">
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                    <img alt="Image placeholder" src="../../../assets/img/team-4.jpg" class="rounded-circle">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Jessica Rowland">
                                    <img alt="Image placeholder" src="../../../assets/img/team-3.jpg" class="">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Michael Lewis">
                                    <img alt="Image placeholder" src="../../../assets/img/team-2.jpg" class="rounded-circle">
                                </a>
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="Audrey Love">
                                    <img alt="Image placeholder" src="../../../assets/img/team-4.jpg" class="rounded-circle">
                                </a>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <div class="dropdown">
                                <button class="btn btn-link text-secondary ps-0 pe-2" id="navbarDropdownMenuLink4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-lg"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="navbarDropdownMenuLink4">
                                    <a class="dropdown-item" href="javascript:;">Action</a>
                                    <a class="dropdown-item" href="javascript:;">Another action</a>
                                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                                </div>
                                </div>
                            </div>
                            </div>
                            <p class="text-sm mt-3"> For standing out. But the time is now to be okay to be the greatest you. </p>
                            <hr class="horizontal dark">
                            <div class="row">
                            <div class="col-6">
                                <h6 class="text-sm mb-0">4</h6>
                                <p class="text-secondary text-sm font-weight-bold mb-0">Participants</p>
                            </div>
                            <div class="col-6 text-end">
                                <h6 class="text-sm mb-0">16.01.22</h6>
                                <p class="text-secondary text-sm font-weight-bold mb-0">Due date</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <a href="javascript:;">
                            <i class="fa fa-plus text-secondary mb-3"></i>
                            <h5 class=" text-secondary"> New project </h5>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </section>

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