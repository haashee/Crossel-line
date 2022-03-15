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
                                <span class="text-sm">送信済み一斉メッセージ</span>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info" onclick="history.back()">
                                <i class="ni ni-bold-left me-2 text-dark opacity-6"></i>
                                <span class="text-sm">前に戻る</span>
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
                                    <h5 class="mb-0">一斉送信済み</h5>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-2 pb-3">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">送信済み一覧</h6>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                            <div class=" h-100">
                                <div class="card-body p-3 py-0">
                                <ul class="list-group mx-4">
                                    @forelse ($chats as $chat)
                                        <li class="list-group-item border-0 d-flex ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-2 text-dark font-weight-bold text-sm">
                                                {{ date('Y/m/d, H:i', strtotime($chat->created_at)) }} 
                                                {{-- <a class="btn btn-link text-dark text-muted text-xxs mb-1 px-0 ms-1" data-bs-toggle="tooltip" data-bs-original-title="編集する"
                                                    href="{{ route('template.edit', ['aid' => $account->id, 'template' => $chat->id]) }}">
                                                    <i class="fas fa-edit text-xs me-1"></i>
                                                </a> --}}
                                            </h6>
                                            <div class="text-xs ms-5 mb-2">
                                                @forelse ($chat->tags as $tag)
                                                    {{ $tag->name }}<span class="tag-dot ms-1 me-3" style="background-color:{{ $tag->color }};"></span>
                                                    {{-- <span class=" me-3">hello</span> --}}
                                                @empty
                                                    タグなし<span class="text-dark text-xs"></span>
                                                @endforelse
                                            </div>
                                            <p class="text-sm ms-5">{{ $chat->message }}</p>
                                            @if ($chat->image)
                                                <div class="col-xl-3 col-md-6 mb-xl-0 ms-4">
                                                    <div class="card card-blog card-plain">
                                                        <div class="position-relative">
                                                            <a class="d-block border-radius-xl">
                                                                <img src="{{ asset('storage/' . $chat->image) }}" alt="img-blur-shadow"
                                                                    class="img-fluid shadow border-radius-xl">
                                                            </a>
                                                        </div>
                                                        <p class="text-muted text-xs ps-2 pt-2">{{ $chat->image_url }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        </li>
                                        <hr>
                                    @empty
                                        <p>送信されたメッセージがありません。</p>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="button-row d-flex mt-4 col-12">
                                        <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">保存</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}




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