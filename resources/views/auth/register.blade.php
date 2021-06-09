
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(3233,$translate) }} - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
{!! NoCaptcha::renderJs() !!}
</head>
<body>

<nav class="text-center mt-4">
  <a href="{{ url('/') }}" class="navbar-brand m-0 p-0">
      <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" height="28" alt="Rvybe" style="width: 150px;"> 
  </a>
</nav>

<!-- <section class="bg-position-center-top" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(3233,$translate) }}</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(3233,$translate) }}</h1>
        </div>
      </div>
      </div>
    </section> -->
<div class="container my-4">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card border-0 box-shadow">
            <div class="card-body">
              <h2 class="h4 mb-3">{{ Helper::translation(3234,$translate) }}</h2>
              @if($allsettings->display_social_login == 1)
              <div class="py-3">
                <h3 class="d-inline-block align-middle font-size-base font-weight-semibold mb-2 mr-2">{{ Helper::translation(4869,$translate) }}:</h3>
                <div class="d-inline-block align-middle">
                <a class="social-btn sb-google mr-2 mb-2" href="{{ url('/login/google') }}" data-toggle="tooltip" title="Sign in with Google"><i class="dwg-google"></i></a>
                <a class="social-btn sb-facebook mr-2 mb-2" href="{{ url('/login/facebook') }}" data-toggle="tooltip" title="Sign in with Facebook"><i class="dwg-facebook"></i></a>
                </div>
              </div>
              <hr>
              <h3 class="font-size-base pt-4 pb-2">{{ trans('labels.orUsingRegisterFormBelow') }}</h3>
              @endif
              
              <p class="font-size-sm text-muted mb-4">{{ Helper::translation(3236,$translate) }}</p>
              <form method="POST" action="{{ route('register') }}" id="login_form" class="needs-validation" novalidate>
                @csrf
                <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(3237,$translate) }} <span class="required">*</span></label>
                  <input id="name" type="text" class="form-control" name="name" placeholder="{{ Helper::translation(3238,$translate) }}" value="{{ old('name') }}" data-bvalidator="required" autocomplete="name" autofocus>    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                       @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ln">{{ Helper::translation(3111,$translate) }} <span class="required">*</span></label>
                  <input id="username" type="text" name="username" class="form-control" placeholder="{{ Helper::translation(3239,$translate) }}" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email">{{ Helper::translation(3240,$translate) }} <span class="required">*</span></label>
                  <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ Helper::translation(3241,$translate) }}"  autocomplete="email" data-bvalidator="email,required">
                         @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-pass">{{ Helper::translation(3113,$translate) }} <span class="required">*</span></label>
                  <div class="password-toggle">
                    <input id="password" type="password" class="form-control" name="password" placeholder="{{ Helper::translation(3242,$translate) }}" autocomplete="new-password" data-bvalidator="required">@error('password')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only">{{ Helper::translation(4866,$translate) }}</span>
                    </label>
                  </div>
                </div>
              </div>
              <input type="hidden" name="user_type" value="customer">
              <div class="col-sm-6">
               <div class="form-group">
                <label for="email_ad">{{ Helper::translation(4827,$translate) }} <span class="required">*</span></label>
                 <select id="user_type" class="form-control" name="user_type" data-bvalidator="required">
                 <option value=""></option>
                 <option value="{{ $encrypter->encrypt('customer') }}">{{ Helper::translation(4830,$translate) }}</option>
                 <option value="{{ $encrypter->encrypt('vendor') }}">{{ Helper::translation(3142,$translate) }}</option>
                </select>
                </div>
             </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-confirm-pass">{{ Helper::translation(3114,$translate) }} <span class="required">*</span></label>
                  <div class="password-toggle">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ Helper::translation(3243,$translate) }}" data-bvalidator="equal[password],required" autocomplete="new-password">
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only">{{ Helper::translation(4866,$translate) }}</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
              <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                <label>{{ Helper::translation(3244,$translate) }} <span class="required">*</span></label>
                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                 <strong class="red">{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                     @endif
              </div>
              </div>
              <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <div class="custom-checkbox d-block">
                    <a href="{{ URL::to('/login') }}" class="nav-link-inline font-size-sm">{{ Helper::translation(3245,$translate) }} {{ Helper::translation(3225,$translate) }}</a>
                  </div>
                  <button class="btn btn-primary mt-3 mt-sm-0" type="submit">{{ Helper::translation(3233,$translate) }}</button>
                </div>
              </div>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

@include('script')
</body>
</html>
