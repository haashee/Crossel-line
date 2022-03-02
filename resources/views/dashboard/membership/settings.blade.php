@extends('layouts.profile')



@section('title')
Account
@endsection



@section('content')
<div class="main-content position-relative max-height-vh-100 h-100">

    <!-- Navbar -->
    @include('includes.navbar-profile')
    <!-- End Navbar -->


    <!-- Account profile -->
    @include('includes.account-profile')
    <!-- End Account profile -->


    <div class="container-fluid py-4">

        <!--error message-->
        @if ($errors->any())
        <div class="position-fixed bottom-1 end-1 z-index-2">

            <div class="toast fade hide p-2 mt-2 bg-white show" role="alert" aria-live="assertive" id="dangerToast"
                aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="ni ni-notification-70 text-danger me-2"></i>
                    <span class="me-auto text-gradient text-danger font-weight-bold">エラーが発生しました</span>
                    {{-- <small class="text-body">0 mins ago</small> --}}
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



        <div class="row mt-3">
            <div class="col-lg-3">
                <div class="card position-sticky top-1">
                    <ul class="nav flex-column bg-white border-radius-lg p-3">
                        <li class="nav-item">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#profile">
                                <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                                <span class="text-sm">会員登録の設定</span>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info"
                                onclick="history.back()">
                                <i class="ni ni-bold-left me-2 text-dark opacity-6"></i>
                                <span class="text-sm">前に戻る</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item pt-2">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info">
                                <i class="ni ni-books me-2 text-dark opacity-6"></i>
                                <span class="text-sm">Basic Info</span>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll=""
                                href="#notifications">
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
                        </li> --}}
                    </ul>
                </div>
            </div>

            <div class="col-lg-9 mt-lg-0 mt-4">
                <!-- Tags Setting -->
                <div class="card card-body p-4" id="profile">
                    <div class="card-header p-0 pb-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h5 class="mb-0">会員登録の設定</h5>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                        <div class=" h-100">
                            <div class="card-body p-3 py-0">
                                <form action="{{  route('membership.update.privacy', ['aid' => $account->id])  }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row pt-4 pb-3">
                                        <div class="col-md-8 d-flex align-items-center px-0">
                                            <h6 class="mb-0">個人情報取扱についてページ</h6>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <a class="edit-member" href="javascript:;">
                                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="プライバシーポリシーを編集"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-12 px-0">
                                            <label class="form-label">プライバシーページURL</label>
                                            <div class="input-group">
                                                <input id="" name="privacy-url" class="form-control edit-member-show"
                                                    type="text" placeholder="http://www.meniu.io/privacy"
                                                    value="{{ $account->accountSetting->privacy_url }}"
                                                    readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-12 px-0">
                                            <label class="form-label mt-4">プライバシーポリシー本文</label>
                                            <textarea class="form-control edit-member-show" name="privacy-policy" id=""
                                                cols="30" rows="10"
                                                readonly="readonly">{{ $account->accountSetting->privacy_policy }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row pt-4 pb-3">
                                        <div class="col-md-8 d-flex align-items-center px-0">
                                            <h6 class="mb-0">会員画面のカスタマイズ</h6>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 px-0">
                                            <label class="form-label">背景の色</label>
                                            <div class="input-group">
                                                <input class="form-control" type="color" id="colorpicker" name="color"
                                                    value="{{ $account->accountSetting->membership_background }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="button-row d-flex mt-4 col-12">
                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                title="Send">保存</button>
                                        </div>
                                    </div>
                                </form>
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


    let editMemBtn = document.querySelector('.edit-member');
    let editMem = document.querySelectorAll('.edit-member-show');
    editMemBtn.addEventListener('click', event => {
        for (var i = 0; i < editMem.length; i++) {
            editMem[i].toggleAttribute("readonly");
        }
    });

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
@endsection