@extends('template.layouts.auth-layout')
@section('page_title')
    Login
@endsection

@section('main_content')
    <div class="row no-gutters">
        <div class="col-xl-12">
            <div class="auth-form">
                <div class="text-center mb-3">
                    <img src="{{ asset('images/site/icon/icon.png') }}" alt="logo">
                </div>
                <h4 class="text-center mb-4 heading">Login to your account</h4>
                <form method="POST" action="{{ route('login-store') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="mb-1 label"><strong>Username</strong></label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                                autocomplete="off">
                        </div>
                        <div class="form-group col-12">
                            <label class="mb-1 label">
                                <strong>Password</strong>
                            </label>
                            <input id="pwdField" required type="password" class="form-control password-field passwordInput"
                                name="password" autocomplete="off">
                            <span class="togglePasswordInput password-eye-icon">
                                <i class="fa-solid fa-eye-slash "></i>
                            </span>
                        </div>
                        <div class="form-group col-12">
                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox ml-1">
                                        <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
                                        <label class="pl-2 custom-control-label" for="basic_checkbox_1">
                                            <small>Remember Me</small>
                                        </label>
                                    </div>
                                </div>
                                @if (Route::has('custom.forgot.password'))
                                <div class="form-group">
                                    <a href="{{ route('custom.forgot.password') }}"><small>Forgot Password?</small></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="new-account mt-3">
                    <p><small>Don't have an account? </small><a class="text-primary"
                            href="{{ route('register') }}"><small><u>Register</u></small></a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        const passwordInput = document.querySelectorAll('.passwordInput');
        const togglePasswordInput = document.querySelectorAll('.togglePasswordInput');


        togglePasswordInput.forEach((item, index) => {
            item.addEventListener('click', () => {
                if (passwordInput[index].type === 'password') {
                    passwordInput[index].type = 'text';
                    togglePasswordInput[index].innerHTML = '<i class="fa-solid fa-eye "></i>';
                } else {
                    passwordInput[index].type = 'password';
                    togglePasswordInput[index].innerHTML =
                        '<i class="fa-solid fa-eye-slash "></i>';
                }
            })
        })
    </script>
@endsection
