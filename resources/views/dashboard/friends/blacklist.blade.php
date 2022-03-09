@extends('layouts.profile')



@section('title')
Tag setting
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



        <!--confirmation message-->
        <div id="id_confrmdiv" class="card card-body  p-4">
            <div class="row justify-content-center align-items-center">
                <p class="text-md">
                    この操作を実行すると元に戻せなくなります。<br> このまま処理を続けてもよろしいですか?
                </p>
                <button id="id_truebtn" class="mx-3 btn bg-gradient-danger mb-0">進む</button>
                <button id="id_falsebtn" class="mx-3 btn btn-outline-secondary mb-0">戻る</button>
            </div>
        </div>



        <div class="row mt-3">
            <div class="col-lg-3">
                <div class="card position-sticky top-1">
                    <ul class="nav flex-column bg-white border-radius-lg p-3">
                        <li class="nav-item">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#profile">
                                <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                                <span class="text-sm">ブラックリスト</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item pt-2">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll=""
                                href="#notifications">
                                <i class="ni ni-fat-delete me-2 text-dark opacity-6"></i>
                                <span class="text-sm">タグを削除</span>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#sessions">
                                <i class="ni ni-bullet-list-67 me-2 text-dark opacity-6"></i>
                                <span class="text-sm">登録されている友達</span>
                            </a>
                        </li> --}}
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info"
                                onclick="history.back()">
                                <i class="ni ni-bold-left me-2 text-dark opacity-6"></i>
                                <span class="text-sm">前に戻る</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9 mt-lg-0 mt-4">

                <!-- Black Listed Friends -->
                <div class="card card-body p-4" id="profile">
                    <div class="card-header p-0 pb-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h5 class="mb-0">ブラックリスト中の友達</h5>
                            </div>
                        </div>
                        <p class="text-sm">
                            ブラックリスト中の友達は自動応答やメッセージ配信や通知などの動作対象から除外されます。
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                        <div class="table-responsive p-0">
                            <table class="table table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            友達登録日
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            お名前
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            会員登録
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            タグ
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            アクション
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($friends as $friend )
                                    <tr>
                                        <td class="text-sm font-weight-normal">
                                            {{ $friend->created_at->toDateString() }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $friend->name }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <span class="badge badge-dot me-4">
                                                @if ($friend->email)
                                                <i class="bg-info"></i>
                                                <span class="text-dark text-xs">登録済み</span>
                                                @else
                                                <i class="bg-secondary"></i>
                                                <span class="text-dark text-xs">未登録</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            @forelse ($friend->tags as $tag)
                                            <span class="tag-dot me-1"
                                                style="background-color:{{ $tag->color }};"></span>
                                            @empty
                                            <span class="text-dark text-xs">タグなし</span>
                                            @endforelse
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <div class="dropdown">
                                                <a href="/accounts/{{ $account->id }}/friends/{{ $friend->id }}"
                                                    data-bs-toggle="tooltip" data-bs-original-title="見る">
                                                    <i class="fas fa-eye text-third"></i>
                                                </a>
                                                <a href="/accounts/{{ $account->id }}/friends/{{ $friend->id }}/edit"
                                                    class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="編集">
                                                    <i class="fas fa-user-edit text-third"></i>
                                                </a>
                                                <a href="{{ route('friends.chat', ['aid' => $account->id, 'id' => $friend->id]) }}"
                                                    class="" data-bs-toggle="tooltip" data-bs-original-title="チャットする">
                                                    <i class="fas fa-envelope text-third"></i>
                                                </a>
                                                {{-- <a onclick="doSomething()" href="javascript:;"
                                                    data-bs-toggle="tooltip" data-bs-original-title="削除">
                                                    <i class="fas fa-trash text-third"></i>
                                                </a>
                                                <div id="id_confrmdiv">confirmation
                                                    <button id="id_truebtn">Yes</button>
                                                    <button id="id_falsebtn">No</button>
                                                </div> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
<!-- Kanban scripts -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables.js') }}"></script>
<!-- Kanban scripts -->
<script src="{{ asset('assets/js/plugins/dragula/dragula.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script>
<script>
    const dataTableBasic = new simpleDatatables.DataTable(
                "#datatable-basic",
                {
                    searchable: false,
                    fixedHeight: true,
                }
            );

            const dataTableSearch = new simpleDatatables.DataTable(
                "#datatable-search",
                {
                    searchable: true,
                    fixedHeight: true,
                }
            );
</script>
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
<script>
    function confirmDelete(){
        document.getElementById('id_confrmdiv').style.display="block"; 
        
        document.getElementById('id_truebtn').onclick = function(){
           // delete operation
            document.getElementById("deleteBtn").click();
        };
        document.getElementById('id_falsebtn').onclick = function(){
            document.getElementById('id_confrmdiv').style.display="none";
        };
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
@endsection