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

        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">すぐ使えるリッチメニュー</h6>
                        <p class="text-sm">スタンダードテンプレート一覧</p>
                    </div>
                    <div class="card-body p-3">
                        <div class="row target-area">
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ asset('images/rich-img-01.jpeg') }}" alt="img-blur-shadow"
                                                class="img-fluid shadow border-radius-xl">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
                                        <a href="javascript:;">
                                            <h5>
                                                Bubbles
                                            </h5>
                                        </a>
                                        {{-- <p class="mb-4 text-sm">
                                            As Bubble works through a huge amount of internal management turmoil.
                                        </p> --}}
                                        <div class="d-flex align-items-center justify-content-between">
                                            <form 
                                                action="/line/{{ $account->id }}/richmenu/create" 
                                                method="GET" enctype="multipart/form-data">
                                                @csrf
                                                <button value="rich01" name="richmenu-btn" type="submit" class="btn btn-outline-primary btn-sm mb-0">
                                                    リッチメニューを使う
                                                    <span id="show-spinner" class="spinner-border spinner-border-sm hide-content" role="status" aria-hidden="true"></span>
                                                    <span class="sr-only">Loading...</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ asset('images/rich-img-02.jpeg') }}" alt="img-blur-shadow"
                                                class="img-fluid shadow border-radius-lg">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                                        <a href="javascript:;">
                                            <h5>
                                                Scandinavian
                                            </h5>
                                        </a>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <form 
                                                action="/line/{{ $account->id }}/richmenu/create" 
                                                method="GET" enctype="multipart/form-data">
                                                @csrf
                                                
                                                <button value="rich02" name="richmenu-btn" type="submit" class="btn btn-outline-primary btn-sm mb-0">
                                                    リッチメニューを使う
                                                    <span id="show-spinner" class="spinner-border spinner-border-sm hide-content" role="status" aria-hidden="true"></span>
                                                    <span class="sr-only">Loading...</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ asset('images/rich-img-03.jpeg') }}" alt="img-blur-shadow"
                                                class="img-fluid shadow border-radius-xl">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                                        <a href="javascript:;">
                                            <h5>
                                                Minimalist
                                            </h5>
                                        </a>
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <form 
                                                action="/line/{{ $account->id }}/richmenu/create" 
                                                method="GET" enctype="multipart/form-data">
                                                @csrf
                                                
                                                <button value="rich03" name="richmenu-btn" type="submit" class="btn btn-outline-primary btn-sm mb-0">
                                                    リッチメニューを使う
                                                    <span id="show-spinner" class="spinner-border spinner-border-sm hide-content" role="status" aria-hidden="true"></span>
                                                    <span class="sr-only">Loading...</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">カスタムリッチメニュー</h6>
                        <p class="text-sm">カスタムテンプレート一覧</p>
                    </div>
                    <div class="card-body p-3">
                        <div class="row target-area">
                            @foreach ($richmenus as $richmenu)
                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                    <div class="card card-blog card-plain">
                                        <div class="position-relative">
                                            <a class="d-block shadow-xl border-radius-xl">
                                                <img src="{{ asset('uploads/richmenu/' . $richmenu->image) }}" alt="img-blur-shadow"
                                                    class="img-fluid shadow border-radius-xl">
                                            </a>
                                        </div>
                                        <div class="card-body px-1 pb-0">
                                            <p class="text-gradient text-dark mb-2 text-xs">
                                                @if ($richmenu->height == 1686)
                                                    大きいリッチメニュー (ボタン6つ) <br> 
                                                    画像サイズ 2500 x 1686
                                                @else
                                                    小さいリッチメニュー (ボタン3つ) <br> 
                                                    画像サイズ 2500 x 843
                                                @endif
                                            </p>
                                            <a href="{{ route('richmenu.edit', ['aid' => $account->id, 'richmenu' =>$richmenu->id]) }}">
                                                <h5>
                                                    {{ $richmenu->name }}
                                                </h5>
                                            </a>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <form 
                                                    action="/line/{{ $account->id }}/richmenu/create" 
                                                    method="GET" enctype="multipart/form-data">
                                                    @csrf
                                                    <button value="rich01" name="richmenu-btn" type="submit" class="btn btn-outline-primary btn-sm mb-0">
                                                        リッチメニューを使う
                                                        <span id="show-spinner" class="spinner-border spinner-border-sm hide-content" role="status" aria-hidden="true"></span>
                                                        <span class="sr-only">Loading...</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                        <a href="{{ URL::route('richmenu.create', ['aid' => $account->id]) }}">
                                            <i class="fa fa-plus text-secondary mb-3"></i>
                                            <h5 class=" text-secondary"> 新規作成 </h5>
                                        </a>
                                    </div>
                                </div>
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

    const targetArea = document.querySelector('.target-area');
    const richSpinner = document.querySelectorAll('.spinner-border');
    targetArea.addEventListener("click", function(e){
        const targetName = e.target.name;
        if(targetName == 'richmenu-btn'){
            richSpinner.forEach(function(btn) {
                btn.classList.add('hide-content');
                e.target.children[0].classList.remove('hide-content');
            });
        }

    })

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
@endsection