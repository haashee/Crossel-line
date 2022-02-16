<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset('assets/img/team-1.jpg') }}" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        @if (Route::currentRouteName() != 'accounts.index' )
                        {{ $account->name }}
                        @else
                        {{ Auth::user()->name }}
                        @endif
                    </h5>

                    @if (Route::currentRouteName() != 'accounts.index' )
                    <a href="{{ URL::route('accounts.index') }}">
                        <p class="mb-0 font-weight-bold text-sm text-third">
                            アカウント一覧へ戻る
                        </p>
                    </a> 
                    @else
                    <a href="{{ URL::route('dashboard') }}">
                        <p class="mb-0 font-weight-bold text-sm text-third">
                            ダッシュボードへ戻る
                        </p>
                    </a> 
                    @endif
                </div>
            </div>

            @if (Route::currentRouteName() != 'accounts.index' )
            @include('includes.topnav-accounts')
            @else
            <div class="col-auto my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item mx-3">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                href="{{ URL::route('accounts.index') }}" role="tab" aria-selected="false">
                                <i class="ni ni-app"></i>
                                <span class="ms-2">一覧</span>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center 
                        {{ Route::currentRouteNamed('friends.index') ? 'topnav-select' : '' }}" href="" role="tab"
                                aria-selected="true">
                                <i class="ni ni-image"></i>
                                <span class="ms-2">友だちリスト</span>
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center
                        {{ Route::currentRouteNamed('accounts.richmenu') ? 'topnav-select' : '' }}" href="" role="tab"
                                aria-selected="true">
                                <i class="ni ni-image"></i>
                                <span class="ms-2">リッチメニュー</span>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center
                        {{ Route::currentRouteNamed('accounts.edit') ? 'topnav-select' : '' }}" href="" role="tab"
                                aria-selected="false">
                                <i class="ni ni-settings-gear-65"></i>
                                <span class="ms-2">設定</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>