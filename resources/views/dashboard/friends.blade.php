@extends('layouts.master')



@section('title')
    Friends
@endsection



@section('content')
    <main class="main-content position-relative border-radius-lg ">
        

        <!-- Navbar -->
        @include('includes.navbar')
        <!-- End Navbar -->

        
        <div class="container-fluid py-4">
          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                  <div class="card overflow-hidden shadow-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports1.jpg');background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                      <div class="row">
                        <div class="col-8 text-start">
                          <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                            <i class="ni ni-circle-08 text-dark text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                          <h5 class="text-white font-weight-bolder mb-0 mt-3">
                            1600
                          </h5>
                          <span class="text-white text-sm">Users Active</span>
                        </div>
                        <div class="col-4">
                          <div class="dropdown text-end mb-6">
                            <a href="javascript:;" class="cursor-pointer" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-ellipsis-h text-white"></i>
                            </a>
                            <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers1">
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                            </ul>
                          </div>
                          <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+55%</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                  <div class="card overflow-hidden shadow-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports2.jpg');background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                      <div class="row">
                        <div class="col-8 text-start">
                          <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                            <i class="ni ni-active-40 text-dark text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                          <h5 class="text-white font-weight-bolder mb-0 mt-3">
                            357
                          </h5>
                          <span class="text-white text-sm">Click Events</span>
                        </div>
                        <div class="col-4">
                          <div class="dropdown text-end mb-6">
                            <a href="javascript:;" class="cursor-pointer" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-ellipsis-h text-white"></i>
                            </a>
                            <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers2">
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                            </ul>
                          </div>
                          <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+124%</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col-12">
                  <div class="card overflow-hidden shadow-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports3.jpg');background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                      <div class="row">
                        <div class="col-8 text-start">
                          <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                            <i class="ni ni-cart text-dark text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                          <h5 class="text-white font-weight-bolder mb-0 mt-3">
                            2300
                          </h5>
                          <span class="text-white text-sm">Purchases</span>
                        </div>
                        <div class="col-4">
                          <div class="dropdown text-end mb-6">
                            <a href="javascript:;" class="cursor-pointer" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-ellipsis-h text-white"></i>
                            </a>
                            <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers3">
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                            </ul>
                          </div>
                          <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+15%</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                  <div class="card overflow-hidden shadow-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports4.jpg');background-size: cover;">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body p-3 position-relative">
                      <div class="row">
                        <div class="col-8 text-start">
                          <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                            <i class="ni ni-like-2 text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                          <h5 class="text-white font-weight-bolder mb-0 mt-3">
                            940
                          </h5>
                          <span class="text-white text-sm">Likes</span>
                        </div>
                        <div class="col-4">
                          <div class="dropdown text-end mb-6">
                            <a href="javascript:;" class="cursor-pointer" id="dropdownUsers4" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-ellipsis-h text-white"></i>
                            </a>
                            <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers4">
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                              <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                            </ul>
                          </div>
                          <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+90%</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-12 mt-4 mt-lg-0">
              <div class="card h-100">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Reviews</h6>
                </div>
                <div class="card-body pb-0 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-0">
                      <div class="w-100">
                        <div class="d-flex mb-2">
                          <span class="me-2 text-sm font-weight-bold text-capitalize">Positive reviews</span>
                          <span class="ms-auto text-sm font-weight-bold">80%</span>
                        </div>
                        <div>
                          <div class="progress progress-md">
                            <div class="progress-bar bg-gradient-info w-80" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                      <div class="w-100">
                        <div class="d-flex mb-2">
                          <span class="me-2 text-sm font-weight-bold text-capitalize">Neutral reviews</span>
                          <span class="ms-auto text-sm font-weight-bold">17%</span>
                        </div>
                        <div>
                          <div class="progress progress-md">
                            <div class="progress-bar bg-gradient-dark w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                      <div class="w-100">
                        <div class="d-flex mb-2">
                          <span class="me-2 text-sm font-weight-bold text-capitalize">Negative reviews</span>
                          <span class="ms-auto text-sm font-weight-bold">3%</span>
                        </div>
                        <div>
                          <div class="progress progress-md">
                            <div class="progress-bar bg-gradient-danger w-5" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="card-footer pt-0 p-3 d-flex align-items-center">
                  <div class="w-60">
                    <p class="text-sm">
                      More than <b>1,500,000</b> developers used Creative Tim's products and over <b>700,000</b> projects were created.
                    </p>
                  </div>
                  <div class="w-40 text-end">
                    <a class="btn bg-gradient-dark mb-0 text-end" href="javascript:;">View all reviews</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row my-4">
            <div class="col-12">
              <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Review</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../../../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="avatar image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">John Michael</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">Manager</p>
                        </td>
                        <td>
                          <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="text-dark text-xs">positive</span>
                          </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-secondary mb-0 text-sm">john@user.com</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-sm">23/04/18</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-sm">43431</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../../../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="avatar image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">Alexa Liras</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">Programator</p>
                        </td>
                        <td>
                          <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="text-dark text-xs">positive</span>
                          </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-secondary mb-0 text-sm">alexa@user.com</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-sm">93021</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../../../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="avatar image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">Executive</p>
                        </td>
                        <td>
                          <span class="badge badge-dot me-4">
                            <i class="bg-dark"></i>
                            <span class="text-dark text-xs">neutral</span>
                          </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-secondary mb-0 text-sm">laurent@user.com</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-sm">10392</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../../../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="avatar image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">Michael Levi</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">Backend developer</p>
                        </td>
                        <td>
                          <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="text-dark text-xs">positive</span>
                          </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-secondary mb-0 text-sm">michael@user.com</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-sm">34002</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../../../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="avatar image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">Richard Gran</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">Manager</p>
                        </td>
                        <td>
                          <span class="badge badge-dot me-4">
                            <i class="bg-danger"></i>
                            <span class="text-dark text-xs">negative</span>
                          </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-secondary mb-0 text-sm">richard@user.com</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-sm">91879</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../../../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="avatar image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">Miriam Eric</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm text-secondary mb-0">Programtor</p>
                        </td>
                        <td>
                          <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="text-dark text-xs">positive</span>
                          </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-secondary mb-0 text-sm">miriam@user.com</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-sm">23042</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
            <!-- Footer -->
            @include('includes.footer')
            <!-- End Footer -->
        </div>
        
    </main>
@endsection



@section('scripts')
    <!--   Core JS Files   -->
    <script src="../../../assets/js/core/popper.min.js"></script>
    <script src="../../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../../../assets/js/plugins/chartjs.min.js"></script>
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