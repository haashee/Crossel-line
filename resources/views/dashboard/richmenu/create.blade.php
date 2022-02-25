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

        <div class="row">
            <div class="col-12">
                <div class="multisteps-form">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto mt-4 mb-sm-5 mb-3">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button"
                                    title="Product Info">
                                    <span>1. Product Info</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Media">2.
                                    Media</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Socials">3.
                                    Socials</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Pricing">4.
                                    Pricing</button>
                            </div>
                        </div>
                    </div>
                    <!--form panels-->
                    <div class="row">
                        <div class="col-12 col-lg-8 m-auto">
                            <form action="{{ route('richmenu.store', ['aid' => $account->id]) }}" method="POST" enctype="multipart/form-data"
                                class="multisteps-form__form mb-3">
                                @csrf
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Product Information</h5>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="card richmenu">
                                                    <div class="rich-top">
                                                        <div class="row m-2 ms-3 g-0">
                                                            <div class="col-1"><i class="fa fa-arrow-left"></i></div>
                                                            <div class="col-9 text-center"><p>{{ $account->name }}</p></div>
                                                            <div class="col-1"><i class="fa fa-home"></i></div>
                                                            <div class="col-1"><i class="fa fa-bars"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="rich-bottom">
                                                        <div class="rich-display-small position-relative hide-rich">
                                                            <span class="text-top text-md">小さいリッチメニューを使用 <br> ボタン3つまで設定可能</span>
                                                            <div class="row g-0">
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="rich-display-big position-relative">
                                                            <span class="text-top text-md">大きいリッチメニューを使用 <br> ボタン6つまで設定可能</span>
                                                            <div class="row g-0">
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                            </div>
                                                            <div class="row g-0">
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                                <div class="col-4 rich-boxes">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="rich-label">
                                                            <p class="display-label">表示ラベル &#x25BC;</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>メニュー名</label>
                                                <input id="name" name="name" class="multisteps-form__input form-control" type="text" placeholder="管理用メニュー名" />
                                                <label class="mt-4">表示ラベル</label>
                                                <input id="label" name="label" class="multisteps-form__input form-control" type="text" placeholder="リッチメニュー表示ラベル" />
                                                <label class="mt-4">リッチメニューのサイズ</label> <br>
                                                <input type="radio" id="big" name="richmenu_size" class="multisteps-form__input" value="big">
                                                <label for="big">Big</label><br>
                                                <input type="radio" id="small" name="richmenu_size" class="multisteps-form__input" value="small">
                                                <label for="small">Small</label><br>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Media</h5>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <label>Product images</label>
                                                <div class="form-control ">
                                                    <input type="file" name="image" class="form-control "/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Socials</h5>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="card richmenu">
                                                    <div class="rich-top">
                                                        <div class="row m-2 ms-3 g-0">
                                                            <div class="col-1"><i class="fa fa-arrow-left"></i></div>
                                                            <div class="col-9 text-center"><p>{{ $account->name }}</p></div>
                                                            <div class="col-1"><i class="fa fa-home"></i></div>
                                                            <div class="col-1"><i class="fa fa-bars"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="rich-bottom">
                                                        <div class="rich-display-small position-relative hide-rich">
                                                            {{-- <span class="text-top text-md">小さいリッチメニューを使用 <br> ボタン3つまで設定可能</span> --}}
                                                            <div class="row g-0">
                                                                <div class="col-4 rich-boxes">A
                                                                </div>
                                                                <div class="col-4 rich-boxes">B
                                                                </div>
                                                                <div class="col-4 rich-boxes">C
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="rich-display-big position-relative">
                                                            {{-- <span class="text-top text-md">大きいリッチメニューを使用 <br> ボタン6つまで設定可能</span> --}}
                                                            <div class="row g-0">
                                                                <div class="col-4 rich-boxes">A
                                                                </div>
                                                                <div class="col-4 rich-boxes">B
                                                                </div>
                                                                <div class="col-4 rich-boxes">C
                                                                </div>
                                                            </div>
                                                            <div class="row g-0">
                                                                <div class="col-4 rich-boxes">D
                                                                </div>
                                                                <div class="col-4 rich-boxes">E
                                                                </div>
                                                                <div class="col-4 rich-boxes">F
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="rich-label">
                                                            <p class="display-label">表示ラベル &#x25BC;</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label class="multisteps-form__input form-label" for="buttons">「 A 」ボタンの設定</label>
                                                <select class="form-control" name="buttonsA" id="buttons" onchange="showDiv('hidden_div', this)">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                </select>
                                                <div id="hidden_div">
                                                    <label class="text-secondary">リンクのURL</label>
                                                    <input id="url" name="urlA" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                                </div>

                                                <label class="multisteps-form__input form-label mt-4" for="buttons">「 B 」ボタンの設定</label>
                                                <select class="form-control" name="buttonsB" id="buttons">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                </select>
                                                <label class="multisteps-form__input form-label mt-4" for="buttons">「 C 」ボタンの設定</label>
                                                <select class="form-control" name="buttonsC" id="buttons">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                </select>
                                                <label class="multisteps-form__input form-label mt-4" for="buttons">「 D 」ボタンの設定</label>
                                                <select class="form-control" name="buttonsD" id="buttons">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                </select>
                                                <label class="multisteps-form__input form-label mt-4" for="buttons">「 E 」ボタンの設定</label>
                                                <select class="form-control" name="buttonsE" id="buttons">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                </select>
                                                <label class="multisteps-form__input form-label mt-4" for="buttons">「 F 」ボタンの設定</label>
                                                <select class="form-control" name="buttonsF" id="buttons">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4 col-12">
                                                <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button"
                                                    title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Pricing</h5>
                                    <div class="multisteps-form__content mt-3">
                                        <div class="row">
                                            <div class="col-3">
                                                <label>Price</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    placeholder="99.00" />
                                            </div>
                                            <div class="col-4">
                                                <label>Currency</label>
                                                <select class="form-control" name="choices-sizes" id="choices-currency">
                                                    <option value="Choice 1" selected="">USD</option>
                                                    <option value="Choice 2">EUR</option>
                                                    <option value="Choice 3">GBP</option>
                                                    <option value="Choice 4">CNY</option>
                                                    <option value="Choice 5">INR</option>
                                                    <option value="Choice 6">BTC</option>
                                                </select>
                                            </div>
                                            <div class="col-5">
                                                <label>SKU</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    placeholder="71283476591" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="mt-4 form-label">Tags</label>
                                                <select class="form-control" name="choices-tags" id="choices-tags"
                                                    multiple>
                                                    <option value="Choice 1" selected>In Stock</option>
                                                    <option value="Choice 2">Out of Stock</option>
                                                    <option value="Choice 3">Sale</option>
                                                    <option value="Choice 4">Black Friday</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                title="Send">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection



