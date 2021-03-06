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
                                    <h5 class="font-weight-bolder">基本設定</h5>
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
                                                <label>メニュー名 <span class="text-third">(必須)</span></label>
                                                <input id="name" name="name" class="multisteps-form__input form-control" type="text" placeholder="管理用メニュー名" />
                                                <label class="mt-4">表示ラベル <span class="text-third">(必須)</span></label>
                                                <input id="label" name="label" class="multisteps-form__input form-control" type="text" placeholder="リッチメニュー表示ラベル" />
                                                <label class="mt-4">リッチメニューのサイズ <span class="text-third">(必須)</span></label> <br>
                                                <input type="radio" id="big" name="richmenu_size" class="multisteps-form__input" value="big">
                                                <label for="big" class="text-muted">大きいサイズ</label><br>
                                                <input type="radio" id="small" name="richmenu_size" class="multisteps-form__input" value="small">
                                                <label for="small" class="text-muted">小さいサイズ</label><br>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">次へ</button>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">リッチメニュー画像</h5>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <label>画像をアップロード <span class="text-third">(必須)</span></label>
                                                <p class="rich-imagetext-big text-secondary text-xs">ピクセルサイズが[横]2500px x [縦]1686pxのJPEGまたはPNG画像ファイルをアップロードしてください。(サイズ上限1MB)</p>
                                                <p class="rich-imagetext-small text-secondary text-xs hide-rich">ピクセルサイズが[横]2500px x [縦]843pxのJPEGまたはPNG画像ファイルをアップロードしてください。(サイズ上限1MB)</p>
                                                <div class="">
                                                    <input type="file" name="image" class="form-control "/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button"
                                                title="Prev">戻る</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">次へ</button>
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
                                                <label class="multisteps-form__input form-label" for="buttons">「 A 」ボタンの設定<span class="text-third">(必須)</span></label>
                                                <select class="form-control" name="buttonsA" id="buttonsA" onchange="showUrl('divUrl_A', this);showMulti('divMulti_A', this);">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                    <option value="マルチボタン">マルチボタン</option>
                                                </select>
                                                <div id="divUrl_A">
                                                    <label class="text-secondary">リンクのURL <span class="text-third">(URLはhttp://から始まる必要があります。)</span></label>
                                                    <input id="urlA" name="urlA" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                                </div>
                                                <div id="divMulti_A">
                                                    <label class="text-secondary">マルチボタンを選択<span class="text-third">(必須)</span></label>
                                                    <div class="input-group">
                                                        <select class="multisteps-form__input form-control" name="multiA" id="multiA">
                                                            <option value="" disabled selected>未選択</option>
                                                            <option value="{{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}" data-message="{{ $richmenuSetting->displayTextA }}">
                                                                {{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}" data-message="{{ $richmenuSetting->displayTextB }}">
                                                                {{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}" data-message="{{ $richmenuSetting->displayTextC }}">
                                                                {{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}
                                                            </option>
                                                        </select>                                        
                                                    </div>
                                                </div>

                                                <label class="multisteps-form__input form-label mt-4" for="buttons">「 B 」ボタンの設定<span class="text-third">(必須)</span></label>
                                                <select class="form-control" name="buttonsB" id="buttonsB" onchange="showUrl('divUrl_B', this);showMulti('divMulti_B', this);">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                    <option value="マルチボタン">マルチボタン</option>
                                                </select>
                                                <div id="divUrl_B">
                                                    <label class="text-secondary">リンクのURL <span class="text-third">(URLはhttp://から始まる必要があります。)</span></label>
                                                    <input id="urlB" name="urlB" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                                </div>
                                                <div id="divMulti_B">
                                                    <label class="text-secondary">マルチボタンを選択<span class="text-third">(必須)</span></label>
                                                    <div class="input-group">
                                                        <select class="multisteps-form__input form-control" name="multiB" id="multiB">
                                                            <option value="" disabled selected>未選択</option>
                                                            <option value="{{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}" data-message="{{ $richmenuSetting->displayTextA }}">
                                                                {{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}" data-message="{{ $richmenuSetting->displayTextB }}">
                                                                {{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}" data-message="{{ $richmenuSetting->displayTextC }}">
                                                                {{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}
                                                            </option>
                                                        </select>                                        
                                                    </div>
                                                </div>

                                                <label class="multisteps-form__input form-label mt-4" for="buttons">「 C 」ボタンの設定<span class="text-third">(必須)</span></label>
                                                <select class="form-control" name="buttonsC" id="buttonsC" onchange="showUrl('divUrl_C', this);showMulti('divMulti_C', this);">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                    <option value="マルチボタン">マルチボタン</option>
                                                </select>
                                                <div id="divUrl_C">
                                                    <label class="text-secondary">リンクのURL <span class="text-third">(URLはhttp://から始まる必要があります。)</span></label>
                                                    <input id="urlC" name="urlC" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                                </div>
                                                <div id="divMulti_C">
                                                    <label class="text-secondary">マルチボタンを選択<span class="text-third">(必須)</span></label>
                                                    <div class="input-group">
                                                        <select class="multisteps-form__input form-control" name="multiC" id="multiC">
                                                            <option value="" disabled selected>未選択</option>
                                                            <option value="{{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}" data-message="{{ $richmenuSetting->displayTextA }}">
                                                                {{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}" data-message="{{ $richmenuSetting->displayTextB }}">
                                                                {{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}" data-message="{{ $richmenuSetting->displayTextC }}">
                                                                {{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}
                                                            </option>
                                                        </select>                                        
                                                    </div>
                                                </div>

                                                <label class="multisteps-form__input form-label mt-4 forbig-richmenu" for="buttons">「 D 」ボタンの設定<span class="text-third">(必須)</span></label>
                                                <select class="form-control forbig-richmenu" name="buttonsD" id="buttonsD" onchange="showUrl('divUrl_D', this);showMulti('divMulti_D', this);">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                    <option value="マルチボタン">マルチボタン</option>
                                                </select>
                                                <div id="divUrl_D">
                                                    <label class="text-secondary">リンクのURL <span class="text-third">(URLはhttp://から始まる必要があります。)</span></label>
                                                    <input id="urlD" name="urlD" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                                </div>
                                                <div id="divMulti_D">
                                                    <label class="text-secondary">マルチボタンを選択<span class="text-third">(必須)</span></label>
                                                    <div class="input-group">
                                                        <select class="multisteps-form__input form-control" name="multiD" id="multiD">
                                                            <option value="" disabled selected>未選択</option>
                                                            <option value="{{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}" data-message="{{ $richmenuSetting->displayTextA }}">
                                                                {{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}" data-message="{{ $richmenuSetting->displayTextB }}">
                                                                {{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}" data-message="{{ $richmenuSetting->displayTextC }}">
                                                                {{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}
                                                            </option>
                                                        </select>                                        
                                                    </div>
                                                </div>

                                                <label class="multisteps-form__input form-label mt-4 forbig-richmenu" for="buttons">「 E 」ボタンの設定<span class="text-third">(必須)</span></label>
                                                <select class="form-control forbig-richmenu" name="buttonsE" id="buttonsE" onchange="showUrl('divUrl_E', this);showMulti('divMulti_E', this);">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                    <option value="マルチボタン">マルチボタン</option>
                                                </select>
                                                <div id="divUrl_E">
                                                    <label class="text-secondary">リンクのURL <span class="text-third">(URLはhttp://から始まる必要があります。)</span></label>
                                                    <input id="urlE" name="urlE" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                                </div>
                                                <div id="divMulti_E">
                                                    <label class="text-secondary">マルチボタンを選択<span class="text-third">(必須)</span></label>
                                                    <div class="input-group">
                                                        <select class="multisteps-form__input form-control" name="multiE" id="multiE">
                                                            <option value="" disabled selected>未選択</option>
                                                            <option value="{{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}" data-message="{{ $richmenuSetting->displayTextA }}">
                                                                {{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}" data-message="{{ $richmenuSetting->displayTextB }}">
                                                                {{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}" data-message="{{ $richmenuSetting->displayTextC }}">
                                                                {{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}
                                                            </option>
                                                        </select>                                        
                                                    </div>
                                                </div>

                                                <label class="multisteps-form__input form-label mt-4 forbig-richmenu" for="buttons">「 F 」ボタンの設定<span class="text-third">(必須)</span></label>
                                                <select class="form-control forbig-richmenu" name="buttonsF" id="buttonsF" onchange="showUrl('divUrl_F', this);showMulti('divMulti_F', this);">
                                                    <option value="">-</option>
                                                    <option value="メニューをみる">メニューをみる</option>
                                                    <option value="注文履歴">注文履歴</option>
                                                    <option value="会員情報">会員情報</option>
                                                    <option value="店舗情報">店舗情報</option>
                                                    <option value="友達に紹介">友達に紹介</option>
                                                    <option value="リンク">リンク</option>
                                                    <option value="マルチボタン">マルチボタン</option>
                                                </select>
                                                <div id="divUrl_F">
                                                    <label class="text-secondary">リンクのURL <span class="text-third">(URLはhttp://から始まる必要があります。)</span></label>
                                                    <input id="urlF" name="urlF" class="multisteps-form__input form-control" type="text" placeholder="http://www.google.com" />
                                                </div>
                                                <div id="divMulti_F">
                                                    <label class="text-secondary">マルチボタンを選択<span class="text-third">(必須)</span></label>
                                                    <div class="input-group">
                                                        <select class="multisteps-form__input form-control" name="multiF" id="multiF">
                                                            <option value="" disabled selected>未選択</option>
                                                            <option value="{{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}" data-message="{{ $richmenuSetting->displayTextA }}">
                                                                {{ $richmenuSetting->nameA ? $richmenuSetting->nameA : "マルチボタンA" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}" data-message="{{ $richmenuSetting->displayTextB }}">
                                                                {{ $richmenuSetting->nameB ? $richmenuSetting->nameB : "マルチボタンB" }}
                                                            </option>
                                                            <option value="{{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}" data-message="{{ $richmenuSetting->displayTextC }}">
                                                                {{ $richmenuSetting->nameC ? $richmenuSetting->nameC : "マルチボタンC" }}
                                                            </option>
                                                        </select>                                        
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4 col-12">
                                                <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button"
                                                    title="Prev">戻る</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="button" title="Next">次へ</button>
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
        var cdf = document.querySelectorAll(".forbig-richmenu");
        var bigImageText = document.querySelectorAll(".rich-imagetext-big");
        var smallImageText = document.querySelectorAll(".rich-imagetext-small");

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



        
        document.getElementById('label').addEventListener('keyup', copyToDiv);
        
        var inputDisplay = document.querySelectorAll(".display-label");

        function copyToDiv() {
            inputDisplay.forEach((display)=>{
                display.innerHTML = document.getElementById("label").value + ' &#x25BC;';
            })
        }

        
        function showUrl(divId, element)
        {
            document.getElementById(divId).style.display = (element.value == 'リンク') ? 'block' : 'none';
        }

        function showMulti(divId, element)
        {
            document.getElementById(divId).style.display = element.value == 'マルチボタン' ? 'block' : 'none';
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