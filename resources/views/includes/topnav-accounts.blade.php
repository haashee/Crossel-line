<div class="col-auto my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
    <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills-custom nav-fill p-1" role="tablist">
            <li class="nav-item mx-2">
                <a 
                    class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center {{ Route::currentRouteNamed('chat.index') ? 'topnav-select' : '' }}"
                    href="{{ route('chat.index', ['aid' => $account->id]) }}" role="tab" aria-selected="true">
                    <i class="ni ni-chat-round"></i>
                    <span class="ms-2">チャット機能</span>
                </a>
            </li>
            <li class="nav-item mx-2">
                <a 
                    class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center 
                        {{ Route::currentRouteNamed('friends.index') ? 'topnav-select' : '' }}"
                    href="{{ route('friends.index', ['aid' => $account->id]) }}" role="tab" aria-selected="true">
                    <i class="ni ni-collection"></i>
                    <span class="ms-2">友だちリスト</span>
                </a>
            </li>
            <li class="nav-item mx-2">
                <a 
                    class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center
                        {{ Route::currentRouteNamed('accounts.richmenu') ? 'topnav-select' : '' }}"
                    href="/accounts/{{ $account->id }}/richmenu" role="tab" aria-selected="true">
                    <i class="ni ni-image"></i>
                    <span class="ms-2">リッチメニュー</span>
                </a>
            </li>
            <li class="nav-item mx-2">
                <a 
                    class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center
                        {{ Route::currentRouteNamed('accounts.edit') ? 'topnav-select' : '' }}"
                    href="/accounts/{{ $account->id }}/edit" role="tab" aria-selected="false">
                    <i class="ni ni-settings-gear-65"></i>
                    <span class="ms-2">設定</span>
                </a>
            </li>
        </ul>
    </div>
</div>