@section('scripts')
<script src="../../../assets/js/core/popper.min.js"></script>
<script src="../../../assets/js/core/bootstrap.min.js"></script>
<script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../../../assets/js/plugins/choices.min.js"></script>
<script src="../../../assets/js/plugins/dropzone.min.js"></script>
<script src="../../../assets/js/plugins/quill.min.js"></script>
<script src="../../../assets/js/plugins/multistep-form.js"></script>
<script>

        if (document.getElementById('choices-currency')) {
        var element = document.getElementById('choices-currency');
        const example = new Choices(element, {
            searchEnabled: false
        });
        };

        if (document.getElementById('choices-tags')) {
        var tags = document.getElementById('choices-tags');
        const examples = new Choices(tags, {
            removeItemButton: true
        });

        examples.setChoices(
            [{
                value: 'One',
                label: 'Expired',
                disabled: true
            },
            {
                value: 'Two',
                label: 'Out of Stock',
                selected: true
            }
            ],
            'value',
            'label',
            false,
        );
        }



        var bigBtn = document.getElementById("big");
        var smallBtn = document.getElementById("small");
        var bigs = document.querySelectorAll(".rich-display-big");
        var smalls = document.querySelectorAll(".rich-display-small");

        bigBtn.addEventListener("click", function() {
            smalls.forEach((small) => {
                small.classList.add("hide-rich");
            });
            bigs.forEach((big) => {
                big.classList.remove("hide-rich");
            });
        });
        smallBtn.addEventListener("click", function() {
            smalls.forEach((small) => {
                small.classList.remove("hide-rich");
            });
            bigs.forEach((big) => {
                big.classList.add("hide-rich");
            });
        });



        
        document.getElementById('label').addEventListener('keyup', copyToDiv);
        
        var inputDisplay = document.querySelectorAll(".display-label");

        function copyToDiv() {
            inputDisplay.forEach((display)=>{
                display.innerHTML = document.getElementById("label").value + ' &#x25BC;';
            })
        }

        
        function showDiv(divId, element)
        {
            document.getElementById(divId).style.display = element.value == 'リンク' ? 'block' : 'none';
        }
</script>
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