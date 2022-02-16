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

        @include('includes.topnav-accounts')

      </div>
    </div>
  </div>
  <div class="container-fluid py-4">

    <!--error message-->
    @if ($errors->any())
    <div class="position-fixed bottom-1 end-1 z-index-2">

      <div class="toast fade hide p-2 mt-2 bg-white show" role="alert" aria-live="assertive" id="dangerToast"
        aria-atomic="true">
        <div class="toast-header border-0">
          <i class="ni ni-notification-70 text-danger me-2"></i>
          <span class="me-auto text-gradient text-danger font-weight-bold">エラーが発生しました</span>
          <small class="text-body">0 mins ago</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          @foreach ($errors->all() as $error )
          {{ $error }} <br>
          @endforeach </div>
      </div>
    </div>
    @endif

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

    <form action="/friends/{{ $friend->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row mt-3">
        <div class="col-lg-3">
          <div class="card position-sticky top-1">
            <ul class="nav flex-column bg-white border-radius-lg p-3">
              <li class="nav-item">
                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#profile">
                  <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                  <span class="text-sm">Profile</span>
                </a>
              </li>
              <li class="nav-item pt-2">
                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info">
                  <i class="ni ni-books me-2 text-dark opacity-6"></i>
                  <span class="text-sm">Basic Info</span>
                </a>
              </li>
              <li class="nav-item pt-2">
                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#notifications">
                  <i class="ni ni-bell-55 me-2 text-dark opacity-6"></i>
                  <span class="text-sm">Notifications</span>
                </a>
              </li>
              <li class="nav-item pt-2">
                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#sessions">
                  <i class="ni ni-watch-time me-2 text-dark opacity-6"></i>
                  <span class="text-sm">Sessions</span>
                </a>
              </li>
              <li class="nav-item pt-2">
                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#delete">
                  <i class="ni ni-settings-gear-65 me-2 text-dark opacity-6"></i>
                  <span class="text-sm">Delete Account</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">
          <!-- Card Profile -->
          <div class="card card-body" id="profile">
            <div class="row justify-content-center align-items-center">
              <div class="col-sm-auto col-4">
                <div class="avatar avatar-sm position-relative">
                  <img src="../../../assets/img/team-3.jpg" alt="bruce" class="w-100 border-radius-lg shadow-sm">
                </div>
              </div>
              <div class="col-sm-auto col-8 my-auto">
                <div class="h-100">
                  <h5 class="mb-1 font-weight-bolder">
                    {{ $friend->name }}
                  </h5>
                  <p class="mb-0 font-weight-bold text-sm text-secondary">
                    登録日 {{ $friend->created_at->toDateString() }}
                  </p>
                </div>
              </div>
              <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                <label class="form-check-label mb-0">
                  <small id="profileVisibility">
                    Switch to invisible
                  </small>
                </label>
                <div class="form-check form-switch ms-2">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked
                    onchange="visible()">
                </div>
              </div>
            </div>
          </div>
          <!-- Card Basic Info -->
          <div class="card mt-4" id="basic-info">
            <div class="card-header">
              <h5>基本情報</h5>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-6">
                  <label class="form-label">ユーザー名</label>
                  <div class="input-group">
                    <input 
                      id="firstName" name="name" class="form-control" 
                      type="text" placeholder="ユーザー名" value="{{ $friend->name }}">
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label">メールアドレス</label>
                  <div class="input-group">
                    <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 col-6">
                  <label class="form-label mt-4">性別</label>
                  <select class="form-control" name="gender" id="choices-gender">
                    <option value="male">男性</option>
                    <option value="female">女性</option>
                  </select>
                </div>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-sm-5 col-5">
                      <label class="form-label mt-4">Birth Date</label>
                      <select class="form-control" name="choices-month" id="choices-month"></select>
                    </div>
                    <div class="col-sm-4 col-3">
                      <label class="form-label mt-4">&nbsp;</label>
                      <select class="form-control" name="choices-day" id="choices-day"></select>
                    </div>
                    <div class="col-sm-3 col-4">
                      <label class="form-label mt-4">&nbsp;</label>
                      <select class="form-control" name="choices-year" id="choices-year"></select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label mt-4">郵便番号</label>
                  <div class="input-group">
                    <input id="location" name="location" class="form-control" type="text" placeholder="Sydney, A">
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label mt-4">電話番号</label>
                  <div class="input-group">
                    <input id="phone" name="phone" class="form-control" type="number" placeholder="+40 735 631 620">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 align-self-center">
                  <label class="form-label mt-4">リッチメニュー</label>
                  <select class="form-control" name="choices-language" id="choices-language">
                    <option value="English">English</option>
                    <option value="French">French</option>
                    <option value="Spanish">Spanish</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label mt-4">タグ</label>
                  <input class="form-control" id="choices-skills" type="text" value="vuejs, angular, react"
                    placeholder="Enter something" />
                </div>
              </div>
            </div>
          </div>
          <!-- Card Notifications -->
          <div class="card mt-4" id="notifications">
            <div class="card-header">
              <h5>Notifications</h5>
              <p class="text-sm">Choose how you receive notifications. These notification settings apply to the things you’re watching.</p>
            </div>
            <div class="card-body pt-0">
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th class="ps-1" colspan="4">
                        <p class="mb-0">Activity</p>
                      </th>
                      <th class="text-center">
                        <p class="mb-0">Email</p>
                      </th>
                      <th class="text-center">
                        <p class="mb-0">Push</p>
                      </th>
                      <th class="text-center">
                        <p class="mb-0">SMS</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="ps-1" colspan="4">
                        <div class="my-auto">
                          <span class="text-dark d-block text-sm">Mentions</span>
                          <span class="text-xs font-weight-normal">Notify when another user mentions you in a comment</span>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault11">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault12">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault13">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="ps-1" colspan="4">
                        <div class="my-auto">
                          <span class="text-dark d-block text-sm">Comments</span>
                          <span class="text-xs font-weight-normal">Notify when another user comments your item.</span>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault14">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault15">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault16">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="ps-1" colspan="4">
                        <div class="my-auto">
                          <span class="text-dark d-block text-sm">Follows</span>
                          <span class="text-xs font-weight-normal">Notify when another user follows you.</span>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault17">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault18">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault19">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="ps-1" colspan="4">
                        <div class="my-auto">
                          <p class="text-sm mb-0">Log in from a new device</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault20">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault21">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault22">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Card Sessions -->
          <div class="card mt-4" id="sessions">
            <div class="card-header pb-3">
              <h5>Sessions</h5>
              <p class="text-sm">This is a list of devices that have logged into your account. Remove those that you do not recognize.</p>
            </div>
            <div class="card-body pt-0">
              <div class="d-flex align-items-center">
                <div class="text-center w-5">
                  <i class="fas fa-desktop text-lg opacity-6"></i>
                </div>
                <div class="my-auto ms-3">
                  <div class="h-100">
                    <p class="text-sm mb-1">
                      Bucharest 68.133.163.201
                    </p>
                    <p class="mb-0 text-xs">
                      Your current session
                    </p>
                  </div>
                </div>
                <span class="badge badge-success badge-sm my-auto ms-auto me-3">Active</span>
                <p class="text-secondary text-sm my-auto me-3">EU</p>
                <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                  <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                </a>
              </div>
              <hr class="horizontal dark">
              <div class="d-flex align-items-center">
                <div class="text-center w-5">
                  <i class="fas fa-desktop text-lg opacity-6"></i>
                </div>
                <p class="my-auto ms-3">Chrome on macOS</p>
                <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
                <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                  <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                </a>
              </div>
              <hr class="horizontal dark">
              <div class="d-flex align-items-center">
                <div class="text-center w-5">
                  <i class="fas fa-mobile text-lg opacity-6"></i>
                </div>
                <p class="my-auto ms-3">Safari on iPhone</p>
                <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
                <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                  <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- Card Delete Account -->
          <div class="card mt-4" id="delete">
            <div class="card-header">
              <h5>Delete Account</h5>
              <p class="text-sm mb-0">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
            <div class="card-body d-sm-flex pt-0">
              <div class="d-flex align-items-center mb-sm-0 mb-4">
                <div>
                  <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault0">
                  </div>
                </div>
                <div class="ms-2">
                  <span class="text-dark font-weight-bold d-block text-sm">Confirm</span>
                  <span class="text-xs d-block">I want to delete my account.</span>
                </div>
              </div>
              <button class="btn btn-outline-secondary mb-0 ms-auto" type="button" name="button">Deactivate</button>
              <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Delete Account</button>
            </div>
          </div>
        </div>
    </form>


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
<script src="../../../assets/js/plugins/choices.min.js"></script>
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

    let editTokenBtn = document.querySelector('.edit-token');
    let editToken = document.querySelectorAll('.edit-token-show');
    editTokenBtn.addEventListener('click', event => {
        for (var i = 0; i < editToken.length; i++) {
            editToken[i].toggleAttribute("readonly");
        }
    });

    let editLiffBtn = document.querySelector('.edit-liff');
    let editLiff = document.querySelectorAll('.edit-liff-show');
    editLiffBtn.addEventListener('click', event => {
        for (var i = 0; i < editLiff.length; i++) {
            editLiff[i].toggleAttribute("readonly");
        }
    });

</script>
<script>
  if (document.getElementById('choices-gender')) {
    var gender = document.getElementById('choices-gender');
    const example = new Choices(gender);
  }

  if (document.getElementById('choices-language')) {
    var language = document.getElementById('choices-language');
    const example = new Choices(language);
  }

  if (document.getElementById('choices-skills')) {
    var skills = document.getElementById('choices-skills');
    const example = new Choices(skills, {
      delimiter: ',',
      editItems: true,
      maxItemCount: 5,
      removeItemButton: true,
      addItems: true
    });
  }

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

  function visible() {
    var elem = document.getElementById('profileVisibility');
    if (elem) {
      if (elem.innerHTML == "Switch to visible") {
        elem.innerHTML = "Switch to invisible"
      } else {
        elem.innerHTML = "Switch to visible"
      }
    }
  }

  var openFile = function(event) {
    var input = event.target;

    // Instantiate FileReader
    var reader = new FileReader();
    reader.onload = function() {
      imageFile = reader.result;

      document.getElementById("imageChange").innerHTML = '<img width="200" src="' + imageFile + '" class="rounded-circle w-100 shadow" />';
    };
    reader.readAsDataURL(input.files[0]);
  };
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
@endsection