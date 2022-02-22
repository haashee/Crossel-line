<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    Argon Dashboard 2 PRO by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
</head>

<body class="bg-gray-100">
  <!-- Navbar -->
  {{-- <nav
    class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container ps-2 pe-0">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../../../pages/dashboards/default.html">
        Argon Dashboard 2 PRO
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
        <ul class="navbar-nav navbar-nav-hover mx-auto">
          <li class="nav-item dropdown dropdown-hover mx-2">
            <a role="button" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center "
              id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
              Pages
              <img src="{{ asset('assets/img/down-arrow-white.svg') }}" alt="down-arrow"
                class="arrow ms-1 d-lg-block d-none">
              <img src="../../../assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-1 d-lg-none d-block">
            </a>
            <div class="dropdown-menu dropdown-menu-animation dropdown-xl p-3 border-radius-xl mt-0 mt-lg-3 shadow-none"
              aria-labelledby="dropdownMenuPages">
              <div class="row d-none d-lg-block">
                <div class="col-12 px-4 py-2">
                  <div class="row">
                    <div class="col-4 position-relative">
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                        <i class="ni ni-spaceship me-3 text-primary"></i>
                        Dashboards
                      </div>
                      <a href="../../../pages/dashboards/landing.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Landing</span>
                      </a>
                      <a href="../../../pages/dashboards/default.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Default</span>
                      </a>
                      <a href="../../../pages/dashboards/automotive.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Automotive</span>
                      </a>
                      <a href="../../../pages/dashboards/smart-home.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Smart Home</span>
                      </a>
                      <a href="../../../pages/dashboards/virtual-reality.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Virtual Reality</span>
                      </a>
                      <a href="../../../pages/dashboards/crm.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">CRM</span>
                      </a>
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                        <i class="ni ni-circle-08 me-3 text-primary"></i>
                        Users
                      </div>
                      <a href="../../../pages/pages/users/reports.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Reports</span>
                      </a>
                      <a href="../../../pages/pages/users/new-user.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">New User</span>
                      </a>
                      <hr class="vertical dark">
                    </div>
                    <div class="col-4 position-relative">
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                        <i class="ni ni-badge me-3 text-primary"></i>
                        Profile
                      </div>
                      <a href="../../../pages/pages/profile/overview.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Overview</span>
                      </a>
                      <a href="../../../pages/pages/profile/teams.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Teams</span>
                      </a>
                      <a href="../../../pages/pages/profile/projects.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Projects</span>
                      </a>
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                        <i class="ni ni-app me-3 text-primary"></i>
                        Projects
                      </div>
                      <a href="../../../pages/pages/projects/general.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">General</span>
                      </a>
                      <a href="../../../pages/pages/projects/timeline.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Timeline</span>
                      </a>
                      <a href="../../../pages/pages/projects/new-project.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">New Project</span>
                      </a>
                      <hr class="vertical dark">
                    </div>
                    <div class="col-4">
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                        <i class="ni ni-single-02 me-3 text-primary"></i>
                        Account
                      </div>
                      <a href="../../../pages/pages/account/settings.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Settings</span>
                      </a>
                      <a href="../../../pages/pages/account/billing.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Billing</span>
                      </a>
                      <a href="../../../pages/pages/account/invoice.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Invoice</span>
                      </a>
                      <a href="../../../pages/pages/account/security.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Security</span>
                      </a>
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0 mt-3">
                        <i class="ni ni-folder-17 me-3 text-primary"></i>
                        Extra
                      </div>
                      <a href="../../../pages/pages/pricing-page.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Pricing Page</span>
                      </a>
                      <a href="../../../pages/pages/rtl-page.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">RTL Page</span>
                      </a>
                      <a href="../../../pages/pages/widgets.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Widgets</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- responsive -->
              <div class="d-lg-none">
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                  <i class="ni ni-spaceship me-3 text-primary"></i>
                  Dashboards
                </div>
                <a href="../../../pages/dashboards/landing.html" class="dropdown-item border-radius-md ms-3">
                  Landing
                </a>
                <a href="../../../pages/dashboards/default.html" class="dropdown-item border-radius-md ms-3">
                  Default
                </a>
                <a href="../../../pages/dashboards/automotive.html" class="dropdown-item border-radius-md ms-3">
                  Automotive
                </a>
                <a href="../../../pages/dashboards/smart-home.html" class="dropdown-item border-radius-md ms-3">
                  Smart Home
                </a>
                <a href="../../../pages/dashboards/virtual-reality.html" class="dropdown-item border-radius-md ms-3">
                  Virtual Reality
                </a>
                <a href="../../../pages/dashboards/crm.html" class="dropdown-item border-radius-md ms-3">
                  CRM
                </a>
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0 mt-3">
                  <i class="ni ni-circle-08 me-3 text-primary"></i>
                  Users
                </div>
                <a href="../../../pages/pages/users/reports.html" class="dropdown-item border-radius-md ms-3">
                  Reports
                </a>
                <a href="../../../pages/pages/users/new-user.html" class="dropdown-item border-radius-md ms-3">
                  New user
                </a>
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0 mt-3">
                  <i class="ni ni-badge me-3 text-primary"></i>
                  Profile
                </div>
                <a href="../../../pages/pages/profile/overview.html" class="dropdown-item border-radius-md ms-3">
                  Overview
                </a>
                <a href="../../../pages/pages/profile/teams.html" class="dropdown-item border-radius-md ms-3">
                  Teams
                </a>
                <a href="../../../pages/pages/profile/projects.html" class="dropdown-item border-radius-md ms-3">
                  Projects
                </a>
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                  <i class="ni ni-app me-3 text-primary"></i>
                  Projects
                </div>
                <a href="../../../pages/pages/projects/general.html" class="dropdown-item border-radius-md ms-3">
                  General
                </a>
                <a href="../../../pages/pages/projects/timeline.html" class="dropdown-item border-radius-md ms-3">
                  Timeline
                </a>
                <a href="../../../pages/pages/projects/new-project.html" class="dropdown-item border-radius-md ms-3">
                  New Project
                </a>
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                  <i class="ni ni-single-02 me-3 text-primary"></i>
                  Account
                </div>
                <a href="../../../pages/pages/account/settings.html" class="dropdown-item border-radius-md ms-3">
                  Settings
                </a>
                <a href="../../../pages/pages/account/billing.html" class="dropdown-item border-radius-md ms-3">
                  Billing
                </a>
                <a href="../../../pages/pages/account/invoice.html" class="dropdown-item border-radius-md ms-3">
                  Invoice
                </a>
                <a href="../../../pages/pages/account/security.html" class="dropdown-item border-radius-md ms-3">
                  Security
                </a>
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                  <i class="ni ni-folder-17 me-3 text-primary"></i>
                  Extra
                </div>
                <a href="../../../pages/pages/pricing-page.html" class="dropdown-item border-radius-md ms-3">
                  Pricing Page
                </a>
                <a href="../../../pages/pages/rtl-page.html" class="dropdown-item border-radius-md ms-3">
                  RTL Page
                </a>
                <a href="../../../pages/pages/widgets.html" class="dropdown-item border-radius-md ms-3">
                  Widgets
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-hover mx-2">
            <a role="button" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center "
              id="dropdownMenuAccount" data-bs-toggle="dropdown" aria-expanded="false">
              Authentication
              <img src=" ../../../assets/img/down-arrow-white.svg " alt="down-arrow"
                class="arrow ms-1 d-lg-block d-none">
              <img src="../../../assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-1 d-lg-none d-block">
            </a>
            <div class="dropdown-menu dropdown-menu-animation dropdown-lg border-radius-xl p-3 mt-0 mt-lg-3 shadow-none"
              aria-labelledby="dropdownMenuAccount">
              <div class="row d-none d-lg-flex">
                <div class="col-6">
                  <div class="py-6 h-100 w-100 d-flex border-radius-lg position-relative dropdown-image"
                    style="background-image:url('https://images.unsplash.com/photo-1635944095210-23114a1fb7c0?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1335&q=80')">
                    <div class="mask bg-gradient-primary border-radius-lg"></div>
                    <div
                      class="d-flex justify-content-center align-items-center text-center text-white font-weight-bold w-100 z-index-1 flex-column">
                      <span class="text-lg">Explore our<br>Authentication pages</span>
                    </div>
                  </div>
                </div>
                <div class="col-6 ps-0 d-flex justify-content-center flex-column">
                  <ul class="list-group">
                    <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                      <a class="dropdown-item border-radius-md ps-3 d-flex align-items-center justify-content-between mb-1"
                        id="dropdownSignIn">
                        <span>Sign In</span>
                        <img src="../../../assets/img/down-arrow.svg" alt="down-arrow" class="arrow">
                      </a>
                      <div class="dropdown-menu mt-0 py-3 px-2" aria-labelledby="dropdownSignIn">
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/signin/basic.html">
                          <span>Basic</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/signin/cover.html">
                          <span>Cover</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/signin/illustration.html">
                          <span>Illustration</span>
                        </a>
                      </div>
                    </li>
                    <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                      <a class="dropdown-item border-radius-md ps-3 d-flex align-items-center justify-content-between mb-1"
                        id="dropdownSignUp">
                        <span>Sign Up</span>
                        <img src="../../../assets/img/down-arrow.svg" alt="down-arrow" class="arrow">
                      </a>
                      <div class="dropdown-menu mt-0 py-3 px-2" aria-labelledby="dropdownSignUp">
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/signup/basic.html">
                          <span>Basic</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/signup/cover.html">
                          <span>Cover</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/signup/illustration.html">
                          <span>Illustration</span>
                        </a>
                      </div>
                    </li>
                    <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                      <a class="dropdown-item border-radius-md ps-3 d-flex align-items-center justify-content-between mb-1"
                        id="dropdownPasswordReset">
                        <span>Reset Password</span>
                        <img src="../../../assets/img/down-arrow.svg" alt="down-arrow" class="arrow">
                      </a>
                      <div class="dropdown-menu mt-0 py-3 px-2" aria-labelledby="dropdownPasswordReset">
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/reset/basic.html">
                          <span>Basic</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/reset/cover.html">
                          <span>Cover</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/reset/illustration.html">
                          <span>Illustration</span>
                        </a>
                      </div>
                    </li>
                    <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                      <a class="dropdown-item border-radius-md ps-3 d-flex align-items-center justify-content-between mb-1"
                        id="dropdownLock">
                        <span>Lock</span>
                        <img src="../../../assets/img/down-arrow.svg" alt="down-arrow" class="arrow">
                      </a>
                      <div class="dropdown-menu mt-0 py-3 px-2" aria-labelledby="dropdownLock">
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/lock/basic.html">
                          <span>Basic</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/lock/cover.html">
                          <span>Cover</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/lock/illustration.html">
                          <span>Illustration</span>
                        </a>
                      </div>
                    </li>
                    <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                      <a class="dropdown-item border-radius-md ps-3 d-flex align-items-center justify-content-between mb-1"
                        id="dropdown2fa">
                        <span>2-Step Verification</span>
                        <img src="../../../assets/img/down-arrow.svg" alt="down-arrow" class="arrow">
                      </a>
                      <div class="dropdown-menu mt-0 py-3 px-2" aria-labelledby="dropdown2fa">
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/verification/basic.html">
                          <span>Basic</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/verification/cover.html">
                          <span>Cover</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/verification/illustration.html">
                          <span>Illustration</span>
                        </a>
                      </div>
                    </li>
                    <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                      <a class="dropdown-item border-radius-md ps-3 d-flex align-items-center justify-content-between mb-1"
                        id="dropdownError">
                        <span>Error</span>
                        <img src="../../../assets/img/down-arrow.svg" alt="down-arrow" class="arrow">
                      </a>
                      <div class="dropdown-menu mt-0 py-3 px-2" aria-labelledby="dropdownError">
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/error/404.html">
                          <span>404</span>
                        </a>
                        <a class="dropdown-item ps-3 border-radius-md mb-1"
                          href="../../../pages/authentication/error/500.html">
                          <span>500</span>
                        </a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row d-lg-none">
                <div class="col-12 d-flex justify-content-center flex-column">
                  <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                    Sign In
                  </h6>
                  <a href="../../../pages/authentication/signin/basic.html" class="dropdown-item border-radius-md">
                    Basic
                  </a>
                  <a href="../../../pages/authentication/signin/cover.html" class="dropdown-item border-radius-md">
                    Cover
                  </a>
                  <a href="../../../pages/authentication/signin/illustration.html"
                    class="dropdown-item border-radius-md">
                    Illustration
                  </a>
                  <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                    Sign Up
                  </h6>
                  <a href="../../../pages/authentication/signup/basic.html" class="dropdown-item border-radius-md">
                    Basic
                  </a>
                  <a href="../../../pages/authentication/signup/cover.html" class="dropdown-item border-radius-md">
                    Cover
                  </a>
                  <a href="../../../pages/authentication/signup/illustration.html"
                    class="dropdown-item border-radius-md">
                    Illustration
                  </a>
                  <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                    Reset Password
                  </h6>
                  <a href="../../../pages/authentication/reset/basic.html" class="dropdown-item border-radius-md">
                    Basic
                  </a>
                  <a href="../../../pages/authentication/reset/cover.html" class="dropdown-item border-radius-md">
                    Cover
                  </a>
                  <a href="../../../pages/authentication/reset/illustration.html"
                    class="dropdown-item border-radius-md">
                    Illustation
                  </a>
                  <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                    Lock
                  </h6>
                  <a href="../../../pages/authentication/lock/basic.html" class="dropdown-item border-radius-md">
                    Basic
                  </a>
                  <a href="../../../pages/authentication/lock/cover.html" class="dropdown-item border-radius-md">
                    Cover
                  </a>
                  <a href="../../../pages/authentication/lock/illustration.html" class="dropdown-item border-radius-md">
                    Illustration
                  </a>
                  <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                    2-Step Verification
                  </h6>
                  <a href="../../../pages/authentication/verification/basic.html"
                    class="dropdown-item border-radius-md">
                    Basic
                  </a>
                  <a href="../../../pages/authentication/verification/cover.html"
                    class="dropdown-item border-radius-md">
                    Cover
                  </a>
                  <a href="../../../pages/authentication/verification/illustration.html"
                    class="dropdown-item border-radius-md">
                    Illustration
                  </a>
                  <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center mt-3 px-0">
                    Error
                  </h6>
                  <a href="../../../pages/authentication/error/404.html" class="dropdown-item border-radius-md">
                    404
                  </a>
                  <a href="../../../pages/authentication/error/500.html" class="dropdown-item border-radius-md">
                    500
                  </a>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-hover mx-2">
            <a role="button" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center "
              id="dropdownMenuBlocks" data-bs-toggle="dropdown" aria-expanded="false">
              Applications
              <img src=" ../../../assets/img/down-arrow-white.svg " alt="down-arrow"
                class="arrow ms-1 d-lg-block d-none">
              <img src="../../../assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-1 d-lg-none d-block">
            </a>
            <div
              class="dropdown-menu dropdown-menu-animation dropdown-md dropdown-md-responsive p-3 border-radius-lg mt-0 mt-lg-3 shadow-none"
              aria-labelledby="dropdownMenuBlocks">
              <div class="d-none d-lg-block">
                <ul class="list-group">
                  <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../pages/applications/kanban.html">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-single-copy-04 text-primary"></i>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between">
                          <div>
                            <p class="dropdown-header text-dark p-0">Kanban</p>
                          </div>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../pages/applications/wizard.html">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-laptop text-primary"></i>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between">
                          <div>
                            <p class="dropdown-header text-dark p-0">Wizard</p>
                          </div>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md"
                      href="../../../pages/applications/datatables.html">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-badge text-primary"></i>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between">
                          <div>
                            <p class="dropdown-header text-dark p-0">DataTables</p>
                          </div>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item dropdown dropdown-hover dropdown-subitem list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md"
                      href="../../../pages/applications/calendar.html">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-notification-70 text-primary"></i>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between">
                          <div>
                            <p class="dropdown-header text-dark p-0">Calendar</p>
                          </div>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- responsive -->
              <div class="row d-lg-none">
                <div class="col-md-12">
                  <a class="py-2 ps-3 border-radius-md" href="../../../pages/applications/kanban.html">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-single-copy-04 text-primary"></i>
                      </div>
                      <div class="w-100 d-flex align-items-center justify-content-between">
                        <div>
                          <p class="dropdown-header text-dark p-0">Kanban</p>
                        </div>
                      </div>
                    </div>
                  </a>
                  <a class="py-2 ps-3 border-radius-md" href="../../../pages/applications/wizard.html">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-laptop text-primary"></i>
                      </div>
                      <div class="w-100 d-flex align-items-center justify-content-between">
                        <div>
                          <p class="dropdown-header text-dark p-0">Wizard</p>
                        </div>
                      </div>
                    </div>
                  </a>
                  <a class="py-2 ps-3 border-radius-md" href="../../../pages/applications/datatables.html">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-badge text-primary"></i>
                      </div>
                      <div class="w-100 d-flex align-items-center justify-content-between">
                        <div>
                          <p class="dropdown-header text-dark p-0">DataTables</p>
                        </div>
                      </div>
                    </div>
                  </a>
                  <a class="py-2 ps-3 border-radius-md" href="../../../pages/applications/calendar.html">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-notification-70 text-primary"></i>
                      </div>
                      <div class="w-100 d-flex align-items-center justify-content-between">
                        <div>
                          <p class="dropdown-header text-dark p-0">Calendar</p>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-hover mx-2">
            <a role="button" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center "
              id="dropdownMenuEcommerce" data-bs-toggle="dropdown" aria-expanded="false">
              Ecommerce
              <img src=" ../../../assets/img/down-arrow-white.svg  " alt="down-arrow"
                class="arrow ms-1 d-lg-block d-none">
              <img src="../../../assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-1 d-lg-none d-block">
            </a>
            <div class="dropdown-menu dropdown-menu-animation dropdown-lg p-3 border-radius-xl mt-0 mt-lg-3 shadow-none"
              aria-labelledby="dropdownMenuEcommerce">
              <div class="row d-none d-lg-block">
                <div class="col-12 px-4 py-2">
                  <div class="row">
                    <div class="col-6 position-relative">
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                        <i class="ni ni-cart text-primary me-3"></i>
                        Orders
                      </div>
                      <a href="../../../pages/ecommerce/orders/list.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Order List</span>
                      </a>
                      <a href="../../../pages/ecommerce/orders/details.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Order Details</span>
                      </a>
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0 mt-3">
                        <i class="ni ni-box-2 text-primary me-3"></i>
                        General
                      </div>
                      <a href="../../../pages/ecommerce/overview.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Overview</span>
                      </a>
                      <a href="../../../pages/ecommerce/referral.html" class="dropdown-item border-radius-md">
                        <span class="ps-3">Referral</span>
                      </a>
                      <hr class="vertical dark">
                    </div>
                    <div class="col-6 position-relative">
                      <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                        <i class="ni ni-planet text-primary me-3"></i>
                        Products
                      </div>
                      <a href="../../../pages/ecommerce/products/new-product.html"
                        class="dropdown-item border-radius-md">
                        <span class="ps-3">New Product</span>
                      </a>
                      <a href="../../../pages/ecommerce/products/edit-product.html"
                        class="dropdown-item border-radius-md">
                        <span class="ps-3">Edit Product</span>
                      </a>
                      <a href="../../../pages/ecommerce/products/product-page.html"
                        class="dropdown-item border-radius-md">
                        <span class="ps-3">Product Page</span>
                      </a>
                      <a href="../../../pages/ecommerce/products/products-list.html"
                        class="dropdown-item border-radius-md">
                        <span class="ps-3">Products List</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- responsive -->
              <div class="d-lg-none">
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0">
                  <i class="ni ni-cart text-primary me-3"></i>
                  Orders
                </div>
                <a href="../../../pages/ecommerce/orders/list.html" class="dropdown-item border-radius-md ms-3">
                  Order List
                </a>
                <a href="../../../pages/pages/orders/details.html" class="dropdown-item border-radius-md ms-3">
                  Order Details
                </a>
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0 mt-3">
                  <i class="ni ni-box-2 text-primary me-3"></i>
                  General
                </div>
                <a href="../../../pages/ecommerce/overview.html" class="dropdown-item border-radius-md ms-3">
                  Overview
                </a>
                <a href="../../../pages/ecommerce/referral.html" class="dropdown-item border-radius-md ms-3">
                  Referral
                </a>
                <div class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-0 mt-3">
                  <i class="ni ni-planet text-primary me-3"></i>
                  Products
                </div>
                <a href="../../../pages/ecommerce/products/new-product.html"
                  class="dropdown-item border-radius-md ms-3">
                  New Product
                </a>
                <a href="../../../pages/ecommerce/products/edit-product.html"
                  class="dropdown-item border-radius-md ms-3">
                  Edit Product
                </a>
                <a href="../../../pages/ecommerce/products/product-page.html"
                  class="dropdown-item border-radius-md ms-3">
                  Product Page
                </a>
                <a href="../../../pages/ecommerce/products/products-list.html"
                  class="dropdown-item border-radius-md ms-3">
                  Products List
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-hover mx-2">
            <a role="button" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center "
              id="dropdownMenuDocs" data-bs-toggle="dropdown" aria-expanded="false">
              Docs
              <img src=" ../../../assets/img/down-arrow-white.svg " alt="down-arrow"
                class="arrow ms-1 d-lg-block d-none">
              <img src="../../../assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-1 d-lg-none d-block">
            </a>
            <div
              class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-lg mt-0 mt-lg-3 p-3 border-radius-lg shadow-none"
              aria-labelledby="dropdownMenuDocs">
              <div class="d-none d-lg-block">
                <ul class="list-group">
                  <li class="nav-item list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md"
                      href="https://www.creative-tim.com/learning-lab/bootstrap/overview/argon-dashboard">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-planet text-primary"></i>
                        </div>
                        <div>
                          <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">Getting
                            Started</h6>
                          <span class="text-sm">All about overview, quick start, license and contents</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md"
                      href="https://www.creative-tim.com/learning-lab/bootstrap/colors/argon-dashboard">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-single-copy-04 text-primary"></i>
                        </div>
                        <div>
                          <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">
                            Foundation</h6>
                          <span class="text-sm">See our colors, icons and typography</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md"
                      href="https://www.creative-tim.com/learning-lab/bootstrap/alerts/argon-dashboard">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-app text-primary"></i>
                        </div>
                        <div>
                          <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">
                            Components</h6>
                          <span class="text-sm">Explore our collection of fully designed components</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md"
                      href="https://www.creative-tim.com/learning-lab/bootstrap/datepicker/argon-dashboard">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-chart-bar-32 text-primary"></i>
                        </div>
                        <div>
                          <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">Plugins
                          </h6>
                          <span class="text-sm">Check how you can integrate our plugins</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md"
                      href="https://www.creative-tim.com/learning-lab/bootstrap/utilities/argon-dashboard">
                      <div class="d-flex">
                        <div class="icon h-10 me-3 d-flex mt-1">
                          <i class="ni ni-settings text-primary"></i>
                        </div>
                        <div>
                          <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">Utility
                            Classes</h6>
                          <span class="text-sm">For those who want flexibility, use our utility classes</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="row d-lg-none">
                <div class="col-md-12 g-0">
                  <a class="dropdown-item py-2 ps-3 border-radius-md"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/overview/argon-dashboard">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-planet text-primary"></i>
                      </div>
                      <div>
                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">Getting
                          Started</h6>
                        <span class="text-sm">All about overview, quick start, license and contents</span>
                      </div>
                    </div>
                  </a>
                  <a class="dropdown-item py-2 ps-3 border-radius-md"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/colors/argon-dashboard">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-single-copy-04 text-primary"></i>
                      </div>
                      <div>
                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">
                          Foundation</h6>
                        <span class="text-sm">See our colors, icons and typography</span>
                      </div>
                    </div>
                  </a>
                  <a class="dropdown-item py-2 ps-3 border-radius-md"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/alerts/argon-dashboard">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-app text-primary"></i>
                      </div>
                      <div>
                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">
                          Components</h6>
                        <span class="text-sm">Explore our collection of fully designed components</span>
                      </div>
                    </div>
                  </a>
                  <a class="dropdown-item py-2 ps-3 border-radius-md"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/datepicker/argon-dashboard">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-chart-bar-32 text-primary"></i>
                      </div>
                      <div>
                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">Plugins
                        </h6>
                        <span class="text-sm">Check how you can integrate our plugins</span>
                      </div>
                    </div>
                  </a>
                  <a class="dropdown-item py-2 ps-3 border-radius-md"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/utilities/argon-dashboard">
                    <div class="d-flex">
                      <div class="icon h-10 me-3 d-flex mt-1">
                        <i class="ni ni-settings text-primary"></i>
                      </div>
                      <div>
                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center p-0">Utility
                          Classes</h6>
                        <span class="text-sm">All about overview, quick start, license and contents</span>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav d-lg-block d-none">
          <li class="nav-item">
            <a href="https://www.creative-tim.com/product/argon-dashboard-pro" class="btn btn-sm  btn-white  mb-0 me-1"
              onclick="smoothToPricing('pricing-argon')">Buy Now</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> --}}
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
      style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Welcome!</h1>
            <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for
              free.</p>
          </div>
        </div>
      </div>
    </div>

    <!--session message-->
    @if (session()->has('message'))
    <div class="position-fixed bottom-1 end-1 z-index-2">
      <div class="toast fade hide p-2 bg-white show" role="alert" aria-live="assertive" id="successToast"
        aria-atomic="true">
        <div class="toast-header border-0">
          <i class="ni ni-check-bold text-success me-2"></i>
          <span class="me-auto font-weight-bold">{{ session()->get('title') }}</span>
          {{-- <small class="text-body">11 mins ago</small> --}}
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          {{ session()->get('message') }}
        </div>
      </div>
    </div>
    @endif
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center pb-5">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            {{-- <div class="card-header text-center pt-4">
              <h5>Register with</h5>
            </div> --}}
            <div class="mem-btn-container row px-xl-5 px-sm-4 px-4 py-3">
              <div class="col-4 ms-auto px-1">
                <button class="mem-tab-btn btn btn-outline-light w-100 mb-0 active" data-memtab="settings">
                  基本情報
                </button>
              </div>
              <div class="col-4 px-1">
                <button class="mem-tab-btn btn btn-outline-light w-100 mb-0" data-memtab="orders">
                  注文履歴
                </button>
              </div>
              <div class="col-4 me-auto px-1">
                <button class="mem-tab-btn btn btn-outline-light w-100 mb-0" data-memtab="card">
                  会員証
                </button>
              </div>
              {{-- <div class="mt-2 position-relative text-center">
                <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                  or
                </p>
              </div> --}}
            </div>
            <div class="mem-content card-body pt-2 active" id="settings">
              <form role="form" action="{{  route('friends.update', ['aid' => $account->id,'friend'=>$friend->id])  }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input id="firstName" name="name" class="form-control" type="hidden" placeholder="ユーザー名" value="{{ $friend->name }}">
                <div class="mb-3">
                  <label class="form-label">メールアドレス</label>
                  <div class="input-group">
                    <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com" value="{{ $friend->email }}" required>
                  </div>
                </div>
                <div class="col-sm-8 mb-3">
                  <div class="row">
                    <div class="col-sm-5 col-5">
                      <label class="form-label">お誕生日</label>
                        <select name="dob-year" id="dob-year" class="form-control" required>
                          <option value="">年</option>
                          <option value="">----</option>
                          <option value="2015" {{date("Y", strtotime($friend->birthday)) == '2015'  ? 'selected' : ''}}>2015</option>
                          <option value="2014" {{date("Y", strtotime($friend->birthday)) == '2014'  ? 'selected' : ''}}>2014</option>
                          <option value="2013" {{date("Y", strtotime($friend->birthday)) == '2013'  ? 'selected' : ''}}>2013</option>
                          <option value="2012" {{date("Y", strtotime($friend->birthday)) == '2012'  ? 'selected' : ''}}>2012</option>
                          <option value="2011" {{date("Y", strtotime($friend->birthday)) == '2011'  ? 'selected' : ''}}>2011</option>
                          <option value="2010" {{date("Y", strtotime($friend->birthday)) == '2010'  ? 'selected' : ''}}>2010</option>
                          <option value="2009" {{date("Y", strtotime($friend->birthday)) == '2009'  ? 'selected' : ''}}>2009</option>
                          <option value="2008" {{date("Y", strtotime($friend->birthday)) == '2008'  ? 'selected' : ''}}>2008</option>
                          <option value="2007" {{date("Y", strtotime($friend->birthday)) == '2007'  ? 'selected' : ''}}>2007</option>
                          <option value="2006" {{date("Y", strtotime($friend->birthday)) == '2006'  ? 'selected' : ''}}>2006</option>
                          <option value="2005" {{date("Y", strtotime($friend->birthday)) == '2005'  ? 'selected' : ''}}>2005</option>
                          <option value="2004" {{date("Y", strtotime($friend->birthday)) == '2004'  ? 'selected' : ''}}>2004</option>
                          <option value="2003" {{date("Y", strtotime($friend->birthday)) == '2003'  ? 'selected' : ''}}>2003</option>
                          <option value="2002" {{date("Y", strtotime($friend->birthday)) == '2002'  ? 'selected' : ''}}>2002</option>
                          <option value="2001" {{date("Y", strtotime($friend->birthday)) == '2001'  ? 'selected' : ''}}>2001</option>
                          <option value="2000" {{date("Y", strtotime($friend->birthday)) == '2000'  ? 'selected' : ''}}>2000</option>
                          <option value="1999" {{date("Y", strtotime($friend->birthday)) == '1999'  ? 'selected' : ''}}>1999</option>
                          <option value="1998" {{date("Y", strtotime($friend->birthday)) == '1998'  ? 'selected' : ''}}>1998</option>
                          <option value="1997" {{date("Y", strtotime($friend->birthday)) == '1997'  ? 'selected' : ''}}>1997</option>
                          <option value="1996" {{date("Y", strtotime($friend->birthday)) == '1996'  ? 'selected' : ''}}>1996</option>
                          <option value="1995" {{date("Y", strtotime($friend->birthday)) == '1995'  ? 'selected' : ''}}>1995</option>
                          <option value="1994" {{date("Y", strtotime($friend->birthday)) == '1994'  ? 'selected' : ''}}>1994</option>
                          <option value="1993" {{date("Y", strtotime($friend->birthday)) == '1993'  ? 'selected' : ''}}>1993</option>
                          <option value="1992" {{date("Y", strtotime($friend->birthday)) == '1992'  ? 'selected' : ''}}>1992</option>
                          <option value="1991" {{date("Y", strtotime($friend->birthday)) == '1991'  ? 'selected' : ''}}>1991</option>
                          <option value="1990" {{date("Y", strtotime($friend->birthday)) == '1990'  ? 'selected' : ''}}>1990</option>
                          <option value="1989" {{date("Y", strtotime($friend->birthday)) == '1989'  ? 'selected' : ''}}>1989</option>
                          <option value="1988" {{date("Y", strtotime($friend->birthday)) == '1988'  ? 'selected' : ''}}>1988</option>
                          <option value="1987" {{date("Y", strtotime($friend->birthday)) == '1987'  ? 'selected' : ''}}>1987</option>
                          <option value="1986" {{date("Y", strtotime($friend->birthday)) == '1986'  ? 'selected' : ''}}>1986</option>
                          <option value="1985" {{date("Y", strtotime($friend->birthday)) == '1985'  ? 'selected' : ''}}>1985</option>
                          <option value="1984" {{date("Y", strtotime($friend->birthday)) == '1984'  ? 'selected' : ''}}>1984</option>
                          <option value="1983" {{date("Y", strtotime($friend->birthday)) == '1983'  ? 'selected' : ''}}>1983</option>
                          <option value="1982" {{date("Y", strtotime($friend->birthday)) == '1982'  ? 'selected' : ''}}>1982</option>
                          <option value="1981" {{date("Y", strtotime($friend->birthday)) == '1981'  ? 'selected' : ''}}>1981</option>
                          <option value="1980" {{date("Y", strtotime($friend->birthday)) == '1980'  ? 'selected' : ''}}>1980</option>
                          <option value="1979" {{date("Y", strtotime($friend->birthday)) == '1979'  ? 'selected' : ''}}>1979</option>
                          <option value="1978" {{date("Y", strtotime($friend->birthday)) == '1978'  ? 'selected' : ''}}>1978</option>
                          <option value="1977" {{date("Y", strtotime($friend->birthday)) == '1977'  ? 'selected' : ''}}>1977</option>
                          <option value="1976" {{date("Y", strtotime($friend->birthday)) == '1976'  ? 'selected' : ''}}>1976</option>
                          <option value="1975" {{date("Y", strtotime($friend->birthday)) == '1975'  ? 'selected' : ''}}>1975</option>
                          <option value="1974" {{date("Y", strtotime($friend->birthday)) == '1974'  ? 'selected' : ''}}>1974</option>
                          <option value="1973" {{date("Y", strtotime($friend->birthday)) == '1973'  ? 'selected' : ''}}>1973</option>
                          <option value="1972" {{date("Y", strtotime($friend->birthday)) == '1972'  ? 'selected' : ''}}>1972</option>
                          <option value="1971" {{date("Y", strtotime($friend->birthday)) == '1971'  ? 'selected' : ''}}>1971</option>
                          <option value="1970" {{date("Y", strtotime($friend->birthday)) == '1970'  ? 'selected' : ''}}>1970</option>
                          <option value="1969" {{date("Y", strtotime($friend->birthday)) == '1969'  ? 'selected' : ''}}>1969</option>
                          <option value="1968" {{date("Y", strtotime($friend->birthday)) == '1968'  ? 'selected' : ''}}>1968</option>
                          <option value="1967" {{date("Y", strtotime($friend->birthday)) == '1967'  ? 'selected' : ''}}>1967</option>
                          <option value="1966" {{date("Y", strtotime($friend->birthday)) == '1966'  ? 'selected' : ''}}>1966</option>
                          <option value="1965" {{date("Y", strtotime($friend->birthday)) == '1965'  ? 'selected' : ''}}>1965</option>
                          <option value="1964" {{date("Y", strtotime($friend->birthday)) == '1964'  ? 'selected' : ''}}>1964</option>
                          <option value="1963" {{date("Y", strtotime($friend->birthday)) == '1963'  ? 'selected' : ''}}>1963</option>
                          <option value="1962" {{date("Y", strtotime($friend->birthday)) == '1962'  ? 'selected' : ''}}>1962</option>
                          <option value="1961" {{date("Y", strtotime($friend->birthday)) == '1961'  ? 'selected' : ''}}>1961</option>
                          <option value="1960" {{date("Y", strtotime($friend->birthday)) == '1960'  ? 'selected' : ''}}>1960</option>
                          <option value="1959" {{date("Y", strtotime($friend->birthday)) == '1959'  ? 'selected' : ''}}>1959</option>
                          <option value="1958" {{date("Y", strtotime($friend->birthday)) == '1958'  ? 'selected' : ''}}>1958</option>
                          <option value="1957" {{date("Y", strtotime($friend->birthday)) == '1957'  ? 'selected' : ''}}>1957</option>
                          <option value="1956" {{date("Y", strtotime($friend->birthday)) == '1956'  ? 'selected' : ''}}>1956</option>
                          <option value="1955" {{date("Y", strtotime($friend->birthday)) == '1955'  ? 'selected' : ''}}>1955</option>
                          <option value="1954" {{date("Y", strtotime($friend->birthday)) == '1954'  ? 'selected' : ''}}>1954</option>
                          <option value="1953" {{date("Y", strtotime($friend->birthday)) == '1953'  ? 'selected' : ''}}>1953</option>
                          <option value="1952" {{date("Y", strtotime($friend->birthday)) == '1952'  ? 'selected' : ''}}>1952</option>
                          <option value="1951" {{date("Y", strtotime($friend->birthday)) == '1951'  ? 'selected' : ''}}>1951</option>
                          <option value="1950" {{date("Y", strtotime($friend->birthday)) == '1950'  ? 'selected' : ''}}>1950</option>
                          <option value="1949" {{date("Y", strtotime($friend->birthday)) == '1949'  ? 'selected' : ''}}>1949</option>
                          <option value="1948" {{date("Y", strtotime($friend->birthday)) == '1948'  ? 'selected' : ''}}>1948</option>
                          <option value="1947" {{date("Y", strtotime($friend->birthday)) == '1947'  ? 'selected' : ''}}>1947</option>
                          <option value="1946" {{date("Y", strtotime($friend->birthday)) == '1946'  ? 'selected' : ''}}>1946</option>
                          <option value="1945" {{date("Y", strtotime($friend->birthday)) == '1945'  ? 'selected' : ''}}>1945</option>
                          <option value="1944" {{date("Y", strtotime($friend->birthday)) == '1944'  ? 'selected' : ''}}>1944</option>
                          <option value="1943" {{date("Y", strtotime($friend->birthday)) == '1943'  ? 'selected' : ''}}>1943</option>
                          <option value="1942" {{date("Y", strtotime($friend->birthday)) == '1942'  ? 'selected' : ''}}>1942</option>
                          <option value="1941" {{date("Y", strtotime($friend->birthday)) == '1941'  ? 'selected' : ''}}>1941</option>
                          <option value="1940" {{date("Y", strtotime($friend->birthday)) == '1940'  ? 'selected' : ''}}>1940</option>
                          <option value="1939" {{date("Y", strtotime($friend->birthday)) == '1939'  ? 'selected' : ''}}>1939</option>
                          <option value="1938" {{date("Y", strtotime($friend->birthday)) == '1938'  ? 'selected' : ''}}>1938</option>
                          <option value="1937" {{date("Y", strtotime($friend->birthday)) == '1937'  ? 'selected' : ''}}>1937</option>
                          <option value="1936" {{date("Y", strtotime($friend->birthday)) == '1936'  ? 'selected' : ''}}>1936</option>
                          <option value="1935" {{date("Y", strtotime($friend->birthday)) == '1935'  ? 'selected' : ''}}>1935</option>
                          <option value="1934" {{date("Y", strtotime($friend->birthday)) == '1934'  ? 'selected' : ''}}>1934</option>
                          <option value="1933" {{date("Y", strtotime($friend->birthday)) == '1933'  ? 'selected' : ''}}>1933</option>
                          <option value="1932" {{date("Y", strtotime($friend->birthday)) == '1932'  ? 'selected' : ''}}>1932</option>
                          <option value="1931" {{date("Y", strtotime($friend->birthday)) == '1931'  ? 'selected' : ''}}>1931</option>
                          <option value="1930" {{date("Y", strtotime($friend->birthday)) == '1930'  ? 'selected' : ''}}>1930</option>
                          <option value="1929" {{date("Y", strtotime($friend->birthday)) == '1929'  ? 'selected' : ''}}>1929</option>
                          <option value="1928" {{date("Y", strtotime($friend->birthday)) == '1928'  ? 'selected' : ''}}>1928</option>
                          <option value="1927" {{date("Y", strtotime($friend->birthday)) == '1927'  ? 'selected' : ''}}>1927</option>
                          <option value="1926" {{date("Y", strtotime($friend->birthday)) == '1926'  ? 'selected' : ''}}>1926</option>
                          <option value="1925" {{date("Y", strtotime($friend->birthday)) == '1925'  ? 'selected' : ''}}>1925</option>
                          <option value="1924" {{date("Y", strtotime($friend->birthday)) == '1924'  ? 'selected' : ''}}>1924</option>
                          <option value="1923" {{date("Y", strtotime($friend->birthday)) == '1923'  ? 'selected' : ''}}>1923</option>
                          <option value="1922" {{date("Y", strtotime($friend->birthday)) == '1922'  ? 'selected' : ''}}>1922</option>
                          <option value="1921" {{date("Y", strtotime($friend->birthday)) == '1921'  ? 'selected' : ''}}>1921</option>
                          <option value="1920" {{date("Y", strtotime($friend->birthday)) == '1920'  ? 'selected' : ''}}>1920</option>
                          <option value="1919" {{date("Y", strtotime($friend->birthday)) == '1919'  ? 'selected' : ''}}>1919</option>
                          <option value="1918" {{date("Y", strtotime($friend->birthday)) == '1918'  ? 'selected' : ''}}>1918</option>
                          <option value="1917" {{date("Y", strtotime($friend->birthday)) == '1917'  ? 'selected' : ''}}>1917</option>
                          <option value="1916" {{date("Y", strtotime($friend->birthday)) == '1916'  ? 'selected' : ''}}>1916</option>
                          <option value="1915" {{date("Y", strtotime($friend->birthday)) == '1915'  ? 'selected' : ''}}>1915</option>
                          <option value="1914" {{date("Y", strtotime($friend->birthday)) == '1914'  ? 'selected' : ''}}>1914</option>
                          <option value="1913" {{date("Y", strtotime($friend->birthday)) == '1913'  ? 'selected' : ''}}>1913</option>
                          <option value="1912" {{date("Y", strtotime($friend->birthday)) == '1912'  ? 'selected' : ''}}>1912</option>
                          <option value="1911" {{date("Y", strtotime($friend->birthday)) == '1911'  ? 'selected' : ''}}>1911</option>
                          <option value="1910" {{date("Y", strtotime($friend->birthday)) == '1910'  ? 'selected' : ''}}>1910</option>
                          <option value="1909" {{date("Y", strtotime($friend->birthday)) == '1909'  ? 'selected' : ''}}>1909</option>
                          <option value="1908" {{date("Y", strtotime($friend->birthday)) == '1908'  ? 'selected' : ''}}>1908</option>
                          <option value="1907" {{date("Y", strtotime($friend->birthday)) == '1907'  ? 'selected' : ''}}>1907</option>
                          <option value="1906" {{date("Y", strtotime($friend->birthday)) == '1906'  ? 'selected' : ''}}>1906</option>
                          <option value="1905" {{date("Y", strtotime($friend->birthday)) == '1905'  ? 'selected' : ''}}>1905</option>
                          <option value="1904" {{date("Y", strtotime($friend->birthday)) == '1904'  ? 'selected' : ''}}>1904</option>
                          <option value="1903" {{date("Y", strtotime($friend->birthday)) == '1903'  ? 'selected' : ''}}>1903</option>
                          <option value="1902" {{date("Y", strtotime($friend->birthday)) == '1902'  ? 'selected' : ''}}>1901</option>
                          <option value="1901" {{date("Y", strtotime($friend->birthday)) == '1901'  ? 'selected' : ''}}>1901</option>
                          <option value="1900" {{date("Y", strtotime($friend->birthday)) == '1900'  ? 'selected' : ''}}>1900</option>
                        </select>
                    </div>
                    <div class="col-sm-4 col-3">
                      <label class="form-label">&nbsp;</label>
                        <select name="dob-month" id="dob-month" class="form-control" required>
                          <option value="">月</option>
                          <option value="">-----</option>
                          <option value="01" {{date("F", strtotime($friend->birthday)) == 'January'  ? 'selected' : ''}}>01</option>
                          <option value="02" {{date("F", strtotime($friend->birthday)) == 'February'  ? 'selected' : ''}}>02</option>
                          <option value="03" {{date("F", strtotime($friend->birthday)) == 'March'  ? 'selected' : ''}}>03</option>
                          <option value="04" {{date("F", strtotime($friend->birthday)) == 'April'  ? 'selected' : ''}}>04</option>
                          <option value="05" {{date("F", strtotime($friend->birthday)) == 'May'  ? 'selected' : ''}}>05</option>
                          <option value="06" {{date("F", strtotime($friend->birthday)) == 'June'  ? 'selected' : ''}}>06</option>
                          <option value="07" {{date("F", strtotime($friend->birthday)) == 'July'  ? 'selected' : ''}}>07</option>
                          <option value="08" {{date("F", strtotime($friend->birthday)) == 'August'  ? 'selected' : ''}}>08</option>
                          <option value="09" {{date("F", strtotime($friend->birthday)) == 'September'  ? 'selected' : ''}}>09</option>
                          <option value="10" {{date("F", strtotime($friend->birthday)) == 'October'  ? 'selected' : ''}}>10</option>
                          <option value="11" {{date("F", strtotime($friend->birthday)) == 'November'  ? 'selected' : ''}}>11</option>
                          <option value="12" {{date("F", strtotime($friend->birthday)) == 'December'  ? 'selected' : ''}}>12</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-4">
                      <label class="form-label">&nbsp;</label>
                        <select name="dob-day" id="dob-day" class="form-control" required>
                          <option value="">日</option>
                          <option value="">---</option>
                          <option value="01" {{date("d", strtotime($friend->birthday)) == '01'  ? 'selected' : ''}}>01</option>
                          <option value="02" {{date("d", strtotime($friend->birthday)) == '02'  ? 'selected' : ''}}>02</option>
                          <option value="03" {{date("d", strtotime($friend->birthday)) == '03'  ? 'selected' : ''}}>03</option>
                          <option value="04" {{date("d", strtotime($friend->birthday)) == '04'  ? 'selected' : ''}}>04</option>
                          <option value="05" {{date("d", strtotime($friend->birthday)) == '05'  ? 'selected' : ''}}>05</option>
                          <option value="06" {{date("d", strtotime($friend->birthday)) == '06'  ? 'selected' : ''}}>06</option>
                          <option value="07" {{date("d", strtotime($friend->birthday)) == '07'  ? 'selected' : ''}}>07</option>
                          <option value="08" {{date("d", strtotime($friend->birthday)) == '08'  ? 'selected' : ''}}>08</option>
                          <option value="09" {{date("d", strtotime($friend->birthday)) == '09'  ? 'selected' : ''}}>09</option>
                          <option value="10" {{date("d", strtotime($friend->birthday)) == '10'  ? 'selected' : ''}}>10</option>
                          <option value="11" {{date("d", strtotime($friend->birthday)) == '11'  ? 'selected' : ''}}>11</option>
                          <option value="12" {{date("d", strtotime($friend->birthday)) == '12'  ? 'selected' : ''}}>12</option>
                          <option value="13" {{date("d", strtotime($friend->birthday)) == '13'  ? 'selected' : ''}}>13</option>
                          <option value="14" {{date("d", strtotime($friend->birthday)) == '14'  ? 'selected' : ''}}>14</option>
                          <option value="15" {{date("d", strtotime($friend->birthday)) == '15'  ? 'selected' : ''}}>15</option>
                          <option value="16" {{date("d", strtotime($friend->birthday)) == '16'  ? 'selected' : ''}}>16</option>
                          <option value="17" {{date("d", strtotime($friend->birthday)) == '17'  ? 'selected' : ''}}>17</option>
                          <option value="18" {{date("d", strtotime($friend->birthday)) == '18'  ? 'selected' : ''}}>18</option>
                          <option value="19" {{date("d", strtotime($friend->birthday)) == '19'  ? 'selected' : ''}}>19</option>
                          <option value="20" {{date("d", strtotime($friend->birthday)) == '20'  ? 'selected' : ''}}>20</option>
                          <option value="21" {{date("d", strtotime($friend->birthday)) == '21'  ? 'selected' : ''}}>21</option>
                          <option value="22" {{date("d", strtotime($friend->birthday)) == '22'  ? 'selected' : ''}}>22</option>
                          <option value="23" {{date("d", strtotime($friend->birthday)) == '23'  ? 'selected' : ''}}>23</option>
                          <option value="24" {{date("d", strtotime($friend->birthday)) == '24'  ? 'selected' : ''}}>24</option>
                          <option value="25" {{date("d", strtotime($friend->birthday)) == '25'  ? 'selected' : ''}}>25</option>
                          <option value="26" {{date("d", strtotime($friend->birthday)) == '26'  ? 'selected' : ''}}>26</option>
                          <option value="27" {{date("d", strtotime($friend->birthday)) == '27'  ? 'selected' : ''}}>27</option>
                          <option value="28" {{date("d", strtotime($friend->birthday)) == '28'  ? 'selected' : ''}}>28</option>
                          <option value="29" {{date("d", strtotime($friend->birthday)) == '29'  ? 'selected' : ''}}>29</option>
                          <option value="30" {{date("d", strtotime($friend->birthday)) == '30'  ? 'selected' : ''}}>30</option>
                          <option value="31" {{date("d", strtotime($friend->birthday)) == '31'  ? 'selected' : ''}}>31</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-6">
                  <label class="form-label">性別</label>
                  <select class="form-control" name="gender" id="choices-gender" >
                    <option value="male" {{$friend->gender == 'male'  ? 'selected' : ''}}>男性</option>
                    <option value="female" {{$friend->gender == 'female'  ? 'selected' : ''}}>女性</option>
                  </select>
                  </div>
                  <div class="col-6">
                    <label class="form-label">郵便番号</label>
                    <div class="input-group">
                      <input id="location" name="postcode" class="form-control" type="text" placeholder="000-0000" value="{{ $friend->postcode }}">
                    </div>
                  </div>
                </div>


                <div class="form-check form-check-info text-start">
                  <input class="form-check-input" type="checkbox" name="checkbox" value="checkbox" id="flexCheckDefault" checked required>
                  <label class="form-check-label" for="flexCheckDefault">
                    <a href="javascript:;" class="text-dark font-weight-bolder">個人情報の取り扱い</a>に同意します。
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">登録</button>
                </div>
              </form>
            </div>
            <div class="mem-content card-body pt-0" id="orders">
                <div class="col-md-10 mx-auto">
                  <div class="accordion-body p-0">
                    <div class="mem-order-accordion">
                      <div class="mem-order-container">
                        <div class="mem-order-label">2022年3月1日</div>
                        <div class="mem-order-content">
                          <h6>受取店舗</h6>
                          <p>
                            Restaurant Name here
                          </p> 
                          <h6>受取時間</h6>
                          <p>
                            11:30 ~ 11:45
                          </p>
                          <h6>支払方法</h6>
                          <p>
                            Payment method
                          </p>
                          <h6>注文商品</h6>
                          <p>
                            Orders
                          </p>
                          <h6>合計税込</h6>
                          <p>
                            1780円
                          </p>
                        </div>
                      </div>
                      <hr>
                      <div class="mem-order-container">
                        <div class="mem-order-label">2022年3月1日</div>
                        <div class="mem-order-content">
                          <h6>受取店舗</h6>
                          <p>
                            Restaurant Name here
                          </p> 
                          <h6>受取時間</h6>
                          <p>
                            11:30 ~ 11:45
                          </p>
                          <h6>支払方法</h6>
                          <p>
                            Payment method
                          </p>
                          <h6>注文商品</h6>
                          <p>
                            Orders
                          </p>
                          <h6>合計税込</h6>
                          <p>
                            1780円
                          </p>
                        </div>
                      </div>
                      <hr>
                      <div class="mem-order-container">
                        <div class="mem-order-label">2022年3月1日</div>
                        <div class="mem-order-content">
                          <h6>受取店舗</h6>
                          <p>
                            Restaurant Name here
                          </p> 
                          <h6>受取時間</h6>
                          <p>
                            11:30 ~ 11:45
                          </p>
                          <h6>支払方法</h6>
                          <p>
                            Payment method
                          </p>
                          <h6>注文商品</h6>
                          <p>
                            Orders
                          </p>
                          <h6>合計税込</h6>
                          <p>
                            1780円
                          </p>
                        </div>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
            </div>
            <div class="mem-content card-body" id="card">
              <p>hello Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque ratione magni aut, minus
                similique, obcaecati eveniet, ducimus voluptatem laboriosam fuga inventore natus reiciendis sit itaque
                eum voluptatum aperiam quidem aliquid!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <!-- Kanban scripts -->
  <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }


    const btns = document.querySelectorAll('.mem-tab-btn');
    const card = document.querySelector('.card');
    const articles = document.querySelectorAll('.mem-content');
    card.addEventListener('click', function(e){
      const id = e.target.dataset.memtab;
      if(id){
        // remove active from other buttons
        btns.forEach(function(btn){
          btn.classList.remove("active");
          e.target.classList.add("active");
        })
        // hide other articles
        articles.forEach(function(article){
          article.classList.remove("active");
        })
        const element = document.getElementById(id);
        element.classList.add("active");
      }
    })


  if (document.getElementById('choices-year')) {
    var year = document.getElementById('choices-year');
    setTimeout(function() {
      const example = new Choices(year);
    }, 1);

    for (y = 1900; y <= 2020; y++) {
      var optn = document.createElement("OPTION");
      optn.text = y;
      optn.value = y;

      if (y == 2020) {
        optn.selected = true;
      }

      year.options.add(optn);
    }
  }

  if (document.getElementById('choices-day')) {
    var day = document.getElementById('choices-day');
    setTimeout(function() {
      const example = new Choices(day);
    }, 1);


    for (y = 1; y <= 31; y++) {
      var optn = document.createElement("OPTION");
      optn.text = y;
      optn.value = y;

      if (y == 1) {
        optn.selected = true;
      }

      day.options.add(optn);
    }

  }

      if (document.getElementById('choices-month')) {
    var month = document.getElementById('choices-month');
    setTimeout(function() {
      const example = new Choices(month);
    }, 1);

    var d = new Date();
    var monthArray = new Array();
    monthArray[0] = "January";
    monthArray[1] = "February";
    monthArray[2] = "March";
    monthArray[3] = "April";
    monthArray[4] = "May";
    monthArray[5] = "June";
    monthArray[6] = "July";
    monthArray[7] = "August";
    monthArray[8] = "September";
    monthArray[9] = "October";
    monthArray[10] = "November";
    monthArray[11] = "December";
    for (m = 0; m <= 11; m++) {
      var optn = document.createElement("OPTION");
      optn.text = monthArray[m];
      // server side month start from one
      optn.value = (m + 1);
      // if june selected
      if (m == 1) {
        optn.selected = true;
      }
      month.options.add(optn);
    }
  }

  const accordion = document.getElementsByClassName('mem-order-container');

for (i=0; i<accordion.length; i++) {
  accordion[i].addEventListener('click', function () {
    this.classList.toggle('active')
  })
}

  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.0') }}"></script>
</body>

</html>