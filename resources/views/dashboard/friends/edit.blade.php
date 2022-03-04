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
      <div class="col-lg-3">
        <div class="card position-sticky top-1">
          <ul class="nav flex-column bg-white border-radius-lg p-3">
            <li class="nav-item">
              <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#profile">
                <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                <span class="text-sm">Profile</span>
              </a>
            </li>
            <li class="nav-item pt-2">
              <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info">
                <i class="ni ni-books me-2 text-dark opacity-6"></i>
                <span class="text-sm">Basic Info</span>
              </a>
            </li>
            <li class="nav-item pt-2">
              <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#notifications">
                <i class="ni ni-bell-55 me-2 text-dark opacity-6"></i>
                <span class="text-sm">Notifications</span>
              </a>
            </li>
            <li class="nav-item pt-2">
              <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#sessions">
                <i class="ni ni-watch-time me-2 text-dark opacity-6"></i>
                <span class="text-sm">Sessions</span>
              </a>
            </li>
            <li class="nav-item pt-2">
              <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#delete">
                <i class="ni ni-settings-gear-65 me-2 text-dark opacity-6"></i>
                <span class="text-sm">Delete Account</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-9 mt-lg-0 mt-4">
        <form action="{{  route('friends.update', ['aid' => $account->id,'friend'=>$friend->id])  }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <!-- Card Profile -->
          <div class="card card-body" id="profile">
            <div class="row justify-content-center align-items-center">
              <div class="col-sm-auto col-4">
                <div class="avatar avatar-sm position-relative">
                  <img src="{{ asset('uploads/profile-pic/' . $friend->image) }}" alt="bruce"
                    class="w-100 border-radius-lg shadow-sm">
                </div>
              </div>
              <div class="col-sm-auto col-8 my-auto">
                <div class="h-100">
                  <h5 class="mb-1 font-weight-bolder">
                    {{ $friend->name }}
                  </h5>
                  <p class="mb-0 font-weight-bold text-sm text-secondary">
                    登録日 {{ $friend->created_at->toDateString() }}
                  </p>
                </div>
              </div>
              <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                <label class="form-check-label mb-0">
                  <small id="profileVisibility">
                    Switch to invisible
                  </small>
                </label>
                <div class="form-check form-switch ms-2">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked
                    onchange="visible()">
                </div>
              </div>
            </div>
          </div>
          <!-- Card Basic Info -->
          <div class="card mt-4" id="basic-info">
            <div class="card-header">
              <h5>基本情報</h5>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-6">
                  <label class="form-label">ユーザー名<span class="text-third">(必須)</span></label>
                  <div class="input-group">
                    <input id="firstName" name="name" class="form-control" type="text" placeholder="ユーザー名"
                      value="{{ $friend->name }}">
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label">メールアドレス</label>
                  <div class="input-group">
                    <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com"
                      value="{{ $friend->email }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 col-6">
                  <label class="form-label mt-4">性別</label>
                  <select class="form-control" name="gender" id="choices-gender">
                    <option value="" {{$friend->gender == null ? 'selected' : ''}} disabled>未選択</option>
                    <option value="male" {{$friend->gender == 'male' ? 'selected' : ''}}>男性</option>
                    <option value="female" {{$friend->gender == 'female' ? 'selected' : ''}}>女性</option>
                  </select>
                </div>
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-sm-5 col-5">
                      <label class="form-label mt-4">お誕生日</label>
                      <input type="text" name="" id="birth-date" value="{{ $friend->birthday }}" >
                      <select name="dob-year" id="dob-year" class="form-control">
                        <option value="" disabled>年</option>
                        <option value="" disabled>----</option>
                        <option value="2015" {{date("Y", strtotime($friend->birthday)) == '2015' ? 'selected' :
                          ''}}>2015</option>
                        <option value="2014" {{date("Y", strtotime($friend->birthday)) == '2014' ? 'selected' :
                          ''}}>2014</option>
                        <option value="2013" {{date("Y", strtotime($friend->birthday)) == '2013' ? 'selected' :
                          ''}}>2013</option>
                        <option value="2012" {{date("Y", strtotime($friend->birthday)) == '2012' ? 'selected' :
                          ''}}>2012</option>
                        <option value="2011" {{date("Y", strtotime($friend->birthday)) == '2011' ? 'selected' :
                          ''}}>2011</option>
                        <option value="2010" {{date("Y", strtotime($friend->birthday)) == '2010' ? 'selected' :
                          ''}}>2010</option>
                        <option value="2009" {{date("Y", strtotime($friend->birthday)) == '2009' ? 'selected' :
                          ''}}>2009</option>
                        <option value="2008" {{date("Y", strtotime($friend->birthday)) == '2008' ? 'selected' :
                          ''}}>2008</option>
                        <option value="2007" {{date("Y", strtotime($friend->birthday)) == '2007' ? 'selected' :
                          ''}}>2007</option>
                        <option value="2006" {{date("Y", strtotime($friend->birthday)) == '2006' ? 'selected' :
                          ''}}>2006</option>
                        <option value="2005" {{date("Y", strtotime($friend->birthday)) == '2005' ? 'selected' :
                          ''}}>2005</option>
                        <option value="2004" {{date("Y", strtotime($friend->birthday)) == '2004' ? 'selected' :
                          ''}}>2004</option>
                        <option value="2003" {{date("Y", strtotime($friend->birthday)) == '2003' ? 'selected' :
                          ''}}>2003</option>
                        <option value="2002" {{date("Y", strtotime($friend->birthday)) == '2002' ? 'selected' :
                          ''}}>2002</option>
                        <option value="2001" {{date("Y", strtotime($friend->birthday)) == '2001' ? 'selected' :
                          ''}}>2001</option>
                        <option value="2000" {{date("Y", strtotime($friend->birthday)) == '2000' ? 'selected' :
                          ''}}>2000</option>
                        <option value="1999" {{date("Y", strtotime($friend->birthday)) == '1999' ? 'selected' :
                          ''}}>1999</option>
                        <option value="1998" {{date("Y", strtotime($friend->birthday)) == '1998' ? 'selected' :
                          ''}}>1998</option>
                        <option value="1997" {{date("Y", strtotime($friend->birthday)) == '1997' ? 'selected' :
                          ''}}>1997</option>
                        <option value="1996" {{date("Y", strtotime($friend->birthday)) == '1996' ? 'selected' :
                          ''}}>1996</option>
                        <option value="1995" {{date("Y", strtotime($friend->birthday)) == '1995' ? 'selected' :
                          ''}}>1995</option>
                        <option value="1994" {{date("Y", strtotime($friend->birthday)) == '1994' ? 'selected' :
                          ''}}>1994</option>
                        <option value="1993" {{date("Y", strtotime($friend->birthday)) == '1993' ? 'selected' :
                          ''}}>1993</option>
                        <option value="1992" {{date("Y", strtotime($friend->birthday)) == '1992' ? 'selected' :
                          ''}}>1992</option>
                        <option value="1991" {{date("Y", strtotime($friend->birthday)) == '1991' ? 'selected' :
                          ''}}>1991</option>
                        <option value="1990" {{date("Y", strtotime($friend->birthday)) == '1990' ? 'selected' :
                          ''}}>1990</option>
                        <option value="1989" {{date("Y", strtotime($friend->birthday)) == '1989' ? 'selected' :
                          ''}}>1989</option>
                        <option value="1988" {{date("Y", strtotime($friend->birthday)) == '1988' ? 'selected' :
                          ''}}>1988</option>
                        <option value="1987" {{date("Y", strtotime($friend->birthday)) == '1987' ? 'selected' :
                          ''}}>1987</option>
                        <option value="1986" {{date("Y", strtotime($friend->birthday)) == '1986' ? 'selected' :
                          ''}}>1986</option>
                        <option value="1985" {{date("Y", strtotime($friend->birthday)) == '1985' ? 'selected' :
                          ''}}>1985</option>
                        <option value="1984" {{date("Y", strtotime($friend->birthday)) == '1984' ? 'selected' :
                          ''}}>1984</option>
                        <option value="1983" {{date("Y", strtotime($friend->birthday)) == '1983' ? 'selected' :
                          ''}}>1983</option>
                        <option value="1982" {{date("Y", strtotime($friend->birthday)) == '1982' ? 'selected' :
                          ''}}>1982</option>
                        <option value="1981" {{date("Y", strtotime($friend->birthday)) == '1981' ? 'selected' :
                          ''}}>1981</option>
                        <option value="1980" {{date("Y", strtotime($friend->birthday)) == '1980' ? 'selected' :
                          ''}}>1980</option>
                        <option value="1979" {{date("Y", strtotime($friend->birthday)) == '1979' ? 'selected' :
                          ''}}>1979</option>
                        <option value="1978" {{date("Y", strtotime($friend->birthday)) == '1978' ? 'selected' :
                          ''}}>1978</option>
                        <option value="1977" {{date("Y", strtotime($friend->birthday)) == '1977' ? 'selected' :
                          ''}}>1977</option>
                        <option value="1976" {{date("Y", strtotime($friend->birthday)) == '1976' ? 'selected' :
                          ''}}>1976</option>
                        <option value="1975" {{date("Y", strtotime($friend->birthday)) == '1975' ? 'selected' :
                          ''}}>1975</option>
                        <option value="1974" {{date("Y", strtotime($friend->birthday)) == '1974' ? 'selected' :
                          ''}}>1974</option>
                        <option value="1973" {{date("Y", strtotime($friend->birthday)) == '1973' ? 'selected' :
                          ''}}>1973</option>
                        <option value="1972" {{date("Y", strtotime($friend->birthday)) == '1972' ? 'selected' :
                          ''}}>1972</option>
                        <option value="1971" {{date("Y", strtotime($friend->birthday)) == '1971' ? 'selected' :
                          ''}}>1971</option>
                        <option value="1970" {{date("Y", strtotime($friend->birthday)) == '1970' ? 'selected' :
                          ''}}>1970</option>
                        <option value="1969" {{date("Y", strtotime($friend->birthday)) == '1969' ? 'selected' :
                          ''}}>1969</option>
                        <option value="1968" {{date("Y", strtotime($friend->birthday)) == '1968' ? 'selected' :
                          ''}}>1968</option>
                        <option value="1967" {{date("Y", strtotime($friend->birthday)) == '1967' ? 'selected' :
                          ''}}>1967</option>
                        <option value="1966" {{date("Y", strtotime($friend->birthday)) == '1966' ? 'selected' :
                          ''}}>1966</option>
                        <option value="1965" {{date("Y", strtotime($friend->birthday)) == '1965' ? 'selected' :
                          ''}}>1965</option>
                        <option value="1964" {{date("Y", strtotime($friend->birthday)) == '1964' ? 'selected' :
                          ''}}>1964</option>
                        <option value="1963" {{date("Y", strtotime($friend->birthday)) == '1963' ? 'selected' :
                          ''}}>1963</option>
                        <option value="1962" {{date("Y", strtotime($friend->birthday)) == '1962' ? 'selected' :
                          ''}}>1962</option>
                        <option value="1961" {{date("Y", strtotime($friend->birthday)) == '1961' ? 'selected' :
                          ''}}>1961</option>
                        <option value="1960" {{date("Y", strtotime($friend->birthday)) == '1960' ? 'selected' :
                          ''}}>1960</option>
                        <option value="1959" {{date("Y", strtotime($friend->birthday)) == '1959' ? 'selected' :
                          ''}}>1959</option>
                        <option value="1958" {{date("Y", strtotime($friend->birthday)) == '1958' ? 'selected' :
                          ''}}>1958</option>
                        <option value="1957" {{date("Y", strtotime($friend->birthday)) == '1957' ? 'selected' :
                          ''}}>1957</option>
                        <option value="1956" {{date("Y", strtotime($friend->birthday)) == '1956' ? 'selected' :
                          ''}}>1956</option>
                        <option value="1955" {{date("Y", strtotime($friend->birthday)) == '1955' ? 'selected' :
                          ''}}>1955</option>
                        <option value="1954" {{date("Y", strtotime($friend->birthday)) == '1954' ? 'selected' :
                          ''}}>1954</option>
                        <option value="1953" {{date("Y", strtotime($friend->birthday)) == '1953' ? 'selected' :
                          ''}}>1953</option>
                        <option value="1952" {{date("Y", strtotime($friend->birthday)) == '1952' ? 'selected' :
                          ''}}>1952</option>
                        <option value="1951" {{date("Y", strtotime($friend->birthday)) == '1951' ? 'selected' :
                          ''}}>1951</option>
                        <option value="1950" {{date("Y", strtotime($friend->birthday)) == '1950' ? 'selected' :
                          ''}}>1950</option>
                        <option value="1949" {{date("Y", strtotime($friend->birthday)) == '1949' ? 'selected' :
                          ''}}>1949</option>
                        <option value="1948" {{date("Y", strtotime($friend->birthday)) == '1948' ? 'selected' :
                          ''}}>1948</option>
                        <option value="1947" {{date("Y", strtotime($friend->birthday)) == '1947' ? 'selected' :
                          ''}}>1947</option>
                        <option value="1946" {{date("Y", strtotime($friend->birthday)) == '1946' ? 'selected' :
                          ''}}>1946</option>
                        <option value="1945" {{date("Y", strtotime($friend->birthday)) == '1945' ? 'selected' :
                          ''}}>1945</option>
                        <option value="1944" {{date("Y", strtotime($friend->birthday)) == '1944' ? 'selected' :
                          ''}}>1944</option>
                        <option value="1943" {{date("Y", strtotime($friend->birthday)) == '1943' ? 'selected' :
                          ''}}>1943</option>
                        <option value="1942" {{date("Y", strtotime($friend->birthday)) == '1942' ? 'selected' :
                          ''}}>1942</option>
                        <option value="1941" {{date("Y", strtotime($friend->birthday)) == '1941' ? 'selected' :
                          ''}}>1941</option>
                        <option value="1940" {{date("Y", strtotime($friend->birthday)) == '1940' ? 'selected' :
                          ''}}>1940</option>
                        <option value="1939" {{date("Y", strtotime($friend->birthday)) == '1939' ? 'selected' :
                          ''}}>1939</option>
                        <option value="1938" {{date("Y", strtotime($friend->birthday)) == '1938' ? 'selected' :
                          ''}}>1938</option>
                        <option value="1937" {{date("Y", strtotime($friend->birthday)) == '1937' ? 'selected' :
                          ''}}>1937</option>
                        <option value="1936" {{date("Y", strtotime($friend->birthday)) == '1936' ? 'selected' :
                          ''}}>1936</option>
                        <option value="1935" {{date("Y", strtotime($friend->birthday)) == '1935' ? 'selected' :
                          ''}}>1935</option>
                        <option value="1934" {{date("Y", strtotime($friend->birthday)) == '1934' ? 'selected' :
                          ''}}>1934</option>
                        <option value="1933" {{date("Y", strtotime($friend->birthday)) == '1933' ? 'selected' :
                          ''}}>1933</option>
                        <option value="1932" {{date("Y", strtotime($friend->birthday)) == '1932' ? 'selected' :
                          ''}}>1932</option>
                        <option value="1931" {{date("Y", strtotime($friend->birthday)) == '1931' ? 'selected' :
                          ''}}>1931</option>
                        <option value="1930" {{date("Y", strtotime($friend->birthday)) == '1930' ? 'selected' :
                          ''}}>1930</option>
                        <option value="1929" {{date("Y", strtotime($friend->birthday)) == '1929' ? 'selected' :
                          ''}}>1929</option>
                        <option value="1928" {{date("Y", strtotime($friend->birthday)) == '1928' ? 'selected' :
                          ''}}>1928</option>
                        <option value="1927" {{date("Y", strtotime($friend->birthday)) == '1927' ? 'selected' :
                          ''}}>1927</option>
                        <option value="1926" {{date("Y", strtotime($friend->birthday)) == '1926' ? 'selected' :
                          ''}}>1926</option>
                        <option value="1925" {{date("Y", strtotime($friend->birthday)) == '1925' ? 'selected' :
                          ''}}>1925</option>
                        <option value="1924" {{date("Y", strtotime($friend->birthday)) == '1924' ? 'selected' :
                          ''}}>1924</option>
                        <option value="1923" {{date("Y", strtotime($friend->birthday)) == '1923' ? 'selected' :
                          ''}}>1923</option>
                        <option value="1922" {{date("Y", strtotime($friend->birthday)) == '1922' ? 'selected' :
                          ''}}>1922</option>
                        <option value="1921" {{date("Y", strtotime($friend->birthday)) == '1921' ? 'selected' :
                          ''}}>1921</option>
                        <option value="1920" {{date("Y", strtotime($friend->birthday)) == '1920' ? 'selected' :
                          ''}}>1920</option>
                        <option value="1919" {{date("Y", strtotime($friend->birthday)) == '1919' ? 'selected' :
                          ''}}>1919</option>
                        <option value="1918" {{date("Y", strtotime($friend->birthday)) == '1918' ? 'selected' :
                          ''}}>1918</option>
                        <option value="1917" {{date("Y", strtotime($friend->birthday)) == '1917' ? 'selected' :
                          ''}}>1917</option>
                        <option value="1916" {{date("Y", strtotime($friend->birthday)) == '1916' ? 'selected' :
                          ''}}>1916</option>
                        <option value="1915" {{date("Y", strtotime($friend->birthday)) == '1915' ? 'selected' :
                          ''}}>1915</option>
                        <option value="1914" {{date("Y", strtotime($friend->birthday)) == '1914' ? 'selected' :
                          ''}}>1914</option>
                        <option value="1913" {{date("Y", strtotime($friend->birthday)) == '1913' ? 'selected' :
                          ''}}>1913</option>
                        <option value="1912" {{date("Y", strtotime($friend->birthday)) == '1912' ? 'selected' :
                          ''}}>1912</option>
                        <option value="1911" {{date("Y", strtotime($friend->birthday)) == '1911' ? 'selected' :
                          ''}}>1911</option>
                        <option value="1910" {{date("Y", strtotime($friend->birthday)) == '1910' ? 'selected' :
                          ''}}>1910</option>
                        <option value="1909" {{date("Y", strtotime($friend->birthday)) == '1909' ? 'selected' :
                          ''}}>1909</option>
                        <option value="1908" {{date("Y", strtotime($friend->birthday)) == '1908' ? 'selected' :
                          ''}}>1908</option>
                        <option value="1907" {{date("Y", strtotime($friend->birthday)) == '1907' ? 'selected' :
                          ''}}>1907</option>
                        <option value="1906" {{date("Y", strtotime($friend->birthday)) == '1906' ? 'selected' :
                          ''}}>1906</option>
                        <option value="1905" {{date("Y", strtotime($friend->birthday)) == '1905' ? 'selected' :
                          ''}}>1905</option>
                        <option value="1904" {{date("Y", strtotime($friend->birthday)) == '1904' ? 'selected' :
                          ''}}>1904</option>
                        <option value="1903" {{date("Y", strtotime($friend->birthday)) == '1903' ? 'selected' :
                          ''}}>1903</option>
                        <option value="1902" {{date("Y", strtotime($friend->birthday)) == '1902' ? 'selected' :
                          ''}}>1901</option>
                        <option value="1901" {{date("Y", strtotime($friend->birthday)) == '1901' ? 'selected' :
                          ''}}>1901</option>
                        <option value="1900" {{date("Y", strtotime($friend->birthday)) == '1900' ? 'selected' :
                          ''}}>1900</option>
                      </select>
                    </div>
                    <div class="col-sm-4 col-3">
                      <label class="form-label mt-4">&nbsp;</label>
                      <select name="dob-month" id="dob-month" class="form-control">
                        <option value="" disabled>月</option>
                        <option value="" disabled>-----</option>
                        <option value="01" {{date("F", strtotime($friend->birthday)) == 'January' ? 'selected' : ''}}>01
                        </option>
                        <option value="02" {{date("F", strtotime($friend->birthday)) == 'February' ? 'selected' :
                          ''}}>02</option>
                        <option value="03" {{date("F", strtotime($friend->birthday)) == 'March' ? 'selected' : ''}}>03
                        </option>
                        <option value="04" {{date("F", strtotime($friend->birthday)) == 'April' ? 'selected' : ''}}>04
                        </option>
                        <option value="05" {{date("F", strtotime($friend->birthday)) == 'May' ? 'selected' : ''}}>05
                        </option>
                        <option value="06" {{date("F", strtotime($friend->birthday)) == 'June' ? 'selected' : ''}}>06
                        </option>
                        <option value="07" {{date("F", strtotime($friend->birthday)) == 'July' ? 'selected' : ''}}>07
                        </option>
                        <option value="08" {{date("F", strtotime($friend->birthday)) == 'August' ? 'selected' : ''}}>08
                        </option>
                        <option value="09" {{date("F", strtotime($friend->birthday)) == 'September' ? 'selected' :
                          ''}}>09</option>
                        <option value="10" {{date("F", strtotime($friend->birthday)) == 'October' ? 'selected' : ''}}>10
                        </option>
                        <option value="11" {{date("F", strtotime($friend->birthday)) == 'November' ? 'selected' :
                          ''}}>11</option>
                        <option value="12" {{date("F", strtotime($friend->birthday)) == 'December' ? 'selected' :
                          ''}}>12</option>
                      </select>
                    </div>
                    <div class="col-sm-3 col-4">
                      <label class="form-label mt-4">&nbsp;</label>
                      <select name="dob-day" id="dob-day" class="form-control">
                        <option value="" disabled>日</option>
                        <option value="" disabled>---</option>
                        <option value="01" {{date("d", strtotime($friend->birthday)) == '01' ? 'selected' : ''}}>01
                        </option>
                        <option value="02" {{date("d", strtotime($friend->birthday)) == '02' ? 'selected' : ''}}>02
                        </option>
                        <option value="03" {{date("d", strtotime($friend->birthday)) == '03' ? 'selected' : ''}}>03
                        </option>
                        <option value="04" {{date("d", strtotime($friend->birthday)) == '04' ? 'selected' : ''}}>04
                        </option>
                        <option value="05" {{date("d", strtotime($friend->birthday)) == '05' ? 'selected' : ''}}>05
                        </option>
                        <option value="06" {{date("d", strtotime($friend->birthday)) == '06' ? 'selected' : ''}}>06
                        </option>
                        <option value="07" {{date("d", strtotime($friend->birthday)) == '07' ? 'selected' : ''}}>07
                        </option>
                        <option value="08" {{date("d", strtotime($friend->birthday)) == '08' ? 'selected' : ''}}>08
                        </option>
                        <option value="09" {{date("d", strtotime($friend->birthday)) == '09' ? 'selected' : ''}}>09
                        </option>
                        <option value="10" {{date("d", strtotime($friend->birthday)) == '10' ? 'selected' : ''}}>10
                        </option>
                        <option value="11" {{date("d", strtotime($friend->birthday)) == '11' ? 'selected' : ''}}>11
                        </option>
                        <option value="12" {{date("d", strtotime($friend->birthday)) == '12' ? 'selected' : ''}}>12
                        </option>
                        <option value="13" {{date("d", strtotime($friend->birthday)) == '13' ? 'selected' : ''}}>13
                        </option>
                        <option value="14" {{date("d", strtotime($friend->birthday)) == '14' ? 'selected' : ''}}>14
                        </option>
                        <option value="15" {{date("d", strtotime($friend->birthday)) == '15' ? 'selected' : ''}}>15
                        </option>
                        <option value="16" {{date("d", strtotime($friend->birthday)) == '16' ? 'selected' : ''}}>16
                        </option>
                        <option value="17" {{date("d", strtotime($friend->birthday)) == '17' ? 'selected' : ''}}>17
                        </option>
                        <option value="18" {{date("d", strtotime($friend->birthday)) == '18' ? 'selected' : ''}}>18
                        </option>
                        <option value="19" {{date("d", strtotime($friend->birthday)) == '19' ? 'selected' : ''}}>19
                        </option>
                        <option value="20" {{date("d", strtotime($friend->birthday)) == '20' ? 'selected' : ''}}>20
                        </option>
                        <option value="21" {{date("d", strtotime($friend->birthday)) == '21' ? 'selected' : ''}}>21
                        </option>
                        <option value="22" {{date("d", strtotime($friend->birthday)) == '22' ? 'selected' : ''}}>22
                        </option>
                        <option value="23" {{date("d", strtotime($friend->birthday)) == '23' ? 'selected' : ''}}>23
                        </option>
                        <option value="24" {{date("d", strtotime($friend->birthday)) == '24' ? 'selected' : ''}}>24
                        </option>
                        <option value="25" {{date("d", strtotime($friend->birthday)) == '25' ? 'selected' : ''}}>25
                        </option>
                        <option value="26" {{date("d", strtotime($friend->birthday)) == '26' ? 'selected' : ''}}>26
                        </option>
                        <option value="27" {{date("d", strtotime($friend->birthday)) == '27' ? 'selected' : ''}}>27
                        </option>
                        <option value="28" {{date("d", strtotime($friend->birthday)) == '28' ? 'selected' : ''}}>28
                        </option>
                        <option value="29" {{date("d", strtotime($friend->birthday)) == '29' ? 'selected' : ''}}>29
                        </option>
                        <option value="30" {{date("d", strtotime($friend->birthday)) == '30' ? 'selected' : ''}}>30
                        </option>
                        <option value="31" {{date("d", strtotime($friend->birthday)) == '31' ? 'selected' : ''}}>31
                        </option>
                      </select>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label mt-4">郵便番号</label>
                  <div class="input-group">
                    <input id="location" name="postcode" class="form-control" type="text" placeholder="Sydney, A"
                      value="{{ $friend->postcode }}">
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label mt-4">電話番号</label>
                  <div class="input-group">
                    <input id="phone" name="phone" class="form-control" type="tel" placeholder="090-1234-5678"
                      value="{{ $friend->phone }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 align-self-center">
                  <label class="form-label mt-4">リッチメニュー</label>
                  <select class="form-control" name="choices-language" id="choices-language">
                    <option value="English">English</option>
                    <option value="French">French</option>
                    <option value="Spanish">Spanish</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label mt-4">タグ<span class="text-third">(Ctrlで複数選択可能)</span></label>
                  <select id="category" name="tags[]" multiple class="form-control">
                    @forelse ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @empty
                    <p>タグが登録されていません。</p>
                    @endforelse
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="button-row d-flex mt-4 col-12">
                  <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">保存</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Card Notifications -->
          <div class="card mt-4" id="notifications">
            <div class="card-header">
              <h5>Notifications</h5>
              <p class="text-sm">Choose how you receive notifications. These notification settings apply to the things
                you’re watching.</p>
            </div>
            <div class="card-body pt-0">
              <div class="table-responsive">
                <table class="table mb-0">
                  <thead>
                    <tr>
                      <th class="ps-1" colspan="4">
                        <p class="mb-0">Activity</p>
                      </th>
                      <th class="text-center">
                        <p class="mb-0">Email</p>
                      </th>
                      <th class="text-center">
                        <p class="mb-0">Push</p>
                      </th>
                      <th class="text-center">
                        <p class="mb-0">SMS</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="ps-1" colspan="4">
                        <div class="my-auto">
                          <span class="text-dark d-block text-sm">Mentions</span>
                          <span class="text-xs font-weight-normal">Notify when another user mentions you in a
                            comment</span>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault11">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault12">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault13">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="ps-1" colspan="4">
                        <div class="my-auto">
                          <span class="text-dark d-block text-sm">Comments</span>
                          <span class="text-xs font-weight-normal">Notify when another user comments your item.</span>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault14">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault15">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault16">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="ps-1" colspan="4">
                        <div class="my-auto">
                          <span class="text-dark d-block text-sm">Follows</span>
                          <span class="text-xs font-weight-normal">Notify when another user follows you.</span>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault17">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault18">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault19">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="ps-1" colspan="4">
                        <div class="my-auto">
                          <p class="text-sm mb-0">Log in from a new device</p>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault20">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault21">
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                          <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckDefault22">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="button-row d-flex mt-4 col-12">
                  <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">保存</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <!-- Card Sessions -->
        <div class="card mt-4" id="sessions">
          <div class="card-header pb-3">
            <h5>Sessions</h5>
            <p class="text-sm">This is a list of devices that have logged into your account. Remove those that you do
              not recognize.</p>
          </div>
          <div class="card-body pt-0">
            <div class="d-flex align-items-center">
              <div class="text-center w-5">
                <i class="fas fa-desktop text-lg opacity-6"></i>
              </div>
              <div class="my-auto ms-3">
                <div class="h-100">
                  <p class="text-sm mb-1">
                    Bucharest 68.133.163.201
                  </p>
                  <p class="mb-0 text-xs">
                    Your current session
                  </p>
                </div>
              </div>
              <span class="badge badge-success badge-sm my-auto ms-auto me-3">Active</span>
              <p class="text-secondary text-sm my-auto me-3">EU</p>
              <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
              </a>
            </div>
            <hr class="horizontal dark">
            <div class="d-flex align-items-center">
              <div class="text-center w-5">
                <i class="fas fa-desktop text-lg opacity-6"></i>
              </div>
              <p class="my-auto ms-3">Chrome on macOS</p>
              <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
              <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
              </a>
            </div>
            <hr class="horizontal dark">
            <div class="d-flex align-items-center">
              <div class="text-center w-5">
                <i class="fas fa-mobile text-lg opacity-6"></i>
              </div>
              <p class="my-auto ms-3">Safari on iPhone</p>
              <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
              <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Card Delete Account -->
        <div class="card mt-4" id="delete">
          <div class="card-header">
            <h5>Delete Account</h5>
            <p class="text-sm mb-0">削除された友達データは復元できませんのでご注意ください。</p>
          </div>
          <div class="card-body d-sm-flex pt-0">
            <div class="d-flex align-items-center mb-sm-0 mb-4">
              <div class="ms-2">
                <span class="text-dark font-weight-bold d-block text-sm">削除を確定</span>
                <span class="text-xs d-block">削除を確定するには「確定」ボタンを押してから削除してください。</span>
              </div>
            </div>

            <form class='ms-auto'
              action="{{  route('friends.destroy', ['aid' => $account->id,'friend'=>$friend->id])  }}" method="POST">
              @csrf
              @method('delete')
              <button class="confirm-delete btn btn-outline-secondary mb-0 ms-auto" type="button"
                name="button">確定</button>
              <button class="confirm-delete-btn btn bg-gradient-danger mb-0 ms-2" type="submit" name="button" disabled>
                削除
              </button>
            </form>
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
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
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

    let editDeleteBtn = document.querySelector('.confirm-delete');
    let editDelete = document.querySelector('.confirm-delete-btn');
    editDeleteBtn.addEventListener('click', event => {
      editDelete.toggleAttribute("disabled");
    });

    // let editTokenBtn = document.querySelector('.edit-token');
    // let editToken = document.querySelectorAll('.edit-token-show');
    // editTokenBtn.addEventListener('click', event => {
    //     for (var i = 0; i < editToken.length; i++) {
    //         editToken[i].toggleAttribute("readonly");
    //     }
    // });

    // let editLiffBtn = document.querySelector('.edit-liff');
    // let editLiff = document.querySelectorAll('.edit-liff-show');
    // editLiffBtn.addEventListener('click', event => {
    //     for (var i = 0; i < editLiff.length; i++) {
    //         editLiff[i].toggleAttribute("readonly");
    //     }
    // });

    const dateHidden = document.querySelector('#birth-date');
    if (dateHidden.value !== "1970-01-01") {
    const [yyyy,mm,dd] = dateHidden.split("-");
    document.getElementById("dob-year").value=yyyy;
    document.getElementById("dob-month").value=mm;
    document.getElementById("dob-day").value=dd;
    } else {
    document.getElementById("dob-year").value=null;
    document.getElementById("dob-month").value=null;
    document.getElementById("dob-day").value=null;
    }

  </script>
  <script>
    if (document.getElementById('choices-gender')) {
    var gender = document.getElementById('choices-gender');
    const example = new Choices(gender);
  }

  if (document.getElementById('choices-language')) {
    var language = document.getElementById('choices-language');
    const example = new Choices(language);
  }

  if (document.getElementById('choices-skills')) {
    var skills = document.getElementById('choices-skills');
    const example = new Choices(skills, {
      delimiter: ',',
      editItems: true,
      maxItemCount: 5,
      removeItemButton: true,
      addItems: true
    });
  }

  if (document.getElementById('choices-year')) {
    var year = document.getElementById('choices-year');
    setTimeout(function() {
      const example = new Choices(year);
    }, 1);

    for (y = 1900; y <= 2020; y++) {
      var optn = document.createElement("OPTION");
      optn.text = y;
      optn.value = y;

      if (y == 2020) {
        optn.selected = true;
      }

      year.options.add(optn);
    }
  }

  if (document.getElementById('choices-day')) {
    var day = document.getElementById('choices-day');
    setTimeout(function() {
      const example = new Choices(day);
    }, 1);


    for (y = 1; y <= 31; y++) {
      var optn = document.createElement("OPTION");
      optn.text = y;
      optn.value = y;

      if (y == 1) {
        optn.selected = true;
      }

      day.options.add(optn);
    }

  }

  if (document.getElementById('choices-month')) {
    var month = document.getElementById('choices-month');
    setTimeout(function() {
      const example = new Choices(month);
    }, 1);

    var d = new Date();
    var monthArray = new Array();
    monthArray[0] = "January";
    monthArray[1] = "February";
    monthArray[2] = "March";
    monthArray[3] = "April";
    monthArray[4] = "May";
    monthArray[5] = "June";
    monthArray[6] = "July";
    monthArray[7] = "August";
    monthArray[8] = "September";
    monthArray[9] = "October";
    monthArray[10] = "November";
    monthArray[11] = "December";
    for (m = 0; m <= 11; m++) {
      var optn = document.createElement("OPTION");
      optn.text = monthArray[m];
      // server side month start from one
      optn.value = (m + 1);
      // if june selected
      if (m == 1) {
        optn.selected = true;
      }
      month.options.add(optn);
    }
  }

  function visible() {
    var elem = document.getElementById('profileVisibility');
    if (elem) {
      if (elem.innerHTML == "Switch to visible") {
        elem.innerHTML = "Switch to invisible"
      } else {
        elem.innerHTML = "Switch to visible"
      }
    }
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.0') }}"></script>
  @endsection