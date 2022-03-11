<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    {{ $account->name }}の会員画面
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  {{-- <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.0') }}" rel="stylesheet" /> --}}
  <link id="pagestyle" href="../../../assets/css/argon-dashboard.css?v=2.0.0" rel="stylesheet" />  
</head>

<body class="bg-gray-100">

  <main class="main-content  mt-0">


    
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



    
    <div id="liffAppContent">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-color: {{ $account->accountSetting->membership_background }}; background-position: top; z-index:-10;">
        {{-- <span class="mask bg-gradient-dark opacity-6"></span> --}}
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h2 class="text-white mb-8">プロフィール</h2>
              {{-- <p class="text-lead text-white">
                Use these awesome forms to login or create new account in your project for free.
              </p> --}}
            </div>
          </div>
        </div>
      </div>
      
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n14 justify-content-center pb-5">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0 membership-card-height">
              {{-- <div class="card-header text-center pt-4">
                <h5>Register with</h5>
              </div> --}}
              <div class="mem-btn-container row px-xl-5 px-sm-4 px-4 py-3">
                <div class="col-4 col-xs-4 col-sm-4 ms-auto px-1">
                  <button class="mem-tab-btn btn btn-outline-light w-100 mb-0 text-xs active" data-memtab="settings">
                    基本情報
                  </button>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 px-1">
                  <button class="mem-tab-btn btn btn-outline-light w-100 mb-0 text-xs" data-memtab="orders">
                    注文履歴
                  </button>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 me-auto px-1">
                  <button class="mem-tab-btn btn btn-outline-light w-100 mb-0 text-xs" data-memtab="card">
                    会員証
                  </button>
                </div>
                {{-- <div class="mt-2 position-relative text-center">
                  <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                    or
                  </p>
                </div> --}}
              </div>
              <div class="mem-content card-body pt-2 active" id="settings">
                {{-- <form role="form" action="{{  route('membership.update', ['aid' => $account->id,'id' => $friend->id])  }}" method="POST" enctype="multipart/form-data"> --}}
                <form role="form" action="/accounts/{{ $account->id }}/membership/{{ $friend->id }}/update" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input id="firstName" name="name" class="form-control" type="hidden" placeholder="ユーザー名" value="{{ $friend->name }}">
                  <div class="mb-3">
                    <label class="form-label">メールアドレス<span class="text-third">(必須)</span></label>
                    <div class="input-group">
                      <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com" value="{{ $friend->email }}" oninvalid="this.setCustomValidity('こちらは必須項目です。')" onchange="this.setCustomValidity('')" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">電話番号<span class="text-third">(任意)</span></label>
                    <div class="input-group">
                      <input id="phone" name="phone" class="form-control" type="tel" placeholder="090-9999-8888" value="{{ $friend->phone }}">
                    </div>
                  </div>
                  <div class="col-sm-8 mb-3">
                    <div class="row">
                      <div class="col-sm-5 col-5">
                        <label class="form-label mt-4">お誕生日<span class="text-third">(必須)</span></label>
                        <input type="text" name="" id="birth-date" value="{{ $friend->birthday }}" hidden >
                        <select name="dob-year" id="dob-year" class="form-control" required>
                          <option value="" disabled></option>
                          <option value="" >未選択</option>
                          <option value="2015">2015</option>
                          <option value="2014">2014</option>
                          <option value="2013">2013</option>
                          <option value="2012">2012</option>
                          <option value="2011">2011</option>
                          <option value="2010">2010</option>
                          <option value="2009">2009</option>
                          <option value="2008">2008</option>
                          <option value="2007">2007</option>
                          <option value="2006">2006</option>
                          <option value="2005">2005</option>
                          <option value="2004">2004</option>
                          <option value="2003">2003</option>
                          <option value="2002">2002</option>
                          <option value="2001">2001</option>
                          <option value="2000">2000</option>
                          <option value="1999">1999</option>
                          <option value="1998">1998</option>
                          <option value="1997">1997</option>
                          <option value="1996">1996</option>
                          <option value="1995">1995</option>
                          <option value="1994">1994</option>
                          <option value="1993">1993</option>
                          <option value="1992">1992</option>
                          <option value="1991">1991</option>
                          <option value="1990">1990</option>
                          <option value="1989">1989</option>
                          <option value="1988">1988</option>
                          <option value="1987">1987</option>
                          <option value="1986">1986</option>
                          <option value="1985">1985</option>
                          <option value="1984">1984</option>
                          <option value="1983">1983</option>
                          <option value="1982">1982</option>
                          <option value="1981">1981</option>
                          <option value="1980">1980</option>
                          <option value="1979">1979</option>
                          <option value="1978">1978</option>
                          <option value="1977">1977</option>
                          <option value="1976">1976</option>
                          <option value="1975">1975</option>
                          <option value="1974">1974</option>
                          <option value="1973">1973</option>
                          <option value="1972">1972</option>
                          <option value="1971">1971</option>
                          <option value="1970">1970</option>
                          <option value="1969">1969</option>
                          <option value="1968">1968</option>
                          <option value="1967">1967</option>
                          <option value="1966">1966</option>
                          <option value="1965">1965</option>
                          <option value="1964">1964</option>
                          <option value="1963">1963</option>
                          <option value="1962">1962</option>
                          <option value="1961">1961</option>
                          <option value="1960">1960</option>
                          <option value="1959">1959</option>
                          <option value="1958">1958</option>
                          <option value="1957">1957</option>
                          <option value="1956">1956</option>
                          <option value="1955">1955</option>
                          <option value="1954">1954</option>
                          <option value="1953">1953</option>
                          <option value="1952">1952</option>
                          <option value="1951">1951</option>
                          <option value="1950">1950</option>
                          <option value="1949">1949</option>
                          <option value="1948">1948</option>
                          <option value="1947">1947</option>
                          <option value="1946">1946</option>
                          <option value="1945">1945</option>
                          <option value="1944">1944</option>
                          <option value="1943">1943</option>
                          <option value="1942">1942</option>
                          <option value="1941">1941</option>
                          <option value="1940">1940</option>
                          <option value="1939">1939</option>
                          <option value="1938">1938</option>
                          <option value="1937">1937</option>
                          <option value="1936">1936</option>
                          <option value="1935">1935</option>
                          <option value="1934">1934</option>
                          <option value="1933">1933</option>
                          <option value="1932">1932</option>
                          <option value="1931">1931</option>
                          <option value="1930">1930</option>
                          <option value="1929">1929</option>
                          <option value="1928">1928</option>
                          <option value="1927">1927</option>
                          <option value="1926">1926</option>
                          <option value="1925">1925</option>
                          <option value="1924">1924</option>
                          <option value="1923">1923</option>
                          <option value="1922">1922</option>
                          <option value="1921">1921</option>
                          <option value="1920">1920</option>
                          <option value="1919">1919</option>
                          <option value="1918">1918</option>
                          <option value="1917">1917</option>
                          <option value="1916">1916</option>
                          <option value="1915">1915</option>
                          <option value="1914">1914</option>
                          <option value="1913">1913</option>
                          <option value="1912">1912</option>
                          <option value="1911">1911</option>
                          <option value="1910">1910</option>
                          <option value="1909">1909</option>
                          <option value="1908">1908</option>
                          <option value="1907">1907</option>
                          <option value="1906">1906</option>
                          <option value="1905">1905</option>
                          <option value="1904">1904</option>
                          <option value="1903">1903</option>
                          <option value="1902">1901</option>
                          <option value="1901">1901</option>
                          <option value="1900">1900</option>
                        </select>
                      </div>
                      <div class="col-sm-4 col-3">
                        <label class="form-label mt-4">&nbsp;</label>
                        <select name="dob-month" id="dob-month" class="form-control" required>
                          <option value="" disabled>月</option>
                          <option value="">未選択</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                        </select>
                      </div>
                      <div class="col-sm-3 col-4">
                        <label class="form-label mt-4">&nbsp;</label>
                        <select name="dob-day" id="dob-day" class="form-control" required>
                          <option value="" disabled>日</option>
                          <option value="">未選択</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-6">
                    <label class="form-label">性別<span class="text-third">(任意)</span></label>
                    <select class="form-control" name="gender" id="choices-gender" >
                      <option value="male" {{$friend->gender == 'male'  ? 'selected' : ''}}>男性</option>
                      <option value="female" {{$friend->gender == 'female'  ? 'selected' : ''}}>女性</option>
                    </select>
                    </div>
                    <div class="col-6">
                      <label class="form-label">郵便番号<span class="text-third">(任意)</span></label>
                      <div class="input-group">
                        <input id="location" name="postcode" class="form-control" type="text" placeholder="000-0000" value="{{ $friend->postcode }}">
                      </div>
                    </div>
                  </div>
                  <div class="form-check form-check-info text-start">
                    <input class="form-check-input" type="checkbox" name="checkbox" value="checkbox" id="flexCheckDefault" checked required>
                    <label class="form-check-label" for="flexCheckDefault">
                      <a href="/accounts/{{ $account->id }}/membership/privacy" class="text-dark font-weight-bolder">個人情報の取り扱い</a>に同意します。
                    </label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">登録</button>
                  </div>
                </form>
              </div>
              <div class="mem-content card-body pt-0" id="orders">
                  <div class="col-md-10 mx-auto">
                    <div class="accordion-body p-0">
                      <div class="mem-order-accordion">
                        <div class="mem-order-container">
                          <div class="mem-order-label">2022年3月1日</div>
                          <div class="mem-order-content">
                            <h6>受取店舗</h6>
                            <p>
                              Restaurant Name here
                            </p>
                            <h6>受取時間</h6>
                            <p>
                              11:30 ~ 11:45
                            </p>
                            <h6>支払方法</h6>
                            <p>
                              Payment method
                            </p>
                            <h6>注文商品</h6>
                            <p>
                              Orders
                            </p>
                            <h6>合計税込</h6>
                            <p>
                              1780円
                            </p>
                          </div>
                        </div>
                        <hr>
                        <div class="mem-order-container">
                          <div class="mem-order-label">2022年3月1日</div>
                          <div class="mem-order-content">
                            <h6>受取店舗</h6>
                            <p>
                              Restaurant Name here
                            </p>
                            <h6>受取時間</h6>
                            <p>
                              11:30 ~ 11:45
                            </p>
                            <h6>支払方法</h6>
                            <p>
                              Payment method
                            </p>
                            <h6>注文商品</h6>
                            <p>
                              Orders
                            </p>
                            <h6>合計税込</h6>
                            <p>
                              1780円
                            </p>
                          </div>
                        </div>
                        <hr>
                        <div class="mem-order-container">
                          <div class="mem-order-label">2022年3月1日</div>
                          <div class="mem-order-content">
                            <h6>受取店舗</h6>
                            <p>
                              Restaurant Name here
                            </p>
                            <h6>受取時間</h6>
                            <p>
                              11:30 ~ 11:45
                            </p>
                            <h6>支払方法</h6>
                            <p>
                              Payment method
                            </p>
                            <h6>注文商品</h6>
                            <p>
                              Orders
                            </p>
                            <h6>合計税込</h6>
                            <p>
                              1780円
                            </p>
                          </div>
                        </div>
                        <hr>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="mem-content card-body" id="card">
                @if ($friend->email)
                  <div class="qrcode-container">
                    <div class="qrcocde">{!! DNS2D::getBarcodeHTML(url('/') . '/accounts/1/friends/{{ $friend->id }}', 'QRCODE',5,5) !!}</div>
                  </div>
                  <p class="text-center mt-2">この画面をご提示ください</p>
                  <div class="id-container ">
                    <p>会員番号 : <br> {{ $account->name }}-00{{ $friend->id}}</p>
                    <p>識別番号 : <br> {{ $friend->line_id}}</p>
                  </div>
                @else
                  <p class="text-center mt-2">会員登録がされてません。<br> 登録後、会員画面が表示されます。</p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    <!-- LIFF ID ERROR -->
    <div id="liffIdErrorMessage" class="hide-content">
        <p>You have not assigned any value for LIFF ID.</p>
        <p>If you are running the app using Node.js, please set the LIFF ID as an environment variable in your Heroku account follwing the below steps: </p>
        <code id="code-block">
            <ol>
                <li>Go to `Dashboard` in your Heroku account.</li>
                <li>Click on the app you just created.</li>
                <li>Click on `Settings` and toggle `Reveal Config Vars`.</li>
                <li>Set `MY_LIFF_ID` as the key and the LIFF ID as the value.</li>
                <li>Your app should be up and running. Enter the URL of your app in a web browser.</li>
            </ol>
        </code>
        <p>If you are using any other platform, please add your LIFF ID in the <code>index.html</code> file.</p>
        <p>For more information about how to add your LIFF ID, see <a href="https://developers.line.biz/en/reference/liff/#initialize-liff-app">Initializing the LIFF app</a>.</p>
    </div>
    <!-- LIFF INIT ERROR -->
    <div id="liffInitErrorMessage" class="hide-content">
        <p>Something went wrong with LIFF initialization.</p>
        <p>LIFF initialization can fail if a user clicks "Cancel" on the "Grant permission" screen, or if an error occurs in the process of <code>liff.init()</code>.</p>
    </div>
    <!-- NODE.JS LIFF ID ERROR -->
    <div id="nodeLiffIdErrorMessage" class="hide-content">
        <p>Unable to receive the LIFF ID as an environment variable.</p>
    </div>



  </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <!-- Kanban scripts -->
  <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }



    let dateHidden = document.querySelector('#birth-date');
    if (dateHidden.value != null) {
    const [yyyy,mm,dd] = dateHidden.value.split("-");
    document.getElementById("dob-year").value=yyyy;
    document.getElementById("dob-month").value=mm;
    document.getElementById("dob-day").value=dd;
    } 



    const btns = document.querySelectorAll('.mem-tab-btn');
    const card = document.querySelector('.card');
    const articles = document.querySelectorAll('.mem-content');
    card.addEventListener('click', function(e){
      const id = e.target.dataset.memtab;
      if(id){
        // remove active from other buttons
        btns.forEach(function(btn){
          btn.classList.remove("active");
          e.target.classList.add("active");
        })
        // hide other articles
        articles.forEach(function(article){
          article.classList.remove("active");
        })
        const element = document.getElementById(id);
        element.classList.add("active");
      }
    })

    const accordion = document.getElementsByClassName('mem-order-container');

    for (i=0; i<accordion.length; i++) {
      accordion[i].addEventListener('click', function () {
        this.classList.toggle('active')
      })
    }

  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.0') }}"></script>
  <!-- LIFF -->
  <script>    
      const defaultLiffId = {!! json_encode($account->liff_tall) !!};
  </script>
  <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
  <script src="../../../liff/liff-starter.js"></script>
</body>

</html>