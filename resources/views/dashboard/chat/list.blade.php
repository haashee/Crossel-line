@extends('layouts.profile')



@section('title')
Friend list
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
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h5 class="mb-0">チャットリスト</h5>
                        <p class="text-sm mb-0">
                            Chat list for this account.
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        チャット開始日
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        メッセージ
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        お名前
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        会員登録
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        友達登録日
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        設定
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chatList as $chat )
                                    @if ($chat->lineuser_id)

                                    <tr>
                                        <td class="text-sm font-weight-normal">
                                            {{ $chat->created_at->toDateString() }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ Str::limit($chat->message,28) }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            @if ( $chat->senderName !== $account->name )
                                            {{ $chat->senderName }}
                                            @else
                                            {{ $chat->receiverName }}
                                            @endif
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <span class="badge badge-dot me-4">
                                                @if ($chat->lineUser->email)
                                                <i class="bg-info"></i>
                                                <span class="text-dark text-xs">登録済み</span>
                                                @else
                                                <i class="bg-secondary"></i>
                                                <span class="text-dark text-xs">未登録</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $chat->lineUser->created_at->toDateString() }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <div class="dropdown">
                                                <a href="/accounts/{{ $account->id }}/friends/{{ $chat->lineUser->id }}"
                                                    data-bs-toggle="tooltip" data-bs-original-title="友達情報を見る" class="mx-3 ms-0">
                                                    <i class="fas fa-eye text-third"></i>
                                                </a>
                                                {{-- <a href="/accounts/{{ $account->id }}/friends/{{ $chat->id }}/edit"
                                                    class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="編集">
                                                    <i class="fas fa-user-edit text-third"></i>
                                                </a> --}}
                                                <a href="{{ route('friends.chat', ['aid' => $account->id, 'id' => $chat->lineUser->id]) }}"
                                                    class="" data-bs-toggle="tooltip" data-bs-original-title="チャットする">
                                                    <i class="fas fa-envelope text-third"></i>
                                                </a>
                                        </td>
                                    </tr>
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        @include('includes.footer')
        <!-- End Footer -->

    </div>
    {{-- <div class="container-fluid py-4">
        <div class="row my-4 ">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Function</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Review</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Employed</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($friends as $friend )
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../../../assets/img/team-3.jpg" class="avatar avatar-sm me-3"
                                                    alt="avatar image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $friend->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm text-secondary mb-0">Programator</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-dot me-4">
                                            <i class="bg-info"></i>
                                            <span class="text-dark text-xs">positive</span>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-secondary mb-0 text-sm">alexa@user.com</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-sm">93021</span>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../../../assets/img/team-3.jpg" class="avatar avatar-sm me-3"
                                                    alt="avatar image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Alexa Liras</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm text-secondary mb-0">Programator</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-dot me-4">
                                            <i class="bg-info"></i>
                                            <span class="text-dark text-xs">positive</span>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-secondary mb-0 text-sm">alexa@user.com</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-sm">93021</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../../../assets/img/team-4.jpg" class="avatar avatar-sm me-3"
                                                    alt="avatar image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm text-secondary mb-0">Executive</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-dot me-4">
                                            <i class="bg-dark"></i>
                                            <span class="text-dark text-xs">neutral</span>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-secondary mb-0 text-sm">laurent@user.com</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-sm">10392</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../../../assets/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                    alt="avatar image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Richard Gran</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm text-secondary mb-0">Manager</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-dot me-4">
                                            <i class="bg-danger"></i>
                                            <span class="text-dark text-xs">negative</span>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-secondary mb-0 text-sm">richard@user.com</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-sm">91879</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


</div>
@endsection



@section('scripts')
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
    var win = navigator.platform.indexOf("Win") > -1;
            if (win && document.querySelector("#sidenav-scrollbar")) {
                var options = {
                    damping: "0.5",
                };
                Scrollbar.init(
                    document.querySelector("#sidenav-scrollbar"),
                    options
                );
            }
</script>
<script>
    function doSomething(){
        document.getElementById('id_confrmdiv').style.display="block"; //this is the replace of this line

        document.getElementById('id_truebtn').onclick = function(){
           // Do your delete operation
            alert('true');
        };
        document.getElementById('id_falsebtn').onclick = function(){
            alert('false');
            return false;
        };
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.0') }}"></script>

@endsection