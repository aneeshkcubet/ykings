@extends('auth.auth')

@section('htmlheader_title')
Register
@endsection

@section('content')

<body class="register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/home') }}"><b>Admin</b>LTE</a>
        </div>

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>
            <form action="{{ url('/auth/register') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="First name" name="first_name" value="{{ old('first_name') }}"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{ old('last_name') }}"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <select name="gender" class="form-control">
                        <option value="">Select gender</option>
                        <option value="2">Female</option>
                        <option value="1">Male</option>                        
                    </select>                
                </div>
                <div class="form-group has-feedback">
                    <select name="fitness_status" class="form-control">
                        <option value="">Select your fitness status</option>
                        <option value="1">I am definitely fit</option>
                        <option value="2">I am quite fit</option>
                        <option value="3">I am not so fit</option>                        
                    </select>                    
                </div>
                <div class="form-group has-feedback">
                    <select name="goal" class="form-control">
                        <option value="">Select your goal</option>
                        <option value="1">Get lean</option>
                        <option value="2">Get fit</option>
                        <option value="3">Get strong</option>                        
                    </select>                    
                </div>
                
                <div class="form-group has-feedback">
                    <div class="col-xs-4">
                        User image                    
                    </div>
                    <div class="col-xs-8">
                        <input type="file" name="image"/>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="About you" name="quote" value="{{ old('quote') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
            </div>

            <a href="{{ url('/auth/login') }}" class="text-center">I already have a membership</a>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    @include('auth.scripts')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
