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
                  <small id="isBlackList">
                    {{$friend->isBlackListed == true ? 'ブラックリストに追加済み' : 'ブラックリストに追加する'}}
                  </small>
                </label>
                <div class="form-check form-switch ms-2">
                  <input name="isBlackListed" class="form-check-input" type="checkbox" id="checkBoxBlack"
                    onchange="visible()" {{$friend->isBlackListed == true ? 'checked' : ''}} >
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
                      <input type="text" name="" id="birth-date" value="{{ $friend->birthday }}" hidden >
                      <select name="dob-year" id="dob-year" class="form-control">
                        <option value="" disabled>年</option>
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
                      <select name="dob-month" id="dob-month" class="form-control">
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
                      <select name="dob-day" id="dob-day" class="form-control">
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
                <div class="col-md-4">
                  <label class="form-label mt-4">非公開タグ<span class="text-third">(Ctrlで複数選択可能)</span></label>                  
                  <select id="tags" name="tags[]" multiple class="form-control">
                    @forelse ($tags as $tag)
                    <option value="{{ $tag->id }}" {{$friend->tags->contains('id', $tag->id)  ? 'selected' : ''}}>{{ $tag->name }}</option>
                    @empty
                    <p>非公開タグが登録されていません。</p>
                    @endforelse
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label mt-4">公開タグ<span class="text-third">(1つのみ選択可)</span></label>                  
                  <select id="tags" name="tags[]" class="form-control">
                    @forelse ($tagsPublic as $tag)
                    <option value="{{ $tag->id }}" {{$friend->tags->contains('id', $tag->id)  ? 'selected' : ''}}>{{ $tag->name }}</option>
                    @empty
                    <p>公開タグが登録されていません。</p>
                    @endforelse
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label mt-4">リッチメニュー</label>
                  <select class="form-control" name="choices-language" id="choices-language">
                    <option value="English">English</option>
                    <option value="French">French</option>
                    <option value="Spanish">Spanish</option>
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
                name="button">確定
              </button>
              <button onclick="confirmDelete()" class="confirm-delete-btn btn bg-gradient-danger mb-0 ms-2" type="button" name="button" disabled>
                削除
              </button>
              <button id="deleteBtn" class="btn bg-gradient-danger mb-0 ms-2" type="submit" name="button" hidden>
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

    let dateHidden = document.querySelector('#birth-date');
    if (dateHidden.value != null) {
    const [yyyy,mm,dd] = dateHidden.value.split("-");
    document.getElementById("dob-year").value=yyyy;
    document.getElementById("dob-month").value=mm;
    document.getElementById("dob-day").value=dd;
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
    var elem = document.getElementById('isBlackList');
    var inputBlack = document.getElementById('checkBoxBlack');

    if (inputBlack.checked) {
      elem.innerHTML = "ブラックリストに追加済み"
      console.log("checked");
    } else {
      elem.innerHTML = "ブラックリストに追加する"
      console.log("not checked");
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
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.0') }}"></script>
  @endsection