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
                <small class="text-body">0 mins ago</small>
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
            <div class="col-12 col-xl-4 mt-xl-0 mt-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Conversations</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group ContentChatListFull mb-3">
                            @foreach ($chatList as $chat)
                                @if ($chat->lineuser_id)
                                    
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                    <div class="avatar avatar-xs me-3">
                                        <img src="{{ asset('uploads/profile-pic/' . $chat->lineUser->image) }}" alt="kal"
                                            class="border-radius-lg shadow">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">
                                            @if ( $chat->senderName !== $account->name )
                                            {{ $chat->senderName }}
                                            @else
                                            {{ $chat->receiverName }}
                                            @endif
                                        </h6>
                                        <p class="mb-0 text-xs">{{ Str::limit($chat->message,22) }}</p>
                                    </div>
                                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="{{  route('chat.show', ['aid' => $account->id, 'chat' => $chat->lineuser_id])  }}">Reply</a>
                                </li>
                                @endif
                            @endforeach
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                <div class="avatar me-3">
                                    <img src="../../../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Anne Marie</h6>
                                    <p class="mb-0 text-xs">Awesome work, can you..</p>
                                </div>
                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                <div class="avatar me-3">
                                    <img src="../../../assets/img/ivana-square.jpg" alt="kal"
                                        class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Ivanna</h6>
                                    <p class="mb-0 text-xs">About files I can..</p>
                                </div>
                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                <div class="avatar me-3">
                                    <img src="../../../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Peterson</h6>
                                    <p class="mb-0 text-xs">Have a great afternoon..</p>
                                </div>
                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center px-0">
                                <div class="avatar me-3">
                                    <img src="../../../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Nick Daniel</h6>
                                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                                </div>
                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                            </li>
                        </ul>
                        <a class="text-xs text-left p-1" href="{{ route('chat.list', ['aid' => $account->id]) }}">チャット一覧を見る</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-8 mt-md-0 mt-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">一斉送信 </h6>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal gray-light my-4">
                    <div class="card-body p-3 pt-0">
                        <div class="my-1 rounded-lg ">
                            <div class="position-relative w-100">
                                {{-- <p class="text-md mx-4">チャットを選択して下さい</p>
                                <p class="text-sm text-secondary mx-4">新しくチャットを開始する場合は「友だち検索」からチャットを開始したい友だちを選択し、友だち詳細画面の「個別チャット履歴」ブロック内の「チャットを開始する」ボタンから新規チャットを開始する事が出来ます。</p>
                                <hr class="horizontal gray-light my-4"> --}}
                                <p class="text-md mx-4">チャットの設定は下記ボタンをクリック</p>
                                <a href="{{ route('multiple.show', ['aid' => $account->id]) }}" class="btn btn-outline-primary btn-sm mx-1 ms-4">送信済みのメッセージ</a>
                                <a href="{{ route('tag.index', ['aid' => $account->id]) }}" class="btn btn-outline-primary btn-sm mx-1">タグを管理</a>
                            </div>
                        </div>
                        <!-- Card Chat Input -->
                        <div class="">
                            <form class="my-3 py-2 px-4 rounded-lg text-sm flex flex-col flex-grow"
                                action="{{  route('multiple.store', ['aid' => $account->id])  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="sender_name" value="{{ $account->name }}">
                                {{-- <input type="hidden" name="receiver_name" value="{{ $friend->name }}"> --}}
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="form-label mt-0">送信する友達のタグ<span class="text-third">(Ctrlで複数選択可能)</span></label>
                                        <select id="category" name="tags[]" multiple class="form-control h-75" oninvalid="this.setCustomValidity('こちらは必須項目です。')" onchange="this.setCustomValidity('')" required>
                                            @forelse ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @empty
                                            <p>タグが登録されていません。</p>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="form-label mt-4">画像メッセージを追加<span class="text-third">(jpgまたはpngで5MBまでのファイル)</span></label>
                                                <input class="form-control" type="file" id="image" name="image" accept="image/png, image/jpeg">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label mt-4">画像の送信順番</label>
                                                <select class="form-control" name="isAfter" id="">
                                                    <option value="1" selected>画像をメッセージ本文の後に送信</option>
                                                    <option value="0">画像をメッセージ本文の前に送信</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label mt-4">画像メッセージの通知テキスト<span class="text-third">(必須)</span></label>
                                                <input class="form-control" type="text" id="image_text" name="image_text">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mt-4">画像メッセージのリンクURL<span class="text-third">(httpsからご記入ください)</span></label>
                                                <input class="form-control" type="text" id="image_url" name="image_url" placeholder="https://google.com">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="form-label mt-4">一斉送信するメッセージ本文<span class="text-third">(必須)</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <textarea name="message" class="form-control " type="text" id='chat-input'
                                                placeholder="メッセージを入力" rows="3" cols="50" oninvalid="this.setCustomValidity('こちらは必須項目です。')" onchange="this.setCustomValidity('')" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn bg-gradient-dark btn-sm float-end mb-2 w-100"
                                            type="submit">送信
                                        </button>
                                        {{-- <select name="tag" id="" class="form-control text-xxs py-1 text-center" style="text-indent: 0px;">
                                            <option value="" disabled selected>タグ</option>
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select> --}}
                                        <select name="" id="chat-options" class="form-control text-xxs py-1 text-center mt-1" style="text-indent: 0px;">
                                            <option value="" disabled selected>テンプレート</option>
                                            @foreach($templates->take(4) as $template)
                                                @if ($template->isFavorite == false)
                                                    <option value="{{ $template->text }}">{{ $template->name }}</option>
                                                @endif                                           
                                            @endforeach
                                            <option value="" disabled>お気に入り</option>
                                            @foreach($templates as $template)
                                                @if ($template->isFavorite == true)
                                                    <option value="{{ $template->text }}">{{ $template->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

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

    var chatOptions = document.querySelector('#chat-options');
    var chatInput = document.querySelector('#chat-input');

    chatOptions.addEventListener('change', function(event) {
    chatInput.value = event.target.value;
    });

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
@endsection