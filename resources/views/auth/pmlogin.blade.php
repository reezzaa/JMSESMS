<!DOCTYPE html>
<html>
    @include('layouts.app')
    <body>
        {!!Html::image("img/login_bg.png")!!}

        <!-- <img src="img/login_bg.png" alt="Login Full Background" class="full-bg animation-pulseSlow"> -->
        <div id="login-container" class="animation-fadeIn">
            <div class="login-title text-center">
                <h1> <strong>JMSESMS</strong><br><br> <strong>Login as PROJECT MANAGER</strong></h1>
                
              <form class="form-horizontal form-borderless" method="POST" id="form-login" action="{{ route('pm.login.submit') }}">
                        {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                <input id="email" type="email" class="form-control input-lg" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!-- <label for="password" class="col-md-4 control-label">Password</label> -->
                         <div class="col-xs-12">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input id="password" type="password" class="form-control input-lg" placeholder="Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 ">
                                <div class="col-xs-4 checkbox">
                                    <label class="switch switch-primary" data-toggle="tooltip" title="Remember Me?">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span></span>
                                    </label>

                                </div>
                                 <div class="col-xs-8">
                                     <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                                <!-- <div class="checkbox">

                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div> -->
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div> -->
                    </form>
            </div>
        </div>

    </body>
</html>     