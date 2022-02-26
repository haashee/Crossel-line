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
                            <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#save">
                                <i class="ni ni-watch-time me-2 text-dark opacity-6"></i>
                                <span class="text-sm">Save</span>
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
                <form action=""
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Card Profile -->
                    <div class="card card-body" id="profile">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-auto col-4">
                                <div class="avatar avatar-sm position-relative">
                                    <img src="{{ asset('uploads/richmenu/' . $richmenu->image) }}" alt="リッチメニュー画像"
                                        class="w-100 border-radius-lg shadow-sm">
                                </div>
                            </div>
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1 font-weight-bolder">
                                        {{ $richmenu->name }}
                                    </h5>
                                    <a href="{{ URL::route('richmenu.index', ['aid' => $account->id]) }}">
                                        <p class="mb-0 font-weight-bold text-sm text-third">
                                            リッチメニュー一覧へ戻る
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
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
                                    <label>メニュー名 <span class="text-third">(必須)</span></label>
                                    <input id="name" name="name" class="multisteps-form__input form-control" type="text" placeholder="管理用メニュー名" value="{{ $richmenu->name }}"/>
                                    <label class="mt-4">表示ラベル <span class="text-third">(必須)</span></label>
                                    <input id="label" name="label" class="multisteps-form__input form-control" type="text" placeholder="リッチメニュー表示ラベル"  value="{{ $richmenu->display_text }}"/>
                                    <label class="mt-4">リッチメニューのサイズ <span class="text-third">(必須)</span></label> <br>
                                    <input type="radio" id="big" name="richmenu_size" class="multisteps-form__input" value="big" {{$richmenu->height == '1686' ? 'checked' : ''}}>
                                    <label for="big">Big</label><br>
                                    <input type="radio" id="small" name="richmenu_size" class="multisteps-form__input" value="small" {{$richmenu->height == '843' ? 'checked' : ''}}>
                                    <label for="small">Small</label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Image -->
                    <div class="card mt-4" id="notifications">
                        <div class="card-header">
                            <h5>リッチメニュー画像</h5>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-auto col-4 px-12">
                                <img src="{{ asset('uploads/richmenu/' . $richmenu->image) }}" alt="リッチメニュー画像"
                                        class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label>画像を変更する場合のみアップロードしてください</label>
                                    <p class="rich-imagetext-big text-secondary text-xs">ピクセルサイズが[横]2500px x [縦]1686pxのJPEGまたはPNG画像ファイルをアップロードしてください。(サイズ上限1MB)</p>
                                    <p class="rich-imagetext-small text-secondary text-xs hide-rich">ピクセルサイズが[横]2500px x [縦]843pxのJPEGまたはPNG画像ファイルをアップロードしてください。(サイズ上限1MB)</p>
                                    <div class="form-control ">
                                        <input id="image" type="file" name="image" class="form-control hide-content"/>
                                        <label for="image" class="mb-0" >画像を変えるにはクリック (現在選択されている画像ファイル: {{ $richmenu->image }}) </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Buttons -->
                    <div class="card mt-4" id="sessions">
                        <div class="card-header pb-3">
                            <h5>ボタンの設定</h5>
                            <p class="text-sm">set the buttons</p>
                        </div>
                        <div class="card-body pt-0">
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
                                    <select class="form-control" name="buttonsA" id="buttonsA" onchange="showDiv('hidden_divA', this)">
                                        <option value="" {{$richmenu->text_a == null ? 'selected' : ''}}>-</option>
                                        <option value="メニューをみる" {{$richmenu->text_a == 'メニューをみる' ? 'selected' : ''}}>メニューをみる</option>
                                        <option value="注文履歴" {{$richmenu->text_a == '注文履歴' ? 'selected' : ''}}>注文履歴</option>
                                        <option value="会員情報" {{$richmenu->text_a == '会員情報' ? 'selected' : ''}}>会員情報</option>
                                        <option value="店舗情報" {{$richmenu->text_a == '店舗情報' ? 'selected' : ''}}>店舗情報</option>
                                        <option value="友達に紹介" {{$richmenu->text_a == '友達に紹介' ? 'selected' : ''}}>友達に紹介</option>
                                        <option value="リンク" {{$richmenu->text_a == 'リンク' ? 'selected' : ''}}>リンク</option>
                                    </select>
                                    <div id="hidden_divA">
                                        <label class="text-secondary">リンクのURL</label>
                                        <input id="urlA" name="urlA" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                    </div>

                                    <label class="multisteps-form__input form-label mt-4" for="buttons">「 B 」ボタンの設定</label>
                                    <select class="form-control" name="buttonsB" id="buttonsB" onchange="showDiv('hidden_divB', this)">
                                        <option value="" {{$richmenu->text_b == null ? 'selected' : ''}}>-</option>
                                        <option value="メニューをみる" {{$richmenu->text_b == 'メニューをみる' ? 'selected' : ''}}>メニューをみる</option>
                                        <option value="注文履歴" {{$richmenu->text_b == '注文履歴' ? 'selected' : ''}}>注文履歴</option>
                                        <option value="会員情報" {{$richmenu->text_b == '会員情報' ? 'selected' : ''}}>会員情報</option>
                                        <option value="店舗情報" {{$richmenu->text_b == '店舗情報' ? 'selected' : ''}}>店舗情報</option>
                                        <option value="友達に紹介" {{$richmenu->text_b == '友達に紹介' ? 'selected' : ''}}>友達に紹介</option>
                                        <option value="リンク" {{$richmenu->text_b == 'リンク' ? 'selected' : ''}}>リンク</option>
                                    </select>
                                    <div id="hidden_divB">
                                        <label class="text-secondary">リンクのURL</label>
                                        <input id="urlB" name="urlB" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                    </div>

                                    <label class="multisteps-form__input form-label mt-4" for="buttons">「 C 」ボタンの設定</label>
                                    <select class="form-control" name="buttonsC" id="buttonsC" onchange="showDiv('hidden_divC', this)">
                                        <option value="" {{$richmenu->text_c == null ? 'selected' : ''}}>-</option>
                                        <option value="メニューをみる" {{$richmenu->text_c == 'メニューをみる' ? 'selected' : ''}}>メニューをみる</option>
                                        <option value="注文履歴" {{$richmenu->text_c == '注文履歴' ? 'selected' : ''}}>注文履歴</option>
                                        <option value="会員情報" {{$richmenu->text_c == '会員情報' ? 'selected' : ''}}>会員情報</option>
                                        <option value="店舗情報" {{$richmenu->text_c == '店舗情報' ? 'selected' : ''}}>店舗情報</option>
                                        <option value="友達に紹介" {{$richmenu->text_c == '友達に紹介' ? 'selected' : ''}}>友達に紹介</option>
                                        <option value="リンク" {{$richmenu->text_c == 'リンク' ? 'selected' : ''}}>リンク</option>
                                    </select>
                                    <div id="hidden_divC">
                                        <label class="text-secondary">リンクのURL</label>
                                        <input id="urlC" name="urlC" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                    </div>

                                    <label class="multisteps-form__input form-label mt-4 forbig-richmenu" for="buttons">「 D 」ボタンの設定</label>
                                    <select class="form-control forbig-richmenu" name="buttonsD" id="buttonsD" onchange="showDiv('hidden_divD', this)">
                                        <option value="" {{$richmenu->text_d == null ? 'selected' : ''}}>-</option>
                                        <option value="メニューをみる" {{$richmenu->text_d == 'メニューをみる' ? 'selected' : ''}}>メニューをみる</option>
                                        <option value="注文履歴" {{$richmenu->text_d == '注文履歴' ? 'selected' : ''}}>注文履歴</option>
                                        <option value="会員情報" {{$richmenu->text_d == '会員情報' ? 'selected' : ''}}>会員情報</option>
                                        <option value="店舗情報" {{$richmenu->text_d == '店舗情報' ? 'selected' : ''}}>店舗情報</option>
                                        <option value="友達に紹介" {{$richmenu->text_d == '友達に紹介' ? 'selected' : ''}}>友達に紹介</option>
                                        <option value="リンク" {{$richmenu->text_d == 'リンク' ? 'selected' : ''}}>リンク</option>
                                    </select>
                                    <div id="hidden_divD">
                                        <label class="text-secondary">リンクのURL</label>
                                        <input id="urlD" name="urlD" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                    </div>

                                    <label class="multisteps-form__input form-label mt-4 forbig-richmenu" for="buttons">「 E 」ボタンの設定</label>
                                    <select class="form-control forbig-richmenu" name="buttonsE" id="buttonsE" onchange="showDiv('hidden_divE', this)">
                                        <option value="" {{$richmenu->text_e == null ? 'selected' : ''}}>-</option>
                                        <option value="メニューをみる" {{$richmenu->text_e == 'メニューをみる' ? 'selected' : ''}}>メニューをみる</option>
                                        <option value="注文履歴" {{$richmenu->text_e == '注文履歴' ? 'selected' : ''}}>注文履歴</option>
                                        <option value="会員情報" {{$richmenu->text_e == '会員情報' ? 'selected' : ''}}>会員情報</option>
                                        <option value="店舗情報" {{$richmenu->text_e == '店舗情報' ? 'selected' : ''}}>店舗情報</option>
                                        <option value="友達に紹介" {{$richmenu->text_e == '友達に紹介' ? 'selected' : ''}}>友達に紹介</option>
                                        <option value="リンク" {{$richmenu->text_e == 'リンク' ? 'selected' : ''}}>リンク</option>
                                    </select>
                                    <div id="hidden_divE">
                                        <label class="text-secondary">リンクのURL</label>
                                        <input id="urlE" name="urlE" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                    </div>

                                    <label class="multisteps-form__input form-label mt-4 forbig-richmenu" for="buttons">「 F 」ボタンの設定</label>
                                    <select class="form-control forbig-richmenu" name="buttonsF" id="buttonsF" onchange="showDiv('hidden_divF', this)">
                                        <option value="" {{$richmenu->text_f == null ? 'selected' : ''}}>-</option>
                                        <option value="メニューをみる" {{$richmenu->text_f == 'メニューをみる' ? 'selected' : ''}}>メニューをみる</option>
                                        <option value="注文履歴" {{$richmenu->text_f == '注文履歴' ? 'selected' : ''}}>注文履歴</option>
                                        <option value="会員情報" {{$richmenu->text_f == '会員情報' ? 'selected' : ''}}>会員情報</option>
                                        <option value="店舗情報" {{$richmenu->text_f == '店舗情報' ? 'selected' : ''}}>店舗情報</option>
                                        <option value="友達に紹介" {{$richmenu->text_f == '友達に紹介' ? 'selected' : ''}}>友達に紹介</option>
                                        <option value="リンク" {{$richmenu->text_f == 'リンク' ? 'selected' : ''}}>リンク</option>
                                    </select>
                                    <div id="hidden_divF">
                                        <label class="text-secondary">リンクのURL</label>
                                        <input id="urlF" name="urlF" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Save and Submit Account -->
                    <div class="card mt-4" id="save">
                        <div class="card-header">
                            <h5>保存する</h5>
                            {{-- <p class="text-sm mb-0">save changes</p> --}}
                        </div>
                        <div class="card-body d-sm-flex pt-0">
                            <div class="d-flex align-items-center mb-sm-0 mb-4">
                                <div class="ms-2">
                                    <span class="text-dark font-weight-bold d-block text-sm">変更を適用するには</span>
                                    <span class="text-xs d-block">リッチメニューをLINEアカウントに適用するにはリッチメニュー一覧の「リッチメニューを使う」をクリック</span>
                                </div>
                            </div>
                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                        title="Send">変更を保存</button>
                        </div>
                    </div>
                </form>
                <!-- Card Delete Account -->
                <div class="card mt-4" id="delete">
                    <div class="card-header">
                        <h5>Delete Account</h5>
                        <p class="text-sm mb-0">Once you delete your account, there is no going back. Please be certain.
                        </p>
                    </div>
                    <div class="card-body d-sm-flex pt-0">
                        <div class="d-flex align-items-center mb-sm-0 mb-4">
                            <div class="ms-2">
                                <span class="text-dark font-weight-bold d-block text-sm">削除を確定</span>
                                <span class="text-xs d-block">削除を確定するには「確定」ボタンを押してから削除してください。</span>
                            </div>
                        </div>

                        <form class='ms-auto'
                            action=""
                            method="POST">
                            @csrf
                            @method('delete')
                            <button class="confirm-delete btn btn-outline-secondary mb-0 ms-auto" type="button"
                                name="button">確定</button>
                            <button class="confirm-delete-btn btn bg-gradient-danger mb-0 ms-2" type="submit"
                                name="button" disabled>
                                Delete Account
                            </button>
                        </form>
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



    var bigBtn = document.getElementById("big");
    var smallBtn = document.getElementById("small");
    var bigs = document.querySelectorAll(".rich-display-big");
    var smalls = document.querySelectorAll(".rich-display-small");
    var cdf = document.querySelectorAll(".forbig-richmenu");
    var bigImageText = document.querySelectorAll(".rich-imagetext-big");
    var smallImageText = document.querySelectorAll(".rich-imagetext-small");

    if(bigBtn.checked) {
        smalls.forEach((small) => {
            small.classList.add("hide-rich");
        });
        bigs.forEach((big) => {
            big.classList.remove("hide-rich");
        });
        cdf.forEach((btn) =>{
            btn.classList.remove("hide-rich");
        });
        bigImageText.forEach((text)=>{
            text.classList.remove("hide-rich");
        });
        smallImageText.forEach((text)=>{
            text.classList.add("hide-rich");
        });
    }else if(smallBtn.checked) {
        smalls.forEach((small) => {
            small.classList.remove("hide-rich");
        });
        bigs.forEach((big) => {
            big.classList.add("hide-rich");
        });
        cdf.forEach((btn) =>{
            btn.classList.add("hide-rich");
        });
        bigImageText.forEach((text)=>{
            text.classList.add("hide-rich");
        });
        smallImageText.forEach((text)=>{
            text.classList.remove("hide-rich");
        });
    }
        bigBtn.addEventListener("click", function() {
            smalls.forEach((small) => {
                small.classList.add("hide-rich");
            });
            bigs.forEach((big) => {
                big.classList.remove("hide-rich");
            });
            cdf.forEach((btn) =>{
                btn.classList.remove("hide-rich");
            });
            bigImageText.forEach((text)=>{
                text.classList.remove("hide-rich");
            });
            smallImageText.forEach((text)=>{
                text.classList.add("hide-rich");
            });
        });
        smallBtn.addEventListener("click", function() {
            smalls.forEach((small) => {
                small.classList.remove("hide-rich");
            });
            bigs.forEach((big) => {
                big.classList.add("hide-rich");
            });
            cdf.forEach((btn) =>{
                btn.classList.add("hide-rich");
            });
            bigImageText.forEach((text)=>{
                text.classList.add("hide-rich");
            });
            smallImageText.forEach((text)=>{
                text.classList.remove("hide-rich");
            });
        });


    
    document.addEventListener('DOMContentLoaded', copyToDiv);
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
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.0') }}"></script>
@endsection