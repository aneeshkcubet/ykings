<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- end of global level css -->
    <!-- page level css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login.css') }}" />
    <!-- end of page level css -->

</head>

<body>
    <div class="container">
        <div class="row vertical-offset-100">
            <!-- Notifications -->
      
            <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
                <div id="container_demo">
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <a class="hiddenanchor" id="toforgot"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form action="" autocomplete="on" method="post" role="form">
                                <h3 class="black_bg">
                                    <!--<img src="{{ asset('assets/img/logo.png') }}" alt="josh logo">-->
                                    <br>Log in</h3>
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                    <label style="margin-bottom:0px;" for="email" class="uname control-label"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                        E-mail
                                    </label>
<!--                                    <input id="email" name="email" required type="email" placeholder="E-mail" value="{!! Input::old('email') !!}" />-->
                                    <input id="email" name="email" required type="email" placeholder="E-mail" value="admin@admin.com" />
                                    <div class="col-sm-12">
                                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                    <label style="margin-bottom:0px;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                        Password
                                    </label>
                                    <input id="password" name="password" required type="password"  value="admin"/>
                                    <div class="col-sm-12">
                                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <p class="keeplogin">
                                    <input type="checkbox" name="remember-me" id="remember-me" value="remember-me" />
                                    <label for="remember-me">Keep me logged in</label>
                                </p>
                                <p class="login button">
                                    <input type="submit" value="Login" class="btn btn-success" />
                                </p>
                               
                            </form>
                        </div>
                                              
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- global js -->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{ asset('vendors/livicons/minified/raphael-min.js') }}"></script>
    <script src="{{ asset('vendors/livicons/minified/livicons-1.4.min.js') }}"></script>
    <!-- end of global js -->
</body>
</html>