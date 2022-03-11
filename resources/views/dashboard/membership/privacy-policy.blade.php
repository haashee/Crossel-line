<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        プライバシーポリシー
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
    {{-- <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.0') }}" rel="stylesheet" /> --}}
    <link id="pagestyle" href="../../../assets/css/argon-dashboard.css?v=2.0.0" rel="stylesheet" />  
</head>

<body class="bg-gray-100">

    <main class="main-content  mt-0">


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



        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-color: {{ $account->accountSetting->membership_background }}; background-position: top; z-index:-10;">
            {{-- <span class="mask bg-gradient-dark opacity-6"></span> --}}
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h2 class="text-white mb-8">個人情報取扱方</h2>
                        {{-- <p class="text-lead text-white">
                            Use these awesome forms to login or create new account in your project for free.
                        </p> --}}
                    </div>
                </div>
            </div>
        </div>



        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n14 justify-content-center pb-5">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0 membership-card-height">
                        <div class="mem-btn-container row px-xl-5 px-sm-4 px-4 py-3">
                            {{-- <div class="col-4 ms-auto px-1">
                                <button class="mem-tab-btn btn btn-outline-light w-100 mb-0 active"
                                    data-memtab="settings">
                                    基本情報
                                </button>
                            </div> --}}
                            <div class="col-4 col-xs-4 col-sm-4 me-auto px-1">
                                <button class="mem-tab-btn btn btn-outline-light w-100 text-xs mb-0" data-memtab="card" onclick="history.back()">
                                    戻る
                                </button>
                            </div>
                            <div class="col-8 col-xs-8 col-sm-8 px-1">
                                <button class="mem-tab-btn btn btn-outline-light w-100 mb-0 text-xs active" data-memtab="orders">
                                    個人情報取扱
                                </button>
                            </div>
                        </div>

                        <div class="mem-content card-body pt-0 active" id="orders">
                            <div class="col-md-10 mx-auto">

                                @if($account->accountSetting->privacy_policy)
                                    <div class="mt-2">
                                        <h6>{{ $account->name }}の個人情報取り扱いについて</h6>
                                        <p style="white-space: pre-line; ">{!! $account->accountSetting->privacy_policy !!}</p>
                                        <a href="{{ $account->accountSetting->privacy_url }}" class="btn bg-gradient-dark w-100 my-2">
                                            {{ $account->name }}の個人情報取扱について詳しく
                                        </a>
                                    </div>
                                @else
                                    <div class="mt-2">
                                        <h6>{{ $account->name }}の個人情報取り扱いについて</h6>
                                        <p style="white-space: pre-line; ">{{ $account->name }}の個人情報方針が登録されていません。</p>
                                    </div>
                                @endif

                                <div class="mt-3">
                                    <h6>Meniuの個人情報取り扱いについて</h6>
                                    <p>
                                        本サービスより送信された情報は、株式会社unybexが運営するウェブサービス「Meniu」に送信され、Meniuのサーバに保存されます。株式会社unybexは、本サービスを通じてお客様からご提供頂きました個人情報を個人情報保護方針にしたがい取り扱います。
                                    </p>
                                    <a href="" class="btn bg-gradient-dark w-100 my-2">Meniuの個人情報取扱について詳しく</a>
                                </div>
                            </div>
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

    <!-- LIFF -->
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <script src="../../../liff/liff-starter.js"></script>
</body>

</html>