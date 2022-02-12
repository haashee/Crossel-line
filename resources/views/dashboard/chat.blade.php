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
                        <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center  active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
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
            <div class="row">
                <div class="col-12">
                <div class="card overflow-scroll">
                    <div class="card-body d-flex">
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg border-1 rounded-circle bg-gradient-primary">
                        <i class="fas fa-plus text-white"></i>
                        </a>
                        <p class="mb-0 text-sm" style="margin-top:6px;">Add story</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-primary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/team-1.jpg">
                        </a>
                        <p class="mb-0 text-sm">Abbie W</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-primary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/team-2.jpg">
                        </a>
                        <p class="mb-0 text-sm">Boris U</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-primary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/team-3.jpg">
                        </a>
                        <p class="mb-0 text-sm">Kay R</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-primary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/team-4.jpg">
                        </a>
                        <p class="mb-0 text-sm">Tom M</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-primary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/team-5.jpg">
                        </a>
                        <p class="mb-0 text-sm">Nicole N</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-primary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/marie.jpg">
                        </a>
                        <p class="mb-0 text-sm">Marie P</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-primary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/bruce-mars.jpg">
                        </a>
                        <p class="mb-0 text-sm">Bruce M</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-secondary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/ivana-squares.jpg">
                        </a>
                        <p class="mb-0 text-sm">Sandra A</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-secondary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/kal-visuals-square.jpg">
                        </a>
                        <p class="mb-0 text-sm">Katty L</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-secondary">
                        <img alt="Image placeholder" class="p-1" src="../../../assets/img/ivana-square.jpg">
                        </a>
                        <p class="mb-0 text-sm">Emma O</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="javascript:;" class="avatar avatar-lg rounded-circle border border-secondary">
                        <img alt="Image placeholder" class="p-1" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/team-9.jpg">
                        </a>
                        <p class="mb-0 text-sm">Tao G</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <a href="javascript:;">
                        <img src="../../../assets/img/team-4.jpg" class="avatar" alt="profile-image">
                        </a>
                        <div class="mx-3">
                        <a href="javascript:;" class="text-dark font-weight-600 text-sm">John Snow</a>
                        <small class="d-block text-muted">3 days ago</small>
                        </div>
                    </div>
                    <div class="text-end ms-auto">
                        <button type="button" class="btn btn-xs btn-primary mb-0">
                        <i class="fas fa-plus pe-2"></i> Follow
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                    <p class="mb-4">
                        Personal profiles are the perfect way for you to grab their attention and persuade recruiters to continue reading your CV because you’re telling them from the off exactly why they should hire you.
                    </p>
                    <img alt="Image placeholder" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/activity-feed.jpg" class="img-fluid border-radius-lg shadow-lg max-height-500">
                    <div class="row align-items-center px-2 mt-4 mb-2">
                        <div class="col-sm-6">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                            <i class="ni ni-like-2 me-1 cursor-pointer opacity-6"></i>
                            <span class="text-sm me-3 ">150</span>
                            </div>
                            <div class="d-flex align-items-center">
                            <i class="ni ni-chat-round me-1 cursor-pointer opacity-6"></i>
                            <span class="text-sm me-3">36</span>
                            </div>
                            <div class="d-flex align-items-center">
                            <i class="ni ni-curved-next me-1 cursor-pointer opacity-6"></i>
                            <span class="text-sm me-2">12</span>
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-6 d-none d-sm-block">
                        <div class="d-flex align-items-center justify-content-sm-end">
                            <div class="d-flex align-items-center">
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland">
                                <img alt="Image placeholder" src="../../../assets/img/team-5.jpg" class="">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Audrey Love">
                                <img alt="Image placeholder" src="../../../assets/img/team-2.jpg" class="rounded-circle">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Michael Lewis">
                                <img alt="Image placeholder" src="../../../assets/img/team-1.jpg" class="rounded-circle">
                            </a>
                            </div>
                            <small class="ps-2 font-weight-bold">and 30+ more</small>
                        </div>
                        </div>
                        <hr class="horizontal dark my-3">
                    </div>
                    <!-- Comments -->
                    <div class="mb-1">
                        <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img alt="Image placeholder" class="avatar rounded-circle" src="../../../assets/img/bruce-mars.jpg">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="h5 mt-0">Michael Lewis</h6>
                            <p class="text-sm">I always felt like I could do anything. That’s the main thing people are controlled by! Thoughts- their perception of themselves!</p>
                            <div class="d-flex">
                            <div>
                                <i class="ni ni-like-2 me-1 cursor-pointer opacity-6"></i>
                            </div>
                            <span class="text-sm me-2">3 likes</span>
                            <div>
                                <i class="ni ni-curved-next me-1 cursor-pointer opacity-6"></i>
                            </div>
                            <span class="text-sm me-2">2 shares</span>
                            </div>
                        </div>
                        </div>
                        <div class="d-flex mt-3">
                        <div class="flex-shrink-0">
                            <img alt="Image placeholder" class="avatar rounded-circle" src="../../../assets/img/team-5.jpg">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="h5 mt-0">Jessica Stones</h6>
                            <p class="text-sm">Society has put up so many boundaries, so many limitations on what’s right and wrong that it’s almost impossible to get a pure thought out. It’s like a little kid, a little boy.</p>
                            <div class="d-flex">
                            <div>
                                <i class="ni ni-like-2 me-1 cursor-pointer opacity-6"></i>
                            </div>
                            <span class="text-sm me-2">10 likes</span>
                            <div>
                                <i class="ni ni-curved-next me-1 cursor-pointer opacity-6"></i>
                            </div>
                            <span class="text-sm me-2">1 share</span>
                            </div>
                        </div>
                        </div>
                        <div class="d-flex mt-4">
                        <div class="flex-shrink-0">
                            <img alt="Image placeholder" class="avatar rounded-circle me-3" src="../../../assets/img/team-4.jpg">
                        </div>
                        <div class="flex-grow-1 my-auto">
                            <form>
                            <textarea class="form-control" placeholder="Write your comment" rows="1"></textarea>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-12 col-lg-6">
                <div class="card mb-3 mt-lg-0 mt-4">
                    <div class="card-body pb-0">
                    <div class="row align-items-center mb-3">
                        <div class="col-9">
                        <h5 class="mb-1">
                            <a href="javascript:;">Digital Marketing</a>
                        </h5>
                        </div>
                        <div class="col-3 text-end">
                        <div class="dropstart">
                            <a href="javascript:;" class="text-secondary" id="dropdownMarketingCard" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="dropdownMarketingCard">
                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Edit Team</a></li>
                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Add Member</a></li>
                            <li><a class="dropdown-item border-radius-md" href="javascript:;">See Details</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Team</a></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <p>A group of people who collectively are responsible for all of the work necessary to produce working, validated assets.</p>
                    <ul class="list-unstyled mx-auto">
                        <li class="d-flex">
                        <p class="mb-0">Industry:</p>
                        <span class="badge badge-secondary ms-auto">Marketing Team</span>
                        </li>
                        <li>
                        <hr class="horizontal dark">
                        </li>
                        <li class="d-flex">
                        <p class="mb-0">Rating:</p>
                        <div class="rating ms-auto">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        </li>
                        <li>
                        <hr class="horizontal dark">
                        </li>
                        <li class="d-flex">
                        <p class="mb-0">Members:</p>
                        <div class="avatar-group ms-auto">
                            <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexa Tompson">
                            <img alt="Image placeholder" src="../../../assets/img/team-1.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                            <img alt="Image placeholder" src="../../../assets/img/team-2.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                            <img alt="Image placeholder" src="../../../assets/img/team-3.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Martin Doe">
                            <img alt="Image placeholder" src="../../../assets/img/team-4.jpg">
                            </a>
                        </div>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card mt-4 mb-3">
                    <div class="card-body pb-0">
                    <div class="row align-items-center mb-3">
                        <div class="col-9">
                        <h5 class="mb-1">
                            <a href="javascript:;">Design</a>
                        </h5>
                        </div>
                        <div class="col-3 text-end">
                        <div class="dropstart">
                            <a href="javascript:;" class="text-secondary" id="dropdownDesignCard" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="dropdownDesignCard">
                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Edit Team</a></li>
                            <li><a class="dropdown-item border-radius-md" href="javascript:;">Add Member</a></li>
                            <li><a class="dropdown-item border-radius-md" href="javascript:;">See Details</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Team</a></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <p>Because it's about motivating the doers. Because I’m here to follow my dreams and inspire other people to follow their dreams, too.</p>
                    <ul class="list-unstyled mx-auto">
                        <li class="d-flex">
                        <p class="mb-0">Industry:</p>
                        <span class="badge badge-secondary ms-auto">Design Team</span>
                        </li>
                        <li>
                        <hr class="horizontal dark">
                        </li>
                        <li class="d-flex">
                        <p class="mb-0">Rating:</p>
                        <div class="rating ms-auto">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        </li>
                        <li>
                        <hr class="horizontal dark">
                        </li>
                        <li class="d-flex">
                        <p class="mb-0">Members:</p>
                        <div class="avatar-group ms-auto">
                            <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Martin Doe">
                            <img alt="Image placeholder" src="../../../assets/img/team-4.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                            <img alt="Image placeholder" src="../../../assets/img/team-3.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexa Tompson">
                            <img alt="Image placeholder" src="../../../assets/img/team-1.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexandra Smith">
                            <img alt="Image placeholder" src="../../../assets/img/team-5.jpg">
                            </a>
                        </div>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="avatar avatar-lg">
                        <img alt="Image placeholder" src="../../../assets/img/small-logos/logo-slack.svg">
                        </div>
                        <div class="ms-2 my-auto">
                        <h6 class="mb-0">Slack Meet</h6>
                        <p class="text-xs mb-0">11:00 AM</p>
                        </div>
                    </div>
                    <p class="mt-3"> You have an upcoming meet for Marketing Planning</p>
                    <p class="mb-0"><b>Meeting ID:</b> 902-128-281</p>
                    <hr class="horizontal dark">
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm btn-primary mb-0">
                        Join
                        </button>
                        <div class="avatar-group ms-auto">
                        <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexa Tompson">
                            <img alt="Image placeholder" src="../../../assets/img/team-1.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                            <img alt="Image placeholder" src="../../../assets/img/team-2.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                            <img alt="Image placeholder" src="../../../assets/img/team-3.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Martin Doe">
                            <img alt="Image placeholder" src="../../../assets/img/ivana-squares.jpg">
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body p-3">
                    <div class="d-flex">
                        <div class="avatar avatar-lg">
                        <img alt="Image placeholder" src="../../../assets/img/small-logos/logo-invision.svg">
                        </div>
                        <div class="ms-2 my-auto">
                        <h6 class="mb-0">Invision</h6>
                        <p class="text-xs mb-0">4:50 PM</p>
                        </div>
                    </div>
                    <p class="mt-3"> You have an upcoming video call for <span class="text-primary">Soft Design</span> at 5:00 PM.</p>
                    <p class="mb-0"><b>Meeting ID:</b> 111-968-981</p>
                    <hr class="horizontal dark">
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm btn-primary mb-0">
                        Join
                        </button>
                        <div class="avatar-group ms-auto">
                        <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexa Tompson">
                            <img alt="Image placeholder" src="../../../assets/img/team-1.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                            <img alt="Image placeholder" src="../../../assets/img/team-2.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                            <img alt="Image placeholder" src="../../../assets/img/team-3.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-lg avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Martin Doe">
                            <img alt="Image placeholder" src="../../../assets/img/ivana-squares.jpg">
                        </a>
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