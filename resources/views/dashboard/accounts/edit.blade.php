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

            <div class="toast fade hide p-2 mt-2 bg-white show" role="alert" aria-live="assertive"
                id="dangerToast" aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="ni ni-notification-70 text-danger me-2"></i>
                    <span class="me-auto text-gradient text-danger font-weight-bold">エラーが発生しました</span>
                    <small class="text-body">0 mins ago</small>
                    <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast"
                        aria-label="Close"></i>
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
                                <img src="{{ asset('uploads/profile-pic/' . $account->image) }}"
                                    class="border-radius-md" alt="team-2">
                                <label
                                    class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                    <span><i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="" aria-hidden="true" data-bs-original-title="Edit Image"
                                            aria-label="Edit Image"></i></span>
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
                                        <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault"
                                            checked>
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                            for="flexSwitchCheckDefault">Email me when someone follows me</label>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox"
                                            id="flexSwitchCheckDefault1">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                            for="flexSwitchCheckDefault1">Email me when someone answers on my
                                            post</label>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox"
                                            id="flexSwitchCheckDefault2" checked>
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                            for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                                    </div>
                                </li>
                            </ul>
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 px-0">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox"
                                            id="flexSwitchCheckDefault3">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                            for="flexSwitchCheckDefault3">New launches and projects</label>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox"
                                            id="flexSwitchCheckDefault4" checked>
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                            for="flexSwitchCheckDefault4">Monthly product updates</label>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 pb-0">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox"
                                            id="flexSwitchCheckDefault5">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                            for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-8 mt-md-0 mt-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">アカウント設定</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a class="edit-token" href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="アクセストークンを編集"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body p-3">
                            <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                                <label class="text-muted">チャネルシークレット</label>
                                <input class="edit-token-show multisteps-form__input form-control mb-3" type="text" placeholder="channel_secret"
                                    value="{{ $account->channel_secret }}" name="channel_secret" readonly="readonly"/>
                                <label class="text-muted">アクセストークン</label>
                                <textarea class="edit-token-show multisteps-form__input form-control mb-3" placeholder="access_token"
                                    name="access_token" readonly="readonly">{{ $account->access_token }}</textarea>
                                <label class="text-muted">Name</label>
                                <input class="multisteps-form__input form-control mb-3" type="text"
                                    value="{{ $account->name }}" name="name" />
                                <label class="text-muted">Webhook URL</label>
                                <input class="multisteps-form__input form-control mb-3" type="text"
                                    value="https://e2ef-223-133-69-171.ngrok.io/line/{{ $account->id }}/webhook" name="" readonly="readonly"/>
                            </div>

                            <div class="row pt-4 pb-3">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">LIFF設定</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a class="edit-liff" href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Liffを編集"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                                <label class="text-muted">FULL エンドポイントURL</label>
                                <input class="multisteps-form__input form-control" type="text"
                                    value="URL for menu" name="" readonly="readonly"/>
                                <label class="text-muted">FULLのLIFF ID</label>
                                <input class="edit-liff-show multisteps-form__input form-control mb-3" type="text"
                                    value="{{ $account->liff_full }}" name="liff_full" readonly="readonly"/>
                                <hr class="horizontal dark" />

                                <label class="text-muted">TALL エンドポイントURL</label>
                                <input class="multisteps-form__input form-control" type="text"
                                    value="URL for menu" name="" readonly="readonly"/>
                                <label class="text-muted">TALLのLIFF ID</label>
                                <input class="edit-liff-show multisteps-form__input form-control mb-3" type="text"
                                    value="{{ $account->liff_tall }}" name="liff_tall" readonly="readonly"/>
                                <hr class="horizontal dark" />

                                <label class="text-muted">COMPACT エンドポイントURL</label>
                                <input class="multisteps-form__input form-control" type="text"
                                    value="URL for menu" name="" readonly="readonly"/>
                                <label class="text-muted">COMPACTのLIFF ID</label>
                                <input class="edit-liff-show multisteps-form__input form-control mb-3" type="text"
                                    value="{{ $account->liff_compact }}" name="liff_compact" readonly="readonly"/>
                            </div>

                            <hr class="horizontal gray-light my-4">

                            <div class="row">
                                <div class="button-row d-flex mt-4 col-12">
                                    <a href="{{ URL::route('accounts.index') }}"
                                        class="btn bg-gradient-light mb-0 js-btn-prev">アカウント一覧</a>
                                    <a href="javascript:;">
                                        <i class="fas fa-trash text-secondary text-sm px-3 pt-2" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="有料プランをご利用中は削除できません。"></i>
                                    </a>
                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                        title="Send">保存</button>
                                </div>
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
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
@endsection