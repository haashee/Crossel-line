@extends('layouts.profile')



@section('title')
Account Wizard
@endsection



@section('content')
<main class="main-content position-relative border-radius-lg ">


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
                                <button class="multisteps-form__progress-btn js-active" type="button" title="Address">
                                    <span>Webhookの確認</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Address">
                                    <span>Liffの設定</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                    <span>完了</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--form panels-->
                    <div class="row">
                        <div class="col-12 col-lg-8 m-auto">
                            <form action="/accounts/{{ $account->id }}" method="POST" enctype="multipart/form-data"
                                class="multisteps-form__form">
                                @csrf
                                @method('PUT')
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                    data-animation="FadeIn">
                                    <div class="row text-center">
                                        <div class="col-10 mx-auto">
                                            <p class="font-weight-normal pt-4">下記WebhookのURLをコピーしてLINEアカウントへ貼り付けてください。</p>
                                        </div>
                                    </div>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start m-auto">
                                                <label class="text-muted">Webhook URL</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    value="https://d466-223-133-69-171.ngrok.io/line/{{ $account->id }}/webhook" name=""
                                                    readonly="readonly" />
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    placeholder="name" name="name" value="{{ $account->name }}" hidden/>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    placeholder="channel_secret" name="channel_secret" value="{{ $account->channel_secret }}" hidden/>
                                                <textarea class="multisteps-form__input form-control mb-3"
                                                    placeholder="access_token" name="access_token" hidden>{{ $account->access_token }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="button-row d-flex mt-4">
                                        <a href="{{ route('accounts.index') }}" class="btn bg-gradient-dark ms-auto mb-0 js-btn-next">完了</a>
                                        </div> --}}
                                        <div class="row">
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                    data-animation="FadeIn">
                                    <div class="row text-center">
                                        <div class="col-10 mx-auto">
                                            <h5 class="font-weight-normal">What are you doing? (checkboxes)</h5>
                                            <p>Give us more details about you. What do you enjoy doing in your spare
                                                time?</p>
                                        </div>
                                    </div>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start m-auto">
                                                <label class="">FULL エンドポイントURL</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    value="URL for menu" name="" readonly="readonly"/>
                                                <label>FULLのLIFF ID</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    placeholder="Liff ID (Full用)" name="liff_full" />
                                                <hr class="horizontal dark" />

                                                <label class="">TALL エンドポイントURL</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    value="URL for menu" name="" readonly="readonly"/>
                                                <label>TALLのLIFF ID</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    placeholder="Liff ID (Tall用)" name="liff_tall" />
                                                <hr class="horizontal dark" />

                                                <label class="">COMPACT エンドポイントURL</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    value="URL for menu" name="" readonly="readonly"/>
                                                <label>COMPACTのLIFF ID</label>
                                                <input class="multisteps-form__input form-control mb-3"
                                                    placeholder="Liff ID (Compact用)" name="liff_compact"/>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                    data-animation="FadeIn">
                                    <div class="row text-center">
                                        <div class="col-10 mx-auto">
                                            <h5 class="font-weight-normal">Are you living in a nice area?</h5>
                                            <p>One thing I love about the later sunsets is the chance to go for a walk
                                                through the neighborhood woods before dinner</p>
                                        </div>
                                    </div>
                                    <div class="multisteps-form__content">
                                        <div class="row text-start">
                                            <div class="col-12 col-md-8 ms-auto mt-3">
                                                <label>Street Name</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    placeholder="Eg. Soft" />
                                            </div>
                                            <div class="col-12 col-md-4 ms-auto mt-3">
                                                <label>Street No</label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    placeholder="Eg. 221" />
                                            </div>
                                            <div class="col-12 col-md-7 ms-auto mt-3">
                                                <label>City</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    placeholder="Eg. Tokyo" />
                                            </div>
                                            <div class="col-12 col-md-5 ms-auto mt-3 text-start">
                                                <label>Country</label>
                                                <select class="form-control" name="choices-country"
                                                    id="choices-country">
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Brasil">Brasil</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4 col-12">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                    title="Send">Send</button>
                                            </div>
                                        </div>
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

</main>
@endsection



@section('scripts')
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<!-- Kanban scripts -->
<script src="{{ asset('assets/js/plugins/dragula/dragula.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script>
<script src="{{ asset('assets/js/plugins/multistep-form.js') }}"></script>
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>


<script>
    if (document.getElementById('choices-country')) {
            var country = document.getElementById('choices-country');
            const example = new Choices(country);
            }

            var openFile = function(event) {
            var input = event.target;

            // Instantiate FileReader
            var reader = new FileReader();
            reader.onload = function() {
                imageFile = reader.result;

                document.getElementById("imageChange").innerHTML = '<img width="200" src="' + imageFile + '" class="rounded-circle w-100 shadow" />';
            };
            reader.readAsDataURL(input.files[0]);
            };
</script>
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
<script src="../../assets/js/argon-dashboard.min.js?v=2.0.0"></script>
@endsection