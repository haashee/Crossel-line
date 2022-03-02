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



        {{-- <div class="row mt-3">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Platform Settings</h6>
                    </div>
                    <div class="col-12 col-sm-4 p-3 ">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('uploads/profile-pic/' . $account->image) }}" class="border-radius-md"
                                alt="team-2">
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
                                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault1">
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                        for="flexSwitchCheckDefault1">Email me when someone answers on my
                                        post</label>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault2"
                                        checked>
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
                                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault4"
                                        checked>
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
            <div class="col-12 col-md-6 col-xl-9 mt-md-0 mt-4">
                <!-- Account Basic Info -->
                <div class="card h-100" id="profile">
                    <form action="/accounts/{{ $account->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                <input class="edit-token-show multisteps-form__input form-control mb-3" type="text"
                                    placeholder="channel_secret" value="{{ $account->channel_secret }}"
                                    name="channel_secret" readonly="readonly" />
                                <label class="text-muted">アクセストークン</label>
                                <textarea class="edit-token-show multisteps-form__input form-control mb-3"
                                    placeholder="access_token" name="access_token"
                                    readonly="readonly">{{ $account->access_token }}</textarea>
                                <label class="text-muted">Name</label>
                                <input class="multisteps-form__input form-control mb-3" type="text"
                                    value="{{ $account->name }}" name="name" />
                                <label class="text-muted">Webhook URL</label>
                                <input class="multisteps-form__input form-control mb-3" type="text"
                                    value="https://6ee2-223-133-69-171.ngrok.io/line/{{ $account->id }}/webhook" name=""
                                    readonly="readonly" />
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
                                <input class="multisteps-form__input form-control" type="text" value="URL for menu"
                                    name="" readonly="readonly" />
                                <label class="text-muted">FULLのLIFF ID</label>
                                <input class="edit-liff-show multisteps-form__input form-control mb-3" type="text"
                                    value="{{ $account->liff_full }}" name="liff_full" readonly="readonly" />
                                <hr class="horizontal dark" />

                                <label class="text-muted">TALL エンドポイントURL</label>
                                <input class="multisteps-form__input form-control" type="text" value="URL for menu"
                                    name="" readonly="readonly" />
                                <label class="text-muted">TALLのLIFF ID</label>
                                <input class="edit-liff-show multisteps-form__input form-control mb-3" type="text"
                                    value="{{ $account->liff_tall }}" name="liff_tall" readonly="readonly" />
                                <hr class="horizontal dark" />

                                <label class="text-muted">COMPACT エンドポイントURL</label>
                                <input class="multisteps-form__input form-control" type="text" value="URL for menu"
                                    name="" readonly="readonly" />
                                <label class="text-muted">COMPACTのLIFF ID</label>
                                <input class="edit-liff-show multisteps-form__input form-control mb-3" type="text"
                                    value="{{ $account->liff_compact }}" name="liff_compact" readonly="readonly" />
                            </div>

                            <hr class="horizontal gray-light my-4">

                            <div class="row">
                                <div class="button-row d-flex mt-4 col-12">
                                    <a href="{{ URL::route('accounts.index') }}"
                                        class="btn bg-gradient-light mb-0 js-btn-prev">アカウント一覧</a>
                                    <a href="javascript:;">
                                        <i class="fas fa-trash text-secondary text-sm px-3 pt-2"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="有料プランをご利用中は削除できません。"></i>
                                    </a>
                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                        title="Send">保存</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div> --}}



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
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9 mt-lg-0 mt-4">

                <!-- Tags Setting -->
                <div class="card card-body p-4" id="profile">
                        <div class="card-header p-0 pb-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h5 class="mb-0">タグの管理</h5>
                                </div>

                            </div>
                        </div>

                        <div class="row pt-2 pb-3">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">タグ一覧</h6>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                            <div class=" h-100">
                                <div class="card-body p-3 py-0">
                                <ul class="list-group mx-4">
                                    @forelse ($tags as $tag)
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $tag->name }}</h6>
                                            @if ($tag->isPublic == true)
                                                <span class="text-xs">公開タグ</span>
                                            @else
                                                <span class="text-xs">非公開タグ</span>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center text-sm">
                                            <p class="text-xs mx-1 mt-3">タグの色</p>
                                            <span class="tag-dot me-4" style="background-color:{{ $tag->color }};"></span>
                                            <a class="btn btn-link text-dark text-muted text-xs mb-0 px-0 mx-1" href="{{ route('tag.setting', ['aid' => $account->id, 'id' => $tag->id]) }}">
                                                <i class="fas fa-edit text-sm me-1"></i>
                                            </a>
                                            {{-- <form class="ms-auto" action="{{ route('tag.destroy', ['aid' => $account->id, 'tag' => $tag->id]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-link text-dark text-muted text-xs mb-0 px-0" type="submit" name="button">
                                                    <i class="fas fa-trash text-sm me-1"></i>
                                                </button>
                                            </form> --}}
                                        </div>
                                        </li>
                                    @empty
                                        <p>タグが登録されてません。新規タグをご登録ください。</p>
                                    @endforelse

                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                            <form action="{{ route('tag.store', ['aid' => $account->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 d-flex align-items-center py-3">
                                    <h6 class="mb-0">新規タグの作成</h6>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <label class="">タグの名前<span class="text-third">(必須)</span></label>
                                        <div class="input-group">
                                        <input class="edit-token-show multisteps-form__input form-control" type="text"
                                            placeholder="タグの名前" value=""
                                            name="name" />                                    
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">タグの色<span class="text-third">(必須)</span></label>
                                        <div class="input-group">
                                            <input class="form-control" type="color" id="colorpicker" name="color" value="">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">友達に公開<span class="text-third">(必須)</span></label>
                                        <div class="input-group form-check form-switch my-auto">
                                        <input name="isPublic" class="form-check-input" type="checkbox" 
                                            id="flexSwitchCheckDefault2" >
                                            {{-- {{ $tag->isPublic == true ? 'checked' :''}} --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="button-row d-flex mt-4 col-12">
                                        <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">保存</button>
                                    </div>
                                </div>
                            </form>
                        </div>




                </div>
                <!-- Card Basic Info -->
                <div class="card mt-4" id="basic-info">
                    <form action="{{  route('membership.update.privacy', ['aid' => $account->id])  }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header pb-2">
                            <h5>会員登録の設定</h5>
                        </div>

                        <div class="row pt-0 pb-3 px-4">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">個人情報取扱についてページ</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <a class="edit-member" href="javascript:;">
                                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="プライバシーポリシーを編集"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <label class="form-label">プライバシーページURL</label>
                                    <div class="input-group">
                                        <input id="" name="privacy-url" class="form-control edit-member-show" type="text"
                                            placeholder="http://www.meniu.io/privacy" 
                                            value=""
                                            readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <label class="form-label mt-4">プライバシーポリシー本文</label>
                                    <textarea class="form-control edit-member-show" name="privacy-policy" id="" cols="30" rows="10" readonly="readonly"></textarea>
                                </div>
                            </div>

                            <div class="row pt-4 pb-3">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">会員画面のカスタマイズ</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">背景の色</label>
                                    <div class="input-group">
                                        <input class="form-control" type="color" id="colorpicker" name="color" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="button-row d-flex mt-4 col-12">
                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                        title="Send">保存</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Card Notifications -->
                <div class="card mt-4" id="notifications">
                    <div class="card-header">
                        <h5>Notifications</h5>
                        <p class="text-sm">Choose how you receive notifications. These notification settings apply
                            to the things
                            you’re watching.</p>
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
                                                <span class="text-xs font-weight-normal">Notify when another user
                                                    mentions you in a
                                                    comment</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" checked type="checkbox"
                                                    id="flexSwitchCheckDefault11">
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault12">
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault13">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-1" colspan="4">
                                            <div class="my-auto">
                                                <span class="text-dark d-block text-sm">Comments</span>
                                                <span class="text-xs font-weight-normal">Notify when another user
                                                    comments your item.</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" checked type="checkbox"
                                                    id="flexSwitchCheckDefault14">
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" checked type="checkbox"
                                                    id="flexSwitchCheckDefault15">
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault16">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-1" colspan="4">
                                            <div class="my-auto">
                                                <span class="text-dark d-block text-sm">Follows</span>
                                                <span class="text-xs font-weight-normal">Notify when another user
                                                    follows you.</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault17">
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" checked type="checkbox"
                                                    id="flexSwitchCheckDefault18">
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault19">
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
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" checked type="checkbox"
                                                    id="flexSwitchCheckDefault20">
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" checked type="checkbox"
                                                    id="flexSwitchCheckDefault21">
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                <input class="form-check-input" checked type="checkbox"
                                                    id="flexSwitchCheckDefault22">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="button-row d-flex mt-4 col-12">
                                <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">保存</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Sessions -->
                <div class="card mt-4" id="sessions">
                    <div class="card-header pb-3">
                        <h5>Sessions</h5>
                        <p class="text-sm">This is a list of devices that have logged into your account. Remove those
                            that you do
                            not recognize.</p>
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
                        <p class="text-sm mb-0">削除されたアカウントは復元できませんのでご注意ください。
                        </p>
                    </div>
                    <div class="card-body d-sm-flex pt-4">
                        <div class="d-flex align-items-center mb-sm-0 mb-4">
                            <div class="ms-2">
                                {{-- <span class="text-dark font-weight-bold d-block text-sm">アカウントの削除はできません</span>
                                <span class="text-xs d-block">有料プランをご利用中はアカウントの削除ができません。</span> --}}
                                <span class="text-dark font-weight-bold d-block text-sm">削除を確定</span>
                                <span class="text-xs d-block">削除を確定するには「確定」ボタンを押してから削除してください。</span>
                            </div>
                        </div>

                        <form class="ms-auto" action="/accounts/{{ $account->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="confirm-delete btn btn-outline-secondary mb-0 ms-auto" type="button"
                                name="button">確定</button>
                            <button class="confirm-delete-btn btn bg-gradient-danger mb-0 ms-2" type="submit"
                                name="button" disabled>
                                削除
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!--admin buttons message-->
        {{-- @if (@isset(Auth::user()->id) && (Auth::user()->name== 'admin'))
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
        @endisset --}}



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


    let editDeleteBtn = document.querySelector('.confirm-delete');
    let editDelete = document.querySelector('.confirm-delete-btn');
    editDeleteBtn.addEventListener('click', event => {
        editDelete.toggleAttribute("disabled");
    });


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