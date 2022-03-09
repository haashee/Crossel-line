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
                                <span class="text-sm">タグの編集</span>
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
                    <div class="col-12 col-sm-12 mt-4 mt-sm-0 text-start m-auto">
                        <form action="{{ route('template.update', ['aid' => $account->id, 'template' => $template->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="col-md-8 d-flex align-items-center py-3">
                                    <h6 class="mb-0">テンプレートの編集</h6>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <label class="">テンプレートの名前<span class="text-third">(必須)</span></label>
                                        <div class="input-group">
                                        <input class="edit-token-show multisteps-form__input form-control" type="text"
                                            placeholder="テンプレートの名前" value="{{ $template->name }}"
                                            name="name" />                                    
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">お気に入り</label>
                                        <div class="input-group form-check form-switch my-auto">
                                        <input name="isFavorite" class="form-check-input" type="checkbox" 
                                            id="flexSwitchCheckDefault2" {{ $template->isFavorite == true ? 'checked' :''}}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label class="">テンプレート本文<span class="text-third">(必須)</span></label>
                                        <div class="input-group">
                                            <textarea class="edit-token-show multisteps-form__input form-control" name="text" id="" 
                                                cols="30" rows="3" placeholder="テンプレート本文">{{ $template->text }}</textarea>                             
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="button-row d-flex mt-4 col-12">
                                        <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">保存</button>
                                    </div>
                                </div>
                        </form>
                        <div class="d-flex align-items-center mb-sm-0 my-3">
                            <div class="ms-2">
                                <span class="text-dark font-weight-bold d-block text-sm">テンプレートを削除する</span>
                                <span class="text-xs d-block">削除されたテンプレートは復元できませんのでご注意ください。</span>
                            </div>
                            <form class="ms-auto" action="{{ route('template.destroy', ['aid' => $account->id, 'template' => $template->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button onclick="confirmDelete()" class="btn btn-link text-dark text-muted text-xs mb-0 px-0 " type="button" name="button">
                                    <i class="fas fa-trash text-secondary text-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="テンプレートを削除する"></i>
                                </button>
                                <button id="deleteBtn" class="btn btn-link text-dark text-muted text-xs mb-0 px-0 " type="submit" name="button" hidden>
                                    <i class="fas fa-trash text-secondary text-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="テンプレートを削除する"></i>
                                </button>
                            </form>
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