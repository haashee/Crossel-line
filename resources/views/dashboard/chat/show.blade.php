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

        <div class="row mt-3">
            <div class="col-12 col-xl-4 mt-xl-0 mt-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Conversations</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group ContentChatList mb-3">
                            @foreach ($chatList as $chat)
                                @if ($chat->lineuser_id)
                                    
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                    <div class="avatar avatar-xs me-3">
                                        <img src="{{ asset('uploads/profile-pic/' . $friend->image) }}" alt="kal"
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
                                <h6 class="mb-0">{{ $friend->name }}とのチャット</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="javascript:window.location.reload(true)">
                                    <i class="fas fa-redo text-secondary text-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="チャットを更新する"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal gray-light my-4">
                    <div class="card-body p-3 pt-0">
                        <div class="my-1 rounded-lg ">
                            <div class="position-relative w-100 Content">
                                @foreach ($chats as $chat)
                                <div class="chat ">
                                    @if ($chat->message)                                        
                                        <div data-time="{{ date('Y/m/d h:i', strtotime($chat->created_at)) }}" class="{{ $chat->senderName == $account->name ? 'msg sent' : 'msg rcvd' }}">
                                            {{ $chat->message }}
                                        </div>
                                    @else
                                        <p class="text-center text-xs">チャットが開始されました。</p>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Card Chat Input -->
                        <div class="">
                            <form class="my-3 py-2 px-4 rounded-lg text-sm flex flex-col flex-grow"
                                action="{{  route('chat.store', ['aid' => $account->id, 'id' => $friend->id])  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="sender_name" value="{{ $account->name }}">
                                <input type="hidden" name="receiver_name" value="{{ $friend->name }}">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <textarea name="message" class="form-control " type="text" id='chat-input'
                                                placeholder="メッセージを入力"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn bg-gradient-dark btn-sm float-end mb-2 w-100"
                                            type="submit">送信
                                        </button>
                                        <select name="" id="chat-options" class="form-control text-xxs py-1" style="text-indent: 1px;">
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