<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    {{ $account->name }}の会員登録
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
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
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


    
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
      style="background-color: {{ $account->accountSetting->membership_background }}; background-position: top;">
      {{-- <span class="mask bg-gradient-dark opacity-6"></span> --}}
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2">プロフィール</h1>
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
              <div class="col-4 ms-auto px-1">
                <button class="mem-tab-btn btn btn-outline-light w-100 mb-0 active" data-memtab="settings">
                  基本情報
                </button>
              </div>
              <div class="col-4 px-1">
                <button class="mem-tab-btn btn btn-outline-light w-100 mb-0" data-memtab="orders">
                  注文履歴
                </button>
              </div>
              <div class="col-4 me-auto px-1">
                <button class="mem-tab-btn btn btn-outline-light w-100 mb-0" data-memtab="card">
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
              <form role="form" action="{{  route('friends.update', ['aid' => $account->id,'friend'=>$friend->id])  }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input id="firstName" name="name" class="form-control" type="hidden" placeholder="ユーザー名" value="{{ $friend->name }}">
                <div class="mb-3">
                  <label class="form-label">メールアドレス（必須）</label>
                  <div class="input-group">
                    <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com" value="{{ $friend->email }}" oninvalid="this.setCustomValidity('こちらは必須項目です。')" required>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">電話番号（任意）</label>
                  <div class="input-group">
                    <input id="phone" name="phone" class="form-control" type="tel" placeholder="090-9999-8888" value="{{ $friend->phone }}">
                  </div>
                </div>
                <div class="col-sm-8 mb-3">
                  <div class="row">
                    <div class="col-sm-5 col-5">
                      <label class="form-label">お誕生日（必須）</label>
                        <select name="dob-year" id="dob-year" class="form-control" oninvalid="this.setCustomValidity('こちらは必須項目です。')" required>
                          <option value="">年</option>
                          <option value="2015" {{date("Y", strtotime($friend->birthday)) == '2015'  ? 'selected' : ''}}>2015</option>
                          <option value="2014" {{date("Y", strtotime($friend->birthday)) == '2014'  ? 'selected' : ''}}>2014</option>
                          <option value="2013" {{date("Y", strtotime($friend->birthday)) == '2013'  ? 'selected' : ''}}>2013</option>
                          <option value="2012" {{date("Y", strtotime($friend->birthday)) == '2012'  ? 'selected' : ''}}>2012</option>
                          <option value="2011" {{date("Y", strtotime($friend->birthday)) == '2011'  ? 'selected' : ''}}>2011</option>
                          <option value="2010" {{date("Y", strtotime($friend->birthday)) == '2010'  ? 'selected' : ''}}>2010</option>
                          <option value="2009" {{date("Y", strtotime($friend->birthday)) == '2009'  ? 'selected' : ''}}>2009</option>
                          <option value="2008" {{date("Y", strtotime($friend->birthday)) == '2008'  ? 'selected' : ''}}>2008</option>
                          <option value="2007" {{date("Y", strtotime($friend->birthday)) == '2007'  ? 'selected' : ''}}>2007</option>
                          <option value="2006" {{date("Y", strtotime($friend->birthday)) == '2006'  ? 'selected' : ''}}>2006</option>
                          <option value="2005" {{date("Y", strtotime($friend->birthday)) == '2005'  ? 'selected' : ''}}>2005</option>
                          <option value="2004" {{date("Y", strtotime($friend->birthday)) == '2004'  ? 'selected' : ''}}>2004</option>
                          <option value="2003" {{date("Y", strtotime($friend->birthday)) == '2003'  ? 'selected' : ''}}>2003</option>
                          <option value="2002" {{date("Y", strtotime($friend->birthday)) == '2002'  ? 'selected' : ''}}>2002</option>
                          <option value="2001" {{date("Y", strtotime($friend->birthday)) == '2001'  ? 'selected' : ''}}>2001</option>
                          <option value="2000" {{date("Y", strtotime($friend->birthday)) == '2000'  ? 'selected' : ''}}>2000</option>
                          <option value="1999" {{date("Y", strtotime($friend->birthday)) == '1999'  ? 'selected' : ''}}>1999</option>
                          <option value="1998" {{date("Y", strtotime($friend->birthday)) == '1998'  ? 'selected' : ''}}>1998</option>
                          <option value="1997" {{date("Y", strtotime($friend->birthday)) == '1997'  ? 'selected' : ''}}>1997</option>
                          <option value="1996" {{date("Y", strtotime($friend->birthday)) == '1996'  ? 'selected' : ''}}>1996</option>
                          <option value="1995" {{date("Y", strtotime($friend->birthday)) == '1995'  ? 'selected' : ''}}>1995</option>
                          <option value="1994" {{date("Y", strtotime($friend->birthday)) == '1994'  ? 'selected' : ''}}>1994</option>
                          <option value="1993" {{date("Y", strtotime($friend->birthday)) == '1993'  ? 'selected' : ''}}>1993</option>
                          <option value="1992" {{date("Y", strtotime($friend->birthday)) == '1992'  ? 'selected' : ''}}>1992</option>
                          <option value="1991" {{date("Y", strtotime($friend->birthday)) == '1991'  ? 'selected' : ''}}>1991</option>
                          <option value="1990" {{date("Y", strtotime($friend->birthday)) == '1990'  ? 'selected' : ''}}>1990</option>
                          <option value="1989" {{date("Y", strtotime($friend->birthday)) == '1989'  ? 'selected' : ''}}>1989</option>
                          <option value="1988" {{date("Y", strtotime($friend->birthday)) == '1988'  ? 'selected' : ''}}>1988</option>
                          <option value="1987" {{date("Y", strtotime($friend->birthday)) == '1987'  ? 'selected' : ''}}>1987</option>
                          <option value="1986" {{date("Y", strtotime($friend->birthday)) == '1986'  ? 'selected' : ''}}>1986</option>
                          <option value="1985" {{date("Y", strtotime($friend->birthday)) == '1985'  ? 'selected' : ''}}>1985</option>
                          <option value="1984" {{date("Y", strtotime($friend->birthday)) == '1984'  ? 'selected' : ''}}>1984</option>
                          <option value="1983" {{date("Y", strtotime($friend->birthday)) == '1983'  ? 'selected' : ''}}>1983</option>
                          <option value="1982" {{date("Y", strtotime($friend->birthday)) == '1982'  ? 'selected' : ''}}>1982</option>
                          <option value="1981" {{date("Y", strtotime($friend->birthday)) == '1981'  ? 'selected' : ''}}>1981</option>
                          <option value="1980" {{date("Y", strtotime($friend->birthday)) == '1980'  ? 'selected' : ''}}>1980</option>
                          <option value="1979" {{date("Y", strtotime($friend->birthday)) == '1979'  ? 'selected' : ''}}>1979</option>
                          <option value="1978" {{date("Y", strtotime($friend->birthday)) == '1978'  ? 'selected' : ''}}>1978</option>
                          <option value="1977" {{date("Y", strtotime($friend->birthday)) == '1977'  ? 'selected' : ''}}>1977</option>
                          <option value="1976" {{date("Y", strtotime($friend->birthday)) == '1976'  ? 'selected' : ''}}>1976</option>
                          <option value="1975" {{date("Y", strtotime($friend->birthday)) == '1975'  ? 'selected' : ''}}>1975</option>
                          <option value="1974" {{date("Y", strtotime($friend->birthday)) == '1974'  ? 'selected' : ''}}>1974</option>
                          <option value="1973" {{date("Y", strtotime($friend->birthday)) == '1973'  ? 'selected' : ''}}>1973</option>
                          <option value="1972" {{date("Y", strtotime($friend->birthday)) == '1972'  ? 'selected' : ''}}>1972</option>
                          <option value="1971" {{date("Y", strtotime($friend->birthday)) == '1971'  ? 'selected' : ''}}>1971</option>
                          <option value="1970" {{date("Y", strtotime($friend->birthday)) == '1970'  ? 'selected' : ''}}>1970</option>
                          <option value="1969" {{date("Y", strtotime($friend->birthday)) == '1969'  ? 'selected' : ''}}>1969</option>
                          <option value="1968" {{date("Y", strtotime($friend->birthday)) == '1968'  ? 'selected' : ''}}>1968</option>
                          <option value="1967" {{date("Y", strtotime($friend->birthday)) == '1967'  ? 'selected' : ''}}>1967</option>
                          <option value="1966" {{date("Y", strtotime($friend->birthday)) == '1966'  ? 'selected' : ''}}>1966</option>
                          <option value="1965" {{date("Y", strtotime($friend->birthday)) == '1965'  ? 'selected' : ''}}>1965</option>
                          <option value="1964" {{date("Y", strtotime($friend->birthday)) == '1964'  ? 'selected' : ''}}>1964</option>
                          <option value="1963" {{date("Y", strtotime($friend->birthday)) == '1963'  ? 'selected' : ''}}>1963</option>
                          <option value="1962" {{date("Y", strtotime($friend->birthday)) == '1962'  ? 'selected' : ''}}>1962</option>
                          <option value="1961" {{date("Y", strtotime($friend->birthday)) == '1961'  ? 'selected' : ''}}>1961</option>
                          <option value="1960" {{date("Y", strtotime($friend->birthday)) == '1960'  ? 'selected' : ''}}>1960</option>
                          <option value="1959" {{date("Y", strtotime($friend->birthday)) == '1959'  ? 'selected' : ''}}>1959</option>
                          <option value="1958" {{date("Y", strtotime($friend->birthday)) == '1958'  ? 'selected' : ''}}>1958</option>
                          <option value="1957" {{date("Y", strtotime($friend->birthday)) == '1957'  ? 'selected' : ''}}>1957</option>
                          <option value="1956" {{date("Y", strtotime($friend->birthday)) == '1956'  ? 'selected' : ''}}>1956</option>
                          <option value="1955" {{date("Y", strtotime($friend->birthday)) == '1955'  ? 'selected' : ''}}>1955</option>
                          <option value="1954" {{date("Y", strtotime($friend->birthday)) == '1954'  ? 'selected' : ''}}>1954</option>
                          <option value="1953" {{date("Y", strtotime($friend->birthday)) == '1953'  ? 'selected' : ''}}>1953</option>
                          <option value="1952" {{date("Y", strtotime($friend->birthday)) == '1952'  ? 'selected' : ''}}>1952</option>
                          <option value="1951" {{date("Y", strtotime($friend->birthday)) == '1951'  ? 'selected' : ''}}>1951</option>
                          <option value="1950" {{date("Y", strtotime($friend->birthday)) == '1950'  ? 'selected' : ''}}>1950</option>
                          <option value="1949" {{date("Y", strtotime($friend->birthday)) == '1949'  ? 'selected' : ''}}>1949</option>
                          <option value="1948" {{date("Y", strtotime($friend->birthday)) == '1948'  ? 'selected' : ''}}>1948</option>
                          <option value="1947" {{date("Y", strtotime($friend->birthday)) == '1947'  ? 'selected' : ''}}>1947</option>
                          <option value="1946" {{date("Y", strtotime($friend->birthday)) == '1946'  ? 'selected' : ''}}>1946</option>
                          <option value="1945" {{date("Y", strtotime($friend->birthday)) == '1945'  ? 'selected' : ''}}>1945</option>
                          <option value="1944" {{date("Y", strtotime($friend->birthday)) == '1944'  ? 'selected' : ''}}>1944</option>
                          <option value="1943" {{date("Y", strtotime($friend->birthday)) == '1943'  ? 'selected' : ''}}>1943</option>
                          <option value="1942" {{date("Y", strtotime($friend->birthday)) == '1942'  ? 'selected' : ''}}>1942</option>
                          <option value="1941" {{date("Y", strtotime($friend->birthday)) == '1941'  ? 'selected' : ''}}>1941</option>
                          <option value="1940" {{date("Y", strtotime($friend->birthday)) == '1940'  ? 'selected' : ''}}>1940</option>
                          <option value="1939" {{date("Y", strtotime($friend->birthday)) == '1939'  ? 'selected' : ''}}>1939</option>
                          <option value="1938" {{date("Y", strtotime($friend->birthday)) == '1938'  ? 'selected' : ''}}>1938</option>
                          <option value="1937" {{date("Y", strtotime($friend->birthday)) == '1937'  ? 'selected' : ''}}>1937</option>
                          <option value="1936" {{date("Y", strtotime($friend->birthday)) == '1936'  ? 'selected' : ''}}>1936</option>
                          <option value="1935" {{date("Y", strtotime($friend->birthday)) == '1935'  ? 'selected' : ''}}>1935</option>
                          <option value="1934" {{date("Y", strtotime($friend->birthday)) == '1934'  ? 'selected' : ''}}>1934</option>
                          <option value="1933" {{date("Y", strtotime($friend->birthday)) == '1933'  ? 'selected' : ''}}>1933</option>
                          <option value="1932" {{date("Y", strtotime($friend->birthday)) == '1932'  ? 'selected' : ''}}>1932</option>
                          <option value="1931" {{date("Y", strtotime($friend->birthday)) == '1931'  ? 'selected' : ''}}>1931</option>
                          <option value="1930" {{date("Y", strtotime($friend->birthday)) == '1930'  ? 'selected' : ''}}>1930</option>
                          <option value="1929" {{date("Y", strtotime($friend->birthday)) == '1929'  ? 'selected' : ''}}>1929</option>
                          <option value="1928" {{date("Y", strtotime($friend->birthday)) == '1928'  ? 'selected' : ''}}>1928</option>
                          <option value="1927" {{date("Y", strtotime($friend->birthday)) == '1927'  ? 'selected' : ''}}>1927</option>
                          <option value="1926" {{date("Y", strtotime($friend->birthday)) == '1926'  ? 'selected' : ''}}>1926</option>
                          <option value="1925" {{date("Y", strtotime($friend->birthday)) == '1925'  ? 'selected' : ''}}>1925</option>
                          <option value="1924" {{date("Y", strtotime($friend->birthday)) == '1924'  ? 'selected' : ''}}>1924</option>
                          <option value="1923" {{date("Y", strtotime($friend->birthday)) == '1923'  ? 'selected' : ''}}>1923</option>
                          <option value="1922" {{date("Y", strtotime($friend->birthday)) == '1922'  ? 'selected' : ''}}>1922</option>
                          <option value="1921" {{date("Y", strtotime($friend->birthday)) == '1921'  ? 'selected' : ''}}>1921</option>
                          <option value="1920" {{date("Y", strtotime($friend->birthday)) == '1920'  ? 'selected' : ''}}>1920</option>
                          <option value="1919" {{date("Y", strtotime($friend->birthday)) == '1919'  ? 'selected' : ''}}>1919</option>
                          <option value="1918" {{date("Y", strtotime($friend->birthday)) == '1918'  ? 'selected' : ''}}>1918</option>
                          <option value="1917" {{date("Y", strtotime($friend->birthday)) == '1917'  ? 'selected' : ''}}>1917</option>
                          <option value="1916" {{date("Y", strtotime($friend->birthday)) == '1916'  ? 'selected' : ''}}>1916</option>
                          <option value="1915" {{date("Y", strtotime($friend->birthday)) == '1915'  ? 'selected' : ''}}>1915</option>
                          <option value="1914" {{date("Y", strtotime($friend->birthday)) == '1914'  ? 'selected' : ''}}>1914</option>
                          <option value="1913" {{date("Y", strtotime($friend->birthday)) == '1913'  ? 'selected' : ''}}>1913</option>
                          <option value="1912" {{date("Y", strtotime($friend->birthday)) == '1912'  ? 'selected' : ''}}>1912</option>
                          <option value="1911" {{date("Y", strtotime($friend->birthday)) == '1911'  ? 'selected' : ''}}>1911</option>
                          <option value="1910" {{date("Y", strtotime($friend->birthday)) == '1910'  ? 'selected' : ''}}>1910</option>
                          <option value="1909" {{date("Y", strtotime($friend->birthday)) == '1909'  ? 'selected' : ''}}>1909</option>
                          <option value="1908" {{date("Y", strtotime($friend->birthday)) == '1908'  ? 'selected' : ''}}>1908</option>
                          <option value="1907" {{date("Y", strtotime($friend->birthday)) == '1907'  ? 'selected' : ''}}>1907</option>
                          <option value="1906" {{date("Y", strtotime($friend->birthday)) == '1906'  ? 'selected' : ''}}>1906</option>
                          <option value="1905" {{date("Y", strtotime($friend->birthday)) == '1905'  ? 'selected' : ''}}>1905</option>
                          <option value="1904" {{date("Y", strtotime($friend->birthday)) == '1904'  ? 'selected' : ''}}>1904</option>
                          <option value="1903" {{date("Y", strtotime($friend->birthday)) == '1903'  ? 'selected' : ''}}>1903</option>
                          <option value="1902" {{date("Y", strtotime($friend->birthday)) == '1902'  ? 'selected' : ''}}>1901</option>
                          <option value="1901" {{date("Y", strtotime($friend->birthday)) == '1901'  ? 'selected' : ''}}>1901</option>
                          <option value="1900" {{date("Y", strtotime($friend->birthday)) == '1900'  ? 'selected' : ''}}>1900</option>
                        </select>
                    </div>
                    <div class="col-sm-4 col-3">
                      <label class="form-label">&nbsp;</label>
                        <select name="dob-month" id="dob-month" class="form-control" oninvalid="this.setCustomValidity('こちらは必須項目です。')" required>
                          <option value="">月</option>
                          <option value="01" {{date("F", strtotime($friend->birthday)) == 'January'  ? 'selected' : ''}}>01</option>
                          <option value="02" {{date("F", strtotime($friend->birthday)) == 'February'  ? 'selected' : ''}}>02</option>
                          <option value="03" {{date("F", strtotime($friend->birthday)) == 'March'  ? 'selected' : ''}}>03</option>
                          <option value="04" {{date("F", strtotime($friend->birthday)) == 'April'  ? 'selected' : ''}}>04</option>
                          <option value="05" {{date("F", strtotime($friend->birthday)) == 'May'  ? 'selected' : ''}}>05</option>
                          <option value="06" {{date("F", strtotime($friend->birthday)) == 'June'  ? 'selected' : ''}}>06</option>
                          <option value="07" {{date("F", strtotime($friend->birthday)) == 'July'  ? 'selected' : ''}}>07</option>
                          <option value="08" {{date("F", strtotime($friend->birthday)) == 'August'  ? 'selected' : ''}}>08</option>
                          <option value="09" {{date("F", strtotime($friend->birthday)) == 'September'  ? 'selected' : ''}}>09</option>
                          <option value="10" {{date("F", strtotime($friend->birthday)) == 'October'  ? 'selected' : ''}}>10</option>
                          <option value="11" {{date("F", strtotime($friend->birthday)) == 'November'  ? 'selected' : ''}}>11</option>
                          <option value="12" {{date("F", strtotime($friend->birthday)) == 'December'  ? 'selected' : ''}}>12</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-4">
                      <label class="form-label">&nbsp;</label>
                        <select name="dob-day" id="dob-day" class="form-control" oninvalid="this.setCustomValidity('こちらは必須項目です。')" required>
                          <option value="">日</option>
                          <option value="01" {{date("d", strtotime($friend->birthday)) == '01'  ? 'selected' : ''}}>01</option>
                          <option value="02" {{date("d", strtotime($friend->birthday)) == '02'  ? 'selected' : ''}}>02</option>
                          <option value="03" {{date("d", strtotime($friend->birthday)) == '03'  ? 'selected' : ''}}>03</option>
                          <option value="04" {{date("d", strtotime($friend->birthday)) == '04'  ? 'selected' : ''}}>04</option>
                          <option value="05" {{date("d", strtotime($friend->birthday)) == '05'  ? 'selected' : ''}}>05</option>
                          <option value="06" {{date("d", strtotime($friend->birthday)) == '06'  ? 'selected' : ''}}>06</option>
                          <option value="07" {{date("d", strtotime($friend->birthday)) == '07'  ? 'selected' : ''}}>07</option>
                          <option value="08" {{date("d", strtotime($friend->birthday)) == '08'  ? 'selected' : ''}}>08</option>
                          <option value="09" {{date("d", strtotime($friend->birthday)) == '09'  ? 'selected' : ''}}>09</option>
                          <option value="10" {{date("d", strtotime($friend->birthday)) == '10'  ? 'selected' : ''}}>10</option>
                          <option value="11" {{date("d", strtotime($friend->birthday)) == '11'  ? 'selected' : ''}}>11</option>
                          <option value="12" {{date("d", strtotime($friend->birthday)) == '12'  ? 'selected' : ''}}>12</option>
                          <option value="13" {{date("d", strtotime($friend->birthday)) == '13'  ? 'selected' : ''}}>13</option>
                          <option value="14" {{date("d", strtotime($friend->birthday)) == '14'  ? 'selected' : ''}}>14</option>
                          <option value="15" {{date("d", strtotime($friend->birthday)) == '15'  ? 'selected' : ''}}>15</option>
                          <option value="16" {{date("d", strtotime($friend->birthday)) == '16'  ? 'selected' : ''}}>16</option>
                          <option value="17" {{date("d", strtotime($friend->birthday)) == '17'  ? 'selected' : ''}}>17</option>
                          <option value="18" {{date("d", strtotime($friend->birthday)) == '18'  ? 'selected' : ''}}>18</option>
                          <option value="19" {{date("d", strtotime($friend->birthday)) == '19'  ? 'selected' : ''}}>19</option>
                          <option value="20" {{date("d", strtotime($friend->birthday)) == '20'  ? 'selected' : ''}}>20</option>
                          <option value="21" {{date("d", strtotime($friend->birthday)) == '21'  ? 'selected' : ''}}>21</option>
                          <option value="22" {{date("d", strtotime($friend->birthday)) == '22'  ? 'selected' : ''}}>22</option>
                          <option value="23" {{date("d", strtotime($friend->birthday)) == '23'  ? 'selected' : ''}}>23</option>
                          <option value="24" {{date("d", strtotime($friend->birthday)) == '24'  ? 'selected' : ''}}>24</option>
                          <option value="25" {{date("d", strtotime($friend->birthday)) == '25'  ? 'selected' : ''}}>25</option>
                          <option value="26" {{date("d", strtotime($friend->birthday)) == '26'  ? 'selected' : ''}}>26</option>
                          <option value="27" {{date("d", strtotime($friend->birthday)) == '27'  ? 'selected' : ''}}>27</option>
                          <option value="28" {{date("d", strtotime($friend->birthday)) == '28'  ? 'selected' : ''}}>28</option>
                          <option value="29" {{date("d", strtotime($friend->birthday)) == '29'  ? 'selected' : ''}}>29</option>
                          <option value="30" {{date("d", strtotime($friend->birthday)) == '30'  ? 'selected' : ''}}>30</option>
                          <option value="31" {{date("d", strtotime($friend->birthday)) == '31'  ? 'selected' : ''}}>31</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-6">
                  <label class="form-label">性別（任意）</label>
                  <select class="form-control" name="gender" id="choices-gender" >
                    <option value="male" {{$friend->gender == 'male'  ? 'selected' : ''}}>男性</option>
                    <option value="female" {{$friend->gender == 'female'  ? 'selected' : ''}}>女性</option>
                  </select>
                  </div>
                  <div class="col-6">
                    <label class="form-label">郵便番号（任意）</label>
                    <div class="input-group">
                      <input id="location" name="postcode" class="form-control" type="text" placeholder="000-0000" value="{{ $friend->postcode }}">
                    </div>
                  </div>
                </div>


                <div class="form-check form-check-info text-start">
                  <input class="form-check-input" type="checkbox" name="checkbox" value="checkbox" id="flexCheckDefault" checked required>
                  <label class="form-check-label" for="flexCheckDefault">
                    <a href="{{ route('membership.privacy', ['aid' => $account->id]) }}" class="text-dark font-weight-bolder">個人情報の取り扱い</a>に同意します。
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
</body>

</html>