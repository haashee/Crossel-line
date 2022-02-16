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

    <form action="/accounts/{{ $account->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row mt-3">
        <div class="col-12 col-md-6 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Platform Settings</h6>
            </div>
            <div class="col-12 col-sm-4 p-3 ">
              <div class="avatar avatar-xl position-relative">
                <img src="{{ asset('uploads/profile-pic/' . $account->image) }}" class="border-radius-md" alt="team-2">
                <label class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                  <span><i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                      aria-hidden="true" data-bs-original-title="Edit Image" aria-label="Edit Image"></i></span>
                  <span class="sr-only">Edit Image</span>
                  <input name="image" type="file" style="display: none">
                </label>
              </div>
            </div>
            <div class="card-body p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                      for="flexSwitchCheckDefault">Email me when someone follows me</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault1">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                      for="flexSwitchCheckDefault1">Email me when someone answers on my
                      post</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault2" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                      for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                  </div>
                </li>
              </ul>
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault3">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                      for="flexSwitchCheckDefault3">New launches and projects</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault4" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                      for="flexSwitchCheckDefault4">Monthly product updates</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0 pb-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault5">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                      for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-8 mt-md-0 mt-4">
          <!-- Card Profile -->
          <div class="card card-body" id="profile">
            <div class="row justify-content-center align-items-center">
              <div class="col-sm-auto col-4">
                <div class="avatar avatar-xl position-relative">
                  <img src="../../../assets/img/team-3.jpg" alt="bruce" class="w-100 border-radius-lg shadow-sm">
                </div>
              </div>
              <div class="col-sm-auto col-8 my-auto">
                <div class="h-100">
                  <h5 class="mb-1 font-weight-bolder">
                    Mark Johnson
                  </h5>
                  <p class="mb-0 font-weight-bold text-sm">
                    CEO / Co-Founder
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
              <h5>Basic Info</h5>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-6">
                  <label class="form-label">First Name</label>
                  <div class="input-group">
                    <input id="firstName" name="firstName" class="form-control" type="text" placeholder="Alec"
                      required="required">
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label">Last Name</label>
                  <div class="input-group">
                    <input id="lastName" name="lastName" class="form-control" type="text" placeholder="Thompson"
                      required="required">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 col-6">
                  <label class="form-label mt-4">I'm</label>
                  <select class="form-control" name="choices-gender" id="choices-gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
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
                  <label class="form-label mt-4">Email</label>
                  <div class="input-group">
                    <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com">
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label mt-4">Confirmation Email</label>
                  <div class="input-group">
                    <input id="confirmation" name="confirmation" class="form-control" type="email"
                      placeholder="example@email.com">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label mt-4">Your location</label>
                  <div class="input-group">
                    <input id="location" name="location" class="form-control" type="text" placeholder="Sydney, A">
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label mt-4">Phone Number</label>
                  <div class="input-group">
                    <input id="phone" name="phone" class="form-control" type="number" placeholder="+40 735 631 620">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 align-self-center">
                  <label class="form-label mt-4">Language</label>
                  <select class="form-control" name="choices-language" id="choices-language">
                    <option value="English">English</option>
                    <option value="French">French</option>
                    <option value="Spanish">Spanish</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label mt-4">Skills</label>
                  <input class="form-control" id="choices-skills" type="text" value="vuejs, angular, react"
                    placeholder="Enter something" />
                </div>
              </div>
            </div>
          </div>
        </div>
    </form>


    <!--admin buttons message-->
    @if (@isset(Auth::user()->id) && (Auth::user()->name== 'admin'))
    <div class="row mt-3">
      <div class="col-12 col-md-6 col-xl-12 mt-md-0 mt-4">
        <div class="card h-100">
          <div class="p-3">
            <div class="row">
              <div class="col-md-12 d-flex align-items-center">
                <form action="/accounts/{{ $account->id }}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="btn bg-gradient-dark mb-0 js-btn-prev" type="submit" title="Delete"
                    onclick="return confirm('Are you sure you want to delete?');">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endisset


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