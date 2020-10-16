@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('auth.login')</div>

                <div class="card-body">
                    <form method="post" action="{{ route('login') }}">
                        @csrf

                         <!-- EMAIL-->
                            <div class="form-group">
                                <label>@lang('site.email') :</label>
                            
                                <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-google"></i>
                                </div>
                                
                                <input type="email" class="form-control @error('email') is-invalid @enderror " name="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            
                            
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                         <!-- PASSWORD  -->
                            <div class="form-group">
                                <label>@lang('site.password') :</label>

                                <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-eye-slash show-pass"></i>
                                </div>
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->



                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.login')
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        @lang('auth.Forgot Your Password ?')
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
