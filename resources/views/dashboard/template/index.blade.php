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
                                <span class="text-sm">テンプレートの管理</span>
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
                                    <h5 class="mb-0">テンプレートの管理</h5>
                                </div>

                            </div>
                        </div>

                        <div class="row pt-2 pb-3">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">テンプレート一覧</h6>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                            <div class=" h-100">
                                <div class="card-body p-3 py-0">
                                <ul class="list-group mx-4">
                                    @forelse ($templates as $template)
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $template->name }}</h6>
                                            {{-- @if ($tag->isPublic == true)
                                                <span class="text-xs">公開タグ</span>
                                            @else
                                                <span class="text-xs">非公開タグ</span>
                                            @endif --}}
                                        </div>
                                        <div class="d-flex align-items-center text-sm">
                                            <p class="text-xs mx-1 mt-3">{{ $template->text }}</p>
                                            {{-- <span class="tag-dot me-4" style="background-color:{{ $template->color }};"></span> --}}
                                            {{-- <a class="btn btn-link text-dark text-muted text-xs mb-0 px-0 mx-1" href="{{ route('tag.setting', ['aid' => $account->id, 'id' => $tag->id]) }}">
                                                <i class="fas fa-edit text-sm me-1"></i>
                                            </a> --}}
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
                                        <p>テンプレートが登録されてません。新規テンプレートをご登録ください。</p>
                                    @endforelse

                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                            <form action="{{ route('template.store', ['aid' => $account->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-8 d-flex align-items-center py-3">
                                    <h6 class="mb-0">新規テンプレートの作成</h6>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <label class="">テンプレートの名前<span class="text-third">(必須)</span></label>
                                        <div class="input-group">
                                        <input class="edit-token-show multisteps-form__input form-control" type="text"
                                            placeholder="テンプレートの名前" value=""
                                            name="name" />                                    
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">お気に入り</label>
                                        <div class="input-group form-check form-switch my-auto">
                                        <input name="isPublic" class="form-check-input" type="checkbox" 
                                            id="flexSwitchCheckDefault2" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="">テンプレート本文<span class="text-third">(必須)</span></label>
                                        <div class="input-group">
                                        <textarea class="edit-token-show multisteps-form__input form-control" type="text"
                                            placeholder="テンプレート本文" value=""
                                            name="name">   </textarea>                                 
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